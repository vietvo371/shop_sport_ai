<?php

namespace App\Services;

use App\Models\DonHang;
use App\Models\GioHang;
use App\Models\LichSuTrangThaiDon;
use App\Models\MaGiamGia;
use App\Models\NguoiDung;
use App\Models\ThongBao;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class DonHangService
{
    /**
     * Checkout — tạo đơn hàng từ giỏ hàng.
     */
    public function checkout(NguoiDung $user, array $data): DonHang
    {
        $cart = GioHang::with('items.sanPham', 'items.bienThe')
            ->where('nguoi_dung_id', $user->id)
            ->firstOrFail();

        abort_if($cart->items->isEmpty(), 400, 'Giỏ hàng trống');

        // Tính tiền
        $tamTinh = $cart->items->sum(fn ($i) => $i->don_gia * $i->so_luong);
        $soTienGiam = 0;
        $maGiamGiaId = null;

        // Áp dụng coupon
        if (!empty($data['ma_coupon'])) {
            $coupon = MaGiamGia::where('ma_code', $data['ma_coupon'])
                ->where('trang_thai', true)->first();
            if ($coupon && $tamTinh >= $coupon->gia_tri_don_hang_min) {
                $soTienGiam  = $coupon->tinhSoTienGiam($tamTinh);
                $maGiamGiaId = $coupon->id;
                $coupon->increment('da_su_dung');
            }
        }

        $phiVanChuyen = 0; // TODO: tính phí vận chuyển
        $tongTien = $tamTinh - $soTienGiam + $phiVanChuyen;

        // Snapshot địa chỉ
        $diaChi = $user->diaChi()->findOrFail($data['dia_chi_id']);
        $diaChiGiaoHang = "{$diaChi->dia_chi_cu_the}, {$diaChi->phuong_xa}, {$diaChi->quan_huyen}, {$diaChi->tinh_thanh}";

        // Tạo đơn hàng
        $donHang = DonHang::create([
            'nguoi_dung_id'    => $user->id,
            'dia_chi_id'       => $diaChi->id,
            'ma_giam_gia_id'   => $maGiamGiaId,
            'ma_don_hang'      => 'DH' . strtoupper(Str::random(8)),
            'trang_thai'       => 'cho_xac_nhan',
            'phuong_thuc_tt'   => $data['phuong_thuc_tt'],
            'trang_thai_tt'    => 'chua_thanh_toan',
            'tam_tinh'         => $tamTinh,
            'so_tien_giam'     => $soTienGiam,
            'phi_van_chuyen'   => $phiVanChuyen,
            'tong_tien'        => $tongTien,
            'ghi_chu'          => $data['ghi_chu'] ?? null,
            'ten_nguoi_nhan'   => $diaChi->ho_va_ten,
            'sdt_nguoi_nhan'   => $diaChi->so_dien_thoai,
            'dia_chi_giao_hang'=> $diaChiGiaoHang,
        ]);

        // Tạo chi tiết đơn hàng (snapshot giá)
        foreach ($cart->items as $item) {
            $bienTheInfo = $item->bienThe
                ? "{$item->bienThe->kich_co} / {$item->bienThe->mau_sac}"
                : null;

            $donHang->items()->create([
                'san_pham_id'       => $item->san_pham_id,
                'bien_the_id'       => $item->bien_the_id,
                'ten_san_pham'      => $item->sanPham->ten_san_pham,
                'thong_tin_bien_the'=> $bienTheInfo,
                'so_luong'          => $item->so_luong,
                'don_gia'           => $item->don_gia,
                'thanh_tien'        => $item->don_gia * $item->so_luong,
            ]);
        }

        // Lịch sử trạng thái
        LichSuTrangThaiDon::create([
            'don_hang_id' => $donHang->id,
            'trang_thai'  => 'cho_xac_nhan',
            'ghi_chu'     => 'Đơn hàng được tạo',
        ]);

        // Xóa giỏ hàng
        $cart->items()->delete();

        // Notification
        ThongBao::create([
            'nguoi_dung_id' => $user->id,
            'loai'          => 'don_hang',
            'tieu_de'       => 'Đặt hàng thành công',
            'noi_dung'      => "Đơn hàng #{$donHang->ma_don_hang} đã được đặt thành công.",
            'du_lieu_them'  => ['don_hang_id' => $donHang->id],
        ]);

        return $donHang->load('items');
    }

    /**
     * Danh sách đơn hàng của user.
     */
    public function getUserOrders(NguoiDung $user): LengthAwarePaginator
    {
        return DonHang::where('nguoi_dung_id', $user->id)
            ->with('items.sanPham.anhChinh')
            ->latest()
            ->paginate(10);
    }

    /**
     * Chi tiết đơn hàng theo mã.
     */
    public function getByCode(string $code, NguoiDung $user): ?DonHang
    {
        return DonHang::with(['items.sanPham.anhChinh', 'lichSuTrangThai', 'thanhToan'])
            ->where('ma_don_hang', $code)
            ->where('nguoi_dung_id', $user->id)
            ->first();
    }

    /**
     * Admin: cập nhật trạng thái đơn hàng.
     */
    public function updateStatus(DonHang $donHang, string $trangThai, string $ghiChu = '', NguoiDung $admin = null): DonHang
    {
        $donHang->update(['trang_thai' => $trangThai]);

        LichSuTrangThaiDon::create([
            'don_hang_id' => $donHang->id,
            'trang_thai'  => $trangThai,
            'ghi_chu'     => $ghiChu,
            'cap_nhat_boi'=> $admin?->id,
        ]);

        // Notify user
        ThongBao::create([
            'nguoi_dung_id' => $donHang->nguoi_dung_id,
            'loai'          => 'trang_thai_don_hang',
            'tieu_de'       => 'Đơn hàng cập nhật',
            'noi_dung'      => "Đơn hàng #{$donHang->ma_don_hang} đã chuyển sang: {$trangThai}",
            'du_lieu_them'  => ['don_hang_id' => $donHang->id],
        ]);

        return $donHang->fresh(['items', 'lichSuTrangThai']);
    }
}
