<?php

namespace App\Http\Controllers\Admin;

use App\Models\Video;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VideoController extends Controller
{
    public function index()
    {
        $Videos = Video::with('course')->latest()->get();
        return view('admin.videos.index', compact('Videos'));
    }

    public function create()
    {
        $Courses = Course::orderBy('id', 'desc')->get();
        return view('admin.videos.create', compact('Courses'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|min:3|max:100',
            'link' => 'required|url',
            'course_id' => 'required|exists:courses,id',
        ]);

        Video::create($data);

        return redirect()->route('videos.index')->with('success', 'Video created successfully.');
    }

    public function show(Video $video)
    {
        return view('admin.videos.show', compact('video'));
    }

    public function edit(Video $video)
    {
        $courses = Course::all();
        return view('admin.videos.edit', compact('video', 'courses'));
    }

    public function update(Request $request, Video $video)
    {
        $data = $request->validate([
            'title' => 'required|min:3|max:100',
            'link' => 'required|url',
            'course_id' => 'required|exists:courses,id',
        ]);

        $video->update($data);

        return redirect()->route('videos.index')->with('success', 'Video updated successfully.');
    }

    public function destroy(Video $video)
    {
        $video->delete();
        return redirect()->route('videos.index')->with('success', 'Video deleted successfully.');
    }
}
