{{-- File: resources/views/students/learn/lesson.blade.php --}}

@extends('layout.layoutSinhVien') 
{{-- Kế thừa layout chung --}}

@section('title', $lesson->title)

@section('main-content')
    <div class="container-fluid my-5">
        <div class="row">
            
            {{-- CỘT NỘI DUNG CHÍNH (VIDEO & TEXT) --}}
            <div class="col-lg-9">
                <h1 class="mb-3">{{ $lesson->title }}</h1>
                <p class="text-muted">Khóa học: {{ $course->title }}</p>
                
                <div class="lesson-content bg-white p-4 shadow-sm rounded">
                    @if ($lesson->video_url)
                        {{-- 1. HIỂN THỊ VIDEO --}}
                        <div class="ratio ratio-16x9 mb-4">
                            {{-- Sử dụng iframe để nhúng video từ YouTube hoặc các dịch vụ khác --}}
                            <iframe src="{{ $lesson->video_url }}" allowfullscreen 
                                    frameborder="0" allow="autoplay; encrypted-media"></iframe>
                        </div>
                    @endif
                    
                    {{-- 2. NỘI DUNG TEXT/MÔ TẢ --}}
                    <h3>Nội dung Bài học</h3>
                    <div class="content-text mt-3">
                        {{-- Dùng {!! !!} để hiển thị nội dung HTML nếu cần --}}
                        {!! $lesson->content !!} 
                    </div>
                </div>
                
                {{-- 3. NÚT ĐÁNH DẤU HOÀN THÀNH --}}
                <div class="d-flex justify-content-end mt-4">
                    {{-- Lý tưởng: POST tới 1 route LessonProgressController để lưu tiến độ --}}
                    <button class="btn btn-success btn-lg">✓ Đánh dấu Hoàn thành</button>
                </div>
            </div>
            
            {{-- CỘT SIDEBAR (TÀI LIỆU VÀ CẤU TRÚC KHÓA HỌC) --}}
            <div class="col-lg-3">
                <div class="card shadow-sm sticky-top" style="top: 20px;">
                    <div class="card-header bg-primary text-white">
                        Tài liệu Kèm theo
                    </div>
                    <ul class="list-group list-group-flush">
                        @forelse ($materials as $material)
                            <li class="list-group-item">
                                {{-- Giả định hiển thị icon dựa trên file_type --}}
                                <i class="fas fa-file-download"></i> {{ $material->filename }}
                                
                                {{-- Liên kết tải xuống file --}}
                                <a href="{{ asset('uploads/materials/' . $material->file_path) }}" 
                                   target="_blank" class="float-end btn btn-sm btn-outline-secondary">
                                    Tải xuống
                                </a>
                            </li>
                        @empty
                            <li class="list-group-item text-muted">Không có tài liệu nào.</li>
                        @endforelse
                    </ul>
                </div>
                
                {{-- Bạn có thể thêm danh sách bài học khác của khóa học vào đây --}}
                {{-- để học viên dễ dàng chuyển đổi --}}
            </div>
        </div>
    </div>
@endsection