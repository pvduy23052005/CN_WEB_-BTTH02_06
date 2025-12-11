{{-- File: resources/views/courses/search.blade.php --}}

@extends('layout.layoutSinhVien') {{-- Sử dụng layout có Sidebar --}}
@section('title', $title)

@section('main-content')
    <div class="container my-5">
        <h1>{{ $title }}</h1>
        <p class="lead">Tìm kiếm và khám phá các khóa học mới nhất.</p>

        {{-- FORM TÌM KIẾM VÀ LỌC --}}
        <form method="GET" action="{{ route('student.courses.index') }}" class="mb-4">
            <div class="row g-3">
                <div class="col-md-8">
                    <input type="text" name="search" class="form-control" placeholder="Tìm kiếm theo tiêu đề..." value="{{ request('search_query') }}">
                </div>
                <div class="col-md-3">
                    <select name="category" class="form-select">
                        <option value="">-- Tất cả Danh mục --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" 
                                {{ (string)$category->id === request('selected_category') ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary w-100">Lọc</button>
                </div>
            </div>
        </form>

        <hr>

        {{-- HIỂN THỊ DANH SÁCH KHÓA HỌC --}}
        <div class="row">
            @forelse ($courses as $course)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $course->title }}</h5>
                            <p class="card-text text-muted">{{ $course->category->name ?? 'Không rõ' }}</p>
                            <p class="card-text">{{ Str::limit($course->description, 80) }}</p>
                            <a href="{{ route('student.courses.detail', $course->id) }}" class="btn btn-sm btn-info">Chi tiết</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-warning">Không tìm thấy khóa học nào phù hợp với yêu cầu của bạn.</div>
                </div>
            @endforelse
        </div>

        {{-- PHÂN TRANG --}}
        <div class="mt-4">
            {{ $courses->links() }}
        </div>
    </div>
@endsection