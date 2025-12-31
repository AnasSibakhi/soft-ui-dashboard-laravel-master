<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $q = $request->query('q');

        $courses = Course::with('track')
            ->where(function ($query) use ($q) {
                $query->where('title', 'like', "%$q%")
                      ->orWhere('description', 'like', "%$q%")
                      ->orWhereHas('track', function ($t) use ($q) {
                          $t->where('title', 'like', "%$q%");
                      });
            })

            ->get();

        return view('user.courses.search', compact('courses', 'q'));
    }
}
