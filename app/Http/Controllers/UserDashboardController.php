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
     // عدد التراكات التي تريد عرضها
    $Tracks = Track::with('courses')->orderBy('id' ,'desc')->get();
    $tracks_count = \App\Models\Track::count();
    $users_count = \App\Models\User::count();
    $users = \App\Models\User::latest()->take(6)->get();

     $famous_Tracks_id =Course::pluck('track_id')->countBy()->sort()->reverse()->keys() ->take(10);

     $famous_Tracks =Track::withCount('courses')->whereIn('id',  $famous_Tracks_id)->orderBy('courses_count' ,'desc')->get();

$user_courses_id = User::findOrFail(1)
    ->courses()
    ->pluck('courses.id');
    $user_tracks_id = User::findOrFail(1)
    ->tracks()
    ->pluck('tracks.id');

    $recommended_courses =Course::whereIn('track_id' ,$user_tracks_id)->whereNotIn('id' ,  $user_courses_id)->limit(4)->get();
    // $courses = $user ? $user->courses()->with('track', 'users')->get() : collect();
    // $quizzes = $user ? $user->quizzes()->with('course')->get() : collect();

    return view('user.dashboard', compact(
        'user',
        'tracks_count',
        // 'courses',
        // 'quizzes',
        'users',
        'users_count',
        'latestCourses',
        'Tracks',
        'famous_Tracks',
        'recommended_courses'
    ));
}


}
