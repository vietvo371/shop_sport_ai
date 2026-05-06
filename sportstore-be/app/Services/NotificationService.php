<?php

namespace App\Services;

use App\Mail\ThongBaoMail;
use App\Models\NguoiDung;
use App\Models\ThongBao;
use App\Events\NewNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

/**
 * NotificationService – Master service tái sử dụng
 * 
 * Gửi thông báo đồng thời vào DB + Email.
 * 
 * Cách dùng:
 *   app(NotificationService::class)->send(
 *       user: $user,
 *       loai: 'don_hang',
 *       tieuDe: 'Đơn hàng đã được xác nhận',
 *       noiDung: "Đơn hàng #{$donHang->ma_don} đã được xác nhận.",
 *       duLieuThem: ['Mã đơn' => $donHang->ma_don, 'Tổng tiền' => ...],
 *       hanhDongUrl: url("/orders/{$donHang->id}"),
 *       hanhDongText: 'Xem đơn hàng',
 *   );
 */
class NotificationService
{
    /**
     * Gửi thông báo đến 1 người dùng (DB + Email).
     */
    public function send(
        NguoiDung $user,
        string $loai,
        string $tieuDe,
        string $noiDung,
        array $duLieuThem = [],
        ?string $hanhDongUrl = null,
        ?string $hanhDongText = null,
        bool $guiEmail = true,       // Tắt email nếu cần
    ): ThongBao {
        // 1. Lưu vào DB
        $thongBao = ThongBao::create([
            'nguoi_dung_id' => $user->id,
            'loai'          => $loai,
            'tieu_de'       => $tieuDe,
            'noi_dung'      => $noiDung,
            'du_lieu_them'  => $duLieuThem,
        ]);

        // 1.5 Broadcast realtime
        event(new NewNotification($thongBao));

        // 2. Gửi email (nếu được bật)
        if ($guiEmail) {
            $this->guiEmail($user, $loai, $tieuDe, $noiDung, $duLieuThem, $hanhDongUrl, $hanhDongText);
        }

        return $thongBao;
    }

    /**
     * Broadcast thông báo đến nhiều người cùng lúc.
     */
    public function broadcast(
        iterable $users,
        string $loai,
        string $tieuDe,
        string $noiDung,
        array $duLieuThem = [],
        ?string $hanhDongUrl = null,
        ?string $hanhDongText = null,
    ): void {
        foreach ($users as $user) {
            $this->send($user, $loai, $tieuDe, $noiDung, $duLieuThem, $hanhDongUrl, $hanhDongText);
        }
    }

    /**
     * Gửi email thông báo (xử lý lỗi gracefully — không crash app).
     */
    private function guiEmail(
        NguoiDung $user,
        string $loai,
        string $tieuDe,
        string $noiDung,
        array $duLieuThem,
        ?string $hanhDongUrl,
        ?string $hanhDongText,
    ): void {
        try {
            Mail::to($user->email)->send(new ThongBaoMail(
                tieuDe:       $tieuDe,
                noiDung:      $noiDung,
                loai:         $loai,
                hanhDongUrl:  $hanhDongUrl,
                hanhDongText: $hanhDongText,
                duLieuThem:   $duLieuThem,
            ));
        } catch (\Exception $e) {
            // Log lỗi nhưng KHÔNG crash app — thông báo DB vẫn được lưu
            Log::warning("[NotificationService] Gửi email thất bại cho user #{$user->id}: " . $e->getMessage());
        }
    }
}
