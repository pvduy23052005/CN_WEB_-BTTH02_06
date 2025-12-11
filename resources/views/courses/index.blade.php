{{-- File: resources/views/courses/index.blade.php --}}

@extends('layout.layoutSinhVien') 
@section('title', 'Danh sách Khóa học')

@section('main-content')
    <div class="container my-5">
        <h1 class="mb-4">Khám phá Khóa học</h1>

        {{-- Form Tìm kiếm và Lọc --}}
        <div class="row mb-4">
            <form method="GET" action="{{ route('student.courses.index') }}" class="d-flex align-items-center">
                <div class="col-md-5 me-2">
                    <input type="text" name="search" class="form-control" placeholder="Tìm kiếm theo tên khóa học..." value="{{ $search_query }}">
                </div>
                
                <div class="col-md-4 me-2">
                    <select name="category" class="form-select">
                        <option value="">-- Lọc theo Danh mục --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $selected_category == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-md-3">
                    <button type="submit" class="btn btn-info text-white me-2">Lọc & Tìm</button>
                    <a href="{{ route('student.courses.index') }}" class="btn btn-secondary">Đặt lại</a>
                </div>
            </form>
        </div>

        <div class="row">
            @forelse ($courses as $course)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $course->title }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{ $course->category->name ?? 'Chưa phân loại' }}</h6>
                            <p class="card-text">{{ Str::limit($course->description, 70) }}</p>
                            <a href="{{ route('student.courses.detail', $course->id) }}" class="btn btn-primary btn-sm">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-warning">Không tìm thấy khóa học nào phù hợp.</div>
            @endforelse
        </div>
        
        <div class="d-flex justify-content-center mt-4">
            {{ $courses->links() }}
        </div>
    </div>
@endsection