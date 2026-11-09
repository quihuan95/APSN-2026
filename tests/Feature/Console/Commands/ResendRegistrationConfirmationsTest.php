<?php

namespace Tests\Feature\Console\Commands;

use App\Mail\RegistrationConfirmation;
use App\Models\Registration;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ResendRegistrationConfirmationsTest extends TestCase
{
    use RefreshDatabase;

    public function test_resends_confirmation_email_to_every_registration(): void
    {
        Registration::factory()->count(3)->create();
        Mail::fake();

        $this->artisan('registrations:resend-confirmations', ['--force' => true])
            ->expectsOutput('Confirmation emails sent to 3 registrations.')
            ->assertSuccessful();

        Mail::assertSent(RegistrationConfirmation::class, 3);
    }

    public function test_does_not_send_emails_when_confirmation_is_declined(): void
    {
        Registration::factory()->count(2)->create();
        Mail::fake();

        $this->artisan('registrations:resend-confirmations')
            ->expectsConfirmation('Resend confirmation emails to all 2 registrations?', 'no')
            ->expectsOutput('No confirmation emails were sent.')
            ->assertSuccessful();

        Mail::assertNothingSent();
    }
}
