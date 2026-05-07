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

    protected $appends = ['logo_url'];

    public function getLogoUrlAttribute(): ?string
    {
        if (!$this->logo) return null;
        if (str_starts_with($this->logo, 'http://') || str_starts_with($this->logo, 'https://')) {
            return $this->logo;
        }
        return asset('storage/' . $this->logo);
    }

    public function sanPham(): HasMany
    {
        return $this->hasMany(SanPham::class, 'thuong_hieu_id');
    }
}
