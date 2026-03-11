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
        if (!$request->user()->hasPermission('xem_sp')) {
            return ApiResponse::error('Bạn không có quyền xem danh sách sản phẩm.', 403);
        }
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
        if (!$request->user()->hasPermission('them_sp')) {
            return ApiResponse::error('Bạn không có quyền thêm sản phẩm.', 403);
        }
        $data = $request->validate([
            'ten_san_pham'   => 'required|string|min:5|max:200',
            'danh_muc_id'    => 'required|integer|exists:danh_muc,id',
            'thuong_hieu_id' => 'nullable|integer|exists:thuong_hieu,id',
            'gia_goc'        => 'required|numeric|min:1',
            'gia_khuyen_mai' => 'nullable|numeric|min:0|lt:gia_goc',
            'mo_ta_ngan'     => 'required|string|min:10|max:500',
            'mo_ta_day_du'   => 'required|string|min:20',
            'trang_thai'     => 'boolean',
            'noi_bat'        => 'boolean',
            'ma_sku'         => 'required|string|max:100|unique:san_pham,ma_sku',
            // Biến thể
            'bien_the'             => 'required|array|min:1',
            'bien_the.*.kich_co'    => 'required|string',
            'bien_the.*.mau_sac'     => 'nullable|string',
            'bien_the.*.gia_rieng'   => 'nullable|numeric|min:0',
            'bien_the.*.ton_kho'     => 'required|integer|min:0',
            // Hình ảnh
            'hinh_anh'              => 'required|array|min:1',
            'hinh_anh.*.duong_dan_anh' => 'required|string',
            'hinh_anh.*.la_anh_chinh'   => 'boolean',
            'hinh_anh.*.thu_tu'         => 'integer',
        ], [
            'ten_san_pham.min' => 'Tên sản phẩm phải có ít nhất 5 ký tự.',
            'gia_khuyen_mai.lt' => 'Giá khuyến mãi phải nhỏ hơn giá gốc.',
            'mo_ta_ngan.required' => 'Mô tả ngắn là bắt buộc để hiển thị ở danh sách.',
            'mo_ta_day_du.required' => 'Chi tiết sản phẩm không được để trống.',
            'ma_sku.required' => 'Mã SKU là bắt buộc để quản lý kho.',
            'ma_sku.unique' => 'Mã SKU này đã tồn tại trên hệ thống.',
            'bien_the.required' => 'Sản phẩm phải có ít nhất một phân loại (Size/Màu).',
            'hinh_anh.required' => 'Vui lòng upload ít nhất một hình ảnh sản phẩm.',
        ]);

        // Tạo slug duy nhất từ tên
        $data['duong_dan'] = $this->service->generateUniqueSlug($data['ten_san_pham']);

        $product = $this->service->create($data);
        return ApiResponse::created($product, '[Admin] Tạo sản phẩm thành công');
    }

    public function show(int $id): JsonResponse
    {
        if (!auth()->user()->hasPermission('xem_sp')) {
            return ApiResponse::error('Bạn không có quyền xem chi tiết sản phẩm.', 403);
        }
        $product = SanPham::with(['danhMuc', 'thuongHieu', 'bienThe', 'hinhAnh'])->findOrFail($id);
        return ApiResponse::success($product, '[Admin] Chi tiết sản phẩm');
    }

    public function update(Request $request, int $id): JsonResponse
    {
        if (!$request->user()->hasPermission('sua_sp')) {
            return ApiResponse::error('Bạn không có quyền chỉnh sửa sản phẩm.', 403);
        }
        $product = SanPham::findOrFail($id);
        $data = $request->validate([
            'ten_san_pham'   => 'sometimes|string|min:5|max:200',
            'danh_muc_id'    => 'sometimes|integer|exists:danh_muc,id',
            'thuong_hieu_id' => 'nullable|integer|exists:thuong_hieu,id',
            'gia_goc'        => 'sometimes|numeric|min:1',
            'gia_khuyen_mai' => 'nullable|numeric|min:0|lt:gia_goc',
            'mo_ta_ngan'     => 'sometimes|string|min:10|max:500',
            'mo_ta_day_du'   => 'sometimes|string|min:20',
            'trang_thai'     => 'boolean',
            'noi_bat'        => 'boolean',
            'ma_sku'         => 'sometimes|string|max:100|unique:san_pham,ma_sku,' . $id,
            // Biến thể
            'bien_the'             => 'sometimes|array|min:1',
            'bien_the.*.kich_co'    => 'required|string',
            'bien_the.*.mau_sac'     => 'nullable|string',
            'bien_the.*.gia_rieng'   => 'nullable|numeric|min:0',
            'bien_the.*.ton_kho'     => 'required|integer|min:0',
            // Hình ảnh
            'hinh_anh'              => 'sometimes|array|min:1',
            'hinh_anh.*.duong_dan_anh' => 'required|string',
            'hinh_anh.*.la_anh_chinh'   => 'boolean',
            'hinh_anh.*.thu_tu'         => 'integer',
        ], [
            'ten_san_pham.min' => 'Tên sản phẩm phải có ít nhất 5 ký tự.',
            'gia_khuyen_mai.lt' => 'Giá khuyến mãi phải nhỏ hơn giá gốc.',
            'mo_ta_ngan.required' => 'Mô tả ngắn là bắt buộc để hiển thị ở danh sách.',
            'mo_ta_day_du.required' => 'Chi tiết sản phẩm không được để trống.',
            'ma_sku.unique' => 'Mã SKU này đã tồn tại trên hệ thống.',
            'bien_the.required' => 'Sản phẩm phải có ít nhất một phân loại (Size/Màu).',
            'hinh_anh.required' => 'Vui lòng upload ít nhất một hình ảnh sản phẩm.',
        ]);

        // Cập nhật slug nếu tên sản phẩm thay đổi
        if (isset($data['ten_san_pham']) && $data['ten_san_pham'] !== $product->ten_san_pham) {
            $data['duong_dan'] = $this->service->generateUniqueSlug($data['ten_san_pham'], $product->id);
        }

        $updated = $this->service->update($product, $data);
        return ApiResponse::success($updated, '[Admin] Cập nhật sản phẩm thành công');
    }

    public function destroy(int $id): JsonResponse
    {
        if (!auth()->user()->hasPermission('xoa_sp')) {
            return ApiResponse::error('Bạn không có quyền xóa sản phẩm.', 403);
        }
        $this->service->delete(SanPham::findOrFail($id));
        return ApiResponse::deleted('[Admin] Đã xóa sản phẩm');
    }
}
