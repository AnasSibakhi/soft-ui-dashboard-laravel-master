<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Quiz;
use App\Models\Track;
use App\Models\User;

class HomeController extends Controller
{


     public function adminDashboard()
{
    $tracks = Track::with('courses')->latest()->take(4)->get();
$users = User::latest()->take(3)->get();
    // جلب أحدث 4 كورسات مع الصور والمسار (track) والمستخدم (user)
    $courses = Course::with(['photos', 'track', 'users'])->latest()->take(4)->get();

$quizzes = Quiz::withCount('questions')->latest()->take(4)->get();

    $tracks_count = Track::count();
    $courses_count = Course::count();
    $users_count = User::where('role', 'user')->count();
    $quizzes_count = Quiz::count();

    return view('admin.dashboard', compact(
        'tracks',
        'courses',
        'tracks_count',
        'courses_count',
        'users_count',
        'quizzes_count',
        'users',
        'quizzes'
    ));
}

}
