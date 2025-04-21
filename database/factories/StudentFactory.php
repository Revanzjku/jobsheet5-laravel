<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'NIS' => fake()->unique()->numerify('#######'),
            'student_name' => fake()->name(),
            'gender' => fake()->randomElement(['L', 'P']),
            'place_of_birth' => fake()->city(),
            'date_of_birth' => fake()->date(),
            'classroom_id' => rand(1, 2),
            'student_parent_id' => rand(1, 10)
        ];
    }
}
