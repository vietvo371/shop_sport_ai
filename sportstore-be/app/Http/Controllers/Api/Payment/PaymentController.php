<?php

namespace App\Http\Controllers\Api\Payment;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Models\DonHang;
use App\Models\ThanhToan;
use App\Services\Payment\VNPayService;
use App\Services\Payment\MoMoService;
use App\Services\NotificationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function __construct(
        private VNPayService $vnpayService,
        private MoMoService $momoService,
        private NotificationService $notificationService
    ) {}

    /**
     * Tạo URL thanh toán cho đơn hàng
     */
    public function createPaymentUrl(Request $request): JsonResponse
    {
        $request->validate([
            'ma_don_hang' => 'required|exists:don_hang,ma_don_hang',
            'phuong_thuc' => 'required|in:momo,vnpay',
        ]);

        $donHang = DonHang::where('ma_don_hang', $request->ma_don_hang)->first();

        // Kiểm tra xem đơn hàng đã thanh toán chưa
        if ($donHang->trang_thai_tt === 'da_thanh_toan') {
            return ApiResponse::error('Đơn hàng này đã được thanh toán.', 400);
        }

        try {
            if ($request->phuong_thuc === 'vnpay') {
                $url = $this->vnpayService->createPaymentUrl(
                    $donHang->ma_don_hang,
                    $donHang->tong_tien,
                    "Thanh toan don hang {$donHang->ma_don_hang}"
                );
                return ApiResponse::success(['payment_url' => $url], 'Tạo URL VNPay thành công');
            } else {
                $result = $this->momoService->createPaymentUrl(
                    $donHang->ma_don_hang,
                    $donHang->tong_tien,
                    "Thanh toan don hang {$donHang->ma_don_hang}"
                );

                if (isset($result['payUrl'])) {
                    return ApiResponse::success(['payment_url' => $result['payUrl']], 'Tạo URL MoMo thành công');
                }

                Log::error('MoMo Create Error: ' . json_encode($result));
                return ApiResponse::error('Không thể tạo liên kết MoMo. Vui lòng thử lại.', 500);
            }
        } catch (\Exception $e) {
            Log::error('Payment Error: ' . $e->getMessage());
            return ApiResponse::error('Có lỗi xảy ra khi xử lý thanh toán.', 500);
        }
    }

    /**
     * VNPay Callback (Redirect sau khi thanh toán)
     */
    public function vnpayReturn(Request $request): JsonResponse
    {
        $isValid = $this->vnpayService->verifyResponse($request->all());

        if (!$isValid) {
            return ApiResponse::error('Chữ ký không hợp lệ', 400);
        }

        $vnp_ResponseCode = $request->vnp_ResponseCode;
        $maDonHang = $request->vnp_TxnRef;

        if ($vnp_ResponseCode == '00') {
            $this->updatePaymentStatus($maDonHang, 'vnpay', $request->all(), $request->vnp_TransactionNo);
            return ApiResponse::success(null, 'Thanh toán VNPay thành công');
        }

        return ApiResponse::error('Thanh toán VNPay thất bại', 400);
    }

    /**
     * MoMo IPN/Callback (Xử lý khi MoMo gọi back)
     */
    public function momoIpn(Request $request): JsonResponse
    {
        $isValid = $this->momoService->verifySignature($request->all());

        if (!$isValid) {
            return ApiResponse::error('Chữ ký không hợp lệ', 400);
        }

        $resultCode = $request->resultCode;
        $maDonHang = $request->orderId;

        // Lưu log để dễ debug khi public IPN
        Log::info('MoMo IPN Hit: ', $request->all());

        if ($resultCode == 0) {
            $this->updatePaymentStatus($maDonHang, 'momo', $request->all(), $request->transId);
            return response()->json(['message' => 'Success'], 200);
        }

        return response()->json(['message' => 'Failed'], 200);
    }

    /**
     * MoMo Return (Client Redirect)
     * Xác thực khi Client Frontend bị redirect về từ app momo.
     */
    public function momoReturn(Request $request): JsonResponse
    {
        $isValid = $this->momoService->verifySignature($request->all());

        if (!$isValid) {
            return ApiResponse::error('Chữ ký xác thực bị giả mạo hoặc không hợp lệ', 400);
        }

        $resultCode = $request->resultCode;
        $maDonHang = $request->orderId;
        
        // Extract order prefix if orderId matches FORMAT "DHxxxx_17200..."
        if (str_contains($maDonHang, '_')) {
            $maDonHang = explode('_', $maDonHang)[0];
        }

        if ($resultCode == 0) {
            // Có thể IPN chạy chậm hơn Return do mạng, ta vẫn cập nhật chéo ở đây đề phòng
            $this->updatePaymentStatus($maDonHang, 'momo', $request->all(), $request->transId);
            return ApiResponse::success(null, 'Thanh toán MoMo thành công');
        }

        return ApiResponse::error('Thanh toán MoMo thất bại', 400);
    }

    /**
     * Cập nhật trạng thái đơn hàng và thanh toán
     */
    private function updatePaymentStatus(string $maDonHang, string $phuongThuc, array $payload, string $maGiaoDich)
    {
        DB::transaction(function () use ($maDonHang, $phuongThuc, $payload, $maGiaoDich) {
            $donHang = DonHang::where('ma_don_hang', $maDonHang)->first();
            
            if ($donHang && $donHang->trang_thai_tt !== 'da_thanh_toan') {
                $donHang->update([
                    'trang_thai_tt' => 'da_thanh_toan',
                    'trang_thai'    => 'dang_xu_ly'
                ]);

                ThanhToan::create([
                    'don_hang_id'      => $donHang->id,
                    'phuong_thuc'      => $phuongThuc,
                    'ma_giao_dich'     => $maGiaoDich,
                    'so_tien'          => $donHang->tong_tien,
                    'trang_thai'       => 'thanh_cong',
                    'phan_hoi_cong_tt' => json_encode($payload),
                    'thanh_toan_luc'   => now(),
                ]);

                // Thêm lịch sử trạng thái
                $donHang->lichSuTrangThai()->create([
                    'trang_thai' => 'dang_xu_ly',
                    'ghi_chu'    => "Khách hàng thanh toán qua {$phuongThuc}. Mã GD: {$maGiaoDich}"
                ]);

                // Gửi thông báo Email + Web hook cho Khách hàng
                $nguoiDung = $donHang->nguoiDung;
                if ($nguoiDung) {
                    $tenPhuongThuc = strtoupper($phuongThuc);
                    $this->notificationService->send(
                        user:         $nguoiDung,
                        loai:         'don_hang',
                        tieuDe:       "Thanh toán đơn hàng thành công 💳",
                        noiDung:      "Giao dịch thanh toán qua {$tenPhuongThuc} cho đơn hàng #{$donHang->ma_don_hang} đã được xác nhận thành công. Đơn hàng của bạn sẽ sớm được nhà phân phối SportStore đóng gói và gửi đi.",
                        duLieuThem:   [
                            'Mã đơn hàng' => $donHang->ma_don_hang,
                            'Thanh toán'  => number_format($donHang->tong_tien) . 'đ',
                            'Ví điện tử'  => $tenPhuongThuc,
                            'Mã giao dịch' => $maGiaoDich,
                        ],
                        hanhDongUrl:  config('app.frontend_url') . '/profile/orders/' . $donHang->ma_don_hang,
                        hanhDongText: 'Theo dõi đơn hàng',
                    );
                }
            }
        });
    }
}
