<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DanhMucSeeder extends Seeder
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

        $uniqueCategories = [];
        foreach ($data['products'] as $product) {
            if (isset($product['categories']) && is_array($product['categories'])) {
                foreach ($product['categories'] as $catName) {
                    $uniqueCategories[$catName] = true;
                }
            }
        }

        $now = now();
        $count = 0;

        foreach (array_keys($uniqueCategories) as $idx => $catName) {
            DB::table('danh_muc')->insert([
                'ten'             => $catName,
                'duong_dan'       => Str::slug($catName),
                'danh_muc_cha_id' => null,
                'thu_tu'          => $idx,
                'trang_thai'      => true,
                'created_at'      => $now,
                'updated_at'      => $now,
            ]);
            $count++;
        }

        $this->command->info("✅ DanhMucSeeder: Đã tạo {$count} danh mục gốc từ JSON");
    }
}
