<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\VaiTro;
use App\Models\Quyen;
use Illuminate\Http\Request;
use App\Http\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RoleAdminController extends Controller
{
    /**
     * Danh sách vai trò kèm quyền hạn
     */
    public function index(): JsonResponse
    {
        if (!auth()->user()->hasPermission('phan_quyen')) {
            return ApiResponse::error('Bạn không có quyền quản lý vai trò.', 403);
        }

        $roles = VaiTro::with('quyen')->get();
        return ApiResponse::success($roles, 'Lấy danh sách vai trò thành công');
    }

    /**
     * Chi tiết một vai trò
     */
    public function show(int $id): JsonResponse
    {
        $role = VaiTro::with('quyen')->find($id);
        
        if (!$role) {
            return ApiResponse::notFound('Vai trò không tồn tại');
        }

        return ApiResponse::success($role);
    }

    /**
     * Thêm mới vai trò
     */
    public function store(Request $request): JsonResponse
    {
        if (!auth()->user()->hasPermission('phan_quyen')) {
            return ApiResponse::error('Bạn không có quyền tạo vai trò mới.', 403);
        }

        $data = $request->validate([
            'ten'       => 'required|string|max:100|unique:vai_tro,ten',
            'ma_slug'   => 'nullable|string|max:100|unique:vai_tro,ma_slug',
            'quyen_ids' => 'nullable|array',
            'quyen_ids.*' => 'exists:quyen,id'
        ], [
            'ten.required' => 'Vui lòng nhập tên vai trò.',
            'ten.unique'   => 'Tên vai trò này đã tồn tại.',
            'ma_slug.unique' => 'Mã vai trò này đã tồn tại.'
        ]);

        if (empty($data['ma_slug'])) {
            $data['ma_slug'] = Str::slug($data['ten'], '_');
        }

        try {
            DB::beginTransaction();

            $role = VaiTro::create([
                'ten' => $data['ten'],
                'ma_slug' => $data['ma_slug']
            ]);

            if (!empty($data['quyen_ids'])) {
                $role->quyen()->sync($data['quyen_ids']);
            }

            DB::commit();

            return ApiResponse::created($role->load('quyen'), 'Tạo vai trò mới thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            return ApiResponse::error('Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    /**
     * Cập nhật vai trò
     */
    public function update(Request $request, int $id): JsonResponse
    {
        if (!auth()->user()->hasPermission('phan_quyen')) {
            return ApiResponse::error('Bạn không có quyền chỉnh sửa vai trò.', 403);
        }

        $role = VaiTro::find($id);
        if (!$role) {
            return ApiResponse::notFound('Vai trò không tồn tại');
        }

        // Chặn sửa ma_slug của super_admin
        if ($role->ma_slug === 'super_admin' && $request->has('ma_slug')) {
             return ApiResponse::error('Không thể thay đổi mã của vai trò Siêu quản trị', 403);
        }

        $data = $request->validate([
            'ten'       => 'required|string|max:100|unique:vai_tro,ten,' . $id,
            'ma_slug'   => 'nullable|string|max:100|unique:vai_tro,ma_slug,' . $id,
            'quyen_ids' => 'nullable|array',
            'quyen_ids.*' => 'exists:quyen,id'
        ], [
            'ten.required' => 'Vui lòng nhập tên vai trò.',
            'ten.unique'   => 'Tên vai trò này đã tồn tại.'
        ]);

        try {
            DB::beginTransaction();

            $updateData = ['ten' => $data['ten']];
            if (!empty($data['ma_slug'])) {
                $updateData['ma_slug'] = $data['ma_slug'];
            }

            $role->update($updateData);

            if (isset($data['quyen_ids'])) {
                $role->quyen()->sync($data['quyen_ids']);
            }

            DB::commit();

            return ApiResponse::success($role->load('quyen'), 'Cập nhật vai trò thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            return ApiResponse::error('Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    /**
     * Xóa vai trò
     */
    public function destroy(int $id): JsonResponse
    {
        if (!auth()->user()->hasPermission('phan_quyen')) {
            return ApiResponse::error('Bạn không có quyền xóa vai trò.', 403);
        }

        $role = VaiTro::find($id);
        if (!$role) {
            return ApiResponse::notFound('Vai trò không tồn tại');
        }

        if (in_array($role->ma_slug, ['super_admin', 'customer'])) {
            return ApiResponse::error('Không thể xóa các vai trò hệ thống mặc định', 403);
        }

        $role->delete();

        return ApiResponse::success(null, 'Xóa vai trò thành công');
    }

    /**
     * Lấy danh sách tất cả quyền hạn (để hiển thị checkbox)
     */
    public function permissions(): JsonResponse
    {
        $permissions = Quyen::all()->groupBy('nhom');
        return ApiResponse::success($permissions, 'Lấy danh sách quyền hạn thành công');
    }
}
