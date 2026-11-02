<?php

namespace Database\Factories;

use App\Models\Registration;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Registration>
 */
class RegistrationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => 'Dr.',
            'full_name' => fake()->name(),
            'gender' => fake()->randomElement(['Male', 'Female']),
            'date_of_birth' => fake()->dateTimeBetween('-70 years', '-20 years'),
            'economy' => 'Singapore',
            'organization' => fake()->company(),
            'position' => 'Director',
            'attending_as' => 'Council member',
            'nationality' => 'Singaporean',
            'passport_type' => 'Diplomatic Passport',
            'passport_number' => fake()->bothify('E#######'),
            'passport_expiry' => fake()->dateTimeBetween('+1 year', '+5 years'),
            'passport_copy_path' => 'passports/test-passport.pdf',
            'visa_status' => 'Visa-exempt',
            'sessions' => [
                'forum' => 'Yes',
                'technical_visit' => 'No',
                'council' => 'Yes',
                'welcome_dinner' => 'Yes',
                'council_dinner' => 'No',
            ],
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'dietary' => 'Halal',
            'accessibility' => 'None',
            'consent' => true,
        ];
    }
}
