<?php

namespace Tests\Feature;

use App\Mail\NewRegistrationNotification;
use App\Mail\RegistrationConfirmation;
use App\Models\Registration;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_is_stored(): void
    {
        Storage::fake();
        Mail::fake();
        config()->set('apsn.admin.email', 'admin@example.com');

        $response = $this->post(route('register.store'), [
            'submission_token' => '11111111-1111-4111-8111-111111111111',
            'title' => 'Dr.',
            'full_name' => 'Tran Van An',
            'gender' => 'Male',
            'date_of_birth' => '1985-03-02',
            'economy' => 'Singapore',
            'organization' => 'Port Authority',
            'position' => 'Director',
            'attending_as' => 'Council member',
            'nationality' => 'Singapore',
            'passport_type' => 'Diplomatic Passport',
            'passport_number' => 'E998877',
            'passport_expiry' => '2031-06-01',
            'passport_copy' => UploadedFile::fake()->create('passport.pdf', 120, 'application/pdf'),
            'visa_status' => 'Will apply for e-visa',
            'visa_email' => 'visa@example.com',
            'sessions' => [
                'forum' => 'Yes',
                'technical_visit' => 'Yes',
                'council' => 'Yes',
                'welcome_dinner' => 'No',
                'council_dinner' => 'Yes',
            ],
            'email' => 'an@example.com',
            'phone' => '+6590000000',
            'dietary' => 'Halal',
            'accessibility' => 'None',
            'consent' => '1',
        ]);

        $response->assertRedirect(route('register.thanks'));
        $this->assertSame(1, Registration::count());
        $this->assertSame('Tran Van An', Registration::first()->full_name);
        $this->assertSame('visa@example.com', Registration::first()->visa_email);
        Storage::assertExists(Registration::first()->passport_copy_path);
        Mail::assertSent(RegistrationConfirmation::class, function (RegistrationConfirmation $mail): bool {
            $rendered = $mail->render();

            return str_contains($rendered, 'Your registration has been received')
                && str_contains($rendered, 'Registration ID:')
                && str_contains($rendered, 'Rex Hotel Saigon')
                && str_contains($rendered, 'Tran Van An')
                && str_contains($rendered, 'Economy:')
                && ! str_contains($rendered, 'Country:')
                && ! str_contains($rendered, '**Event:**')
                && ! str_contains($rendered, '&lt;br&gt;');
        });
        Mail::assertSent(NewRegistrationNotification::class, 'admin@example.com');
    }

    public function test_e_visa_email_is_required_for_e_visa_applicants(): void
    {
        $response = $this->post(route('register.store'), [
            'visa_status' => 'Will apply for e-visa',
        ]);

        $response->assertSessionHasErrors('visa_email');
        $this->assertSame(0, Registration::count());
    }

    public function test_registration_can_be_stored_without_a_passport_copy(): void
    {
        Mail::fake();

        $response = $this->post(route('register.store'), [
            'submission_token' => '22222222-2222-4222-8222-222222222222',
            'title' => 'Dr.',
            'full_name' => 'Tran Van An',
            'gender' => 'Male',
            'date_of_birth' => '1985-03-02',
            'economy' => 'Singapore',
            'organization' => 'Port Authority',
            'position' => 'Director',
            'attending_as' => 'Council member',
            'nationality' => 'Singapore',
            'passport_type' => 'Diplomatic Passport',
            'passport_number' => 'E998877',
            'passport_expiry' => '2031-06-01',
            'visa_status' => 'Visa-exempt',
            'sessions' => [
                'forum' => 'Yes',
                'technical_visit' => 'No',
                'council' => 'Yes',
                'welcome_dinner' => 'No',
                'council_dinner' => 'Yes',
            ],
            'email' => 'an@example.com',
            'phone' => '+6590000000',
            'dietary' => 'Halal',
            'accessibility' => 'None',
            'consent' => '1',
        ]);

        $response->assertRedirect(route('register.thanks'));
        $this->assertDatabaseHas('registrations', [
            'email' => 'an@example.com',
            'passport_copy_path' => null,
        ]);
        Mail::assertSent(RegistrationConfirmation::class);
    }

    public function test_duplicate_submission_creates_one_registration_and_sends_one_set_of_emails(): void
    {
        Storage::fake();
        Mail::fake();
        config()->set('apsn.admin.email', 'admin@example.com');
        $data = [
            'submission_token' => '33333333-3333-4333-8333-333333333333',
            'title' => 'Dr.',
            'full_name' => 'Tran Van An',
            'gender' => 'Male',
            'date_of_birth' => '1985-03-02',
            'economy' => 'Singapore',
            'organization' => 'Port Authority',
            'position' => 'Director',
            'attending_as' => 'Council member',
            'nationality' => 'Singapore',
            'passport_type' => 'Diplomatic Passport',
            'passport_number' => 'E998877',
            'passport_expiry' => '2031-06-01',
            'visa_status' => 'Visa-exempt',
            'sessions' => [
                'forum' => 'Yes',
                'technical_visit' => 'No',
                'council' => 'Yes',
                'welcome_dinner' => 'No',
                'council_dinner' => 'Yes',
            ],
            'email' => 'an@example.com',
            'phone' => '+6590000000',
            'dietary' => 'Halal',
            'accessibility' => 'None',
            'consent' => '1',
        ];

        $firstResponse = $this->post(route('register.store'), [
            ...$data,
            'passport_copy' => UploadedFile::fake()->create('passport.pdf', 120, 'application/pdf'),
        ]);
        $duplicateResponse = $this->post(route('register.store'), [
            ...$data,
            'passport_copy' => UploadedFile::fake()->create('passport.pdf', 120, 'application/pdf'),
        ]);

        $firstResponse->assertRedirect(route('register.thanks'));
        $duplicateResponse->assertRedirect(route('register.thanks'));
        $this->assertSame(1, Registration::query()->count());
        $this->assertCount(1, Storage::allFiles('passports'));
        Mail::assertSent(RegistrationConfirmation::class, 1);
        Mail::assertSent(NewRegistrationNotification::class, 1);
    }

    public function test_content_pages_load(): void
    {
        $this->get(route('register'))
            ->assertOk()
            ->assertSee('APSN Forum 2026')
            ->assertSee('APSN');
        $this->get(route('register.thanks'))->assertOk()->assertSee('Your registration has been received');
        $this->get(route('ho-chi-minh'))->assertOk()->assertSee('Thành phố Hồ Chí Minh');
        $this->get(route('rex'))->assertOk()->assertSee('Presidential Suite');
        $this->get(route('satellite'))->assertOk()->assertSee('Saigon Prince Hotel');
    }
}
