{{-- File: resources/views/students/my_courses.blade.php --}}

@extends('layout.layoutSinhVien') 
@section('title', 'Khóa học của tôi')

@section('main-content')
    <div class="container my-5">
        <h1 class="mb-4">Khóa học của tôi</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        
        <div class="row">
            @forelse ($enrollments as $enrollment)
                @php
                    $course = $enrollment->course;
                    $progress = $enrollment->progress ?? 0; 
                @endphp

                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $course->title }}</h5>
                            <p class="card-text text-muted">Giảng viên: {{ $course->instructor->fullname ?? 'N/A' }}</p>
                            
                            {{-- Thanh tiến độ --}}
                            <div class="progress mb-3">
                                <div class="progress-bar bg-info" role="progressbar" style="width: {{ $progress }}%;">
                                    {{ $progress }}%
                                </div>
                            </div>
                            
                            <a href="{{ route('student.progress', $course->id) }}" class="btn btn-primary btn-sm w-100">
                                Tiếp tục học
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">Bạn chưa đăng ký bất kỳ khóa học nào.</div>
<!-- <a href="{{ route('courses.index') }}" class="btn btn-success">Khám phá Khóa học</a> -->
                </div>
            @endforelse
        </div>
        
        {{ $enrollments->links() }}
    </div>
@endsection