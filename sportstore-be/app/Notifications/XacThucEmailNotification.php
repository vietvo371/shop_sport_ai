<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;

class XacThucEmailNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->subject('[SportStore] Xác nhận địa chỉ Email')
            ->view('emails.thong-bao', [
                'tieuDe'       => 'Xác thực tài khoản của bạn 📧',
                'noiDung'      => "Chào {$notifiable->ho_va_ten},\nCảm ơn bạn đã đăng ký tài khoản tại SportStore. Vui lòng nhấn vào nút bên dưới để xác thực địa chỉ email của mình.",
                'loai'          => 'he_thong',
                'hanhDongUrl'  => $verificationUrl,
                'hanhDongText' => 'Xác nhận Email',
                'duLieuThem'   => [
                    'Tài khoản' => $notifiable->email,
                    'Ngày đăng ký' => Carbon::now()->format('d/m/Y'),
                ]
            ]);
    }

    protected function verificationUrl($notifiable): string
    {
        return URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );
    }
}
