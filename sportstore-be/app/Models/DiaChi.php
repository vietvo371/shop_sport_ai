<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DiaChi extends Model
{
    protected $table = 'dia_chi';

    protected $fillable = [
        'nguoi_dung_id', 'ho_va_ten', 'so_dien_thoai',
        'tinh_thanh', 'quan_huyen', 'phuong_xa', 'dia_chi_cu_the', 'la_mac_dinh',
    ];

    protected $casts = ['la_mac_dinh' => 'boolean'];

    public function nguoiDung(): BelongsTo
    {
        return $this->belongsTo(NguoiDung::class, 'nguoi_dung_id');
    }

    // Địa chỉ đầy đủ 1 dòng
    public function getDiaChiDayDuAttribute(): string
    {
        return "{$this->dia_chi_cu_the}, {$this->phuong_xa}, {$this->quan_huyen}, {$this->tinh_thanh}";
    }
}
