<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HinhAnhSanPhamSeeder extends Seeder
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

        // Tạo ánh xạ từ slug sang id để biết sản phẩm nào map với ảnh nào
        $productMap = DB::table('san_pham')->pluck('id', 'duong_dan');

        $now = now();
        $count = 0;
        
        $inserts = [];

        foreach ($data['products'] as $p) {
            $slug = $p['slug'] ?? Str::slug($p['name']);
            $sanPhamId = $productMap[$slug] ?? null;

            if ($sanPhamId && isset($p['images']) && is_array($p['images'])) {
                foreach ($p['images'] as $idx => $url) {
                    $inserts[] = [
                        'san_pham_id'   => $sanPhamId,
                        'duong_dan_anh' => $url, // Lưu URL trực tiếp thay vì tải về để tránh lag/timeout
                        'chu_thich'     => null,
                        'thu_tu'        => $idx,
                        'la_anh_chinh'  => $idx === 0,
                        'created_at'    => $now,
                    ];
                    $count++;
                }
            }
        }

        // Chèn hàng loạt cho tối ưu hiệu suất
        $chunkedInserts = array_chunk($inserts, 500);
        foreach ($chunkedInserts as $chunk) {
            DB::table('hinh_anh_san_pham')->insert($chunk);
        }

        $this->command->info("✅ HinhAnhSanPhamSeeder: Đã tạo {$count} bản ghi ảnh sản phẩm từ JSON.");
    }
}
