<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
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
            'age' => fake()->numberBetween(10, 99),
            'gender' => fake()->randomElement(['Pria', 'Wanita']),
            'address' => fake()->address(),
            'phone_number' => fake()->phoneNumber(),
            'birthday' => fake()->date(),
        ];
    }
}
