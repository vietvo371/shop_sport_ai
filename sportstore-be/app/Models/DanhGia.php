<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DanhGia extends Model
{
    protected $table = 'danh_gia';
    protected $fillable = [
        'san_pham_id', 'nguoi_dung_id', 'don_hang_id',
        'so_sao', 'tieu_de', 'noi_dung', 'da_duyet',
    ];
    protected $casts = ['da_duyet' => 'boolean', 'so_sao' => 'integer'];

    public function sanPham(): BelongsTo   { return $this->belongsTo(SanPham::class, 'san_pham_id'); }
    public function nguoiDung(): BelongsTo { return $this->belongsTo(NguoiDung::class, 'nguoi_dung_id'); }
    public function donHang(): BelongsTo   { return $this->belongsTo(DonHang::class, 'don_hang_id'); }
    public function hinhAnh(): HasMany     { return $this->hasMany(HinhAnhDanhGia::class, 'danh_gia_id'); }
}
