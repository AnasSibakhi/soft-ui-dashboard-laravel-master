<?php

namespace App\Http\Controllers;
use App\Models\QuizUserAnswer;

use App\Models\Course;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QquizzesController extends Controller
{
    public function index($slug , $name)
    {
        $course = Course::where('slug', $slug)->firstOrFail();
        $quiz   = $course->quizzes()->where('name', $name)->firstOrFail();

        return view('user.quiz', compact('quiz'));
    }

 public function submit(Request $request, $slug, $name)
{
    $quiz = Quiz::where('name', $name)->firstOrFail();
    $questions = $quiz->questions;
    $quiz_score = 0;
    $errors = [];

    $normalizeAnswer = function($s) {
        $s = trim((string)$s);
        if ($s === '') return '';
        $parts = preg_split('/[\/\-\: ]+/', $s);
        return strtolower($parts[0]);
    };

    foreach ($questions as $index => $question) {
        $your_answer = $request->input("answers.{$question->id}") ?? '';
        $the_answer  = $question->right_answer ?? '';

        $your_normalized = $normalizeAnswer($your_answer);
        $the_normalized  = $normalizeAnswer($the_answer);
        $quiz_score += $question->score;

        if ($your_normalized !== $the_normalized) {
            $errors[] = "Question " . ($index + 1) .
                        ": Your answer '{$your_answer}' → Correct '{$the_answer}'";
        }
    }

    if (!empty($errors)) {
        return redirect("/courses/$slug/quizzes/$name")
            ->with('error', implode("\n", $errors));
    }

    $user = auth()->user();

    // ثبت الاختبار بدون تكرار لنفس الـ Quiz
    $user->quizzes()->syncWithoutDetaching([$quiz->id]);

    // زيد نقاط المستخدم
    $user->score += $quiz_score;
    $user->save();

    // احفظ سجل الإجابة في جدول quiz_user_answers **قبل أي redirect**
    QuizUserAnswer::updateOrCreate(
        [
            'user_id' => $user->id,
            'quiz_id' => $quiz->id
        ],
        [
            'is_correct' => true,
            'answers'    => $request->input('answers'),
            'score'      => $quiz_score
        ]
    );

    // الآن ارجع للمستخدم
    return redirect("/courses/" . $quiz->course->slug)
        ->with('status', "Well done! You've solved '{$quiz->name}' Quiz and earned {$quiz_score} point");
}
}
