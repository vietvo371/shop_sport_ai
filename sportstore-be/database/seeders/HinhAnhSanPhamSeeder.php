<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HinhAnhSanPhamSeeder extends Seeder
{
    public function run(): void
    {
        $files = [
            'nike_full_dataset.json',
            'wika_full_dataset.json',
            'kaiwin_full_dataset.json',
            'kamito_full_dataset.json'
        ];

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('hinh_anh_san_pham')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Sử dụng Name thay vì Slug làm Key Map vì lúc Seed SP các Slug đã được gắn đuôi rand().
        // Việc chùng tên sản phẩm trên toàn dataset là cực ít nên tỉ lệ trúng map rất cao.
        $productMap = DB::table('san_pham')->pluck('id', 'ten_san_pham');

        $now = now();
        $count = 0;
        $inserts = [];

        foreach ($files as $file) {
            $jsonPath = database_path("seeders/{$file}");
            if (!file_exists($jsonPath)) continue;

            $data = json_decode(file_get_contents($jsonPath), true);
            if (!isset($data['products'])) continue;

            foreach ($data['products'] as $p) {
                $sanPhamId = $productMap[$p['name']] ?? null;

                if ($sanPhamId && isset($p['images']) && is_array($p['images'])) {
                    foreach ($p['images'] as $idx => $url) {
                        $inserts[] = [
                            'san_pham_id'   => $sanPhamId,
                            'duong_dan_anh' => $url, // Lưu URL ngoài thẳng vào database
                            'chu_thich'     => null,
                            'thu_tu'        => $idx,
                            'la_anh_chinh'  => $idx === 0,
                            'created_at'    => $now,
                        ];
                        $count++;
                    }
                }
            }
        }

        // Chèn hàng loạt cho tối ưu bộ nhớ
        $chunkedInserts = array_chunk($inserts, 500);
        foreach ($chunkedInserts as $chunk) {
            DB::table('hinh_anh_san_pham')->insert($chunk);
        }

        $this->command->info("✅ HinhAnhSanPhamSeeder: Đã nạp thành công {$count} hình ảnh cho toàn bộ SP thuộc 4 Dataset.");
    }
}
