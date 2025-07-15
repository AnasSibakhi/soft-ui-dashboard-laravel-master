<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;  // <<-- هذا السطر مهم
use Illuminate\Http\Request;

class CourseQiuzController extends Controller
{
    public function create(Course $course)
    {
        return view('admin.courses.createquiz', compact('course'));
    }

    // باقي الأكواد...
}
