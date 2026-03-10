<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Models\DonHang;
use App\Models\NguoiDung;
use App\Models\SanPham;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

/**
 * @group 1. Quản trị (Admin)
 * @subgroup Thống kê
 * @authenticated
 */
class DashboardAdminController extends Controller
{
    /**
     * Lấy thống kê tổng quan
     * 
     * Trả về các chỉ số cơ bản cho Dashboard admin.
     */
    public function index(): JsonResponse
    {
        $orderStats = DonHang::where('trang_thai', '!=', 'da_huy')
            ->selectRaw('COUNT(*) as total_orders, SUM(tong_tien) as total_revenue')
            ->first();

        $productCount = SanPham::count();
        $userCount = NguoiDung::where('vai_tro', 'khach_hang')->count();

        $recentOrders = DonHang::with('nguoiDung')
            ->latest()
            ->take(10)
            ->get()
            ->map(function ($order) {
                return [
                    'id' => $order->id,
                    'ma_don_hang' => $order->ma_don_hang,
                    'khach_hang' => $order->ten_nguoi_nhan,
                    'tong_tien' => $order->tong_tien,
                    'trang_thai' => $order->trang_thai,
                    'thoi_gian' => $order->created_at->diffForHumans(),
                ];
            });

        return ApiResponse::success([
            'stats' => [
                'total_revenue' => $orderStats->total_revenue ?? 0,
                'total_orders' => $orderStats->total_orders ?? 0,
                'total_products' => $productCount,
                'total_users' => $userCount,
            ],
            'recent_orders' => $recentOrders
        ], 'Thống kê tổng quan');
    }
}
