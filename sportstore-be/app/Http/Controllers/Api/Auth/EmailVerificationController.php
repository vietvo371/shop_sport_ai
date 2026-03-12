<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * @group 1. Xác thực & Tài khoản
 * @subgroup Quản lý Xác thực Email
 */
class EmailVerificationController extends Controller
{
    /**
     * Gửi lại email xác thực
     * 
     * Dành cho người dùng đã đăng nhập nhưng chưa xác thực email.
     * @authenticated
     */
    public function resend(Request $request): JsonResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return ApiResponse::error('Email đã được xác thực trước đó.', 400);
        }

        $request->user()->sendEmailVerificationNotification();

        return ApiResponse::success(null, 'Đã gửi lại link xác thực vào email của bạn.');
    }

    /**
     * Xử lý click vào link xác thực từ email.
     * 
     * @urlParam id int required ID người dùng.
     * @urlParam hash string required Mã hash xác thực.
     */
    public function verify(Request $request, $id, $hash): RedirectResponse
    {
        $frontendUrl = rtrim(config('app.frontend_url', 'http://localhost:3000'), '/');

        // 1. Kiểm tra chữ ký hợp lệ (signed url)
        if (! $request->hasValidSignature()) {
            return redirect($frontendUrl . '/verify-email?status=expired');
        }

        $user = \App\Models\NguoiDung::find($id);

        if (! $user) {
            return redirect($frontendUrl . '/verify-email?status=error');
        }

        // 2. Kiểm tra hash khớp với email
        if (! hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            return redirect($frontendUrl . '/verify-email?status=error');
        }

        if ($user->hasVerifiedEmail()) {
            return redirect($frontendUrl . '/verify-email?status=already_verified');
        }

        $user->markEmailAsVerified();

        return redirect($frontendUrl . '/verify-email?status=success');
    }
}
