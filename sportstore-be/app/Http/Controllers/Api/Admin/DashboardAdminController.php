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
        if (!auth()->user()->hasPermission('xem_dashboard')) {
            return ApiResponse::error('Bạn không có quyền xem bảng điều khiển.', 403);
        }

        $orderStats = DonHang::where('trang_thai', '!=', 'da_huy')
            ->selectRaw('COUNT(*) as total_orders, SUM(tong_tien) as total_revenue')
            ->first();

        $productCount = SanPham::count();
        $userCount = NguoiDung::where('vai_tro', 'khach_hang')->count();

        // 1. Doanh thu theo tháng (6 tháng gần nhất)
        $revenueChart = DB::table('don_hang')
            ->where('trang_thai', '!=', 'da_huy')
            ->where('created_at', '>=', now()->subMonths(6))
            ->selectRaw("DATE_FORMAT(created_at, '%m/%Y') as month, SUM(tong_tien) as total")
            ->groupBy('month')
            ->orderByRaw("MIN(created_at)")
            ->get();

        // 2. Top sản phẩm bán chạy (theo số lượng trong chi tiết đơn hàng)
        $topProducts = DB::table('chi_tiet_don_hang')
            ->join('san_pham', 'chi_tiet_don_hang.san_pham_id', '=', 'san_pham.id')
            ->select('san_pham.id', 'san_pham.ten_san_pham', DB::raw('SUM(chi_tiet_don_hang.so_luong) as total_sold'))
            ->groupBy('san_pham.id', 'san_pham.ten_san_pham')
            ->orderByDesc('total_sold')
            ->take(5)
            ->get();

        // 3. Phân bổ sản phẩm theo danh mục
        $categoryDistribution = DB::table('san_pham')
            ->join('danh_muc', 'san_pham.danh_muc_id', '=', 'danh_muc.id')
            ->select('danh_muc.ten as name', DB::raw('COUNT(*) as value'))
            ->groupBy('danh_muc.id', 'danh_muc.ten')
            ->get();

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
            'charts' => [
                'revenue' => $revenueChart,
                'category_distribution' => $categoryDistribution,
            ],
            'top_products' => $topProducts,
            'recent_orders' => $recentOrders
        ], 'Thống kê tổng quan');
    }
}
