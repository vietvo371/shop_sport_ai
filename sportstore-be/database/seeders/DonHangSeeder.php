<?php

namespace Database\Seeders;

use App\Models\DonHang;
use App\Models\ChiTietDonHang;
use App\Models\NguoiDung;
use App\Models\SanPham;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DonHangSeeder extends Seeder
{
    public function run(): void
    {
        $users = NguoiDung::where('vai_tro', 'khach_hang')->get();
        $products = SanPham::all();

        if ($users->isEmpty() || $products->isEmpty()) {
            return;
        }

        $this->command->info('Bắt đầu sinh đơn hàng giả lập...');

        foreach ($users as $user) {
            // Mỗi user có 1-2 đơn hàng đã giao
            $numOrders = rand(1, 2);

            for ($i = 0; $i < $numOrders; $i++) {
                $order = DonHang::create([
                    'nguoi_dung_id' => $user->id,
                    'ma_don_hang' => 'DH' . strtoupper(Str::random(10)),
                    'trang_thai' => 'da_giao',
                    'phuong_thuc_tt' => 'cod',
                    'trang_thai_tt' => 'da_thanh_toan',
                    'tam_tinh' => 0,
                    'phi_van_chuyen' => 30000,
                    'tong_tien' => 0,
                    'ten_nguoi_nhan' => $user->ho_va_ten,
                    'sdt_nguoi_nhan' => $user->so_dien_thoai,
                    'dia_chi_giao_hang' => 'Địa chỉ giả lập của ' . $user->ho_va_ten,
                ]);

                // Mỗi đơn hàng có 1-3 sản phẩm
                $numItems = rand(1, 3);
                $randomProducts = $products->random($numItems);
                $totalTamTinh = 0;

                foreach ($randomProducts as $product) {
                    $qty = rand(1, 2);
                    $price = $product->gia_khuyen_mai || $product->gia_goc;
                    
                    ChiTietDonHang::create([
                        'don_hang_id' => $order->id,
                        'san_pham_id' => $product->id,
                        'ten_san_pham' => $product->ten_san_pham,
                        'so_luong' => $qty, 
                        'don_gia' => $price,
                        'thanh_tien' => $price * $qty,
                    ]);
                    $totalTamTinh += $price * $qty;
                }

                $order->update([
                    'tam_tinh' => $totalTamTinh,
                    'tong_tien' => $totalTamTinh + 30000,
                ]);
            }
        }

        $this->command->info('Đã seed xong đơn hàng giả lập.');
    }
}
