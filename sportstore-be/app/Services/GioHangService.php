<?php

namespace App\Services;

use App\Models\GioHang;
use App\Models\GioHangSanPham;
use App\Models\BienTheSanPham;
use App\Models\SanPham;
use Illuminate\Support\Facades\Auth;

class GioHangService
{
    /**
     * Lấy hoặc tạo giỏ hàng cho user hiện tại / guest session.
     */
    public function getOrCreate(?int $nguoiDungId, ?string $maPhien): GioHang
    {
        $query = GioHang::query();

        if ($nguoiDungId) {
            return $query->firstOrCreate(['nguoi_dung_id' => $nguoiDungId]);
        }

        return $query->firstOrCreate(['ma_phien' => $maPhien]);
    }

    /**
     * Giỏ hàng đầy đủ với items, sản phẩm, biến thể.
     */
    public function getCart(?int $nguoiDungId, ?string $maPhien): ?GioHang
    {
        return GioHang::with([
            'items.sanPham.anhChinh',
            'items.bienThe',
        ])->when($nguoiDungId, fn ($q) => $q->where('nguoi_dung_id', $nguoiDungId))
          ->when(!$nguoiDungId, fn ($q) => $q->where('ma_phien', $maPhien))
          ->first();
    }

    /**
     * Thêm sản phẩm vào giỏ hàng.
     */
    public function addItem(GioHang $cart, int $sanPhamId, ?int $bienTheId, int $soLuong): GioHangSanPham
    {
        $sp = SanPham::findOrFail($sanPhamId);
        
        // Lấy giá hiện tại
        if ($bienTheId) {
            $bienThe = BienTheSanPham::findOrFail($bienTheId);
            $donGia = $bienThe->gia_rieng > 0 ? $bienThe->gia_rieng : ($sp->gia_khuyen_mai > 0 ? $sp->gia_khuyen_mai : $sp->gia_goc);
        } else {
            $donGia = $sp->gia_khuyen_mai > 0 ? $sp->gia_khuyen_mai : $sp->gia_goc;
        }

        // Nếu item đã có → cộng số lượng
        $existingItem = $cart->items()
            ->where('san_pham_id', $sanPhamId)
            ->where('bien_the_id', $bienTheId)
            ->first();

        if ($existingItem) {
            $existingItem->increment('so_luong', $soLuong);
            return $existingItem->fresh();
        }

        return $cart->items()->create([
            'san_pham_id' => $sanPhamId,
            'bien_the_id' => $bienTheId,
            'so_luong'    => $soLuong,
            'don_gia'     => $donGia,
        ]);
    }

    /**
     * Cập nhật số lượng item.
     */
    public function updateItem(GioHang $cart, int $itemId, int $soLuong): GioHangSanPham
    {
        $item = $cart->items()->findOrFail($itemId);
        $item->update(['so_luong' => $soLuong]);
        return $item;
    }

    /**
     * Xóa item khỏi giỏ.
     */
    public function removeItem(GioHang $cart, int $itemId): void
    {
        $cart->items()->where('id', $itemId)->delete();
    }

    /**
     * Xóa toàn bộ giỏ hàng sau khi đặt hàng thành công.
     */
    public function clear(GioHang $cart): void
    {
        $cart->items()->delete();
    }
}
