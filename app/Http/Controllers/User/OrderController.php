<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('user.orders');
    }

    public function create()
    {
        return view('user.create-order');
    }

    public function store(Request $request)
    {
        // منطق الحفظ
        return redirect()->route('user.orders.index')->with('success', 'تم إرسال الطلب بنجاح');
    }
}
