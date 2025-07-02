<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{


    public function userDashboard()
{
    return view('user.dashboard');
}

 public function dashboard()
    {
        $user = Auth::user();

        // جلب آخر 5 طلبات
        $orders = $user->orders()->latest()->take(5)->get();

        return view('user.dashboard', compact('user', 'orders'));
    }

}
