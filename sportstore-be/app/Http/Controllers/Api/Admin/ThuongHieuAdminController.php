<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Models\ThuongHieu;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ThuongHieuAdminController extends Controller
{
    public function index(): JsonResponse
    {
        return ApiResponse::paginate(ThuongHieu::paginate(20), '[Admin] Thương hiệu');
    }
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate(['ten' => 'required|string|max:100', 'mo_ta' => 'nullable|string']);
        $data['duong_dan'] = Str::slug($data['ten']);
        return ApiResponse::created(ThuongHieu::create($data), '[Admin] Đã tạo thương hiệu');
    }
    public function show(int $id): JsonResponse { return ApiResponse::success(ThuongHieu::findOrFail($id), '[Admin] Chi tiết thương hiệu'); }
    public function update(Request $request, int $id): JsonResponse
    {
        $b = ThuongHieu::findOrFail($id);
        $b->update($request->validate(['ten' => 'sometimes|string', 'trang_thai' => 'boolean']));
        return ApiResponse::success($b, '[Admin] Cập nhật thương hiệu');
    }
    public function destroy(int $id): JsonResponse
    {
        ThuongHieu::findOrFail($id)->delete();
        return ApiResponse::deleted('[Admin] Đã xóa thương hiệu');
    }
}
