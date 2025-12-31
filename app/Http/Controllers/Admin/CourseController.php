<?php

namespace App\Http\Controllers\Admin;

use App\Models\Track;
use App\Models\Course;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->withErrors(['msg' => 'يجب تسجيل الدخول أولاً.']);
        }

        $courses = Course::orderBy('id', 'desc')->paginate(500);
        return view('admin.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tracks = Track::all();
        return view('admin.courses.create', compact('tracks'));
    }

    /**
     * Store a newly created resource in storage.
     */
  public function store(Request $request)
{
    $rules = [
        'title'       => 'required|min:10|max:150',
        'description' => 'required|min:10|max:500',
        'status'      => 'required|integer|in:0,1',
        'link'        => 'required|url',
        'track_id'    => 'required|integer',
        'images.*'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ];

    $validatedData = $request->validate($rules);

    // توليد slug من العنوان
    $slug = Str::slug($validatedData['title']);
    $count = Course::where('slug', 'LIKE', "{$slug}%")->count();
    if ($count > 0) {
        $slug .= '-' . ($count + 1);
    }

    $course = Course::create([
        'title'       => $validatedData['title'],
        'description' => $validatedData['description'],
        'slug'        => $slug,
        'link'        => $validatedData['link'],
        'status'      => $validatedData['status'],
        'track_id'    => $validatedData['track_id'],
    ]);

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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        $tracks = Track::all();
        return view('admin.courses.edit', compact('course', 'tracks'));
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, Course $course)
{
    $rules = [
        'title'      => 'required|min:20|max:150',
        'status'     => 'required|integer|in:0,1',
        'link'       => 'required|url',
        'track_id'   => 'required|integer',
        'images.*'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ];

    $validatedData = $request->validate($rules);

    // تحديث بيانات الكورس
    $course->update([
        'title'    => $validatedData['title'],
        'link'     => $validatedData['link'],
        'status'   => $validatedData['status'],
        'track_id' => $validatedData['track_id'],
    ]);

    // ✅ في حال تم رفع صور جديدة
    if ($request->hasFile('images')) {

        // 🧹 حذف الصور القديمة من جدول photos و من مجلد images (اختياري)
        foreach ($course->photos as $photo) {
            $oldPath = public_path('images/' . $photo->filename);
            if (file_exists($oldPath)) {
                unlink($oldPath); // حذف الصورة من السيرفر
            }
            $photo->delete(); // حذف من قاعدة البيانات
        }

        // رفع الصور الجديدة
        foreach ($request->file('images') as $index => $file) {
            if ($file->isValid()) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('images'), $filename);

                // حفظ الصورة في جدول photos
                $course->photos()->create(['filename' => $filename]);

                // أول صورة نحفظها في عمود image الخاص بجدول courses
                if ($index === 0) {
                    $course->image = $filename;
                    $course->save();
                }
            }
        }
    }

        return redirect()->route('course.index')->with('status', 'Course updated successfully.');
}


    /**
     * Remove the specified resource from storage.
     */
public function destroy(Course $course)
{
    // حذف جميع الصور من السيرفر وقاعدة البيانات
    foreach ($course->photos as $photo) {
        $filePath = public_path('images/' . $photo->filename);
        if (file_exists($filePath)) {
            unlink($filePath); // حذف الصورة من السيرفر
        }
        $photo->delete(); // حذف من قاعدة البيانات
    }

    // حذف الكورس نفسه
    $course->delete();

    return redirect()->route('course.index')->with('status', 'Course deleted successfully.');
}

public function show($id)
{
    $course = Course::with('videos', 'photos', 'track')->findOrFail($id);
    return view('admin.courses.show', compact('course'));
}


}
