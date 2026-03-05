<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ThuongHieu extends Model
{
    protected $table = 'thuong_hieu';

    protected $fillable = ['ten', 'duong_dan', 'logo', 'mo_ta', 'trang_thai'];

    protected $casts = ['trang_thai' => 'boolean'];

    public function sanPham(): HasMany
    {
        return $this->hasMany(SanPham::class, 'thuong_hieu_id');
    }
}
