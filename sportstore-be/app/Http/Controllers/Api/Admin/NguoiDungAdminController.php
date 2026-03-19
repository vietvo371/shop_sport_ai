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
        // Chèn kiểm tra quyền (Tùy chọn: có thể dùng middleware ở api.php thay thế)
        if (!$request->user()->hasPermission('xem_user')) {
            return ApiResponse::error('Bạn không có quyền xem danh sách người dùng.', 403);
        }

        $query = NguoiDung::with('cacVaiTro')->latest();

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
        if (!auth()->user()->hasPermission('xem_user')) {
            return ApiResponse::error('Bạn không có quyền xem thông tin người dùng.', 403);
        }

        $user = NguoiDung::with(['cacVaiTro', 'cacVaiTro.quyen'])
            ->withCount(['donHang', 'danhGia', 'yeuThich'])
            ->findOrFail($id);
        return ApiResponse::success($user, '[Admin] Chi tiết người dùng');
    }

    /**
     * Thêm mới người dùng (Admin)
     */
    public function store(Request $request): JsonResponse
    {
        if (!auth()->user()->hasPermission('them_user')) {
            return ApiResponse::error('Bạn không có quyền thêm mới người dùng.', 403);
        }

        $data = $request->validate([
            'ho_va_ten'    => 'required|string|max:255',
            'email'        => 'required|email|unique:nguoi_dung,email',
            'mat_khau'     => 'required|string|min:6',
            'so_dien_thoai'=> 'nullable|string|max:20',
            'vai_tro'      => 'required|in:khach_hang,quan_tri',
            'trang_thai'   => 'sometimes|boolean',
            'vai_tro_ids'  => 'sometimes|array',
            'vai_tro_ids.*'=> 'exists:vai_tro,id'
        ], [
            'email.unique' => 'Email này đã được sử dụng.',
            'mat_khau.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
        ]);

        $data['mat_khau'] = bcrypt($data['mat_khau']);
        $data['xac_thuc_email_luc'] = now(); // Mặc định xác thực luôn khi admin tạo

        $user = NguoiDung::create($data);

        if (isset($data['vai_tro_ids'])) {
            $user->cacVaiTro()->sync($data['vai_tro_ids']);
        }

        return ApiResponse::success($user->load('cacVaiTro'), '[Admin] Thêm mới người dùng thành công', 201);
    }

    /**
     * Cập nhật thông tin/trạng thái người dùng (Admin)
     *
     * @bodyParam vai_tro string Vai trò (khach_hang, quan_tri).
     * @bodyParam trang_thai boolean Trạng thái hoạt động.
     */
    public function update(Request $request, int $id): JsonResponse
    {
        if (!auth()->user()->hasPermission('sua_user')) {
            return ApiResponse::error('Bạn không có quyền chỉnh sửa người dùng.', 403);
        }

        $user = NguoiDung::findOrFail($id);
        
        $data = $request->validate([
            'vai_tro'      => 'sometimes|in:khach_hang,quan_tri', // Backward compatibility
            'trang_thai'   => 'sometimes|boolean',
            'vai_tro_ids'  => 'sometimes|array',
            'vai_tro_ids.*'=> 'exists:vai_tro,id'
        ], [
            'vai_tro.in' => 'Vai trò được chọn không hợp lệ.',
            'trang_thai.boolean' => 'Trạng thái hoạt động không hợp lệ.',
        ]);

        if (isset($data['vai_tro_ids'])) {
            // Chặn việc tự gỡ quyền admin của chính mình nếu là Super Admin duy nhất (tùy chọn)
            $user->cacVaiTro()->sync($data['vai_tro_ids']);
        }

        $user->update($data);

        return ApiResponse::success($user->load('cacVaiTro'), '[Admin] Cập nhật người dùng thành công');
    }

    /**
     * Xóa người dùng (Admin)
     */
    public function destroy(int $id): JsonResponse
    {
        if (!auth()->user()->hasPermission('go_bo_user')) {
            return ApiResponse::error('Bạn không có quyền xóa người dùng.', 403);
        }

        $user = NguoiDung::findOrFail($id);
        
        // Ngăn chặn xóa tài khoản master
        if ($user->is_master) {
            return ApiResponse::error('Không thể xóa tài khoản Master của hệ thống', 403);
        }

        // Ngăn chặn admin tự xóa chính mình
        if ($user->id === auth()->id()) {
            return ApiResponse::error('Bạn không thể tự xóa tài khoản của chính mình', 403);
        }

        $user->delete();
        return ApiResponse::deleted('[Admin] Đã xóa người dùng thành công');
    }
}
