<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Models\NguoiDung;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group 6. Quản trị viên (Admin)
 * @subgroup Quản lý Người dùng
 * @authenticated
 */
class NguoiDungAdminController extends Controller
{
    /**
     * Danh sách người dùng (Admin)
     *
     * @queryParam page int Số trang. Example: 1
     * @queryParam search string Tìm kiếm theo tên, email, sđt. Example: "Nguyen Van A"
     * @queryParam vai_tro string Lọc theo vai trò (khach_hang, quan_tri).
     */
    public function index(Request $request): JsonResponse
    {
        $query = NguoiDung::latest();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('ho_va_ten', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('so_dien_thoai', 'like', "%$search%");
            });
        }

        if ($request->has('vai_tro')) {
            $query->where('vai_tro', $request->vai_tro);
        }

        return ApiResponse::paginate($query->paginate(20), '[Admin] Danh sách người dùng');
    }

    /**
     * Chi tiết người dùng (Admin)
     */
    public function show(int $id): JsonResponse
    {
        $user = NguoiDung::withCount(['donHang', 'danhGia', 'yeuThich'])->findOrFail($id);
        return ApiResponse::success($user, '[Admin] Chi tiết người dùng');
    }

    /**
     * Cập nhật thông tin/trạng thái người dùng (Admin)
     *
     * @bodyParam vai_tro string Vai trò (khach_hang, quan_tri).
     * @bodyParam trang_thai boolean Trạng thái hoạt động.
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $user = NguoiDung::findOrFail($id);
        
        $data = $request->validate([
            'vai_tro'    => 'sometimes|in:khach_hang,quan_tri',
            'trang_thai' => 'sometimes|boolean',
        ]);

        $user->update($data);

        return ApiResponse::success($user, '[Admin] Cập nhật người dùng thành công');
    }

    /**
     * Xóa người dùng (Admin)
     */
    public function destroy(int $id): JsonResponse
    {
        $user = NguoiDung::findOrFail($id);
        
        // Ngăn chặn admin tự xóa chính mình
        if ($user->id === auth()->id()) {
            return ApiResponse::error('Bạn không thể tự xóa tài khoản của chính mình', 403);
        }

        $user->delete();
        return ApiResponse::deleted('[Admin] Đã xóa người dùng thành công');
    }
}
