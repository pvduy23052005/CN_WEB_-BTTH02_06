<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enrollment; 
use App\Models\Course; 
use App\Models\Lesson;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    // Chức năng 4: Đăng ký khóa học
    // Route: POST /student/enroll/{courseId} -> student.enroll
    public function enroll($courseId)
    {
        $userId = Auth::id();

        // 1. Đảm bảo khóa học tồn tại
        Course::findOrFail($courseId); 

        // 2. Kiểm tra đã đăng ký chưa
        $exists = Enrollment::where('user_id', $userId)
                             ->where('course_id', $courseId)
                             ->exists();

        if ($exists) {
            return back()->with('warning', 'Bạn đã đăng ký khóa học này rồi.');
        }

        // 3. Tạo bản ghi Enrollment
        Enrollment::create([
            'user_id' => $userId,
            'course_id' => $courseId,
            'enrollment_date' => now(), 
            'progress_percentage' => 0, // Khởi tạo tiến độ
        ]);

        return redirect()->route('student.my_courses')->with('success', 'Đăng ký khóa học thành công! Chúc bạn học tốt.');
    }
    
    // Chức năng 5: Theo dõi tiến độ học tập của một Khóa học
    // Route: /student/progress/{courseId} -> student.progress
    public function showProgress($courseId)
    {
        $userId = Auth::id();
        
        // 1. Tìm bản ghi đăng ký của người dùng cho khóa học này
        $enrollment = Enrollment::where('user_id', $userId)
                                  ->where('course_id', $courseId)
                                  ->with('course.lessons') // Load cả thông tin Khóa học và Bài học
                                  ->firstOrFail(); // Nếu chưa đăng ký thì báo lỗi 404
                                  
        $course = $enrollment->course;
        $lessons = $course->lessons;
        
        // Logic tính toán: Tổng số bài học
        $totalLessons = $lessons->count();
        // Logic tính toán: Số bài đã hoàn thành (Ví dụ: Dựa trên trường 'completed' trong bảng Enrollment hoặc LessonCompletion)
        // GIẢ SỬ bạn có một bảng LessonCompletion(user_id, lesson_id, completed_at)
        $completedLessons = 0; // Cần thay thế bằng logic truy vấn thực tế
        
        // Tính lại progress_percentage (nếu cần)
        $newProgress = $totalLessons > 0 ? round(($completedLessons / $totalLessons) * 100) : 0;
        
        // Cập nhật lại vào Enrollment (tùy chọn)
        $enrollment->update(['progress_percentage' => $newProgress]);

        return view('students.progress.show', [ // Ví dụ: students/progress/show.blade.php
            'title' => 'Tiến độ: ' . $course->title,
            'enrollment' => $enrollment,
            'course' => $course,
            'lessons' => $lessons,
            'totalLessons' => $totalLessons,
            'completedLessons' => $completedLessons,
            'progressPercentage' => $newProgress,
        ]);
    }
}
