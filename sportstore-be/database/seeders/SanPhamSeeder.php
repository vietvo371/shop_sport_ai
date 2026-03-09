<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SanPhamSeeder extends Seeder
{
    public function run(): void
    {
        $jsonPath = database_path('seeders/wika_full_dataset.json');
        if (!file_exists($jsonPath)) {
            $this->command->error("Không tìm thấy file wika_full_dataset.json");
            return;
        }

        $json = file_get_contents($jsonPath);
        $data = json_decode($json, true);

        if (!isset($data['products'])) {
            $this->command->info('Không có dữ liệu products trong JSON.');
            return;
        }

        // 1. Lấy map IDs
        $brands = DB::table('thuong_hieu')->pluck('id', 'ten');
        $cats = DB::table('danh_muc')->pluck('id', 'ten');

        $now = now();
        $products = $data['products'];
        $count = 0;

        $brandIds = array_values($brands->toArray());

        foreach ($products as $p) {
            $catId = null;
            if (isset($p['categories']) && count($p['categories']) > 0) {
                // Ưu tiên danh mục đầu tiên
                $catName = $p['categories'][0];
                $catId = $cats[$catName] ?? null;
            }

            $giaKhuyenMai = !empty($p['price']) ? (float) $p['price'] : 0;
            $giaGoc = !empty($p['regular_price']) ? (float) $p['regular_price'] : $giaKhuyenMai;
            if ($giaGoc == 0 && $giaKhuyenMai > 0) {
                $giaGoc = $giaKhuyenMai; // Đảm bảo giá gốc luôn >= giá khuyến mãi
            }
            if ($giaKhuyenMai == $giaGoc) {
                $giaKhuyenMai = null; // Nếu bằng nhau thì ko có khuyến mãi
            }

            // Xử lý mo_ta_ngan tránh quá 500 ký tự
            $moTaNgan = $p['short_description'] ?? '';
            $moTaNgan = strip_tags($moTaNgan);
            if (mb_strlen($moTaNgan) > 490) {
                $moTaNgan = mb_substr($moTaNgan, 0, 490) . '...';
            }

            $sanPhamId = DB::table('san_pham')->insertGetId([
                'ten_san_pham'   => $p['name'],
                'duong_dan'      => $p['slug'] ?? Str::slug($p['name']),
                'ma_sku'         => 'WIKA-' . $p['id'],
                'gia_goc'        => $giaGoc,
                'gia_khuyen_mai' => $giaKhuyenMai,
                'mo_ta_ngan'     => $moTaNgan,
                'mo_ta_day_du'   => $p['description'] ?? '',
                'danh_muc_id'    => $catId,
                'thuong_hieu_id' => $brandIds[array_rand($brandIds)],
                'so_luong_ton_kho'=> 100,
                'noi_bat'        => $count < 12 ? true : false,
                'trang_thai'     => true,
                'created_at'     => $now,
                'updated_at'     => $now,
            ]);

            // Thêm biến thể
            $isGiay = Str::contains(strtolower($p['slug'] ?? ''), 'giay');
            $isAo = Str::contains(strtolower($p['slug'] ?? ''), ['ao', 'bo-thi-dau', 'bo-luyen-tap']);

            if ($isGiay) {
                $sizes = ['39', '40', '41', '42', '43'];
                foreach ($sizes as $size) {
                    DB::table('bien_the_san_pham')->insert([
                        'san_pham_id' => $sanPhamId,
                        'ma_sku'      => 'WIKA-' . $p['id'] . '-' . $size,
                        'kich_co'     => $size,
                        'mau_sac'     => 'Mặc định',
                        'gia_rieng'   => 0,
                        'ton_kho'     => rand(10, 50),
                        'created_at'  => $now,
                        'updated_at'  => $now,
                    ]);
                }
            } elseif ($isAo) {
                $sizes = ['S', 'M', 'L', 'XL', 'XXL'];
                foreach ($sizes as $size) {
                    DB::table('bien_the_san_pham')->insert([
                        'san_pham_id' => $sanPhamId,
                        'ma_sku'      => 'WIKA-' . $p['id'] . '-' . $size,
                        'kich_co'     => $size,
                        'mau_sac'     => 'Mặc định',
                        'gia_rieng'   => ($size == 'XXL') ? 20000 : 0, 
                        'ton_kho'     => rand(20, 100),
                        'created_at'  => $now,
                        'updated_at'  => $now,
                    ]);
                }
            } else {
                DB::table('bien_the_san_pham')->insert([
                    'san_pham_id' => $sanPhamId,
                    'ma_sku'      => 'WIKA-' . $p['id'] . '-FREE',
                    'kich_co'     => 'Freesize',
                    'mau_sac'     => 'Mặc định',
                    'gia_rieng'   => 0,
                    'ton_kho'     => 100,
                    'created_at'  => $now,
                    'updated_at'  => $now,
                ]);
            }

            $count++;
        }

        $this->command->info("✅ SanPhamSeeder: Đã tạo {$count} sản phẩm chuẩn xác từ JSON cùng biến thể.");
    }
}
