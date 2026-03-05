<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HinhAnhDanhGia extends Model
{
    public $timestamps = false;
    protected $table = 'hinh_anh_danh_gia';
    protected $fillable = ['danh_gia_id', 'duong_dan_anh'];
    public function danhGia(): BelongsTo { return $this->belongsTo(DanhGia::class, 'danh_gia_id'); }
}
