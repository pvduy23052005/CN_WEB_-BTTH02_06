<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course; 
use App\Models\Category;
use App\Models\Enrollment; 
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Chức năng 1: Xem danh sách khóa học (Catalogue có tìm kiếm, lọc)
     * Route: /student/courses -> student.courses.index
     */
    public function index(Request $request)
    {
        $categories = Category::all(); 
        $courses = Course::query();
        
        // Logic Tìm kiếm theo tiêu đề
        if ($request->filled('search')) {
            $courses->where('title', 'like', "%{$request->search}%");
        }
        
        // Logic Lọc theo Danh mục (category_id)
        if ($request->filled('category')) {
            $courses->where('category_id', $request->category);
        }
        
        $courses = $courses->paginate(12);
        
        // ĐÃ SỬA VIEW 1: Giả định file là resources/views/courses/search.blade.php
        return view('courses.search', [ 
            'title' => 'Danh sách Khóa học',
            'courses' => $courses,
            'categories' => $categories,
            'search_query' => $request->search, 
            'selected_category' => $request->category, 
        ]);
    }

    /**
     * Chức năng 2: Xem chi tiết khóa học
     * Route: /student/courses/{id} -> student.courses.detail
     */
    public function show($id)
    {
        // Giả định bạn có lesson với cột 'order' để sắp xếp
        $course = Course::with(['lessons' => function($query) {
            $query->orderBy('order'); 
        }])->findOrFail($id);
        
        $userId = Auth::id();

        // ĐÃ SỬA LOGIC: Kiểm tra đăng ký bằng cột 'student_id'
        $isEnrolled = Enrollment::where('student_id', $userId) 
                                 ->where('course_id', $id)
                                 ->exists();
        
        // ĐÃ SỬA VIEW 2: Giả định file là resources/views/courses/detail.blade.php
        return view('courses.detail', [ 
            'title' => $course->title,
            'course' => $course,
            'isEnrolled' => $isEnrolled,
            'lessons' => $course->lessons, // Dữ liệu đã sắp xếp từ with()
        ]);
    }
    
    /**
     * Chức năng 4: Xem khóa học đã đăng ký (My Courses) - Trang chủ Học viên
     * Route: /student/ -> student.my_courses
     */
    public function showMyCourses()
    {
        $userId = Auth::id();
        
        // ĐÃ SỬA LOGIC: Lấy bản ghi Enrollment bằng cột 'student_id'
        $enrollments = Enrollment::where('student_id', $userId) // <-- SỬA TÊN CỘT
                                 ->with('course') 
                                 ->paginate(10); 
        
        // ĐÃ SỬA VIEW 3: Giả định file là resources/views/students/my_courses.blade.php
        return view('students.my_courses', [ 
            "title" => "Khóa học của tôi",
            "enrollments" => $enrollments,
        ]);
    }
}