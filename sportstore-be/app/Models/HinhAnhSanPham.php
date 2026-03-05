<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HinhAnhSanPham extends Model
{
    public $timestamps = false;
    protected $table = 'hinh_anh_san_pham';
    protected $fillable = ['san_pham_id', 'duong_dan_anh', 'chu_thich', 'thu_tu', 'la_anh_chinh'];
    protected $casts = ['la_anh_chinh' => 'boolean'];

    public function sanPham(): BelongsTo
    {
        return $this->belongsTo(SanPham::class, 'san_pham_id');
    }
}
