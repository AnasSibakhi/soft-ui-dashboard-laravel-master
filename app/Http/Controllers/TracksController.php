<?php

namespace App\Http\Controllers;

use App\Models\Track;
use Illuminate\Http\Request;

class TracksController extends Controller
{
    public function index($name){
        $courses = Track::where('name', $name)->first()->courses;
         return view('user.tracks_courses' , compact('courses'));
    }
}
