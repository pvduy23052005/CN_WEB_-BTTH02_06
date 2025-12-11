<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - EduMaster</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background: #fce4ec; /* hồng nhạt nền */
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            background: white;
            border-radius: 18px;
            padding: 45px 40px;
            width: 100%;
            max-width: 460px;
            box-shadow: 0 10px 35px rgba(0,0,0,0.08);
        }

        .header {
            text-align: center;
            margin-bottom: 35px;
        }

        .header h1 {
            font-size: 30px;
            font-weight: 700;
            color: #212121;
            margin-bottom: 6px;
        }

        .header p {
            color: #757575;
            font-size: 15px;
        }

        .form-group {
            margin-bottom: 22px;
        }

        .form-group label {
            font-size: 14px;
            font-weight: 600;
            color: #424242;
            margin-bottom: 6px;
            display: block;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper input {
            width: 100%;
            padding: 12px 15px 12px 45px;
            border: 1.5px solid #e0e0e0;
            border-radius: 10px;
            font-size: 15px;
            transition: 0.2s;
        }

        .input-wrapper input:focus {
            border-color: #ec407a;
            box-shadow: 0 0 0 3px #f8bbd0;
            outline: none;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 16px;
            color: #9e9e9e;
        }

        .btn-submit {
            width: 100%;
            padding: 14px;
            font-size: 16px;
            background: #ec407a;
            border: none;
            border-radius: 10px;
            color: white;
            font-weight: 600;
            margin-top: 10px;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-submit:hover {
            background: #d81b60;
            box-shadow: 0 6px 15px rgba(236, 64, 122, 0.35);
        }

        .footer-text {
            text-align: center;
            margin-top: 22px;
            font-size: 14px;
            color: #616161;
        }

        .footer-text a {
            color: #ec407a;
            text-decoration: none;
            font-weight: 600;
        }

        .footer-text a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <h1>Create Account</h1>
            <p>Join EduMaster to start learning</p>
        </div>

        <form>
            <div class="form-group">
                <label>Full Name</label>
                <div class="input-wrapper">
                    <span class="input-icon">👤</span>
                    <input type="text" placeholder="John Doe" required>
                </div>
            </div>

            <div class="form-group">
                <label>Email Address</label>
                <div class="input-wrapper">
                    <span class="input-icon">📧</span>
                    <input type="email" placeholder="you@example.com" required>
                </div>
            </div>

            <div class="form-group">
                <label>Password</label>
                <div class="input-wrapper">
                    <span class="input-icon">🔒</span>
                    <input type="password" placeholder="••••••••" required>
                </div>
            </div>

            <button class="btn-submit">Sign Up</button>

            <div class="footer-text">
                Already have an account?
                <a href="/login">Log in</a>
            </div>
        </form>
    </div>

</body>
</html>
