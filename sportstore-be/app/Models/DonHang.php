<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DonHang extends Model
{
    protected $table = 'don_hang';

    protected $fillable = [
        'nguoi_dung_id', 'dia_chi_id', 'ma_giam_gia_id', 'ma_don_hang',
        'trang_thai', 'phuong_thuc_tt', 'trang_thai_tt',
        'tam_tinh', 'so_tien_giam', 'phi_van_chuyen', 'tong_tien',
        'ghi_chu', 'ten_nguoi_nhan', 'sdt_nguoi_nhan', 'dia_chi_giao_hang',
    ];

    protected $casts = [
        'tam_tinh'       => 'decimal:2',
        'so_tien_giam'   => 'decimal:2',
        'phi_van_chuyen' => 'decimal:2',
        'tong_tien'      => 'decimal:2',
    ];

    public function nguoiDung(): BelongsTo { return $this->belongsTo(NguoiDung::class, 'nguoi_dung_id'); }
    public function diaChi(): BelongsTo    { return $this->belongsTo(DiaChi::class, 'dia_chi_id'); }
    public function maGiamGia(): BelongsTo { return $this->belongsTo(MaGiamGia::class, 'ma_giam_gia_id'); }
    public function items(): HasMany       { return $this->hasMany(ChiTietDonHang::class, 'don_hang_id'); }
    public function lichSuTrangThai(): HasMany { return $this->hasMany(LichSuTrangThaiDon::class, 'don_hang_id'); }
    public function thanhToan(): HasMany   { return $this->hasMany(ThanhToan::class, 'don_hang_id'); }
    public function danhGia(): HasMany    { return $this->hasMany(DanhGia::class, 'don_hang_id'); }
}
