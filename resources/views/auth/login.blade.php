<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
      body {
    background: #f6f7fb;
    font-family: 'Arial', sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.login-container {
    width: 420px;
}

.login-box {
    background: white;
    padding: 40px 35px;
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.08);
}

h2 {
    font-size: 28px;
    font-weight: 700;
    text-align: center;
}

.subtitle {
    text-align: center;
    color: #6b7280;
    font-size: 14px;
    margin-bottom: 25px;
}

label {
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 6px;
    display: block;
}

.input-group {
    position: relative;
    margin-bottom: 18px;
}

.input-group i {
    position: absolute;
    top: 12px;
    left: 14px;
    font-size: 16px;
    color: #9ca3af;
}

.input-group input {
    width: 100%;
    padding: 12px 12px 12px 42px;
    border: 1px solid #d1d5db;
    border-radius: 10px;
    font-size: 15px;
}

.input-group input:focus {
    border-color: #f31260;
    outline: none;
}

.options {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin: 10px 0 20px;
}

.remember input {
    margin-right: 6px;
}

.forgot {
    color: #f31260;
    font-size: 14px;
    text-decoration: none;
}

.btn-login {
    width: 100%;
    background: #f31260;
    color: white;
    padding: 14px;
    border: none;
    border-radius: 12px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    box-shadow: 0 6px 18px rgba(243,18,96,0.3);
    transition: 0.2s;
}

.btn-login:hover {
    background: #d10f53;
}

.register {
    text-align: center;
    font-size: 14px;
    margin-top: 18px;
    color: #6b7280;
}

.register a {
    color: #f31260;
    font-weight: 600;
    text-decoration: none;
}

    </style>
</head>
<body>

<div class="login-container">
    <form class="login-box" action="{{ route('login.post') }}" method="POST">
        @csrf

        <h2>Welcome Back</h2>
        <p class="subtitle">Sign in to access your courses</p>

        <!-- Email -->
        <label>Email Address</label>
        <div class="input-group">
            <i class="fa-regular fa-envelope"></i>
            <input type="email" name="email" placeholder="you@example.com" required>
        </div>

        <!-- Password -->
        <label>Password</label>
        <div class="input-group">
            <i class="fa-solid fa-lock"></i>
            <input type="password" name="password" placeholder="••••••••" required>
        </div>

        <div class="options">
            <label class="remember">
                <input type="checkbox"> Remember me
            </label>

            <a href="#" class="forgot">Forgot password?</a>
        </div>

        <button class="btn-login" type="submit">Sign In <i class="fa-solid fa-arrow-right"></i></button>

        <p class="register">
            Don't have an account?
            <a href="{{ route('register') }}">Sign up for free</a>
        </p>
    </form>
</div>

</body>
</html>
