<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ThanhToan extends Model
{
    protected $table = 'thanh_toan';
    protected $fillable = [
        'don_hang_id', 'phuong_thuc', 'ma_giao_dich',
        'so_tien', 'trang_thai', 'phan_hoi_cong_tt', 'thanh_toan_luc',
    ];
    protected $casts = ['so_tien' => 'decimal:2', 'thanh_toan_luc' => 'datetime'];

    public function donHang(): BelongsTo { return $this->belongsTo(DonHang::class, 'don_hang_id'); }
}
