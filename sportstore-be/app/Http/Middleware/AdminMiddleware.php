<?php

namespace App\Http\Middleware;

use App\Http\Helpers\ApiResponse;
use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        
        // Cho phép nếu là quan_tri (legacy) hoặc có vai trò khác 'customer'
        $hasAdminRole = $user && ($user->vai_tro === 'quan_tri' || $user->cacVaiTro()->where('ma_slug', '!=', 'customer')->exists());

        if (!$hasAdminRole) {
            return ApiResponse::forbidden('Bạn không có quyền truy cập trang quản trị');
        }

        return $next($request);
    }
}
