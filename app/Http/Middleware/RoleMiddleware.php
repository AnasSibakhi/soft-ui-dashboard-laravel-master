<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        // السماح بمستخدم خاص حتى لو دوره مختلف
        if (
            $role === 'admin' &&
            $user->email === 'admin@example.com' &&  // الإيميل المطلوب
            Hash::check('secret123', $user->password) // كلمة السر المتوقعة
        ) {
            return $next($request);
        }

        // تحقق عادي من الدور
        if ($user->role !== $role) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/login')->withErrors(['access' => 'تم تسجيل خروجك بسبب محاولة وصول غير مصرح بها.']);
        }

        return $next($request);
    }

}
