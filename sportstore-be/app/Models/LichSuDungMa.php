<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LichSuDungMa extends Model
{
    public $timestamps = false;
    const CREATED_AT = 'su_dung_luc';
    protected $table = 'lich_su_dung_ma';
    protected $fillable = ['ma_giam_gia_id', 'nguoi_dung_id', 'don_hang_id'];

    public function maGiamGia(): BelongsTo { return $this->belongsTo(MaGiamGia::class, 'ma_giam_gia_id'); }
    public function nguoiDung(): BelongsTo { return $this->belongsTo(NguoiDung::class, 'nguoi_dung_id'); }
    public function donHang(): BelongsTo   { return $this->belongsTo(DonHang::class, 'don_hang_id'); }
}
