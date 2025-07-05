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




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
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

    Track::create($validated);

    Track::create([
        'name' => $request->name,
        'Creater_Name' => auth()->user()->name, // أو أي اسم تريده
    ]);

    return redirect()->back()->with('success', 'Track added successfully.');
}

    // public function store(Request $request)
    // {
    //     $rules = [

    //         'name' => 'required|min:3|max:50',
    //     ];

    //     $this->validate($request , $rules);
    //     if(Track::create($$request->all())){

    //    return redirect('/admin/tracks')->withStatus('Track successfully created');
    //     } else{
    //   return redirect('/admin/tracks')->withStatus('something worng , Try again');

    //     }

    // }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Track $track)
    {

        return view('admin.tracks.edit', compact('track'));
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, Track $track)
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


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Track $track)
    {
      $track->delete();
return redirect()->route('tracks.index')->with('success', ' Track successfully deleted.');


    }
}
