<?php

namespace Database\Factories;

use App\Models\Quiz;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'answers' => json_encode([
                'A' => $this->faker->word(),
                'B' => $this->faker->word(),
                'C' => $this->faker->word(),
                'D' => $this->faker->word(),
            ]),
            'right_answer' => $this->faker->randomElement(['A', 'B', 'C', 'D']), // ✅ عشوائي
            'score' => $this->faker->randomElement([ 5 ,10 , 15 ,20 ]),
            'quiz_id' => Quiz::inRandomOrder()->first()?->id ?? 1,
        ];
    }
}
