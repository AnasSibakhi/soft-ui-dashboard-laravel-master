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
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // ✅ إذا كان المستخدم هو الادمن الخاص:
            if (
                $user->email === 'admin@example.com' &&
                Hash::check('secret123', $user->password)
            ) {
                return view('admin/dashboard');
            }

            // ✅ إذا كان دوره "admin" بشكل عام
            if ($user->role === 'admin') {
                return view('admin/dashboard');
            }

            // ✅ إذا كان دوره "user"
            if ($user->role === 'user') {
                return redirect()->route('user.dashboard');
            }

            // ❌ دور غير معروف
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

    return view('session.login-session')->with('success', 'تم تسجيل الخروج بنجاح.');
}

}

