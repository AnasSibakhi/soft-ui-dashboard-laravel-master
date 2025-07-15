<?php

namespace App\Http\Controllers\Admin;
use App\Models\Video;
use App\Models\Track;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TrackCourseController extends Controller
{
    public function create(Track $track)
    {
        return view('admin.tracks.createcourse', compact('track'));
    }

    /**
     * Store a newly created course under a track.
     */

public function store(Request $request, Track $track)
{
    $rules = [
        'title'      => 'required|min:10|max:150',
        'status'     => 'required|integer|in:0,1',
        'link'       => 'required|url',
        'images.*'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ];

    $validatedData = $request->validate($rules);

    // ✅ إنشاء الكورس
    $course = Course::create([
        'title'    => $validatedData['title'],
        'link'     => $validatedData['link'],
        'status'   => $validatedData['status'],
        'track_id' => $track->id,
    ]);

    // ✅ إنشاء فيديو تلقائي مرتبط بالكورس
    $course->videos()->create([
        'title' => $validatedData['title'], // أو خليه "Intro Video"
        'link'  => $validatedData['link'],
    ]);

    // ✅ حفظ الصور (كما هو)
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $index => $file) {
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);

            $course->photos()->create(['filename' => $filename]);

            if ($index === 0) {
                $course->image = $filename;
                $course->save();
            }
        }
    }

    return redirect()->route('course.index')->with('status', 'Course created successfully.');
}

}
