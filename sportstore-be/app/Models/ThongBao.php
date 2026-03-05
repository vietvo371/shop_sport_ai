<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ThongBao extends Model
{
    public $timestamps = false;
    const CREATED_AT = 'created_at';
    protected $table = 'thong_bao';
    protected $fillable = ['nguoi_dung_id', 'loai', 'tieu_de', 'noi_dung', 'du_lieu_them', 'da_doc_luc'];
    protected $casts = ['du_lieu_them' => 'array', 'da_doc_luc' => 'datetime'];

    public function nguoiDung(): BelongsTo { return $this->belongsTo(NguoiDung::class, 'nguoi_dung_id'); }
    public function getDaDocAttribute(): bool { return $this->da_doc_luc !== null; }
}
