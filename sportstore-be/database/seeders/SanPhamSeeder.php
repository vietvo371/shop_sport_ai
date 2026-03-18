<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SanPhamSeeder extends Seeder
{
    public function run(): void
    {
        $files = [
            'nike'   => 'nike_full_dataset.json',
            'wika'   => 'wika_full_dataset.json',
            'kaiwin' => 'kaiwin_full_dataset.json',
            'kamito' => 'kamito_full_dataset.json'
        ];

        // Lấy Map thương hiệu (lowercase để so trùng)
        $brands = DB::table('thuong_hieu')->pluck('id', 'ten')->toArray();
        $brandMap = [];
        foreach ($brands as $k => $v) {
            $brandMap[strtolower($k)] = $v;
        }

        // Lấy Map Danh mục dựa vào duong_dan (Kết hợp Slug Danh mục Cha + Con) để chống ghi đè các nhánh trùng tên như "Áo Polo"
        $cats = DB::table('danh_muc')->get()->keyBy('duong_dan')->toArray();

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('san_pham')->truncate();
        DB::table('bien_the_san_pham')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $count = 0;

        foreach ($files as $sysBrand => $file) {
            $jsonPath = database_path("seeders/{$file}");
            if (!file_exists($jsonPath)) continue;

            $data = json_decode(file_get_contents($jsonPath), true);
            if (!isset($data['products'])) continue;

            // Tracking danh sách tên đã nạp để bỏ qua nếu JSON bị trùng lặp tên sản phẩm gỡ lỗi Unique Constraint
            $insertedNames = [];

            foreach ($data['products'] as $p) {
                // Tên sản phẩm phải là High Unique
                $tenSanPham = trim($p['name']);
                if (isset($insertedNames[$tenSanPham])) {
                    // Nếu trùng tên rồi thì bỏ qua nạp để tránh Crash DB
                    continue;
                }
                $insertedNames[$tenSanPham] = true;

                // 1. Xác định Brand ID
                $brandName = isset($p['categories'][0]) ? trim($p['categories'][0]) : $sysBrand;
                $brandId = null;
                foreach ($brandMap as $bk => $bv) {
                    if (Str::contains(strtolower($brandName), $bk)) {
                        $brandId = $bv; break;
                    }
                }
                if (!$brandId) {
                    $brandId = array_values($brandMap)[0] ?? 1; // Fallback
                }

                // 2. Xác định Category ID (Mapping bằng Slug của Danh mục Cha + Con)
                $catId = null;
                if (isset($p['categories']) && count($p['categories']) >= 3) {
                    $parentName = trim($p['categories'][1]);
                    $childName = trim($p['categories'][2]);
                    $slug = Str::slug($parentName . ' ' . $childName);
                    
                    if (isset($cats[$slug])) {
                        $catId = $cats[$slug]->id;
                    } else {
                        // Fallback tìm parent
                        $parentSlug = Str::slug($parentName);
                        if (isset($cats[$parentSlug])) {
                            $catId = $cats[$parentSlug]->id;
                        }
                    }
                }
                if (!$catId) $catId = array_values($cats)[0]->id ?? null;

                // 3. Chuẩn hóa giá
                $giaKhuyenMai = !empty($p['price']) ? (float) $p['price'] : 0;
                $giaGoc = !empty($p['regular_price']) ? (float) $p['regular_price'] : $giaKhuyenMai;
                if ($giaGoc == 0 && $giaKhuyenMai > 0) $giaGoc = $giaKhuyenMai;
                if ($giaKhuyenMai == $giaGoc) $giaKhuyenMai = null;

                $moTaNgan = strip_tags($p['short_description'] ?? '');
                if (mb_strlen($moTaNgan) > 490) $moTaNgan = mb_substr($moTaNgan, 0, 490) . '...';

                $createdAt = now()->subDays(rand(1, 90));

                // Prefix mã SKU tự động
                $skuBase = strtoupper(substr($sysBrand, 0, 3)) . '-' . Str::random(6) . '-' . ($p['id'] ?? Str::random(4));

                try {
                    $sanPhamId = DB::table('san_pham')->insertGetId([
                        'ten_san_pham'   => $tenSanPham,
                        // Slug có thêm random string chuẩn để 100% tránh SQL Integrity Constraint unique
                        'duong_dan'      => ($p['slug'] ?? Str::slug($tenSanPham)) . '-' . Str::random(8),
                        'ma_sku'         => $skuBase,
                        'gia_goc'        => $giaGoc,
                        'gia_khuyen_mai' => $giaKhuyenMai,
                        'mo_ta_ngan'     => $moTaNgan,
                        'mo_ta_day_du'   => $p['description'] ?? '',
                        'danh_muc_id'    => $catId,
                        'thuong_hieu_id' => $brandId,
                        'so_luong_ton_kho'=> 1000,
                        'noi_bat'        => $count % 10 == 0 ? true : false,
                        'trang_thai'     => true,
                        'luot_xem'       => rand(20, 1000),
                        'da_ban'         => rand(0, 100),
                        'created_at'     => $createdAt,
                        'updated_at'     => $createdAt,
                    ]);

                    // 4. Các biến thể (Size/Đồng giá)
                    $nameStr = strtolower($tenSanPham . ' ' . ($p['slug'] ?? ''));
                    $isGiay = Str::contains($nameStr, ['giay', 'giày', 'shoe']);
                    $isAo = Str::contains($nameStr, ['ao', 'áo', 'shirt', 'bo thi dau', 'bộ']);

                    if ($isGiay) {
                        $sizes = ['39', '40', '41', '42', '43'];
                        foreach ($sizes as $size) {
                            DB::table('bien_the_san_pham')->insert([
                                'san_pham_id' => $sanPhamId,
                                'ma_sku'      => $skuBase . '-' . $size,
                                'kich_co'     => $size,
                                'mau_sac'     => 'Mặc định',
                                'gia_rieng'   => null,
                                'ton_kho'     => rand(20, 100),
                                'created_at'  => $createdAt,
                                'updated_at'  => $createdAt,
                            ]);
                        }
                    } elseif ($isAo) {
                        $sizes = ['S', 'M', 'L', 'XL', 'XXL'];
                        foreach ($sizes as $size) {
                            DB::table('bien_the_san_pham')->insert([
                                'san_pham_id' => $sanPhamId,
                                'ma_sku'      => $skuBase . '-' . $size,
                                'kich_co'     => $size,
                                'mau_sac'     => 'Mặc định',
                                'gia_rieng'   => ($size == 'XXL') ? 20000 : null, 
                                'ton_kho'     => rand(30, 200),
                                'created_at'  => $createdAt,
                                'updated_at'  => $createdAt,
                            ]);
                        }
                    } else {
                        DB::table('bien_the_san_pham')->insert([
                            'san_pham_id' => $sanPhamId,
                            'ma_sku'      => $skuBase . '-FREE',
                            'kich_co'     => 'Freesize',
                            'mau_sac'     => 'Mặc định',
                            'gia_rieng'   => null,
                            'ton_kho'     => rand(50, 500),
                            'created_at'  => $createdAt,
                            'updated_at'  => $createdAt,
                        ]);
                    }
                    $count++;
                } catch (\Exception $e) {
                    // Cứ việc bỏ qua nếu bị trùng Unique hoặc văng Exception, Dataset có quá nhiều sản phẩm không cần xót
                    continue;
                }
            }
        }

        $this->command->info("✅ SanPhamSeeder: Đã nạp thành công {$count} sản phẩm ĐA DẠNG từ 4 Dataset (Nike, Wika, Kaiwin, Kamito).");
    }
}
