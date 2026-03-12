<?php

namespace App\Services;

use App\Models\NguoiDung;
use Laravel\Socialite\Two\User as GoogleUser;

class GoogleAuthService
{
    /**
     * Tìm user theo Google ID hoặc Email, hoặc tạo mới nếu chưa tồn tại.
     */
    public function loginOrCreate(GoogleUser $googleUser): array
    {
        // 1. Tìm bằng google_id (returning user đã từng login Google)
        $user = NguoiDung::where('google_id', $googleUser->getId())->first();

        if (!$user) {
            // 2. Tìm bằng email (user đã đăng ký bằng email/password trước đó)
            $user = NguoiDung::where('email', $googleUser->getEmail())->first();

            if ($user) {
                // Liên kết google_id vào tài khoản hiện có
                $user->update([
                    'google_id'        => $googleUser->getId(),
                    'anh_dai_dien'     => $user->anh_dai_dien ?: $googleUser->getAvatar(),
                    // Đặt xac_thuc_email_luc nếu chưa có (email từ Google đã verify)
                    'xac_thuc_email_luc' => $user->xac_thuc_email_luc ?? now(),
                ]);
            } else {
                // 3. Tạo tài khoản mới từ Google profile
                $user = NguoiDung::create([
                    'ho_va_ten'          => $googleUser->getName(),
                    'email'              => $googleUser->getEmail(),
                    'mat_khau'           => null, // Google user không có password
                    'google_id'          => $googleUser->getId(),
                    'anh_dai_dien'       => $googleUser->getAvatar(),
                    'vai_tro'            => 'khach_hang',
                    'trang_thai'         => true,
                    'xac_thuc_email_luc' => now(), // Email từ Google đã được xác thực
                ]);
            }
        }

        // Kiểm tra tài khoản có bị khóa không
        if (!$user->trang_thai) {
            throw new \Exception('Tài khoản đã bị vô hiệu hóa.');
        }

        // Xóa token cũ, tạo token mới
        $user->tokens()->delete();
        $token = $user->createToken('sportstore-google')->plainTextToken;
        $user->load(['cacVaiTro.quyen']);

        return ['user' => $user, 'token' => $token];
    }
}
