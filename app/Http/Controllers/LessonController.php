<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lesson;
use Illuminate\Support\Facades\Auth;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Gate; // Có thể dùng Gate/Policy để bảo mật

class LessonController extends Controller
{
    // Chức năng 6: Xem bài học và tài liệu
    // Route: /student/learn/{lessonId} -> student.learn
    public function showLesson($lessonId)
    {
        // 1. Lấy thông tin Bài học, kèm theo tài liệu và khóa học cha
        $lesson = Lesson::with(['materials', 'course'])->findOrFail($lessonId);
        $courseId = $lesson->course_id;
        $userId = Auth::id();
        
        // =======================================================
        // BƯỚC BẢO MẬT QUAN TRỌNG: Kiểm tra quyền truy cập
        // =======================================================
        
        // Đảm bảo người dùng đã đăng ký khóa học chứa bài học này
        $isEnrolled = Enrollment::where('user_id', $userId)
                                ->where('course_id', $courseId)
                                ->exists();

        if (!$isEnrolled) {
            // Chuyển hướng về trang chi tiết khóa học với thông báo lỗi
            return redirect()->route('student.courses.detail', $courseId)
                             ->with('error', 'Bạn cần đăng ký khóa học để xem bài học này.');
        }

        // =======================================================
        // Nếu đã vượt qua kiểm tra bảo mật, hiển thị nội dung học tập
        // =======================================================
        
        // Ghi lại tiến độ đã xem (Ví dụ: đánh dấu bài học này là "đang xem" hoặc "đã xem")
        // (Thao tác này cần logic chi tiết hơn, có thể dùng 1 bảng riêng như LessonProgress)

        return view('students.learn.lesson', [ 
            'title' => $lesson->title,
            'lesson' => $lesson,
            'course' => $lesson->course,
            'materials' => $lesson->materials, // Tài liệu kèm theo
        ]);
    }
}