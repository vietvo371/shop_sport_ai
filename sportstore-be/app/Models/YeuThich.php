<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class YeuThich extends Model
{
    public $timestamps = false;
    const CREATED_AT = 'created_at';
    protected $table = 'yeu_thich';
    protected $fillable = ['nguoi_dung_id', 'san_pham_id'];

    public function nguoiDung(): BelongsTo { return $this->belongsTo(NguoiDung::class, 'nguoi_dung_id'); }
    public function sanPham(): BelongsTo   { return $this->belongsTo(SanPham::class, 'san_pham_id'); }
}
