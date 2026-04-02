<?php

namespace App\Services;

use App\Http\Helpers\ApiResponse;
use App\Models\DonHang;
use App\Models\GioHang;
use App\Models\LichSuTrangThaiDon;
use App\Models\MaGiamGia;
use App\Models\NguoiDung;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class DonHangService
{
    public function __construct(
        private readonly NotificationService $notificationService
    ) {
    }
    /**
     * Checkout — tạo đơn hàng từ giỏ hàng.
     */
    public function checkout(NguoiDung $user, array $data): DonHang
    {
        return DB::transaction(function () use ($user, $data) {
            $cart = GioHang::with('items.sanPham', 'items.bienThe')
                ->where('nguoi_dung_id', $user->id)
                ->firstOrFail();

            if ($cart->items->isEmpty()) {
                throw new HttpResponseException(ApiResponse::error('Giỏ hàng trống', 400));
            }

            // 1. Kiểm tra tồn kho trước khi thực hiện bất kỳ thao tác nào
            foreach ($cart->items as $item) {
                if ($item->bienThe) {
                    if ($item->bienThe->ton_kho < $item->so_luong) {
                        throw new HttpResponseException(ApiResponse::error(
                            "Sản phẩm {$item->sanPham->ten_san_pham} ({$item->bienThe->kich_co} / {$item->bienThe->mau_sac}) không đủ số lượng trong kho.",
                            400
                        ));
                    }
                } else {
                    if ($item->sanPham->so_luong_ton_kho < $item->so_luong) {
                        throw new HttpResponseException(ApiResponse::error(
                            "Sản phẩm {$item->sanPham->ten_san_pham} không đủ số lượng trong kho.",
                            400
                        ));
                    }
                }
            }

            // 2. Tính tiền
            $tamTinh = $cart->items->sum(fn($i) => $i->don_gia * $i->so_luong);
            $soTienGiam = 0;
            $maGiamGiaId = null;

            // Áp dụng coupon (nếu có)
            if (!empty($data['ma_coupon'])) {
                $coupon = MaGiamGia::where('ma_code', $data['ma_coupon'])
                    ->where('trang_thai', true)->first();
                if ($coupon && $tamTinh >= $coupon->gia_tri_don_hang_min) {
                    $soTienGiam = $coupon->tinhSoTienGiam($tamTinh);
                    $maGiamGiaId = $coupon->id;
                    $coupon->increment('da_su_dung');
                }
            }

            $phiVanChuyen = 0; // TODO: tích hợp API GHTK/GHN để tính phí dynamic
            $tongTien = $tamTinh - $soTienGiam + $phiVanChuyen;

            // 3. Snapshot địa chỉ
            $diaChi = $user->diaChi()->findOrFail($data['dia_chi_id']);
            $diaChiGiaoHang = "{$diaChi->dia_chi_cu_the}, {$diaChi->phuong_xa}, {$diaChi->quan_huyen}, {$diaChi->tinh_thanh}";

            // 4. Tạo đơn hàng
            $donHang = DonHang::create([
                'nguoi_dung_id' => $user->id,
                'dia_chi_id' => $diaChi->id,
                'ma_giam_gia_id' => $maGiamGiaId,
                'ma_don_hang' => 'DH' . strtoupper(Str::random(8)),
                'trang_thai' => 'cho_xac_nhan',
                'phuong_thuc_tt' => $data['phuong_thuc_tt'],
                'trang_thai_tt' => 'chua_thanh_toan',
                'tam_tinh' => $tamTinh,
                'so_tien_giam' => $soTienGiam,
                'phi_van_chuyen' => $phiVanChuyen,
                'tong_tien' => $tongTien,
                'ghi_chu' => $data['ghi_chu'] ?? null,
                'ten_nguoi_nhan' => $diaChi->ho_va_ten,
                'sdt_nguoi_nhan' => $diaChi->so_dien_thoai,
                'dia_chi_giao_hang' => $diaChiGiaoHang,
            ]);

            // 5. Tạo chi tiết & Trừ tồn kho
            foreach ($cart->items as $item) {
                $bienTheInfo = $item->bienThe
                    ? "{$item->bienThe->kich_co} / {$item->bienThe->mau_sac}"
                    : null;

                $donHang->items()->create([
                    'san_pham_id' => $item->san_pham_id,
                    'bien_the_id' => $item->bien_the_id,
                    'ten_san_pham' => $item->sanPham->ten_san_pham,
                    'thong_tin_bien_the' => $bienTheInfo,
                    'so_luong' => $item->so_luong,
                    'don_gia' => $item->don_gia,
                    'thanh_tien' => $item->don_gia * $item->so_luong,
                ]);

                // Trừ kho biến thể
                if ($item->bienThe) {
                    $item->bienThe->decrement('ton_kho', $item->so_luong);
                }
                // Trừ kho tổng sản phẩm
                $item->sanPham->decrement('so_luong_ton_kho', $item->so_luong);
            }

            // 6. Ghi lịch sử trạng thái
            LichSuTrangThaiDon::create([
                'don_hang_id' => $donHang->id,
                'trang_thai' => 'cho_xac_nhan',
                'ghi_chu' => 'Đơn hàng được tạo thành công từ giỏ hàng.',
            ]);

            // 7. Xóa giỏ hàng
            $cart->items()->delete();

            // 8. Notification
            $isOnlinePayment = in_array($data['phuong_thuc_tt'], ['vnpay', 'momo']);
            $tieuDe = $isOnlinePayment ? 'Đơn hàng đang chờ thanh toán ⏳' : 'Đặt hàng thành công 🛍️';
            $noiDung = $isOnlinePayment
                ? "Đơn hàng #{$donHang->ma_don_hang} của bạn đã được khởi tạo. Vui lòng hoàn tất thanh toán để chúng tôi có thể xử lý đơn hàng sớm nhất."
                : "Cảm ơn bạn đã đặt hàng!\nĐơn hàng #{$donHang->ma_don_hang} đã được tiếp nhận và đang chờ xác nhận.";

            $this->notificationService->send(
                user: $user,
                loai: 'don_hang',
                tieuDe: $tieuDe,
                noiDung: $noiDung,
                duLieuThem: [
                    'Mã đơn hàng' => $donHang->ma_don_hang,
                    'Tổng tiền' => number_format($tongTien) . 'đ',
                    'Thanh toán' => match ($data['phuong_thuc_tt']) {
                        'cod' => 'Tiền mặt (COD)',
                        'momo' => 'Ví MoMo',
                        'vnpay' => 'VNPay',
                        default => 'Chuyển khoản',
                    },
                ],
                hanhDongUrl: config('app.frontend_url') . '/profile/orders/' . $donHang->ma_don_hang,
                hanhDongText: 'Xem đơn hàng',
            );

            return $donHang->load('items');
        });
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
        return DonHang::with(['items.sanPham.anhChinh', 'lichSuTrangThai', 'thanhToan', 'danhGia'])
            ->where('ma_don_hang', $code)
            ->where('nguoi_dung_id', $user->id)
            ->first();
    }

    /**
     * Admin: cập nhật trạng thái đơn hàng.
     */
    public function updateStatus(DonHang $donHang, string $trangThai, string $ghiChu = '', ?NguoiDung $admin = null): DonHang
    {
        // 0. Kiểm tra nếu trạng thái mới trùng với trạng thái cũ thì bỏ qua
        if ($trangThai === $donHang->trang_thai) {
            return $donHang;
        }

        // 1. Kiểm tra trạng thái cuối (Terminal States)
        $terminalStates = ['da_giao', 'da_huy', 'hoan_tra'];
        if (in_array($donHang->trang_thai, $terminalStates)) {
            throw new HttpResponseException(ApiResponse::error(
                "Đơn hàng đã ở trạng thái kết thúc ({$donHang->trang_thai}), không thể thay đổi trạng thái.",
                422
            ));
        }

        return DB::transaction(function () use ($donHang, $trangThai, $ghiChu, $admin) {
            // 2. Hoàn tồn kho nếu Huỷ đơn
            if ($trangThai === 'da_huy') {
                foreach ($donHang->items as $item) {
                    if ($item->bienThe) {
                        $item->bienThe->increment('ton_kho', $item->so_luong);
                    }
                    $item->sanPham->increment('so_luong_ton_kho', $item->so_luong);
                }
            }

            $donHang->update(['trang_thai' => $trangThai]);

            LichSuTrangThaiDon::create([
                'don_hang_id' => $donHang->id,
                'trang_thai' => $trangThai,
                'ghi_chu' => $ghiChu,
                'cap_nhat_boi' => $admin?->id,
            ]);

            // 3. Notify user
            $trangThaiLabel = match ($trangThai) {
                'cho_xac_nhan' => 'Chờ xác nhận',
                'da_xac_nhan' => 'Đã xác nhận',
                'dang_xu_ly' => 'Đang xử lý',
                'dang_giao' => 'Đang giao hàng 🚚',
                'da_giao' => 'Đã giao hàng thành công ✅',
                'da_huy' => 'Đã huỷ ❌',
                'hoan_tra' => 'Hoàn trả / Trả hàng ↩️',
                default => $trangThai,
            };

            $nguoiDung = $donHang->nguoiDung;
            if ($nguoiDung) {
                $this->notificationService->send(
                    user: $nguoiDung,
                    loai: 'don_hang',
                    tieuDe: "Đơn hàng cập nhật: {$trangThaiLabel}",
                    noiDung: "Đơn hàng #{$donHang->ma_don_hang} của bạn hiện đã chuyển sang trạng thái: {$trangThaiLabel}.",
                    duLieuThem: [
                        'Mã đơn hàng' => $donHang->ma_don_hang,
                        'Trạng thái' => $trangThaiLabel,
                    ],
                    hanhDongUrl: config('app.frontend_url') . '/profile/orders/' . $donHang->ma_don_hang,
                    hanhDongText: 'Xem đơn hàng',
                );
            }

            return $donHang->fresh(['items', 'lichSuTrangThai']);
        });
    }
}
