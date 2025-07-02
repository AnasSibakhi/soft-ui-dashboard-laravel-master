<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class InfoUserController extends Controller
{


    public function create()
    {
        return view('laravel-examples/user-profile');
    }

    public function store(Request $request)
    {
        // تحديد قواعد التحقق
        $emailRules = ['required', 'email', 'max:50'];

        // إذا تغيّر الإيميل، أضف شرط uniqueness
        if ($request->get('email') != Auth::user()->email) {

            // التحقق من نسخة الديمو
            if (env('IS_DEMO') && Auth::user()->id == 1) {
                return redirect()->back()->withErrors([
                    'msg2' => 'You are in a demo version, you can\'t change the email address.'
                ]);
            }

            $emailRules[] = Rule::unique('users')->ignore(Auth::user()->id);
        }

        // تحقق من باقي الحقول
        $attributes = $request->validate([
            'name' => ['required', 'max:50'],
            'email' => $emailRules,
            'phone' => ['nullable', 'max:50'],
            'location' => ['nullable', 'max:70'],
            'about_me' => ['nullable', 'max:150'],
        ]);

        // التحديث
        User::where('id', Auth::user()->id)->update($attributes);

        return redirect('/user-profile')->with('success', 'Profile updated successfully');
    }
    public function index()
{
    $users = User::all(); // أو paginate إن أردت

    return view('laravel-examples.user-management', compact('users'));
}

}

// namespace App\Http\Controllers\admin;

// use App\Models\User;
// use Illuminate\Http\Request;
// use Illuminate\Validation\Rule;
// use App\Http\Controllers\Controller;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\View;

// class InfoUserController extends Controller
// {

//     public function create()
//     {
//         return view('laravel-examples/user-profile');
//     }

//     public function store(Request $request)
//     {

//         $attributes = request()->validate([
//             'name' => ['required', 'max:50'],
//             'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore(Auth::user()->id)],
//             'phone'     => ['max:50'],
//             'location' => ['max:70'],
//             'about_me'    => ['max:150'],
//         ]);
//         if($request->get('email') != Auth::user()->email)
//         {
//             if(env('IS_DEMO') && Auth::user()->id == 1)
//             {
//                 return redirect()->back()->withErrors(['msg2' => 'You are in a demo version, you can\'t change the email address.']);

//             }

//         }
//         else{
//             $attribute = request()->validate([
//                 'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore(Auth::user()->id)],
//             ]);
//         }


//         User::where('id',Auth::user()->id)
//         ->update([
//             'name'    => $attributes['name'],
//             'email' => $attribute['email'],
//             'phone'     => $attributes['phone'],
//             'location' => $attributes['location'],
//             'about_me'    => $attributes["about_me"],
//         ]);


//         return redirect('/user-profile')->with('success','Profile updated successfully');
//     }
// }
