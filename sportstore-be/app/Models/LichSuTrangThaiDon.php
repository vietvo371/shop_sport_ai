<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LichSuTrangThaiDon extends Model
{
    public $timestamps = false;
    const CREATED_AT = 'created_at';
    protected $table = 'lich_su_trang_thai_don';
    protected $fillable = ['don_hang_id', 'trang_thai', 'ghi_chu', 'cap_nhat_boi'];

    public function donHang(): BelongsTo { return $this->belongsTo(DonHang::class, 'don_hang_id'); }
    public function nguoiCapNhat(): BelongsTo { return $this->belongsTo(NguoiDung::class, 'cap_nhat_boi'); }
}
