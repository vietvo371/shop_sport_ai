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

        // Tài khoản master có mọi quyền truy cập admin
        if ($user->is_master) {
            return $next($request);
        }

        // User có vai_tro='quan_tri' (legacy admin) → full access vào admin area
        // Dù không có RBAC permission cụ thể, vẫn cho phép truy cập admin
        if ($user->vai_tro === 'quan_tri') {
            return $next($request);
        }

        // User cần có ÍT NHẤT 1 quyền RBAC hợp lệ mới được truy cập admin
        if (!$user->hasPermission('xem_dashboard') && !$user->hasPermission('xem_sp') &&
            !$user->hasPermission('xem_user') && !$user->hasPermission('xem_don') &&
            !$user->hasPermission('phan_quyen') && !$user->hasPermission('quan_ly_catalog') &&
            !$user->hasPermission('ma_giam_gia') && !$user->hasPermission('duyet_danh_gia') &&
            !$user->hasPermission('quan_ly_banner') && !$user->hasPermission('gui_quang_ba') &&
            !$user->hasPermission('xem_doanh_thu') && !$user->hasPermission('xem_vai_tro') &&
            !$user->hasPermission('xem_quyen')) {

            return ApiResponse::forbidden('Bạn không có quyền truy cập trang quản trị');
        }

        return $next($request);
    }
}
