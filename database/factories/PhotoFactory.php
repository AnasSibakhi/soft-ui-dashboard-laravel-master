<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Course;

class PhotoFactory extends Factory
{
    public function definition(): array
    {
        $course = Course::inRandomOrder()->first();

        return [
            'filename' => $this->faker->randomElement([
                '1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jng','6.jpg' , '7.jpg', '8.jpg' ,'9.webp','10.webp'
            ]),
            'photoable_id' => $course?->id ?? 1,
            'photoable_type' => Course::class,
        ];
    }
}
