{{-- File: resources/views/students/cours_progress.blade.php --}}

@extends('layout.layoutSinhVien') 
@section('title', 'Tiến độ Khóa học')

@section('main-content')
    <div class="container my-5">
        <h1 class="mb-4">Tiến độ Khóa học: {{ $course->title }}</h1>
        
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <h4 class="card-title">Tổng quan Tiến độ</h4>
                <div class="progress mb-3" style="height: 30px;">
                    <div class="progress-bar bg-info" role="progressbar" style="width: {{ $progressPercentage }}%;">
                         {{ $progressPercentage }}% Hoàn thành
                    </div>
                </div>
            </div>
        </div>

        <h3 class="mt-5">Danh sách Bài học</h3>
        <div class="list-group">
            @forelse ($lessons as $lesson)
                @php
                    // Logic kiểm tra hoàn thành (Tạm thời là false)
                    $isCompleted = false; 
                @endphp

                <div class="list-group-item d-flex justify-content-between align-items-center {{ $isCompleted ? 'bg-light' : '' }}">
                    <div>
                        <span class="me-3">{{ $lesson->order }}.</span>
                        {{ $lesson->title }}
                    </div>
                    <div>
                        @if ($isCompleted)
                            <span class="badge bg-success me-3">Đã hoàn thành</span>
                        @else
                            <a href="{{ route('student.learn', $lesson->id) }}" class="btn btn-sm btn-primary">
                                {{ 'Bắt đầu học' }}
                            </a>
                        @endif
                    </div>
                </div>
            @empty
                 <div class="alert alert-warning">Khóa học chưa có bài học nào được thêm.</div>
            @endforelse
        </div>
        
    </div>
@endsection