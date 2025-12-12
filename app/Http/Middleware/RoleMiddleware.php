<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   * @param  mixed ...$roles  <-- Sửa $role thành ...$roles để nhận nhiều quyền
   */
  public function handle(Request $request, Closure $next, ...$roles): Response
  {
    // 1. Kiểm tra đăng nhập
    if (!Auth::check()) {
      return redirect('/auth/login')->with('error', 'Vui lòng đăng nhập.');
    }

    // 2. Logic kiểm tra quyền nâng cao
    // Cách hoạt động: 
    // - Nếu role của user nằm trong danh sách cho phép
    // - HOẶC nếu user là Admin (role == 2) thì luôn cho qua (Quyền lực tối cao)
    if (in_array($user->role, $roles) || $user->role == 2) {
      return $next($request);
    }

    // 3. Nếu không đủ quyền
    return redirect('/auth/login')->with('error', 'Bạn không có quyền truy cập trang này.');
  }
}
