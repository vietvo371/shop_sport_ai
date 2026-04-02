<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BangSize extends Model
{
    protected $table = 'bang_size';

    protected $fillable = [
        'thuong_hieu_id', 'loai', 'ten_size',
        'chieu_cao_min', 'chieu_cao_max',
        'can_nang_min', 'can_nang_max',
        'chieu_dai_chan_min', 'chieu_dai_chan_max',
        'mo_ta',
    ];

    protected $casts = [
        'chieu_cao_min'        => 'float',
        'chieu_cao_max'        => 'float',
        'can_nang_min'         => 'float',
        'can_nang_max'         => 'float',
        'chieu_dai_chan_min'   => 'float',
        'chieu_dai_chan_max'   => 'float',
    ];

    /**
     * Quy tắc size thuộc về một thương hiệu cụ thể (nếu có)
     */
    public function thuongHieu(): BelongsTo
    {
        return $this->belongsTo(ThuongHieu::class, 'thuong_hieu_id');
    }
}
