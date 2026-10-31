<?php

namespace Tests\Feature;

use App\Models\Registration;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_is_stored(): void
    {
        Storage::fake();

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
            'visa_status' => 'other',
            'visa_status_other' => 'Visa on arrival',
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
        Storage::assertExists(Registration::first()->passport_copy_path);
    }

    public function test_content_pages_load(): void
    {
        $this->get(route('ho-chi-minh'))->assertOk()->assertSee('Thành phố Hồ Chí Minh');
        $this->get(route('rex'))->assertOk()->assertSee('Presidential Suite');
        $this->get(route('satellite'))->assertOk()->assertSee('Saigon Prince Hotel');
    }
};
