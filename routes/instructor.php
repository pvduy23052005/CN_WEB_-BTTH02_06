<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController as Controller;

// [get] /course
Route::get(
  '/course',
  [Controller::class, "index"]
);
