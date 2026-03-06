<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HinhAnhSanPham extends Model
{
    public $timestamps = false;
    protected $table = 'hinh_anh_san_pham';
    protected $fillable = ['san_pham_id', 'duong_dan_anh', 'chu_thich', 'thu_tu', 'la_anh_chinh'];
    protected $casts = ['la_anh_chinh' => 'boolean'];
    protected $appends = ['url'];

    public function getUrlAttribute(): string
    {
        if (!$this->duong_dan_anh) {
            return '';
        }
        
        if (str_starts_with($this->duong_dan_anh, 'http')) {
            return $this->duong_dan_anh;
        }

        $path = str_replace('/storage/', '', $this->duong_dan_anh);
        // Fallback localhost:8000 for local testing if APP_URL is not set properly
        return rtrim(env('APP_URL', 'http://localhost:8000'), '/') . Storage::url($path);
    }

    public function sanPham(): BelongsTo
    {
        return $this->belongsTo(SanPham::class, 'san_pham_id');
    }
}
