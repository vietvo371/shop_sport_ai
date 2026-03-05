<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Models\DanhMuc;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DanhMucAdminController extends Controller
{
    public function index(): JsonResponse
    {
        return ApiResponse::success(DanhMuc::with('danhMucCon')->whereNull('danh_muc_cha_id')->get(), '[Admin] Danh mục');
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate(['ten' => 'required|string|max:100', 'danh_muc_cha_id' => 'nullable|integer|exists:danh_muc,id']);
        $data['duong_dan'] = Str::slug($data['ten']);
        return ApiResponse::created(DanhMuc::create($data), '[Admin] Đã tạo danh mục');
    }

    public function show(int $id): JsonResponse
    {
        return ApiResponse::success(DanhMuc::with('danhMucCon', 'sanPham')->findOrFail($id), '[Admin] Chi tiết danh mục');
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $category = DanhMuc::findOrFail($id);
        $category->update($request->validate(['ten' => 'sometimes|string|max:100', 'trang_thai' => 'boolean']));
        return ApiResponse::success($category, '[Admin] Cập nhật danh mục');
    }

    public function destroy(int $id): JsonResponse
    {
        DanhMuc::findOrFail($id)->delete();
        return ApiResponse::deleted('[Admin] Đã xóa danh mục');
    }
}
