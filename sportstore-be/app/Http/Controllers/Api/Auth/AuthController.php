<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function __construct(private AuthService $authService) {}

    public function register(Request $request): JsonResponse
    {
        $data = $request->validate([
            'ho_va_ten'            => 'required|string|max:100',
            'email'                => 'required|email|unique:nguoi_dung,email',
            'mat_khau'             => 'required|string|min:8|confirmed',
            'so_dien_thoai'        => 'nullable|string|max:20',
        ], [
            'ho_va_ten.required'   => 'Vui lòng nhập họ và tên.',
            'email.required'       => 'Vui lòng nhập email.',
            'email.unique'         => 'Email này đã được sử dụng.',
            'mat_khau.min'         => 'Mật khẩu phải ít nhất 8 ký tự.',
            'mat_khau.confirmed'   => 'Xác nhận mật khẩu không khớp.',
        ]);

        $result = $this->authService->register($data);

        return ApiResponse::created([
            'user'  => $result['user'],
            'token' => $result['token'],
        ], 'Đăng ký thành công');
    }

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

    public function logout(Request $request): JsonResponse
    {
        $this->authService->logout($request->user());
        return ApiResponse::success(null, 'Đăng xuất thành công');
    }

    public function me(Request $request): JsonResponse
    {
        return ApiResponse::success($request->user()->load('diaChi'), 'Thông tin tài khoản');
    }

    public function update(Request $request): JsonResponse
    {
        $data = $request->validate([
            'ho_va_ten'     => 'sometimes|string|max:100',
            'so_dien_thoai' => 'sometimes|nullable|string|max:20',
            'mat_khau_cu'   => 'required_with:mat_khau_moi|string',
            'mat_khau_moi'  => 'sometimes|string|min:8|confirmed',
        ]);

        $user = $this->authService->updateProfile($request->user(), $data);
        return ApiResponse::success($user, 'Cập nhật thông tin thành công');
    }
}
