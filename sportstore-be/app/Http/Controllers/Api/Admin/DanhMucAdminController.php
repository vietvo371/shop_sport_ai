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
        if (!auth()->user()->hasPermission('quan_ly_catalog')) {
            return ApiResponse::error('Bạn không có quyền quản lý danh mục.', 403);
        }

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
        if (!auth()->user()->hasPermission('quan_ly_catalog')) {
            return ApiResponse::error('Bạn không có quyền tạo danh mục.', 403);
        }

        $data = $request->validate([
            'ten'             => 'required|string|max:100',
            'danh_muc_cha_id' => 'nullable|integer|exists:danh_muc,id',
            'trang_thai'      => 'boolean',
            'thu_tu'          => 'nullable|integer|min:0',
        ]);

        // Slug gộp cha-con giống Seeder để tránh collision (cùng tên con ở nhiều cha khác nhau)
        $baseSlug = isset($data['danh_muc_cha_id'])
            ? Str::slug(DanhMuc::findOrFail($data['danh_muc_cha_id'])->ten . ' ' . $data['ten'])
            : Str::slug($data['ten']);

        // Đảm bảo unique bằng cách thêm suffix số
        $slug = $baseSlug;
        $counter = 1;
        while (DanhMuc::where('duong_dan', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter++;
        }
        $data['duong_dan'] = $slug;

        return ApiResponse::created(DanhMuc::create($data), '[Admin] Đã tạo danh mục');
    }

    public function show(int $id): JsonResponse
    {
        return ApiResponse::success(DanhMuc::with('danhMucCon', 'sanPham')->findOrFail($id), '[Admin] Chi tiết danh mục');
    }

    public function update(Request $request, int $id): JsonResponse
    {
        if (!auth()->user()->hasPermission('quan_ly_catalog')) {
            return ApiResponse::error('Bạn không có quyền cập nhật danh mục.', 403);
        }

        $category = DanhMuc::findOrFail($id);
        $data = $request->validate([
            'ten'             => 'sometimes|string|max:100',
            'trang_thai'      => 'boolean',
            'danh_muc_cha_id' => 'nullable|integer|exists:danh_muc,id',
            'thu_tu'          => 'nullable|integer|min:0',
        ]);

        // Tái tính slug nếu tên hoặc danh mục cha thay đổi
        $newTen       = $data['ten'] ?? $category->ten;
        $newParentId  = array_key_exists('danh_muc_cha_id', $data) ? $data['danh_muc_cha_id'] : $category->danh_muc_cha_id;

        if ($newTen !== $category->ten || $newParentId !== $category->danh_muc_cha_id) {
            $baseSlug = $newParentId
                ? Str::slug(DanhMuc::findOrFail($newParentId)->ten . ' ' . $newTen)
                : Str::slug($newTen);

            $slug = $baseSlug;
            $counter = 1;
            while (DanhMuc::where('duong_dan', $slug)->where('id', '!=', $id)->exists()) {
                $slug = $baseSlug . '-' . $counter++;
            }
            $data['duong_dan'] = $slug;
        }

        $category->update($data);
        return ApiResponse::success($category->fresh(), '[Admin] Cập nhật danh mục');
    }

    public function destroy(int $id): JsonResponse
    {
        if (!auth()->user()->hasPermission('quan_ly_catalog')) {
            return ApiResponse::error('Bạn không có quyền xóa danh mục.', 403);
        }

        DanhMuc::findOrFail($id)->delete();
        return ApiResponse::deleted('[Admin] Đã xóa danh mục');
    }
}
