<?php

namespace App\Console\Commands;

use App\Models\DonHang;
use App\Models\LichSuTrangThaiDon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AutoCancelUnpaidOrders extends Command
{
    protected $signature = 'orders:cancel-unpaid {--minutes=30 : Số phút quá hạn}';
    protected $description = 'Tự động hủy đơn hàng thanh toán online chưa thanh toán quá thời hạn và hoàn kho';

    public function handle(): int
    {
        $minutes = (int) $this->option('minutes');

        $expiredOrders = DonHang::where('trang_thai_tt', 'chua_thanh_toan')
            ->whereIn('phuong_thuc_tt', ['vnpay', 'momo'])
            ->where('trang_thai', 'cho_xac_nhan')
            ->where('created_at', '<', now()->subMinutes($minutes))
            ->with('items.bienThe', 'items.sanPham', 'nguoiDung')
            ->get();

        if ($expiredOrders->isEmpty()) {
            $this->info('Không có đơn hàng quá hạn cần hủy.');
            return self::SUCCESS;
        }

        $count = 0;

        foreach ($expiredOrders as $donHang) {
            DB::transaction(function () use ($donHang) {
                foreach ($donHang->items as $item) {
                    if ($item->bienThe) {
                        $item->bienThe->increment('ton_kho', $item->so_luong);
                    }
                    $item->sanPham->increment('so_luong_ton_kho', $item->so_luong);
                }

                $donHang->update([
                    'trang_thai' => 'da_huy',
                ]);

                LichSuTrangThaiDon::create([
                    'don_hang_id' => $donHang->id,
                    'trang_thai' => 'da_huy',
                    'ghi_chu' => 'Tự động hủy do không thanh toán trong thời hạn cho phép.',
                ]);
            });

            $count++;
            Log::info("Auto-cancel đơn hàng #{$donHang->ma_don_hang} do quá hạn thanh toán.");
        }

        $this->info("Đã hủy {$count} đơn hàng quá hạn thanh toán.");
        return self::SUCCESS;
    }
}
