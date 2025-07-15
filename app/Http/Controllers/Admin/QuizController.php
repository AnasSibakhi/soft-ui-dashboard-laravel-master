<?php

namespace App\Http\Controllers\Admin;

use App\Models\Quiz;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    $quizzes = Quiz::with(['questions', 'course'])->orderBy('id', 'desc')->paginate(20);
    return view('admin.quizzes.index', compact('quizzes'));


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $Courses = Course::all(); // تجيب كل الكورسات من قاعدة البيانات

    return view('admin.quizzes.create', compact('Courses'));    }

    /**
     * Store a newly created resource in storage.
     */

public function store(Request $request)
{
    $rules = [
        'name' => 'required|min:3|max:50',
        'course_id' => 'required|integer',
    ];

    $this->validate($request, $rules);

    $quiz = Quiz::create([
        'name' => $request->name,
        'course_id' => $request->course_id,
    ]);

    if ($quiz) {
        return redirect()->route('quizzes.index')->with('success', 'Quiz created successfully.');
    } else {
        return redirect()->back()->with('error', 'Failed to create quiz.');
    }
}


    /**
     * Display the specified resource.
     */
    public function show(Quiz $quiz)
    {

    $quiz->load(['questions', 'course']); // تحميل العلاقات المرتبطة

    return view('admin.quizzes.show', compact('quiz'));




    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quiz $quiz)
    {
        $courses = Course::all();

        return view('admin.quizzes.edit', compact('quiz','courses'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Quiz $quiz)
    {
        $rules = [
        'name' => 'required|min:3|max:50',
        'course_id' => 'required|integer',
    ];

    $this->validate($request, $rules);

    $quiz->update([
        'name' => $request->name,
        'course_id' => $request->course_id,
    ]);

    if ($quiz) {
        return redirect()->route('quizzes.index')->with('success', 'Quiz update successfully.');
    } else {
        return redirect()->back()->with('error', 'Failed to update quiz.');
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quiz $quiz)
    {
              $quiz->delete();
     return redirect()->route('quizzes.index')->with('success', 'The quiz has been delete successfully.');

    }
}
