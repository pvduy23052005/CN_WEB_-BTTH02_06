{{-- File: resources/views/courses/detail.blade.php --}}

@extends('layout.layoutSinhVien') 
{{-- Kế thừa layout chung (từ file layoutDefault.blade.php) --}}

@section('title', $course->title . ' - Chi tiết Khóa học')

@section('main-content')
    <div class="container my-5">
        
        {{-- Hiển thị thông báo lỗi/thành công từ Controller --}}
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        
        <div class="row">
            {{-- CỘT NỘI DUNG CHÍNH (COURSE INFO VÀ LESSONS) --}}
            <div class="col-lg-8">
                <h1>{{ $course->title }}</h1>
                <p class="lead text-muted">{{ $course->category->name ?? 'Chưa phân loại' }}</p>
                <p>Giảng viên: <strong>{{ $course->instructor->fullname ?? 'N/A' }}</strong></p>
                
                <h3 class="mt-4">Mô tả Khóa học</h3>
                <div class="content-body">
                    {!! $course->description !!} 
                    {{-- Dùng {!! !!} nếu description chứa HTML --}}
                </div>

                <h3 class="mt-5">Nội dung Khóa học (Cấu trúc)</h3>
                <div class="list-group">
                    {{-- Lặp qua danh sách bài học ($lessons) --}}
                    @forelse ($lessons as $lesson)
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <span class="me-3">{{ $lesson->order }}.</span>
                                {{ $lesson->title }} 
                            </div>
                            @if ($isEnrolled)
                                {{-- Nếu đã đăng ký, cho phép truy cập bài học --}}
                                <a href="{{ route('student.learn', $lesson->id) }}" class="btn btn-link btn-sm">Xem bài học</a>
                            @endif
                        </div>
                    @empty
                        <div class="list-group-item text-muted">Khóa học này chưa có bài học nào.</div>
                    @endforelse
                </div>
            </div>
            
            {{-- CỘT SIDEBAR (NÚT ĐĂNG KÝ/HỌC) --}}
            <div class="col-lg-4">
                <div class="card shadow-lg sticky-top" style="top: 20px;">
                    <div class="card-body text-center">
                        <h4 class="card-title mb-4">Giá: {{ number_format($course->price ?? 0, 0, ',', '.') }} VND</h4>
                        
                        @if ($isEnrolled)
                            {{-- TRƯỜNG HỢP 1: ĐÃ ĐĂNG KÝ --}}
                            <p class="alert alert-success">Bạn đã đăng ký khóa học này!</p>
                            <a href="{{ route('student.progress', $course->id) }}" class="btn btn-success btn-lg w-100">
                                Tiếp tục học
                            </a>
                        @else
                            {{-- TRƯỜNG HỢP 2: CHƯA ĐĂNG KÝ (HIỂN THỊ NÚT ĐĂNG KÝ) --}}
                            <p class="alert alert-info">Bạn chưa đăng ký khóa học này.</p>
                            <form method="POST" action="{{ route('student.enroll', $course->id) }}">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-lg w-100">
                                    Đăng ký Khóa học Ngay
                                </button>
                            </form>
                        @endif
                        
                        <hr class="my-3">
                        <p>Trình độ: **{{ $course->level ?? 'Tất cả' }}**</p>
                        <p>Thời lượng: **{{ $course->duration_weeks ?? 'N/A' }}** tuần</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection