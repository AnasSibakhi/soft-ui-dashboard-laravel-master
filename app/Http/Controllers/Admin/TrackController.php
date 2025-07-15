<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Track;

class TrackController extends Controller
{
    public function index()
    {
        $tracks = Track::orderBy('id', 'desc')->paginate(20);
        return view('admin.tracks.index', compact('tracks'));
    }

    public function create()
    {
        return view('admin.tracks.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'min:3',
                'max:50',
                'regex:/^[A-Za-z ]+$/', // يسمح فقط بالأحرف الإنجليزية والمسافات
            ],
        ]);

        Track::create([
            'name' => $request->name,
            'Creater_Name' => auth()->user()->name,
        ]);

        return redirect()->back()->with('success', 'Track added successfully.');
    }

    public function show($id)
{
    $track = Track::with('courses.photos')->findOrFail($id);
    return view('admin.tracks.show', compact('track'));
}


    public function edit(Track $track)
    {
        return view('admin.tracks.edit', compact('track'));
    }

    public function update(Request $request, Track $track)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'min:3',
                'max:50',
                'regex:/^[A-Za-z ]+$/',
            ],
        ]);

        if ($request->has('name')) {
            $track->name = $request->name;
        }

        if ($track->isDirty()) {
            $track->save();
            return redirect()->route('tracks.index')->with('success', '✅ Track successfully updated.');
        } else {
            return redirect()->back()->with('info', '⚠️ Nothing was changed.');
        }
    }

    public function destroy(Track $track)
    {
        $track->delete();
        return redirect()->route('tracks.index')->with('success', ' Track successfully deleted.');
    }
}
