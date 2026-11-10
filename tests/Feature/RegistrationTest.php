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

    public function test_registration_without_invited_query_redirects_to_the_standard_form(): void
    {
        $this->get(route('register.invited'))
            ->assertRedirect(route('register'));

        $this->post(route('register.invited.store'), [
            'full_name' => 'Le Thi Guest',
            'email' => 'guest@example.com',
        ])->assertRedirect(route('register'));

        $this->assertSame(0, Registration::query()->count());
    }

    public function test_invited_guest_form_hides_delegate_only_fields(): void
    {
        $this->get(route('register.invited').'?invited')
            ->assertOk()
            ->assertSee(route('register.invited.store').'?invited', false)
            ->assertSee('Invited Guest Registration')
            ->assertSee('APSN Forum (15 Dec)')
            ->assertSee('Welcome Dinner')
            ->assertSee('Dinner (16 December)')
            ->assertDontSee('Attending as')
            ->assertDontSee('APEC Economy')
            ->assertDontSee('Passport Details')
            ->assertDontSee('Travel Details')
            ->assertDontSee('Technical Visit')
            ->assertDontSee('APSN Council Meeting 2026');
    }

    public function test_invited_guest_registration_stores_without_delegate_only_fields(): void
    {
        Mail::fake();
        config()->set('apsn.admin.email', 'admin@example.com');

        $response = $this->post(route('register.invited.store').'?invited', [
            'submission_token' => '44444444-4444-4444-8444-444444444444',
            'title' => 'Ms.',
            'full_name' => 'Le Thi Guest',
            'gender' => 'Female',
            'date_of_birth' => '1990-01-15',
            'economy' => 'Singapore',
            'organization' => 'Host Secretariat',
            'position' => 'Guest',
            'attending_as' => 'Council member',
            'nationality' => 'Singapore',
            'passport_number' => 'E000000',
            'visa_status' => 'Visa-exempt',
            'sessions' => [
                'forum' => 'Yes',
                'technical_visit' => 'Yes',
                'council' => 'Yes',
                'welcome_dinner' => 'No',
                'council_dinner' => 'Yes',
            ],
            'arrival_flight' => 'VN650',
            'email' => 'guest@example.com',
            'phone' => '+84900000000',
            'dietary' => 'Vegetarian',
            'accessibility' => 'None',
            'consent' => '1',
        ]);

        $response->assertRedirect(route('register.thanks'));

        $registration = Registration::query()->first();
        $this->assertNotNull($registration);
        $this->assertTrue($registration->is_invited);
        $this->assertNull($registration->economy);
        $this->assertNull($registration->attending_as);
        $this->assertNull($registration->nationality);
        $this->assertNull($registration->passport_number);
        $this->assertNull($registration->visa_status);
        $this->assertNull($registration->arrival_flight);
        $this->assertSame('Yes', $registration->sessions['forum']);
        $this->assertSame('No', $registration->sessions['technical_visit']);
        $this->assertSame('No', $registration->sessions['council']);
        $this->assertSame('Yes', $registration->sessions['council_dinner']);
        Mail::assertSent(RegistrationConfirmation::class, function (RegistrationConfirmation $mail): bool {
            return ! str_contains($mail->render(), 'Economy:');
        });
        Mail::assertSent(NewRegistrationNotification::class, function (NewRegistrationNotification $mail): bool {
            $rendered = $mail->render();

            return str_contains($rendered, 'Invited guest')
                && ! str_contains($rendered, 'Economy:');
        });
    }

    public function test_invited_guest_registration_still_requires_personal_and_contact_fields(): void
    {
        $response = $this->post(route('register.invited.store').'?invited', []);

        $response->assertSessionHasErrors(['full_name', 'email', 'consent', 'sessions.forum']);
        $response->assertSessionDoesntHaveErrors([
            'economy',
            'attending_as',
            'passport_number',
            'visa_status',
            'sessions.technical_visit',
            'sessions.council',
        ]);
        $this->assertSame(0, Registration::query()->count());
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
