<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Carbon\Carbon;

class ResetPasswordNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public string $token) {}

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        // Link này trỏ về Frontend (Next.js) đã được cấu hình trong AppServiceProvider
        $resetUrl = config('app.frontend_url') . '/reset-password?token=' . $this->token . '&email=' . $notifiable->getEmailForPasswordReset();

        return (new MailMessage)
            ->subject('[SportStore] Yêu cầu đặt lại mật khẩu')
            ->view('emails.thong-bao', [
                'tieuDe'       => 'Đặt lại mật khẩu của bạn 🔑',
                'noiDung'      => "Chào {$notifiable->ho_va_ten},\nChúng tôi nhận được yêu cầu đặt lại mật khẩu cho tài khoản của bạn. Vui lòng nhấn vào nút bên dưới để tiến hành thay đổi mật khẩu mới. Nếu bạn không yêu cầu điều này, hãy bỏ qua email này.",
                'loai'          => 'he_thong',
                'hanhDongUrl'  => $resetUrl,
                'hanhDongText' => 'Đặt lại mật khẩu',
                'duLieuThem'   => [
                    'Tài khoản' => $notifiable->email,
                    'Thời gian yêu cầu' => Carbon::now()->format('d/m/Y H:i'),
                    'Hết hạn sau' => config('auth.passwords.users.expire') . ' phút',
                ]
            ]);
    }
}
