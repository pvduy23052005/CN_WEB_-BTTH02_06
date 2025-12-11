{{-- File: resources/views/layouts/layoutSinhVien.blade.php --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Học viên - @yield('title', 'Trang chủ')</title>
    
    {{-- THAY THẾ CHO PHẦN HEAD TRONG layoutDefault CŨ --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100..900;1,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    {{-- LIÊN KẾT CSS TÙY CHỈNH CỦA BẠN --}}
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    
    <style>
        /* CSS TẠO CẤU TRÚC SIDEBAR */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100vh;
            background-color: #343a40; /* Màu nền Sidebar */
            padding-top: 100px; /* Cần điều chỉnh để bù lại chiều cao của Header của bạn */
            z-index: 1000;
        }
        .content-wrapper {
            margin-left: 250px; /* Bù lại chiều rộng Sidebar */
            padding-top: 20px; /* Đảm bảo nội dung không bị Header che mất */
        }
    </style>
</head>
<body>

    {{-- HEADER SINH VIÊN --}}
    @include('layout.headerStudent') 

    {{-- 1. SIDEBAR (MENU SINH VIÊN) --}}
    <div class="sidebar">
        <div class="p-3">
            <h5 class="text-white mt-3">Menu Học Tập</h5>
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link text-white" href="{{ url('/student') }}">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('student.my_courses') }}">
                    <i class="fas fa-book-open"></i> Khóa học của tôi
                </a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('student.courses.index') }}">
                    <i class="fas fa-search"></i> Khám phá Khóa học
                </a></li>
                {{-- Thêm các liên kết khác như Hồ sơ, Lịch sử... --}}
            </ul>
        </div>
    </div>
    
    {{-- 2. MAIN CONTENT (NỘI DUNG CHÍNH) --}}
    <div class="content-wrapper">
        <div class="container-fluid py-4">
            @yield('main-content')
        </div>
    </div>

    {{-- FOOTER --}}
    @include("layout.footer")
    
    {{-- SCRIPTS --}}
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>