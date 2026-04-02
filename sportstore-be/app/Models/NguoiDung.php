<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\HasPermissions;
use Illuminate\Notifications\Notifiable;

class NguoiDung extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasPermissions, Notifiable;

    protected $table = 'nguoi_dung';

    protected $fillable = [
        'ho_va_ten',
        'email',
        'mat_khau',
        'so_dien_thoai',
        'anh_dai_dien',
        'google_id',
        'is_master',
        'vai_tro',
        'trang_thai',
        'xac_thuc_email_luc',
    ];

    protected $hidden = ['mat_khau'];

    protected $casts = [
        'is_master'          => 'boolean',
        'trang_thai'         => 'boolean',
        'xac_thuc_email_luc' => 'datetime',
    ];

    // Relationships
    public function diaChi(): HasMany
    {
        return $this->hasMany(DiaChi::class, 'nguoi_dung_id');
    }

    public function gioHang(): HasOne
    {
        return $this->hasOne(GioHang::class, 'nguoi_dung_id');
    }

    public function donHang(): HasMany
    {
        return $this->hasMany(DonHang::class, 'nguoi_dung_id');
    }

    public function danhGia(): HasMany
    {
        return $this->hasMany(DanhGia::class, 'nguoi_dung_id');
    }

    public function yeuThich(): HasMany
    {
        return $this->hasMany(YeuThich::class, 'nguoi_dung_id');
    }

    public function phienChatbot(): HasMany
    {
        return $this->hasMany(PhienChatbot::class, 'nguoi_dung_id');
    }

    public function thongBao(): HasMany
    {
        return $this->hasMany(ThongBao::class, 'nguoi_dung_id');
    }

    // Helpers
    public function isAdmin(): bool
    {
        return $this->is_master || $this->vai_tro === 'quan_tri';
    }

    /**
     * Ghi đè phương thức Laravel mặc định để dùng đúng tên cột DB
     */
    public function hasVerifiedEmail(): bool
    {
        return ! is_null($this->xac_thuc_email_luc);
    }

    public function markEmailAsVerified(): bool
    {
        return $this->forceFill([
            'xac_thuc_email_luc' => $this->freshTimestamp(),
        ])->save();
    }

    public function getEmailForVerification(): string
    {
        return $this->email;
    }

    /**
     * Ghi đè để Laravel nhận diện đúng cột mật khẩu (mat_khau)
     */
    public function getAuthPassword(): string
    {
        return $this->mat_khau;
    }

    /**
     * Ghi đè các hàm Remember Token vì bảng nguoi_dung không có các cột này
     */
    public function getRememberToken() { return null; }
    public function setRememberToken($value) {}
    public function getRememberTokenName() { return ''; }

    /**
     * Ghi đè để gửi mail xác thực tiếng Việt
     */
    public function sendEmailVerificationNotification(): void
    {
        $this->notify(new \App\Notifications\XacThucEmailNotification);
    }

    /**
     * Ghi đè để gửi mail đặt lại mật khẩu tiếng Việt
     */
    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new \App\Notifications\ResetPasswordNotification($token));
    }

    /**
     * Ngăn chặn xóa tài khoản master
     */
    public static function boot()
    {
        parent::boot();

        static::deleting(function ($user) {
            if ($user->is_master) {
                throw new \Exception('Không thể xóa tài khoản Master của hệ thống.');
            }
        });
    }
}
