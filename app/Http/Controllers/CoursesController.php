<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;  // صحح الاستدعاء

class CoursesController extends Controller
{
    public function index($slug)
    {
        $course = Course::where('slug', $slug)->firstOrFail(); // استخدم firstOrFail ليرمي 404 إذا ما وجد

        return view('user.course', compact('course'));
    }

}
