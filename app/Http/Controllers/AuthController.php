<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rules;
use App\Providers\RouteServiceProvider;

class AuthController extends Controller
{
    
    public function showRegisterForm()
    {
        return view('auth.register'); 
    }
    
    // Xử lý logic đăng ký (Route POST /register)
    public function register(Request $request)
    {
        // 1. Validation 
        $request->validate([
            'fullname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        
        $user = User::create([
            'fullname' => $request->fullname,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 0, // Mặc định là Học viên
            'deleted' => false, // Đảm bảo user mới được tạo là active
        ]);

        // 3. Đăng nhập và chuyển hướng
        Auth::login($user);
        
        return redirect()->intended(RouteServiceProvider::HOME); 
    }
    
    

    // Hiển thị form đăng nhập (Route GET /login)
    public function showLoginForm()
    {
        return view('auth.login'); 
    }

    // Xử lý logic đăng nhập (Route POST /login)
    public function login(Request $request)
    {
        // 1. Validation 
        $request->validate([
           
            'username' => 'required|email', 
            'password' => 'required',
        ]);
        
        
        $credentials = [
            
            'email' => $request->username, 
            'password' => $request->password,
            'deleted' => false, 
        ];

        if (Auth::attempt($credentials, $request->has('remember'))) {
            $request->session()->regenerate();
            
            // --- LOGIC CHUYỂN HƯỚNG THEO VAI TRÒ (ROLE-BASED REDIRECTION) ---
            
            $user = Auth::user();

            switch ($user->role) {
                case 0: // Học viên
                    // ĐÃ SỬA: Chuyển hướng đến Route gốc /student
                    return redirect()->intended('/student'); 
                    break;
                case 1: // Giảng viên
                    return redirect()->intended('/instructor/dashboard');
                    break;
                case 2: // Quản trị viên
                    return redirect()->intended('/admin/dashboard');
                    break;
                default:
                    return redirect()->intended(RouteServiceProvider::HOME);
            }
        }

        // 3. Báo lỗi thất bại
        throw ValidationException::withMessages([
            // Báo lỗi cho trường input 'username'
            'username' => __('auth.failed'), 
        ]);
    }
    
    // =======================================================
    // III. ĐĂNG XUẤT (LOGOUT)
    // =======================================================
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/login');
    }
}