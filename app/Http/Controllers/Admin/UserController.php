<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('laravel-examples.user-management', compact('users'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('laravel-examples.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'  => 'required|max:50',
            'email' => 'required|email|max:50|unique:users,email,' . $id,
        ]);

        $user = User::findOrFail($id);
        $user->update($request->only('name', 'email'));

        return redirect()->route('user-management')->with('success', 'User updated successfully');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return back()->with('success', 'User deleted successfully');
    }
}

