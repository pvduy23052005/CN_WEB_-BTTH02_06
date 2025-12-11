<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;



class User extends Authenticatable
{
    
    protected $table = 'users';

    
    protected $fillable = [
        'username',
        'email',
        'password',
        'fullname',
        'role',
        
    ];

    
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Các thuộc tính nên được ép kiểu (cast) sang kiểu dữ liệu cụ thể.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        // 'deleted' => 'boolean', // Nếu muốn ép kiểu boolean
    ];
    
    
    protected static function booted()
    {
        static::addGlobalScope('active', function ($builder) {
            $builder->where('deleted', false);
        });
    }

    
    public static function withDeleted()
    {
        return static::withoutGlobalScope('active');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'user_id');
    }
    public function courses()
    {
        // 'courses' là Model đích, 'enrollments' là tên bảng trung gian
        return $this->belongsToMany(Course::class, 'enrollments', 'user_id', 'course_id');
    }

    public function createdCourses()
    {
        return $this->hasMany(Course::class, 'instructor_id');
    }
    
    // Thêm các phương thức tiện ích để kiểm tra vai trò (Role Check)
    public function isAdmin()
    {
        return $this->role === 2;
    }
    public function isInstructor()
    {
        return $this->role === 1;
    }
    
    public function isStudent()
    {
        return $this->role === 0;
    }


}