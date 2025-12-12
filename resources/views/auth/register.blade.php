<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đăng Ký - Admin Panel</title>
  <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>

  <style>
  .role-btn.active {
    border: 2px solid #695cfe !important;
    background: linear-gradient(135deg, #695cfe 0%, #8b7fff 100%) !important;
    color: white !important;
    box-shadow: 0 4px 12px rgba(105, 92, 254, 0.3) !important;
  }
  </style>

  <div class="register-container">
    <div class="register-card">
      <!-- Logo & Title -->
      <div class="logo-container">
        <div class="logo">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
          </svg>
        </div>
        <h1 class="register-title">Tạo tài khoản mới</h1>
        <p class="register-subtitle">Đăng ký để sử dụng hệ thống</p>
      </div>

      <!-- Error/Success Message -->
      <div class="error-message" id="errorMessage">
        Vui lòng kiểm tra lại thông tin!
      </div>
      <div class="success-message" id="successMessage">
        Đăng ký thành công! Đang chuyển hướng...
      </div>

      <!-- Role Selection -->
      <div class="role-selection">
        <label class="form-label">Chọn vai trò đăng ký</label>
        <div class="role-buttons">
          <button type="button" class="role-btn" data-role="admin" data-role-id="2">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
            </svg>
            <span>Admin</span>
          </button>
          <button type="button" class="role-btn" data-role="instructor" data-role-id="1">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
            <span>Instructor</span>
          </button>
          <button type="button" class="role-btn" data-role="student" data-role-id="0">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
            </svg>
            <span>Student</span>
          </button>
        </div>
      </div>

      <!-- Register Form -->
      <form id="registerForm" method="POST" action="/auth/register">
        @csrf
        
        <!-- INPUT ẨN ĐỂ GỬI ROLE -->
        <input type="hidden" name="role" id="roleInput" value="">

        <!-- Full Name & Email -->
        <div class="form-row">
          <div class="form-group">
            <label class="form-label" for="fullname">Họ và tên</label>
            <div class="input-wrapper">
              <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
              </svg>
              <input 
                type="text" 
                id="fullname"
                name="fullname"
                class="form-input" 
                placeholder="Nguyễn Văn A"
                required
              >
            </div>
          </div>

          <div class="form-group">
            <label class="form-label" for="email">Email</label>
            <div class="input-wrapper">
              <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
              </svg>
              <input 
                type="email" 
                id="email"
                name="email"
                class="form-input" 
                placeholder="email@example.com"
                required
              >
            </div>
            @error('email')
                <span style="color: red; font-size: 13px; margin-top: 5px; display: block;">
                    {{ $message }}
                </span>
            @enderror
          </div>
        </div>

        <!-- Username -->
        <div class="form-group">
          <label class="form-label" for="username">Tên đăng nhập</label>
          <div class="input-wrapper">
            <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <input 
              type="text" 
              id="username"
              name="username"
              class="form-input" 
              placeholder="username"
              required
            >
          </div>
        </div>

        <!-- Password -->
        <div class="form-group">
          <label class="form-label" for="password">Mật khẩu</label>
          <div class="input-wrapper">
            <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
            <input 
              type="password" 
              id="password"
              name="password"
              class="form-input" 
              placeholder="••••••••"
              required
            >
            <button type="button" class="password-toggle" id="togglePassword">
              <svg id="eyeIcon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
              </svg>
            </button>
          </div>
        </div>

        <!-- Confirm Password -->
        <div class="form-group">
          <label class="form-label" for="confirmPassword">Xác nhận mật khẩu</label>
          <div class="input-wrapper">
            <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
            </svg>
            <input 
              type="password" 
              id="confirmPassword"
              name="password_confirmation"
              class="form-input" 
              placeholder="••••••••"
              required
            >
            <button type="button" class="password-toggle" id="toggleConfirmPassword">
              <svg id="eyeIcon2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
              </svg>
            </button>
          </div>
        </div>

        <!-- Register Button -->
        <button type="submit" class="btn-register">Đăng ký</button>
      </form>

      <!-- Login Link -->
      <div class="login-link">
        Đã có tài khoản? <a href="/auth/login">Đăng nhập ngay</a>
      </div>
    </div>
  </div>

  <script>
    // Khai báo biến selectedRole
    let selectedRole = null;
    
    // Role selection
    const roleBtns = document.querySelectorAll('.role-btn');
    const roleInput = document.getElementById('roleInput');

    roleBtns.forEach(btn => {
      btn.addEventListener('click', function() {
        roleBtns.forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        selectedRole = this.dataset.role;
        roleInput.value = this.dataset.roleId;
        console.log('Role selected:', selectedRole, 'ID:', roleInput.value);
      });
    });

    // Toggle password visibility
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');
    togglePassword.addEventListener('click', function() {
      const type = passwordInput.type === 'password' ? 'text' : 'password';
      passwordInput.type = type;
      
      if (type === 'text') {
        eyeIcon.innerHTML = `
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
        `;
      } else {
        eyeIcon.innerHTML = `
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
        `;
      }
    });

    const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
    const confirmPasswordInput = document.getElementById('confirmPassword');
    const eyeIcon2 = document.getElementById('eyeIcon2');

    toggleConfirmPassword.addEventListener('click', function() {
      const type = confirmPasswordInput.type === 'password' ? 'text' : 'password';
      confirmPasswordInput.type = type;
      
      if (type === 'text') {
        eyeIcon2.innerHTML = `
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
        `;
      } else {
        eyeIcon2.innerHTML = `
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
        `;
      }
    });

    // Form submission
    const registerForm = document.getElementById('registerForm');
    const errorMessage = document.getElementById('errorMessage');
    const successMessage = document.getElementById('successMessage');

    registerForm.addEventListener('submit', function(e) {
      e.preventDefault(); // Chặn submit tạm thời để validate
      
      // Check if role is selected
      if (!selectedRole || !roleInput.value) {
        errorMessage.textContent = 'Vui lòng chọn vai trò đăng ký!';
        errorMessage.classList.add('show');
        setTimeout(() => {
          errorMessage.classList.remove('show');
        }, 3000);
        return;
      }

      // Get form values
      const password = document.getElementById('password').value;
      const confirmPassword = document.getElementById('confirmPassword').value;

      // Validation
      if (password !== confirmPassword) {
        errorMessage.textContent = 'Mật khẩu xác nhận không khớp!';
        errorMessage.classList.add('show');
        setTimeout(() => {
          errorMessage.classList.remove('show');
        }, 3000);
        return;
      }

      if (password.length < 6) {
        errorMessage.textContent = 'Mật khẩu phải có ít nhất 6 ký tự!';
        errorMessage.classList.add('show');
        setTimeout(() => {
          errorMessage.classList.remove('show');
        }, 3000);
        return;
      }

      // Nếu tất cả validation pass, submit form thật
      console.log('Submitting form with role:', roleInput.value);
      this.submit(); // Submit form
    });
  </script>
</body>
</html>