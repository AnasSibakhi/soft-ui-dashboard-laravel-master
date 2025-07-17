<?php

namespace App\Http\Controllers\Admin;

use App\Models\Quiz;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::with('quiz.course')->orderBy('id', 'desc')->paginate(20);
        return view('admin.questions.index', compact('questions'));
    }

    public function create()
    {
        $quizzes = Quiz::all(); // جلب جميع الاختبارات لعرضها في القائمة
        return view('admin.questions.create', compact('quizzes'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'quiz_id' => 'required|exists:quizzes,id',
        'title' => 'required|string|max:255',
        'answers' => 'required|array|size:4',
        'answers.*' => 'required|string|max:255',
        'right_answer' => 'required|in:A,B,C,D',
        'score' => 'required|integer|min:1|max:100',
    ]);

$question = new Question();
$question->quiz_id = $validated['quiz_id'];
$question->title = $validated['title'];
$question->answers = json_encode($validated['answers']); // تحويل المصفوفة إلى JSON
$question->right_answer = $validated['right_answer'];
$question->score = $validated['score'];
$question->save();

    return redirect()->route('question.index')->with('success', 'Question added successfully.');
}

public function edit($id)
{
    $question = Question::findOrFail($id);
    $quizzes = Quiz::all();

    return view('admin.questions.edit', compact('question', 'quizzes'));
}

public function show($id)
{
    $question = Question::findOrFail($id);
    $quizzes = Quiz::all();

    return view('admin.questions.show', compact('question', 'quizzes'));
}

  public function update(Request $request, $id)
{
    $validated = $request->validate([
        'quiz_id' => 'required|exists:quizzes,id',
        'title' => 'required|string|max:255',
        'answers' => 'required|array|size:4',
        'answers.*' => 'required|string|max:255',
        'right_answer' => 'required|in:A,B,C,D',
        'score' => 'required|integer|min:1|max:100',
    ]);

    $question = Question::findOrFail($id); // جلب السؤال المطلوب تعديله

    $question->quiz_id = $validated['quiz_id'];
    $question->title = $validated['title'];
    $question->answers = json_encode($validated['answers']); // نفس الطريقة، نخزن JSON
    $question->right_answer = $validated['right_answer'];
    $question->score = $validated['score'];
    $question->save();

    return redirect()->route('question.index')->with('success', 'Question updated successfully.');
}



  public function destroy(Question $question)

{
$question->delete();
    return redirect()->route('question.index')->with('success', 'Question delete successfully.');

}

}
