<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DanhMuc extends Model
{
    protected $table = 'danh_muc';

    protected $fillable = ['danh_muc_cha_id', 'ten', 'duong_dan', 'hinh_anh', 'mo_ta', 'thu_tu', 'trang_thai'];

    protected $casts = ['trang_thai' => 'boolean'];

    // Self-referencing
    public function danhMucCha(): BelongsTo
    {
        return $this->belongsTo(DanhMuc::class, 'danh_muc_cha_id');
    }

    public function danhMucCon(): HasMany
    {
        return $this->hasMany(DanhMuc::class, 'danh_muc_cha_id');
    }

    public function sanPham(): HasMany
    {
        return $this->hasMany(SanPham::class, 'danh_muc_id');
    }
}
