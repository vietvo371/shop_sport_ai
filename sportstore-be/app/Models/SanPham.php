<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SanPham extends Model
{
    protected $table = 'san_pham';

    protected $fillable = [
        'danh_muc_id', 'thuong_hieu_id', 'ten_san_pham', 'duong_dan', 'ma_sku',
        'mo_ta_ngan', 'mo_ta_day_du', 'gia_goc', 'gia_khuyen_mai',
        'so_luong_ton_kho', 'can_nang_kg', 'noi_bat', 'trang_thai',
        'da_ban', 'luot_xem', 'diem_danh_gia', 'so_luot_danh_gia',
    ];

    protected $casts = [
        'gia_goc'          => 'decimal:2',
        'gia_khuyen_mai'   => 'decimal:2',
        'diem_danh_gia'    => 'decimal:2',
        'noi_bat'          => 'boolean',
        'trang_thai'       => 'boolean',
    ];

    public function danhMuc(): BelongsTo
    {
        return $this->belongsTo(DanhMuc::class, 'danh_muc_id');
    }

    public function thuongHieu(): BelongsTo
    {
        return $this->belongsTo(ThuongHieu::class, 'thuong_hieu_id');
    }

    public function bienThe(): HasMany
    {
        return $this->hasMany(BienTheSanPham::class, 'san_pham_id');
    }

    public function hinhAnh(): HasMany
    {
        return $this->hasMany(HinhAnhSanPham::class, 'san_pham_id')->orderBy('thu_tu');
    }

    public function anhChinh()
    {
        return $this->hasOne(HinhAnhSanPham::class, 'san_pham_id')->where('la_anh_chinh', true);
    }

    public function danhGia(): HasMany
    {
        return $this->hasMany(DanhGia::class, 'san_pham_id');
    }

    // Giá hiển thị (sale nếu có, ngược lại giá gốc)
    public function getGiaHienThiAttribute(): float
    {
        return $this->gia_khuyen_mai ?? $this->gia_goc;
    }
}
