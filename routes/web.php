<?php

// routes/web.php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// 1. CHUYỂN HƯỚNG MẶC ĐỊNH
Route::redirect('/', '/login'); 

// 2. ROUTES XÁC THỰC
// Đăng nhập
Route::get('/login', [AuthController::class, 'showLoginForm'])->middleware('guest')->name('login'); 
Route::post('/login', [AuthController::class, 'login'])->middleware('guest')->name('login.post');

// Đăng ký
Route::get('/register', [AuthController::class, 'showRegisterForm'])->middleware('guest')->name('register'); 
Route::post('/register', [AuthController::class, 'register'])->middleware('guest')->name('register.post');

// 3. VÙNG BẢO VỆ
Route::get('/dashboard', function () {
    return view('students.dashboard'); 
})->middleware('auth')->name('dashboard');


// Định nghĩa nhóm route cho Học viên (sử dụng file student.php)
Route::middleware('auth')->prefix('student')->group(base_path('routes/student.php'));

// Định nghĩa nhóm route cho Quản trị viên (sử dụng file admin.php)
Route::middleware('auth')->prefix('admin')->group(base_path('routes/admin.php'));