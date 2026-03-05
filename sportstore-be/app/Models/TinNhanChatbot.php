<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TinNhanChatbot extends Model
{
    public $timestamps = false;
    const CREATED_AT = 'created_at';
    protected $table = 'tin_nhan_chatbot';
    protected $fillable = ['phien_id', 'vai_tro', 'noi_dung', 'so_token'];

    public function phien(): BelongsTo { return $this->belongsTo(PhienChatbot::class, 'phien_id'); }
}
