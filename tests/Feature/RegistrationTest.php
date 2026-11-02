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
            'title' => 'Dr.',
            'full_name' => 'Tran Van An',
            'gender' => 'Male',
            'date_of_birth' => '1985-03-02',
            'economy' => 'Singapore',
            'organization' => 'Port Authority',
            'position' => 'Director',
            'attending_as' => 'Council member',
            'nationality' => 'Singaporean',
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
                && str_contains($rendered, 'Registration ID.:')
                && str_contains($rendered, 'Rex Hotel Saigon')
                && str_contains($rendered, 'Tran Van An');
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

    public function test_content_pages_load(): void
    {
        $this->get(route('register'))->assertOk()->assertSee('APSN Forum 2026');
        $this->get(route('register.thanks'))->assertOk()->assertSee('Your registration has been received');
        $this->get(route('ho-chi-minh'))->assertOk()->assertSee('Thành phố Hồ Chí Minh');
        $this->get(route('rex'))->assertOk()->assertSee('Presidential Suite');
        $this->get(route('satellite'))->assertOk()->assertSee('Saigon Prince Hotel');
    }
}
