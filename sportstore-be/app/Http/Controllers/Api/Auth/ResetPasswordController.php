<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\NguoiDung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    /**
     * Đặt lại mật khẩu mới thông qua token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function reset(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'email' => 'required|email|exists:nguoi_dung,email',
            'password' => 'required|confirmed|min:8',
        ], [
            'token.required' => 'Token xác nhận không hợp lệ.',
            'email.required' => 'Email không bắt buộc.',
            'email.exists' => 'Email không tồn tại.',
            'password.required' => 'Mật khẩu mới không được để trống.',
            'password.confirmed' => 'Mật khẩu xác nhận không trùng khớp.',
            'password.min' => 'Mật khẩu mới phải có ít nhất 8 ký tự.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Thực hiện reset password thông qua broker
        $response = Password::broker()->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->mat_khau = Hash::make($password);
                $user->save();
            }
        );

        return $response === Password::PASSWORD_RESET
            ? response()->json(['message' => 'Mật khẩu của bạn đã được đặt lại thành công!'], 200)
            : response()->json(['message' => 'Link đặt lại mật khẩu đã hết hạn hoặc không hợp lệ.'], 400);
    }
}
