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
        $quizzes = Quiz::all();
        return view('admin.questions.create', compact('quizzes'));
    }

public function store(Request $request)
{
    $validated = $request->validate([
        'quiz_id'      => 'required|exists:quizzes,id',
        'title'        => 'required|string|max:255',
        'type'         => 'required|in:text,checkbox',
        'answers'      => 'nullable|string',
        'right_answer' => 'nullable|string|max:255',
        'score'        => 'required|integer|min:1|max:100',
    ]);

    $question = new Question();
    $question->quiz_id = $validated['quiz_id'];
    $question->title   = $validated['title'];
    $question->type    = $validated['type'];

    if ($validated['type'] === 'text') {
        $question->answers = json_encode([]);
        $question->right_answer = $validated['right_answer'] ?? '';
    }

    if ($validated['type'] === 'checkbox') {
        $question->answers = json_encode(
            array_map('trim', explode(',', $validated['answers'] ?? ''))
        );
        $question->right_answer = $validated['right_answer'] ?? '';
    }

    // 🔥 الحل النهائي — ضمان عدم بقاء answers = null
    if ($question->answers === null) {
        $question->answers = json_encode([]);
    }

    $question->score = $validated['score'];
    $question->save();

    return redirect()->route('question.index')
        ->with('success', 'Question added successfully.');
}


    public function show($id)
    {
        $question = Question::findOrFail($id);
        $quizzes = Quiz::all();

        return view('admin.questions.show', compact('question', 'quizzes'));
    }

    public function edit($id)
    {
        $question = Question::findOrFail($id);
        $quizzes = Quiz::all();
        return view('admin.questions.edit', compact('question', 'quizzes'));
    }

public function update(Request $request, $id)
{
    $validated = $request->validate([
        'quiz_id' => 'required|exists:quizzes,id',
        'title'   => 'required|string|max:255',
        'type'    => 'required|in:text,checkbox',
        'score'   => 'required|integer|min:1|max:100',
        'answers' => 'nullable|array',
        'answers.*' => 'nullable|string|max:255',
        'right_answer' => 'nullable|string|max:255',
    ]);

    $question = Question::findOrFail($id);

    $question->quiz_id = $validated['quiz_id'];
    $question->title   = $validated['title'];
    $question->type    = $validated['type'];
    $question->score   = $validated['score'];

    // سؤال نصي: تخزين نصوص فارغة إذا لم توجد إجابة
    if ($validated['type'] === 'text') {
        $question->answers = json_encode([]);
        $question->right_answer = $validated['right_answer'] ?? '';
    }

    // سؤال متعدد (checkbox)
    if ($validated['type'] === 'checkbox') {
        $question->answers = json_encode($validated['answers'] ?? []);
        $question->right_answer = $validated['right_answer'] ?? '';
    }

    // حفظ التعديلات
    $question->save();

    return redirect()->route('question.index')
        ->with('success', 'Question updated successfully.');
}


    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->route('question.index')
            ->with('success', 'Question deleted successfully.');
    }
}
