<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Services\GoogleAuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

/**
 * @group 1. Đăng ký & Đăng nhập
 * @subgroup Google OAuth
 */
class GoogleAuthController extends Controller
{
    public function __construct(private GoogleAuthService $googleAuthService) {}

    /**
     * Lấy URL đăng nhập Google
     *
     * Trả về URL để client redirect đến màn hình chọn tài khoản Google.
     * @unauthenticated
     */
    public function redirectUrl(): JsonResponse
    {
        $url = Socialite::driver('google')
            ->stateless()
            ->redirect()
            ->getTargetUrl();

        return ApiResponse::success(['url' => $url], 'Google OAuth URL');
    }

    /**
     * Xử lý callback từ Google
     *
     * Nhận authorization code từ client, exchange lấy Google profile,
     * tìm hoặc tạo user, trả về token.
     *
     * @unauthenticated
     * @bodyParam code string required Authorization code từ Google. Example: 4/0AX4XfWh...
     */
    public function handleCallback(Request $request): JsonResponse
    {
        $request->validate([
            'code' => 'required|string',
        ]);

        try {
            // Exchange code → lấy Google user info
            $googleUser = Socialite::driver('google')
                ->stateless()
                ->user();

            $result = $this->googleAuthService->loginOrCreate($googleUser);

            return ApiResponse::success([
                'user'  => $result['user'],
                'token' => $result['token'],
            ], 'Đăng nhập Google thành công');

        } catch (\Exception $e) {
            return ApiResponse::error('Không thể xác thực với Google. Vui lòng thử lại.', 401);
        }
    }
}
