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

    public function test_admin_root_url_redirects_to_registrations(): void
    {
        $response = $this->get('/admin');

        $response->assertRedirect('/admin/registrations');
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

    public function test_passport_download_is_unavailable_when_registration_has_no_passport_copy(): void
    {
        Storage::fake();
        $registration = Registration::factory()->create([
            'passport_copy_path' => null,
        ]);

        $this->withSession(['admin_authenticated' => true])
            ->get(route('admin.registrations.show', $registration))
            ->assertOk()
            ->assertDontSee('Download Passport');

        $this->withSession(['admin_authenticated' => true])
            ->get(route('admin.registrations.passport', $registration))
            ->assertNotFound();
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

    public function test_unauthenticated_user_cannot_delete_registration(): void
    {
        $registration = Registration::factory()->create();

        $response = $this->delete(route('admin.registrations.destroy', $registration));

        $response->assertRedirect(route('admin.login'));
        $this->assertDatabaseHas('registrations', ['id' => $registration->id]);
    }

    public function test_authenticated_admin_can_delete_registration_and_removes_passport_file(): void
    {
        Storage::fake();
        Storage::put('passports/passport-to-delete.pdf', 'test-content');

        $registration = Registration::factory()->create([
            'full_name' => 'John Doe',
            'passport_copy_path' => 'passports/passport-to-delete.pdf',
        ]);

        $response = $this->withSession(['admin_authenticated' => true])
            ->delete(route('admin.registrations.destroy', $registration));

        $response->assertRedirect(route('admin.registrations.index'));
        $response->assertSessionHas('status');

        $this->assertDatabaseMissing('registrations', ['id' => $registration->id]);
        Storage::assertMissing('passports/passport-to-delete.pdf');
    }

    public function test_authenticated_admin_can_bulk_delete_registrations(): void
    {
        Storage::fake();
        Storage::put('passports/doc1.pdf', 'doc1');
        Storage::put('passports/doc2.pdf', 'doc2');

        $reg1 = Registration::factory()->create(['passport_copy_path' => 'passports/doc1.pdf']);
        $reg2 = Registration::factory()->create(['passport_copy_path' => 'passports/doc2.pdf']);
        $reg3 = Registration::factory()->create();

        $response = $this->withSession(['admin_authenticated' => true])
            ->delete(route('admin.registrations.bulk-destroy'), [
                'ids' => [$reg1->id, $reg2->id],
            ]);

        $response->assertRedirect(route('admin.registrations.index'));
        $response->assertSessionHas('status', '2 registration(s) deleted successfully.');

        $this->assertDatabaseMissing('registrations', ['id' => $reg1->id]);
        $this->assertDatabaseMissing('registrations', ['id' => $reg2->id]);
        $this->assertDatabaseHas('registrations', ['id' => $reg3->id]);

        Storage::assertMissing('passports/doc1.pdf');
        Storage::assertMissing('passports/doc2.pdf');
    }

    public function test_bulk_delete_validates_ids_presence(): void
    {
        $response = $this->withSession(['admin_authenticated' => true])
            ->delete(route('admin.registrations.bulk-destroy'), [
                'ids' => [],
            ]);

        $response->assertSessionHasErrors('ids');
    }
}
