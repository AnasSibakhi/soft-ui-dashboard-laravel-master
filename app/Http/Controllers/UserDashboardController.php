<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Course;
use App\Models\Order;
use App\Models\Quiz;
use App\Models\Track;

class UserDashboardController extends Controller
{
public function dashboard()
{
    $user = Auth::user(); // ممكن يكون null إذا مش مسجل
    $latestCourses = Course::latest()->take(10)->get();
      $famousTracks = Track::withCount('courses')
        ->orderByDesc('courses_count')
        ->take(10) // عدد التراكات التي تريد عرضها
        ->get();
    $tracks_count = \App\Models\Track::count();
    $users_count = \App\Models\User::count();
    $users = \App\Models\User::latest()->take(6)->get();

    $courses = $user ? $user->courses()->with('track', 'users')->get() : collect();
    $quizzes = $user ? $user->quizzes()->with('course')->get() : collect();

    return view('user.dashboard', compact(
        'user',
        'tracks_count',
        'courses',
        'quizzes',
        'users',
        'users_count',
        'latestCourses',
        'famousTracks'
    ));
}


}
