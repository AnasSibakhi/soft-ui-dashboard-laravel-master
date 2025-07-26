<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Track;
use App\Models\Course;
use App\Models\Video;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Photo;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. إنشاء التراكات أولاً
        $tracks = Track::factory()->count(5)->create();

        // 2. إنشاء كورسات مرتبطة بالتراكات
        foreach ($tracks as $track) {
            Course::factory()->count(5)->create([
                'track_id' => $track->id,
            ]);
        }

        // 3. إنشاء مستخدمين
        $users = User::factory()->count(10)->create();

        // جلب كل الكورسات عشان نستخدمها للربط
        $courses = Course::all();

        // 4. ربط المستخدمين بالكورسات بشكل عشوائي (1 إلى 3 كورسات لكل مستخدم)
        foreach ($users as $user) {
            $userCourses = $courses->random(rand(1, 3))->pluck('id')->toArray();
            $user->courses()->attach($userCourses);
        }

        // 5. فيديوهات لكل كورس
        Course::all()->each(function ($course) {
            Video::factory()->count(2)->create([
                'course_id' => $course->id,
            ]);
        });

        // 6. كويزات وأسئلة
        Course::all()->each(function ($course) {
            $quiz = Quiz::factory()->create(['course_id' => $course->id]);

            Question::factory()->count(5)->create([
                'quiz_id' => $quiz->id,
            ]);
        });

        // 7. صور للكورسات
        Course::all()->each(function ($course) {
            $course->photos()->create([
                'filename' => fake()->randomElement([
                    '1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg',
                    '6.jpg', '7.jpg', '8.jpg', '9.webp', '10.webp',
                ]),
            ]);
        });
    }
}
