<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MaGiamGia extends Model
{
    protected $table = 'ma_giam_gia';
    protected $fillable = [
        'ma_code', 'loai_giam', 'gia_tri', 'gia_tri_don_hang_min',
        'giam_toi_da', 'gioi_han_su_dung', 'da_su_dung',
        'bat_dau_luc', 'het_han_luc', 'trang_thai',
    ];
    protected $casts = [
        'gia_tri'             => 'decimal:2',
        'gia_tri_don_hang_min'=> 'decimal:2',
        'giam_toi_da'         => 'decimal:2',
        'trang_thai'          => 'boolean',
        'bat_dau_luc'         => 'datetime',
        'het_han_luc'         => 'datetime',
    ];

    public function lichSuDung(): HasMany { return $this->hasMany(LichSuDungMa::class, 'ma_giam_gia_id'); }

    public function tinhSoTienGiam(float $tamTinh): float
    {
        if ($this->loai_giam === 'phan_tram') {
            $giam = $tamTinh * ($this->gia_tri / 100);
            return $this->giam_toi_da ? min($giam, $this->giam_toi_da) : $giam;
        }
        return min($this->gia_tri, $tamTinh);
    }
}
