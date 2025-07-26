<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\Admin\ResetController;
use App\Http\Controllers\Admin\TrackController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
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
use App\Http\Controllers\User\CourseController; // تحكم المستخدم في الكورسات

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. مسارات الضيوف (غير مسجلين)
Route::middleware('guest')->group(function () {
    // Route::get('/register', [RegisterController::class, 'create']);
    // Route::post('/register', [RegisterController::class, 'store']);

    Route::get('/login', [SessionsController::class, 'create'])->name('login');
    Route::post('/session', [SessionsController::class, 'store'])->name('session.store');

    Route::get('/login/forgot-password', [ResetController::class, 'create']);
    Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
    Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
    Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');
});

// 2. الصفحة الرئيسية - تعرض لوحة المستخدم للجميع (مسجلين أو زوار)
Route::get('/', [UserDashboardController::class, 'dashboard'])->name('home');

// 3. مسارات المستخدم العادي (محمية بالتسجيل والدور)
Route::middleware(['auth', 'role:user'])->prefix('user')->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'dashboard'])->name('user.dashboard');

    // مسارات الكورسات الخاصة بالمستخدم
    // Route::get('/courses/{course}', [CourseController::class, 'show'])->name('user.courses.show');
    // Route::post('/courses/{course}/enroll', [CourseController::class, 'enroll'])->name('user.courses.enroll');

    // الطلبات الخاصة بالمستخدم
    Route::get('/orders', [OrderController::class, 'index'])->name('user.orders.index');
    Route::get('/orders/create', [OrderController::class, 'create'])->name('user.orders.create');
    Route::post('/orders', [OrderController::class, 'store'])->name('user.orders.store');

    // ملف المستخدم الشخصي
    Route::get('/profile', [ProfileController::class, 'show'])->name('user.profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('user.profile.update');
});

// 4. مسارات المستخدمين المسجلين (أي دور) مشتركة (مثلاً logout)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [SessionsController::class, 'destroy'])->name('logout');

    Route::get('/user-profile', [InfoUserController::class, 'create'])->name('user.profile');
    Route::post('/user-profile', [InfoUserController::class, 'store'])->name('user.profile.update');
});

// 5. مسارات الأدمن محمية
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'adminDashboard'])->name('admin.dashboard');
Route::get('/admin/dashboard', [HomeController::class, 'index'])->name('dashboard');

    Route::get('/billing', fn() => view('admin.billing'))->name('billing');
    Route::get('/profile', fn() => view('admin.profile'))->name('profile');
    Route::get('/rtl', fn() => view('admin.rtl'))->name('rtl');
    Route::get('/tables', fn() => view('admin.tables'))->name('tables');
    Route::get('/virtual-reality', fn() => view('admin.virtual-reality'))->name('virtual-reality');
    Route::get('/static-sign-in', fn() => view('admin.static-sign-in'))->name('sign-in');
    Route::get('/static-sign-up', fn() => view('admin.static-sign-up'))->name('sign-up');

    Route::get('/user-management', [InfoUserController::class, 'index'])->name('user-management');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');

    Route::resource('tracks', TrackController::class);
    Route::resource('tracks.course', TrackCourseController::class);

    Route::resource('course', AdminCourseController::class);

    Route::resource('videos', VideoController::class);
    Route::resource('course.videos', CourseVideoController::class);

    Route::resource('quizzes', QuizController::class);
    Route::resource('quizzes.course', CourseQiuzController::class);

    Route::resource('question', QuestionController::class, ['except' => ['show']]);
    Route::resource('quiz.questions', QuizQuestionController::class);
});
