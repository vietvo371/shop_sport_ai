<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GioHang extends Model
{
    protected $table = 'gio_hang';
    protected $fillable = ['nguoi_dung_id', 'ma_phien'];

    public function nguoiDung(): BelongsTo
    {
        return $this->belongsTo(NguoiDung::class, 'nguoi_dung_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(GioHangSanPham::class, 'gio_hang_id');
    }

    public function getTongSoLuongAttribute(): int
    {
        return $this->items->sum('so_luong');
    }

    public function getTamTinhAttribute(): float
    {
        return $this->items->sum(fn ($i) => $i->don_gia * $i->so_luong);
    }
}
