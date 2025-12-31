<?php

namespace Database\Factories;

use App\Models\Track;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    public function definition(): array
    {
        $title = $this->faker->sentence;
        return [
              'title'     => $title,
             'description' => $this->faker->paragraph(),
            'slug' => strtolower(str_replace(' ', '-', $title)),
            'status'    => $this->faker->randomElement([0, 1]), // ✅ رقم فقط
            'link'      => $this->faker->url,
            'track_id'  => Track::factory(), // ينشئ Track تلقائيًا ويربطه
        ];
    }
}
