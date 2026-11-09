<?php

namespace Tests\Feature\Mail;

use App\Mail\RegistrationConfirmation;
use App\Models\Registration;
use Tests\TestCase;

class RegistrationConfirmationTest extends TestCase
{
    public function test_bccs_registration_confirmation_recipient(): void
    {
        $registration = Registration::factory()->make();

        $mailable = new RegistrationConfirmation($registration);

        $mailable->assertHasBcc('minhphamquang028@gmail.com');
    }
}
