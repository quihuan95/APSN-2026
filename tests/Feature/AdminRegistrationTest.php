<?php

namespace Tests\Feature;

use App\Models\Registration;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\IOFactory;
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

    public function test_authenticated_admin_can_export_registrations_to_excel_with_passport_hyperlink(): void
    {
        config()->set('app.url', 'https://apsn.test');

        $registration = Registration::factory()->create([
            'full_name' => '=Dangerous Formula',
            'email' => 'delegate@example.com',
            'passport_copy_path' => 'passports/delegate.pdf',
        ]);

        $response = $this->withSession(['admin_authenticated' => true])
            ->get(route('admin.registrations.export'));

        $response->assertOk();
        $response->assertDownload('apsn-registrations-'.now()->format('Y-m-d').'.xlsx');

        $spreadsheet = IOFactory::load($response->baseResponse->getFile()->getPathname());
        $sheet = $spreadsheet->getActiveSheet();

        $this->assertSame('Passport Copy', $sheet->getCell('O1')->getValue());
        $this->assertSame('Open Passport', $sheet->getCell('O2')->getValue());
        $this->assertSame(
            'https://apsn.test'.route('admin.registrations.passport', $registration, absolute: false),
            $sheet->getCell('O2')->getHyperlink()->getUrl(),
        );
        $this->assertSame('=Dangerous Formula', $sheet->getCell('C2')->getValue());
        $this->assertSame(DataType::TYPE_STRING, $sheet->getCell('C2')->getDataType());
        $this->assertSame('delegate@example.com', $sheet->getCell('X2')->getValue());
        $this->assertSame('Registration Type', $sheet->getCell('AB1')->getValue());
        $this->assertSame('Delegate', $sheet->getCell('AB2')->getValue());
    }

    public function test_admin_lists_shows_and_exports_an_invited_guest_without_delegate_fields(): void
    {
        $registration = Registration::factory()->create([
            'is_invited' => true,
            'full_name' => 'Le Thi Guest',
            'email' => 'guest@example.com',
            'organization' => 'Host Secretariat',
            'economy' => null,
            'attending_as' => null,
            'nationality' => null,
            'passport_type' => null,
            'passport_number' => null,
            'passport_expiry' => null,
            'passport_copy_path' => null,
            'visa_status' => null,
            'visa_email' => null,
            'arrival_at' => null,
            'arrival_flight' => null,
            'departure_at' => null,
            'departure_flight' => null,
            'hotel_name' => null,
            'sessions' => [
                'forum' => 'Yes',
                'technical_visit' => 'No',
                'council' => 'No',
                'welcome_dinner' => 'No',
                'council_dinner' => 'Yes',
            ],
        ]);

        $this->withSession(['admin_authenticated' => true])
            ->get(route('admin.registrations.index'))
            ->assertOk()
            ->assertSee('Le Thi Guest')
            ->assertSee('Invited guest')
            ->assertSee('Host Secretariat');

        $this->withSession(['admin_authenticated' => true])
            ->get(route('admin.registrations.show', $registration))
            ->assertOk()
            ->assertSee('Invited guest')
            ->assertSee('Technical Visit (16 Dec)')
            ->assertSee('APSN Council Meeting 2026 (16 - 17 Dec) - Council members only')
            ->assertDontSee('Download Passport');

        $response = $this->withSession(['admin_authenticated' => true])
            ->get(route('admin.registrations.export'));

        $response->assertOk();
        $sheet = IOFactory::load($response->baseResponse->getFile()->getPathname())->getActiveSheet();

        $this->assertSame('Registration Type', $sheet->getCell('AB1')->getValue());
        $this->assertSame('Invited guest', $sheet->getCell('AB2')->getValue());
        $this->assertSame('Le Thi Guest', $sheet->getCell('C2')->getValue());
        $this->assertNull($sheet->getCell('G2')->getValue());
        $this->assertNull($sheet->getCell('J2')->getValue());
        $this->assertNull($sheet->getCell('O2')->getValue());
        $this->assertSame('forum; council_dinner', $sheet->getCell('R2')->getValue());
        $this->assertNull($sheet->getCell('T2')->getValue());
        $this->assertSame('guest@example.com', $sheet->getCell('X2')->getValue());
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
