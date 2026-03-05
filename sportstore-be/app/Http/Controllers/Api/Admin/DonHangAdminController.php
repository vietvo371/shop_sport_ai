<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Models\DonHang;
use App\Services\DonHangService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DonHangAdminController extends Controller
{
    public function __construct(private DonHangService $service) {}

    public function index(Request $request): JsonResponse
    {
        $orders = DonHang::with('nguoiDung')
            ->when($request->trang_thai, fn($q) => $q->where('trang_thai', $request->trang_thai))
            ->latest()->paginate(20);
        return ApiResponse::paginate($orders, '[Admin] Danh sách đơn hàng');
    }

    public function show(int $id): JsonResponse
    {
        $order = DonHang::with(['items.sanPham', 'nguoiDung', 'lichSuTrangThai', 'thanhToan'])->findOrFail($id);
        return ApiResponse::success($order, '[Admin] Chi tiết đơn hàng');
    }

    public function updateStatus(Request $request, int $id): JsonResponse
    {
        $data = $request->validate([
            'trang_thai' => 'required|in:cho_xac_nhan,da_xac_nhan,dang_xu_ly,dang_giao,da_giao,da_huy,hoan_tra',
            'ghi_chu'    => 'nullable|string|max:500',
        ]);
        $order = DonHang::findOrFail($id);
        $updated = $this->service->updateStatus($order, $data['trang_thai'], $data['ghi_chu'] ?? '', $request->user());
        return ApiResponse::success($updated, '[Admin] Đã cập nhật trạng thái đơn hàng');
    }
}
