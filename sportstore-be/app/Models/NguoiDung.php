<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class NguoiDung extends Authenticatable
{
    use HasApiTokens;

    protected $table = 'nguoi_dung';

    protected $fillable = [
        'ho_va_ten',
        'email',
        'mat_khau',
        'so_dien_thoai',
        'anh_dai_dien',
        'vai_tro',
        'trang_thai',
    ];

    protected $hidden = ['mat_khau'];

    protected $casts = [
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
        return $this->vai_tro === 'quan_tri';
    }
}
