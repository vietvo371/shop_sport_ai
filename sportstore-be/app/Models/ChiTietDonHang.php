<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChiTietDonHang extends Model
{
    public $timestamps = false;
    protected $table = 'chi_tiet_don_hang';
    protected $fillable = [
        'don_hang_id', 'san_pham_id', 'bien_the_id',
        'ten_san_pham', 'thong_tin_bien_the',
        'so_luong', 'don_gia', 'thanh_tien',
    ];
    protected $casts = ['don_gia' => 'decimal:2', 'thanh_tien' => 'decimal:2'];

    public function donHang(): BelongsTo { return $this->belongsTo(DonHang::class, 'don_hang_id'); }
    public function sanPham(): BelongsTo { return $this->belongsTo(SanPham::class, 'san_pham_id'); }
}
