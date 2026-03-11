<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Models\DonHang;
use App\Services\DonHangService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group 6. Quản trị viên (Admin)
 * @subgroup Quản lý Đơn hàng
 * @authenticated
 */
class DonHangAdminController extends Controller
{
    public function __construct(private DonHangService $service) {}

    /**
     * Danh sách đơn hàng (Admin)
     *
     * @queryParam trang_thai string Lọc đơn hàng theo trạng thái (cho_xac_nhan, da_giao...). Example: cho_xac_nhan
     */
    public function index(Request $request): JsonResponse
    {
        if (!$request->user()->hasPermission('xem_don')) {
            return ApiResponse::error('Bạn không có quyền xem danh sách đơn hàng.', 403);
        }
        $orders = DonHang::with('nguoiDung')
            ->when($request->trang_thai, fn($q) => $q->where('trang_thai', $request->trang_thai))
            ->latest()->paginate(20);
        return ApiResponse::paginate($orders, '[Admin] Danh sách đơn hàng');
    }

    /**
     * Chi tiết đơn hàng (Admin)
     *
     * @urlParam id int required ID đơn hàng. Example: 1
     */
    public function show(int $id): JsonResponse
    {
        if (!auth()->user()->hasPermission('xem_don')) {
            return ApiResponse::error('Bạn không có quyền xem chi tiết đơn hàng.', 403);
        }
        $order = DonHang::with(['items.sanPham', 'nguoiDung', 'lichSuTrangThai', 'thanhToan'])->findOrFail($id);
        return ApiResponse::success($order, '[Admin] Chi tiết đơn hàng');
    }

    /**
     * Cập nhật trạng thái đơn
     *
     * @urlParam id int required ID đơn hàng. Example: 1
     * @bodyParam trang_thai string required Trạng thái mới (cho_xac_nhan, da_xac_nhan, dang_xu_ly, dang_giao, da_giao, da_huy, hoan_tra). Example: da_xac_nhan
     * @bodyParam ghi_chu string Ghi chú cập nhật (VD: Đã gọi xác nhận). Example: Khách hàng đồng ý giao chiều nay.
     */
    public function updateStatus(Request $request, int $id): JsonResponse
    {
        if (!$request->user()->hasPermission('cap_nhat_don')) {
            return ApiResponse::error('Bạn không có quyền cập nhật trạng thái đơn hàng.', 403);
        }
        $data = $request->validate([
            'trang_thai' => 'required|in:cho_xac_nhan,da_xac_nhan,dang_xu_ly,dang_giao,da_giao,da_huy,hoan_tra',
            'ghi_chu'    => 'nullable|string|max:500',
        ]);
        $order = DonHang::findOrFail($id);
        $updated = $this->service->updateStatus($order, $data['trang_thai'], $data['ghi_chu'] ?? '', $request->user());
        return ApiResponse::success($updated, '[Admin] Đã cập nhật trạng thái đơn hàng');
    }
}
