<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HanhViNguoiDung extends Model
{
    public $timestamps = false;
    const CREATED_AT = 'created_at';
    protected $table = 'hanh_vi_nguoi_dung';
    protected $fillable = ['nguoi_dung_id', 'ma_phien', 'san_pham_id', 'hanh_vi', 'thoi_gian_xem_s'];

    public function nguoiDung(): BelongsTo { return $this->belongsTo(NguoiDung::class, 'nguoi_dung_id'); }
    public function sanPham(): BelongsTo   { return $this->belongsTo(SanPham::class, 'san_pham_id'); }
}
