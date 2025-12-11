<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;

// 1. Hiển thị danh sách
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');

// 2. Hiển thị form thêm mới (phải đặt trước route có {id} để tránh lỗi)
Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');

// 3. Xử lý lưu dữ liệu mới (Method POST)
Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');

// 4. Hiển thị form sửa (cần truyền id)
Route::get('/courses/{id}/edit', [CourseController::class, 'edit'])->name('courses.edit');

// 5. Xử lý cập nhật dữ liệu (Method PUT)
Route::put('/courses/{id}', [CourseController::class, 'update'])->name('courses.update');

// 6. Xử lý xóa (Method DELETE)
Route::delete('/courses/{id}', [CourseController::class, 'destroy'])->name('courses.destroy');