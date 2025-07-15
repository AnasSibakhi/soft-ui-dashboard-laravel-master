<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Track;
use App\Models\Course;
use App\Models\Video;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Photo;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * Main UserFactory — contains all factory definitions in one file
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('password'),
            'phone' => $this->faker->numerify('05########'),
            'location' => $this->faker->city(),
            'about_me' => $this->faker->sentence(),
            'remember_token' => Str::random(10),
        ];
    }

    // Inline factory for Track
    public static function trackFactory(): array
    {
        return [
            'name' => fake()->word(),
        ];
    }

    // Inline factory for Course


public static function courseFactory(): array
{
    return [
        'title' => fake()->sentence(),
        'status' => fake()->word(), // أو يمكن تخصيصها أكثر
        'link' => fake()->url(),
        'track_id' => Track::factory(), // ينشئ Track جديد ويربطه تلقائيًا
    ];
}

    // Inline factory for Video
    public static function videoFactory(): array
    {
        return [
            'title' => fake()->sentence(),
            'url' => fake()->url(),
            'course_id' => Course::inRandomOrder()->first()?->id ?? 1,
        ];
    }

    // Inline factory for Quiz
    public static function quizFactory(): array
    {
        return [
            'title' => fake()->word(),
            'course_id' => Course::inRandomOrder()->first()?->id ?? 1,
        ];
    }

    // Inline factory for Question
    public static function questionFactory(): array
    {
        $choices = [fake()->word(), fake()->word(), fake()->word(), fake()->word()];
        return [
            'question_text' => fake()->sentence(),
            'correct_answer' => fake()->randomElement($choices),
            'choices' => json_encode($choices),
            'quiz_id' => Quiz::inRandomOrder()->first()?->id ?? 1,
        ];
    }

    // Inline factory for Photo
    public static function photoFactory(): array
    {
        $course = Course::inRandomOrder()->first();
        return [
            'filename' => fake()->randomElement(['1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jng','6.jpg' , '7.jpg', '8.jpg' ,'9.webp','10.webp']),
            'photoable_id' => $course?->id ?? 1,
            'photoable_type' => Course::class,
        ];
    }
}
