<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $table = 'banners';

    protected $fillable = [
        'tieu_de',
        'hinh_anh',
        'duong_dan',
        'thu_tu',
        'trang_thai',
    ];

    protected $appends = ['url'];

    public function getUrlAttribute(): string
    {
        if (!$this->hinh_anh) {
            return '';
        }

        if (str_starts_with($this->hinh_anh, 'http')) {
            return $this->hinh_anh;
        }

        $path = ltrim(str_replace('/storage/', '', $this->hinh_anh), '/');
        return asset('storage/' . $path);
    }
}
