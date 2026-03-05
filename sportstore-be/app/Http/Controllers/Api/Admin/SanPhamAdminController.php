<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Models\SanPham;
use App\Services\SanPhamService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SanPhamAdminController extends Controller
{
    public function __construct(private SanPhamService $service) {}

    public function index(): JsonResponse
    {
        return ApiResponse::paginate($this->service->adminIndex(), '[Admin] Danh sách sản phẩm');
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'ten_san_pham'   => 'required|string|max:200',
            'danh_muc_id'    => 'required|integer|exists:danh_muc,id',
            'thuong_hieu_id' => 'nullable|integer|exists:thuong_hieu,id',
            'gia_goc'        => 'required|numeric|min:0',
            'gia_khuyen_mai' => 'nullable|numeric|min:0',
            'mo_ta_ngan'     => 'nullable|string|max:500',
            'mo_ta_day_du'   => 'nullable|string',
            'trang_thai'     => 'boolean',
            'noi_bat'        => 'boolean',
        ]);

        // Tạo slug từ tên
        $data['duong_dan'] = \Illuminate\Support\Str::slug($data['ten_san_pham']);

        $product = $this->service->create($data);
        return ApiResponse::created($product, '[Admin] Tạo sản phẩm thành công');
    }

    public function show(int $id): JsonResponse
    {
        $product = SanPham::with(['danhMuc', 'thuongHieu', 'bienThe', 'hinhAnh'])->findOrFail($id);
        return ApiResponse::success($product, '[Admin] Chi tiết sản phẩm');
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $product = SanPham::findOrFail($id);
        $data = $request->validate([
            'ten_san_pham'   => 'sometimes|string|max:200',
            'danh_muc_id'    => 'sometimes|integer|exists:danh_muc,id',
            'thuong_hieu_id' => 'nullable|integer|exists:thuong_hieu,id',
            'gia_goc'        => 'sometimes|numeric|min:0',
            'gia_khuyen_mai' => 'nullable|numeric|min:0',
            'trang_thai'     => 'boolean',
            'noi_bat'        => 'boolean',
        ]);
        $updated = $this->service->update($product, $data);
        return ApiResponse::success($updated, '[Admin] Cập nhật sản phẩm thành công');
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->delete(SanPham::findOrFail($id));
        return ApiResponse::deleted('[Admin] Đã xóa sản phẩm');
    }
}
