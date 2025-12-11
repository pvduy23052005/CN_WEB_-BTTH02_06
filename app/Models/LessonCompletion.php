<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonCompletion extends Model // <--- Tên Class phải chính xác
{
    use HasFactory;

    // Tên bảng (Không bắt buộc nếu bạn dùng quy tắc đặt tên chuẩn của Laravel)
    protected $table = 'lesson_completions'; 

    // Các cột cho phép gán giá trị (create/firstOrCreate)
    protected $fillable = [
        'student_id', // <--- Phải là student_id để khớp với Migration
        'lesson_id', 
        'completed_at',
    ];

    // Khai báo các mối quan hệ (Relathionships)
    
    // Mối quan hệ với Học viên (User)
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
    
    // Mối quan hệ với Bài học (Lesson)
    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id');
    }
}