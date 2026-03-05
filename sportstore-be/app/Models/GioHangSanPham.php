<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GioHangSanPham extends Model
{
    protected $table = 'gio_hang_san_pham';
    protected $fillable = ['gio_hang_id', 'san_pham_id', 'bien_the_id', 'so_luong', 'don_gia'];
    protected $casts = ['don_gia' => 'decimal:2'];

    public function gioHang(): BelongsTo { return $this->belongsTo(GioHang::class, 'gio_hang_id'); }
    public function sanPham(): BelongsTo { return $this->belongsTo(SanPham::class, 'san_pham_id'); }
    public function bienThe(): BelongsTo { return $this->belongsTo(BienTheSanPham::class, 'bien_the_id'); }

    public function getThanhTienAttribute(): float { return $this->don_gia * $this->so_luong; }
}
