<?php

// database/migrations/..._create_lesson_completions_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lesson_completions', function (Blueprint $table) {
            $table->id();
            
            // THÊM CỘT STUDENT ID (Khóa ngoại trỏ đến users)
            $table->unsignedBigInteger('student_id'); 
            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');

            // THÊM CỘT LESSON ID (Khóa ngoại trỏ đến lessons)
            $table->unsignedBigInteger('lesson_id'); 
            $table->foreign('lesson_id')->references('id')->on('lessons')->onDelete('cascade');

            $table->timestamp('completed_at')->nullable();
            
            // Thêm ràng buộc độc nhất
            $table->unique(['student_id', 'lesson_id']); 
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lesson_completions');
    }
};