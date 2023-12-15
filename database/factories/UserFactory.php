<?php

namespace Database\Factories;

use App\Enums\AccountTypes;
use App\Enums\Statuses;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'middle_name' => ucfirst(fake()->randomLetter()),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'phone_number' => fake()->unique()->e164PhoneNumber(),
            'national_id_number' => (string) random_int(1000, 9999),
            'type' => fake()->randomElement([AccountTypes::DOCTOR->value, AccountTypes::RECEPTIONIST->value, AccountTypes::PATIENT->value, AccountTypes::USER->value]),
            'gender' => fake()->randomElement(['male', 'female', 'other']),
            'status' => Statuses::ACTIVE->value,
            'address' => fake()->address(),
            'date_of_birth' => fake()->date('Y-m-d H:i:s'),
            'email_verified_at' => now(),
            'password' => 'password',
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
