<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BienTheSanPham extends Model
{
    protected $table = 'bien_the_san_pham';

    protected $fillable = [
        'san_pham_id', 'ma_sku', 'kich_co', 'mau_sac',
        'ma_mau_hex', 'hinh_anh', 'gia_rieng', 'ton_kho', 'trang_thai',
    ];

    protected $casts = [
        'gia_rieng' => 'decimal:2',
        'trang_thai' => 'boolean',
    ];

    public function sanPham(): BelongsTo
    {
        return $this->belongsTo(SanPham::class, 'san_pham_id');
    }
}
