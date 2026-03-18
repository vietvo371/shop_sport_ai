<?php

namespace App\Services;

use App\Http\Helpers\ApiResponse;
use App\Models\NguoiDung;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    /**
     * Đăng ký tài khoản mới.
     */
    public function register(array $data): array
    {
        $user = NguoiDung::create([
            'ho_va_ten'    => $data['ho_va_ten'],
            'email'        => $data['email'],
            'mat_khau'     => Hash::make($data['mat_khau']),
            'so_dien_thoai'=> $data['so_dien_thoai'] ?? null,
            'vai_tro'      => 'khach_hang',
        ]);

        $token = $user->createToken('sportstore')->plainTextToken;
        $user->load(['cacVaiTro.quyen']);

        // Gửi email xác thực
        $user->sendEmailVerificationNotification();

        return ['user' => $user, 'token' => $token];
    }

    /**
     * Đăng nhập.
     */
    public function login(string $email, string $matKhau): ?array
    {
        $user = NguoiDung::where('email', $email)->first();

        if (!$user || !Hash::check($matKhau, $user->mat_khau)) {
            return null;
        }

        if (!$user->trang_thai) {
            return null;
        }

        // Xóa token cũ (single session)
        $user->tokens()->delete();

        $token = $user->createToken('sportstore')->plainTextToken;
        $user->load(['cacVaiTro.quyen']);

        return ['user' => $user, 'token' => $token];
    }

    /**
     * Đăng xuất — thu hồi token hiện tại.
     */
    public function logout(NguoiDung $user): void
    {
        $user->currentAccessToken()->delete();
    }

    /**
     * Cập nhật profile.
     */
    public function updateProfile(NguoiDung $user, array $data): NguoiDung
    {
        $update = array_filter([
            'ho_va_ten'     => $data['ho_va_ten'] ?? null,
            'so_dien_thoai' => $data['so_dien_thoai'] ?? null,
            'anh_dai_dien'  => $data['anh_dai_dien'] ?? null,
        ]);

        if (!empty($data['mat_khau_moi'])) {
            $update['mat_khau'] = Hash::make($data['mat_khau_moi']);
        }

        $user->update($update);
        return $user->fresh();
    }
}
