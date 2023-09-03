<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reporter>
 */
class ReporterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone_number' => fake()->phoneNumber(),
            'identity_type' => fake()->randomElement(['KTP', 'SIM']),
            'identity_number' => fake()->numerify('###################'),
            'pob' => fake()->city(),
            'dob' => fake()->date(),
            'address' => fake()->address(),
        ];
    }
}
