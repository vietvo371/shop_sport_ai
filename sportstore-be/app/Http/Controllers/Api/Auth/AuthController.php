<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

/**
 * @group 1. Đăng ký & Đăng nhập
 * @subgroup Xác thực người dùng
 *
 * Các API liên quan đến đăng ký, đăng nhập và lấy thông tin phiên bản người dùng hiện tại
 */
class AuthController extends Controller
{
    public function __construct(private AuthService $authService) {}

    /**
     * Đăng ký tài khoản
     *
     * Đăng ký thành viên mới cho SportStore. Mật khẩu sẽ được băm (hash) tự động.
     * 
     * @unauthenticated
     * @bodyParam ho_va_ten string required Họ và tên người dùng. Example: Nguyễn Văn A
     * @bodyParam email string required Địa chỉ email hợp lệ. Example: nguyenva@email.com
     * @bodyParam mat_khau string required Mật khẩu (ít nhất 8 ký tự). Example: password123
     * @bodyParam mat_khau_confirmation string required Nhập lại mật khẩu để xác nhận. Example: password123
     * @bodyParam so_dien_thoai string Số điện thoại liên hệ. Example: 0987654321
     */
    public function register(Request $request): JsonResponse
    {
        $data = $request->validate([
            'ho_va_ten'            => ['required', 'string', 'max:100', 'regex:/^[\p{L}]+(?:\s+[\p{L}]+)+$/u'],
            'email'                => 'required|email|unique:nguoi_dung,email',
            'mat_khau'             => 'required|string|min:8|confirmed',
            'mat_khau_confirmation'=> 'required_with:mat_khau|string|same:mat_khau',
            'so_dien_thoai'        => 'nullable|string|max:20',
        ], [
            'ho_va_ten.required'   => 'Vui lòng nhập họ và tên.',
            'ho_va_ten.regex'      => 'Vui lòng nhập đầy đủ họ và tên (ít nhất 2 từ).',
            'email.required'       => 'Vui lòng nhập email.',
            'email.unique'         => 'Email này đã được sử dụng.',
            'mat_khau.min'         => 'Mật khẩu phải ít nhất 8 ký tự.',
            'mat_khau.confirmed'   => 'Xác nhận mật khẩu không khớp.',
            'mat_khau_confirmation.required_with' => 'Vui lòng xác nhận mật khẩu.',
            'mat_khau_confirmation.same' => 'Xác nhận mật khẩu không khớp.',
        ]);

        $result = $this->authService->register($data);

        return ApiResponse::created([
            'user'  => $result['user'],
            'token' => $result['token'],
        ], 'Đăng ký thành công');
    }

    /**
     * Đăng nhập
     *
     * Xác thực người dùng bằng Email và Mật khẩu. Sẽ trả về Access Token sử dụng cho các request sau.
     * 
     * @unauthenticated
     * @bodyParam email string required Email đã đăng ký. Example: nguyenva@email.com
     * @bodyParam mat_khau string required Mật khẩu đăng nhập. Example: password123
     */
    public function login(Request $request): JsonResponse
    {
        $data = $request->validate([
            'email'    => 'required|email',
            'mat_khau' => 'required|string',
        ], [
            'email.required'    => 'Vui lòng nhập email.',
            'mat_khau.required' => 'Vui lòng nhập mật khẩu.',
        ]);

        $result = $this->authService->login($data['email'], $data['mat_khau']);

        if (!$result) {
            return ApiResponse::error('Email hoặc mật khẩu không đúng', 401);
        }

        return ApiResponse::success([
            'user'  => $result['user'],
            'token' => $result['token'],
        ], 'Đăng nhập thành công');
    }

    /**
     * Đăng xuất
     *
     * Xóa bỏ Access Token hiện tại (Revoke) của người dùng. Yêu cầu truyền Header Authorization.
     * @authenticated
     */
    public function logout(Request $request): JsonResponse
    {
        $this->authService->logout($request->user());
        return ApiResponse::success(null, 'Đăng xuất thành công');
    }

    /**
     * Lấy thông tin cá nhân
     *
     * Trả về thông tin chi tiết tài khoản của người dùng đang đăng nhập, bao gồm cả địa chỉ mặc định.
     * @authenticated
     */
    public function me(Request $request): JsonResponse
    {
        return ApiResponse::success($request->user()->load(['diaChi', 'cacVaiTro.quyen']), 'Thông tin tài khoản');
    }

    /**
     * Cập nhật thông tin cá nhân
     *
     * Cập nhật Profile. Nếu muốn đổi mật khẩu thì cung cấp thêm `mat_khau_cu` và `mat_khau_moi`.
     * 
     * @authenticated
     * @bodyParam ho_va_ten string Họ và tên mới. Example: Nguyễn Văn B
     * @bodyParam so_dien_thoai string Số điện thoại mới. Example: 0912345678
     * @bodyParam mat_khau_cu string Mật khẩu hiện tại (bắt buộc nếu muốn đổi mật khẩu). Example: password123
     * @bodyParam mat_khau_moi string Mật khẩu mới thiết lập (chỉ gửi khi muốn đổi). Example: newpassword456
     * @bodyParam mat_khau_moi_confirmation string Xác nhận mật khẩu mới. Example: newpassword456
     */
    public function update(Request $request): JsonResponse
    {
        $data = $request->validate([
            'ho_va_ten'     => ['sometimes', 'string', 'max:100', 'regex:/^[\p{L}]+(?:\s+[\p{L}]+)+$/u'],
            'so_dien_thoai' => 'sometimes|nullable|string|max:20',
            'anh_dai_dien'  => 'sometimes|nullable|string|max:500',
            'mat_khau_cu'   => 'required_with:mat_khau_moi|string',
            'mat_khau_moi'  => 'sometimes|string|min:8|confirmed',
            'mat_khau_moi_confirmation' => 'required_with:mat_khau_moi|string|same:mat_khau_moi',
        ], [
            'ho_va_ten.regex' => 'Vui lòng nhập đầy đủ họ và tên (ít nhất 2 từ).',
        ]);

        $user = $this->authService->updateProfile($request->user(), $data);
        return ApiResponse::success($user, 'Cập nhật thông tin thành công');
    }
}
