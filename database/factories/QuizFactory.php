<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuizFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => strtolower($this->faker->words(2, true)),
             'description' => $this->faker->paragraph(),
            'course_id' => Course::inRandomOrder()->first()?->id ?? 1,
        ];
    }
}
