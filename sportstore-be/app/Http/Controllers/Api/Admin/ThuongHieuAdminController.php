<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Models\ThuongHieu;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * @group 6. Quản trị viên (Admin)
 * @subgroup Quản lý Thương hiệu
 * @authenticated
 */
class ThuongHieuAdminController extends Controller
{
    /**
     * Danh sách thương hiệu (Admin)
     */
    public function index(Request $request): JsonResponse
    {
        if (!auth()->user()->hasPermission('quan_ly_catalog')) {
            return ApiResponse::error('Bạn không có quyền quản lý thương hiệu.', 403);
        }

        $query = ThuongHieu::query();
        
        if ($request->has('search') && $request->search != '') {
            $query->where('ten', 'like', '%' . $request->search . '%');
        }
        
        $brands = $query->orderByDesc('created_at')->paginate(20);
        return ApiResponse::paginate($brands, '[Admin] Thương hiệu');
    }

    /**
     * Tạo thương hiệu mới
     *
     * @bodyParam ten string required Tên thương hiệu. Example: Nike
     * @bodyParam mo_ta string Mô tả chi tiết. Example: Thương hiệu toàn cầu.
     */
    public function store(Request $request): JsonResponse
    {
        if (!auth()->user()->hasPermission('quan_ly_catalog')) {
            return ApiResponse::error('Bạn không có quyền tạo thương hiệu.', 403);
        }

        $data = $request->validate([
            'ten' => 'required|string|max:100', 
            'mo_ta' => 'nullable|string'
        ]);
        
        $data['duong_dan'] = Str::slug($data['ten']);
        
        if (ThuongHieu::where('duong_dan', $data['duong_dan'])->exists()) {
            return ApiResponse::error('Tên thương hiệu này tạo ra đường dẫn đã tồn tại, vui lòng chọn tên khác.', 422);
        }

        return ApiResponse::created(ThuongHieu::create($data), '[Admin] Đã tạo thương hiệu');
    }
    public function show(int $id): JsonResponse { return ApiResponse::success(ThuongHieu::findOrFail($id), '[Admin] Chi tiết thương hiệu'); }
    public function update(Request $request, int $id): JsonResponse
    {
        if (!auth()->user()->hasPermission('quan_ly_catalog')) {
            return ApiResponse::error('Bạn không có quyền cập nhật thương hiệu.', 403);
        }

        $b = ThuongHieu::findOrFail($id);
        $data = $request->validate([
            'ten' => 'sometimes|string|max:100', 
            'mo_ta' => 'nullable|string', 
            'trang_thai' => 'boolean'
        ]);

        if (isset($data['ten']) && $data['ten'] !== $b->ten) {
            $data['duong_dan'] = Str::slug($data['ten']);
            if (ThuongHieu::where('duong_dan', $data['duong_dan'])->where('id', '!=', $id)->exists()) {
                return ApiResponse::error('Tên thương hiệu này tạo ra đường dẫn đã tồn tại, vui lòng chọn tên khác.', 422);
            }
        }

        $b->update($data);
        return ApiResponse::success($b, '[Admin] Cập nhật thương hiệu');
    }
    public function destroy(int $id): JsonResponse
    {
        if (!auth()->user()->hasPermission('quan_ly_catalog')) {
            return ApiResponse::error('Bạn không có quyền xóa thương hiệu.', 403);
        }

        ThuongHieu::findOrFail($id)->delete();
        return ApiResponse::deleted('[Admin] Đã xóa thương hiệu');
    }
}
