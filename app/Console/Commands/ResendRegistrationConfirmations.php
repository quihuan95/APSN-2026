<?php

namespace App\Console\Commands;

use App\Mail\RegistrationConfirmation;
use App\Models\Registration;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

#[Signature('registrations:resend-confirmations {--force : Send without asking for confirmation}')]
#[Description('Resend the registration confirmation email to every registered attendee')]
class ResendRegistrationConfirmations extends Command
{
    public function handle(): int
    {
        $registrationCount = Registration::query()->count();

        if ($registrationCount === 0) {
            $this->info('There are no registrations to email.');

            return self::SUCCESS;
        }

        if (! $this->option('force') && ! $this->confirm("Resend confirmation emails to all {$registrationCount} registrations?")) {
            $this->info('No confirmation emails were sent.');

            return self::SUCCESS;
        }

        Registration::query()
            ->lazyById(100)
            ->each(function (Registration $registration): void {
                Mail::to($registration->email)->send(new RegistrationConfirmation($registration));
            });

        $this->info("Confirmation emails sent to {$registrationCount} registrations.");

        return self::SUCCESS;
    }
}
