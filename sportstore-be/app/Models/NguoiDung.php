<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\HasPermissions;

class NguoiDung extends Authenticatable
{
    use HasApiTokens, HasPermissions;

    protected $table = 'nguoi_dung';

    protected $fillable = [
        'ho_va_ten',
        'email',
        'mat_khau',
        'so_dien_thoai',
        'anh_dai_dien',
        'is_master',
        'vai_tro',
        'trang_thai',
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
