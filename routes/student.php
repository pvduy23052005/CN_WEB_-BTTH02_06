<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\LessonController;

Route::get('/', [CourseController::class, 'showMyCourses'])->name('home');

Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{id}', [CourseController::class, 'show'])->name('courses.detail');
Route::post('/enroll/{courseId}', [EnrollmentController::class, 'enroll'])->name('enroll');
Route::get('/learn/{lessonId}', [LessonController::class, 'showLesson'])->name('learn');
Route::get('/progress/{courseId}', [EnrollmentController::class, 'showProgress'])->name('progress');

