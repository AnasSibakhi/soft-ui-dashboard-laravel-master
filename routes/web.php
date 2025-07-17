<?php
use App\Models\Video;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\Admin\ResetController;
use App\Http\Controllers\Admin\TrackController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\Admin\InfoUserController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\RegisterController;
use App\Http\Controllers\Admin\SessionsController;
use App\Http\Controllers\Admin\CourseQiuzController;
use App\Http\Controllers\Admin\CourseVideoController;
use App\Http\Controllers\Admin\TrackCourseController;
use App\Http\Controllers\Admin\QuizQuestionController;
use App\Http\Controllers\Admin\ChangePasswordController;
use App\Models\Quiz;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ✅ واجهات الضيوف (غير المسجلين)
Route::middleware(['guest'])->group(function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [SessionsController::class, 'create'])->name('login');
    Route::post('/session', [SessionsController::class, 'store']);
	Route::get('/login/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');
    Route::get('/profile', [ProfileController::class, 'show'])->name('user.profile');
Route::put('/profile', [ProfileController::class, 'update'])->name('user.profile.update');

});

// ✅ واجهات الأدمن فقط
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', [HomeController::class, 'adminDashboard']);
	Route::get('/dashboard', fn() => view('admin.dashboard'))->name('dashboard');
	Route::get('/billing', fn() => view('admin.billing'))->name('billing');
	Route::get('/profile', fn() => view('admin.profile'))->name('profile');
	Route::get('/rtl', fn() => view('admin.rtl'))->name('rtl');
	Route::get('/tables', fn() => view('admin.tables'))->name('tables');
    Route::get('/virtual-reality', fn() => view('admin.virtual-reality'))->name('virtual-reality');
    Route::get('/static-sign-in', fn() => view('admin.static-sign-in'))->name('sign-in');
    Route::get('/static-sign-up', fn() => view('admin.static-sign-up'))->name('sign-up');
    // Route::get('/user-profile', [InfoUserController::class, 'create']);
    // Route::post('/user-profile', [InfoUserController::class, 'store']);
    Route::get('/user-management', [InfoUserController::class, 'index'])->name('user-management');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    Route::post('/logout', [SessionsController::class, 'destroy'])->name('logout');
           });

// ✅ واجهات المستخدم العادي فقط
Route::middleware(['auth', 'role:user'])->prefix('user')->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'userDashboard'])->name('user.dashboard');

});
// Route::middleware(['auth'])->group(function () {
//     Route::get('/profile', [ProfileController::class, 'create'])->name('user.profile');
//     Route::put('/profile', [ProfileController::class, 'store'])->name('user.profile');
// });
Route::middleware(['auth'])->group(function () {
    Route::get('/user-profile', [InfoUserController::class, 'create'])->name('user.profile');
    Route::post('/user-profile', [InfoUserController::class, 'store'])->name('user.profile.update');
});


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', fn() => view('admin.dashboard'))->name('dashboard');
});

Route::get('/', function () {
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect('/login')->with('success', 'تم تسجيل الخروج.');
});
Route::middleware(['auth', 'role:user'])->prefix('user')->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'dashboard'])->name('user.dashboard');
});

Route::middleware(['auth', 'role:user'])->prefix('user')->group(function () {
    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');

    Route::get('/orders', [OrderController::class, 'index'])->name('user.orders.index');
    Route::get('/orders/create', [OrderController::class, 'create'])->name('user.orders.create');
    Route::post('/orders', [OrderController::class, 'store'])->name('user.orders.store');

    Route::get('/profile', [ProfileController::class, 'show'])->name('user.profile');
});
Route::resource('admin/tracks', TrackController::class);
    Route::resource('admin/tracks.course', TrackCourseController::class);

Route::resource('admin/course', CourseController::class);

Route::resource('admin/videos', VideoController::class);
    Route::resource('admin/course.videos', CourseVideoController::class);

Route::resource('admin/quizzes', QuizController::class);
    Route::resource('admin/quizzes.course', CourseQiuzController::class);

Route::resource('admin/question', QuestionController::class , ['except' => ['show']]);
Route::resource('admin/quiz.questions', QuizQuestionController::class);

Route::resource('quizzes.questions', QuestionController::class);
