<?php

namespace App\Http\Controllers\Admin;

use App\Models\Video;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseVideoController extends Controller
{

public function create(Course $course)
{
    return view('admin.courses.createvideo', compact('course'));
}



    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request, Course $course)
{

    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'link' => 'required|url',
    ]);

    $course->videos()->create($validated);

    return redirect()->route('course.show', $course->id)
        ->with('success', 'Video created successfully.');
}

}
