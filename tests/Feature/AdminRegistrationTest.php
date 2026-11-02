<?php

namespace Tests\Feature;

use App\Models\Registration;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminRegistrationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        config()->set('apsn.admin.username', 'admin');
        config()->set('apsn.admin.password', 'secret');
    }

    public function test_unauthenticated_admin_is_redirected_to_login_page(): void
    {
        $response = $this->get(route('admin.registrations.index'));

        $response->assertRedirect(route('admin.login'));
    }

    public function test_admin_api_request_returns_unauthorized_header(): void
    {
        $response = $this->getJson(route('admin.registrations.index'));

        $response->assertUnauthorized();
        $response->assertHeader('WWW-Authenticate');
    }

    public function test_admin_login_page_loads(): void
    {
        $response = $this->get(route('admin.login'));

        $response->assertOk();
        $response->assertSee('Admin Sign In');
        $response->assertSee('Registration Management Portal');
    }

    public function test_admin_can_login_with_valid_credentials(): void
    {
        $response = $this->post(route('admin.login.store'), [
            'username' => 'admin',
            'password' => 'secret',
        ]);

        $response->assertRedirect(route('admin.registrations.index'));
        $this->assertTrue(session('admin_authenticated'));
    }

    public function test_admin_cannot_login_with_invalid_credentials(): void
    {
        $response = $this->from(route('admin.login'))->post(route('admin.login.store'), [
            'username' => 'admin',
            'password' => 'wrong-password',
        ]);

        $response->assertRedirect(route('admin.login'));
        $response->assertSessionHasErrors('username');
        $this->assertNull(session('admin_authenticated'));
    }

    public function test_admin_can_logout(): void
    {
        $this->withSession(['admin_authenticated' => true]);

        $response = $this->post(route('admin.logout'));

        $response->assertRedirect(route('admin.login'));
        $this->assertNull(session('admin_authenticated'));
    }

    public function test_authenticated_admin_can_view_registrations(): void
    {
        $registration = Registration::factory()->create([
            'full_name' => 'Alex Delegate',
            'email' => 'alex@example.com',
        ]);

        $response = $this->withSession(['admin_authenticated' => true])
            ->get(route('admin.registrations.index'));

        $response->assertOk();
        $response->assertSee($registration->full_name);
        $response->assertSee($registration->email);
        $response->assertHeader('Cache-Control', 'no-store, private');
    }

    public function test_authenticated_admin_can_view_details_and_download_passport(): void
    {
        Storage::fake();
        Storage::put('passports/delegate.pdf', 'passport contents');
        $registration = Registration::factory()->create([
            'full_name' => 'Alex Delegate',
            'passport_copy_path' => 'passports/delegate.pdf',
        ]);

        $this->withSession(['admin_authenticated' => true])
            ->get(route('admin.registrations.show', $registration))
            ->assertOk()
            ->assertSee('Alex Delegate');

        $this->withSession(['admin_authenticated' => true])
            ->get(route('admin.registrations.passport', $registration))
            ->assertOk()
            ->assertDownload("passport-{$registration->id}.pdf");
    }

    public function test_authenticated_admin_can_export_registrations_to_csv(): void
    {
        Registration::factory()->create([
            'full_name' => '=Dangerous Formula',
            'email' => 'delegate@example.com',
        ]);

        $response = $this->withSession(['admin_authenticated' => true])
            ->get(route('admin.registrations.export'));

        $response->assertOk();
        $response->assertDownload('apsn-registrations-'.now()->format('Y-m-d').'.csv');
        $this->assertStringContainsString("'=Dangerous Formula", $response->streamedContent());
        $this->assertStringContainsString('delegate@example.com', $response->streamedContent());
    }
}
