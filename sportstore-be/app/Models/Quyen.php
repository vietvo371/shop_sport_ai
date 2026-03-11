<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Quyen extends Model
{
    protected $table = 'quyen';

    protected $fillable = [
        'ten',
        'ma_slug',
        'nhom'
    ];

    /**
     * Quan hệ với vai trò
     */
    public function vaiTro(): BelongsToMany
    {
        return $this->belongsToMany(VaiTro::class, 'vai_tro_quyen', 'quyen_id', 'vai_tro_id');
    }
}
