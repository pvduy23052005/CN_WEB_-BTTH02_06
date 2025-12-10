<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CourseController extends Controller
{

  // [get] /instructor/course 
  public function index(Request $request, Response $response)
  {
    return view('courses.index', [
      "title" => "Dashboard course",
    ]);
  }

  // [get] /student/my_courses
  public function showMyCourses()
  {
      return view('students.my_courses', [
          "title" => "my Course"
      ]);
  }
  
}
