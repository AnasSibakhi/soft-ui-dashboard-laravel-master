<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    // public function home()
    // {
    //     return view('admin.dashboard');    }

        public function adminDashboard()
{
    return view('admin.dashboard'); // أنشئ هذا الملف في resources/views/admin/dashboard.blade.php
}


}
