<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SessionsController extends Controller
{
    public function create()
    {
        return view('session.login-session');
    }

public function store(Request $request)
{

      $credentials = $request->only('email', 'password');
    $name = $request->input('name', 'New User');

    $credentials = $request->validate([
        'email'    => 'required|email',
        'password' => 'required',
    ]);

    // جلب الاسم إن وُجد
    $name = $request->input('name', 'New User');

    $user = \App\Models\User::where('email', $credentials['email'])->first();

    if (!$user) {
        $user = \App\Models\User::create([
            'name'     => $name,
            'email'    => $credentials['email'],
            'password' => Hash::make($credentials['password']),
            'role'     => 'user',
        ]);
    }

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        $user = Auth::user();

        if (
            $user->email === 'admin@example.com' &&
            Hash::check('secret123', $user->password)
        ) {
            return redirect()->route('admin.dashboard');
        }

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($user->role === 'user') {
            return redirect()->intended('/');
        }

        Auth::logout();
        return redirect('/login')->withErrors(['access' => 'صلاحيات الدخول غير معروفة.']);
    }

    return back()->withErrors([
        'email' => 'بيانات الدخول غير صحيحة.',
    ]);
}


  public function destroy()
{
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();

return redirect('/');
}

}

