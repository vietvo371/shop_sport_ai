<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Services\DonHangService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DonHangController extends Controller
{
    public function __construct(private DonHangService $service) {}

    public function index(Request $request): JsonResponse
    {
        $orders = $this->service->getUserOrders($request->user());
        return ApiResponse::paginate($orders, 'Lịch sử đơn hàng');
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'dia_chi_id'   => 'required|integer|exists:dia_chi,id',
            'phuong_thuc_tt' => 'required|in:cod,chuyen_khoan,vnpay,momo',
            'ma_coupon'    => 'nullable|string|max:50',
            'ghi_chu'      => 'nullable|string|max:500',
        ], [
            'dia_chi_id.required'     => 'Vui lòng chọn địa chỉ giao hàng.',
            'dia_chi_id.exists'       => 'Địa chỉ không tồn tại.',
            'phuong_thuc_tt.required' => 'Vui lòng chọn phương thức thanh toán.',
            'phuong_thuc_tt.in'       => 'Phương thức thanh toán không hợp lệ.',
        ]);

        $donHang = $this->service->checkout($request->user(), $data);
        return ApiResponse::created($donHang, 'Đặt hàng thành công');
    }

    public function show(Request $request, string $code): JsonResponse
    {
        $donHang = $this->service->getByCode($code, $request->user());

        if (!$donHang) {
            return ApiResponse::notFound('Không tìm thấy đơn hàng');
        }

        return ApiResponse::success($donHang, 'Chi tiết đơn hàng');
    }
}
