<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class VaiTro extends Model
{
    protected $table = 'vai_tro';

    protected $fillable = [
        'ten',
        'ma_slug'
    ];

    /**
     * Quan hệ với quyền hạn
     */
    public function quyen(): BelongsToMany
    {
        return $this->belongsToMany(Quyen::class, 'vai_tro_quyen', 'vai_tro_id', 'quyen_id');
    }

    /**
     * Quan hệ với người dùng
     */
    public function nguoiDung(): BelongsToMany
    {
        return $this->belongsToMany(NguoiDung::class, 'nguoi_dung_vai_tro', 'vai_tro_id', 'nguoi_dung_id');
    }
}
