<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class VideoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'link' => $this->faker->url(), // ✅ استبدلنا 'url' بـ 'link'
            'course_id' => Course::inRandomOrder()->first()?->id ?? 1,
        ];
    }
}
