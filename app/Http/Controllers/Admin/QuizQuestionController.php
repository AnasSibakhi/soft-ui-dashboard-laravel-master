<?php

namespace App\Http\Controllers\Admin;

use App\Models\Quiz;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuizQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function create(Quiz $quiz)
    {
    return view('admin.quizzes.createquestion', compact('quiz'));

    }

}
