<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PhienChatbot extends Model
{
    public $timestamps = false;
    const CREATED_AT = 'created_at';
    protected $table = 'phien_chatbot';
    protected $fillable = ['nguoi_dung_id', 'ma_phien', 'bat_dau_luc', 'ket_thuc_luc'];
    protected $casts = ['bat_dau_luc' => 'datetime', 'ket_thuc_luc' => 'datetime'];

    public function nguoiDung(): BelongsTo { return $this->belongsTo(NguoiDung::class, 'nguoi_dung_id'); }
    public function tinNhan(): HasMany     { return $this->hasMany(TinNhanChatbot::class, 'phien_id'); }
}
