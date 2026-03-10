<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Models\SanPham;
use App\Services\SanPhamService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group 6. Quản trị viên (Admin)
 * @subgroup Quản lý Sản phẩm
 * @authenticated
 */
class SanPhamAdminController extends Controller
{
    public function __construct(private SanPhamService $service) {}

    /**
     * Danh sách sản phẩm (Admin)
     *
     * Lấy toàn bộ danh sách sản phẩm phục vụ trang quản trị.
     */
    public function index(Request $request): JsonResponse
    {
        return ApiResponse::paginate($this->service->adminIndex($request->all()), '[Admin] Danh sách sản phẩm');
    }

    /**
     * Tạo sản phẩm mới
     *
     * @bodyParam ten_san_pham string required Tên sản phẩm. Example: Áo khoác thể thao
     * @bodyParam danh_muc_id int required ID danh mục. Example: 1
     * @bodyParam thuong_hieu_id int ID thương hiệu (nếu có). Example: 2
     * @bodyParam gia_goc numeric required Giá nhập / Giá niêm yết. Example: 500000
     * @bodyParam gia_khuyen_mai numeric Giá bán thực tế sau giảm. Example: 450000
     * @bodyParam mo_ta_ngan string Mô tả ngắn. Example: Áo khoác dù chống nước
     * @bodyParam mo_ta_day_du string Mô tả chi tiết (HTML). Example: <p>Chi tiết...</p>
     * @bodyParam trang_thai boolean Có đang mở bán hay không. Example: true
     * @bodyParam noi_bat boolean Có đưa lên danh sách nổi bật không. Example: false
     */
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
            // Biến thể
            'bien_the'             => 'nullable|array',
            'bien_the.*.kich_co'    => 'required|string',
            'bien_the.*.mau_sac'     => 'nullable|string',
            'bien_the.*.gia_rieng'   => 'nullable|numeric|min:0',
            'bien_the.*.ton_kho'     => 'required|integer|min:0',
            // Hình ảnh
            'hinh_anh'              => 'nullable|array',
            'hinh_anh.*.duong_dan_anh' => 'required|string',
            'hinh_anh.*.la_anh_chinh'   => 'boolean',
            'hinh_anh.*.thu_tu'         => 'integer',
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
            'mo_ta_ngan'     => 'nullable|string|max:500',
            'mo_ta_day_du'   => 'nullable|string',
            'trang_thai'     => 'boolean',
            'noi_bat'        => 'boolean',
            // Biến thể
            'bien_the'             => 'nullable|array',
            'bien_the.*.kich_co'    => 'required|string',
            'bien_the.*.mau_sac'     => 'nullable|string',
            'bien_the.*.gia_rieng'   => 'nullable|numeric|min:0',
            'bien_the.*.ton_kho'     => 'required|integer|min:0',
            // Hình ảnh
            'hinh_anh'              => 'nullable|array',
            'hinh_anh.*.duong_dan_anh' => 'required|string',
            'hinh_anh.*.la_anh_chinh'   => 'boolean',
            'hinh_anh.*.thu_tu'         => 'integer',
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
