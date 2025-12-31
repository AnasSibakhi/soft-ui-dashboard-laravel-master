<?php

namespace App\Http\Controllers\Admin;

use App\Models\Quiz;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuizQuestionController extends Controller
{
    public function create(Quiz $quiz)
    {
        return view('admin.quizzes.createquestion', compact('quiz'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'quiz_id'      => 'required|exists:quizzes,id',
            'title'        => 'required|string|max:255',
            'answers'      => 'required|array|min:4',
            'right_answer' => 'required|string|max:255',
            'score'        => 'required|integer|min:1|max:100',
        ]);

        $question = new Question();
        $question->quiz_id = $validated['quiz_id'];
        $question->title = $validated['title'];
        $question->answers = json_encode($validated['answers']);
        $question->right_answer = $validated['right_answer'];
        $question->score = $validated['score'];
        $question->save();

        return redirect()->route('question.index')->with('success', 'Question added successfully.');
    }
}

