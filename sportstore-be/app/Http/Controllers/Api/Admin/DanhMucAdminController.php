<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Models\DanhMuc;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * @group 6. Quản trị viên (Admin)
 * @subgroup Quản lý Danh mục
 * @authenticated
 */
class DanhMucAdminController extends Controller
{
    /**
     * Danh sách danh mục (Admin)
     */
    public function index(Request $request): JsonResponse
    {
        $query = DanhMuc::with('danhMucCon')->whereNull('danh_muc_cha_id');
        
        if ($request->has('search') && $request->search != '') {
            $query->where('ten', 'like', '%' . $request->search . '%');
        }
        
        $categories = $query->orderByDesc('created_at')->get();
        return ApiResponse::success($categories, '[Admin] Danh mục');
    }

    /**
     * Tạo danh mục mới
     *
     * @bodyParam ten string required Tên danh mục. Example: Giày bóng đá
     * @bodyParam danh_muc_cha_id int ID danh mục cha (Nếu là danh mục con). Example: null
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'ten' => 'required|string|max:100', 
            'danh_muc_cha_id' => 'nullable|integer|exists:danh_muc,id'
        ]);
        
        $data['duong_dan'] = Str::slug($data['ten']);
        
        if (DanhMuc::where('duong_dan', $data['duong_dan'])->exists()) {
            return ApiResponse::error('Tên danh mục này tạo ra đường dẫn đã tồn tại, vui lòng chọn tên khác.', 422);
        }

        return ApiResponse::created(DanhMuc::create($data), '[Admin] Đã tạo danh mục');
    }

    public function show(int $id): JsonResponse
    {
        return ApiResponse::success(DanhMuc::with('danhMucCon', 'sanPham')->findOrFail($id), '[Admin] Chi tiết danh mục');
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $category = DanhMuc::findOrFail($id);
        $data = $request->validate([
            'ten' => 'sometimes|string|max:100', 
            'trang_thai' => 'boolean',
            'danh_muc_cha_id' => 'nullable|integer|exists:danh_muc,id'
        ]);

        if (isset($data['ten']) && $data['ten'] !== $category->ten) {
            $data['duong_dan'] = Str::slug($data['ten']);
            if (DanhMuc::where('duong_dan', $data['duong_dan'])->where('id', '!=', $id)->exists()) {
                return ApiResponse::error('Tên danh mục này tạo ra đường dẫn đã tồn tại, vui lòng chọn tên khác.', 422);
            }
        }

        $category->update($data);
        return ApiResponse::success($category, '[Admin] Cập nhật danh mục');
    }

    public function destroy(int $id): JsonResponse
    {
        DanhMuc::findOrFail($id)->delete();
        return ApiResponse::deleted('[Admin] Đã xóa danh mục');
    }
}
