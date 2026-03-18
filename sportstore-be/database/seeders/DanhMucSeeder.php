<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DanhMucSeeder extends Seeder
{
    public function run(): void
    {
        $files = [
            'nike_full_dataset.json',
            'wika_full_dataset.json',
            'kaiwin_full_dataset.json',
            'kamito_full_dataset.json'
        ];

        $parents = [];
        $children = [];

        foreach ($files as $file) {
            $jsonPath = database_path("seeders/{$file}");
            if (!file_exists($jsonPath)) continue;

            $data = json_decode(file_get_contents($jsonPath), true);
            if (!isset($data['products'])) continue;

            foreach ($data['products'] as $product) {
                if (isset($product['categories']) && count($product['categories']) >= 3) {
                    // Cấu trúc chung: [0] Brand, [1] Parent Category, [2] Child Category
                    $parentName = trim($product['categories'][1]);
                    $childName = trim($product['categories'][2]);

                    $parents[$parentName] = true;
                    $children[$parentName][$childName] = true;
                }
            }
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('danh_muc')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $now = now();
        $countCha = 0;
        $countCon = 0;
        $thuTu = 1;
        
        foreach ($parents as $pName => $_) {
            // Thêm danh mục cha
            $parentId = DB::table('danh_muc')->insertGetId([
                'ten'             => $pName,
                'duong_dan'       => Str::slug($pName),
                'danh_muc_cha_id' => null,
                'thu_tu'          => $thuTu++,
                'trang_thai'      => true,
                'created_at'      => $now,
                'updated_at'      => $now,
            ]);
            $countCha++;

            // Thêm mảng danh mục con thuộc cha này
            if (isset($children[$pName])) {
                $thuTuCon = 1;
                foreach ($children[$pName] as $cName => $__) {
                    DB::table('danh_muc')->insert([
                        'ten'             => $cName,
                        'duong_dan'       => Str::slug($pName . ' ' . $cName), // Gộp cha-con vô slug đảm bảo không bị UNIQUE trúng
                        'danh_muc_cha_id' => $parentId,
                        'thu_tu'          => $thuTuCon++,
                        'trang_thai'      => true,
                        'created_at'      => $now,
                        'updated_at'      => $now,
                    ]);
                    $countCon++;
                }
            }
        }

        $this->command->info("✅ DanhMucSeeder: Đã tạo Cấu trúc chuẩn với {$countCha} Danh mục Cấp 1, {$countCon} Danh mục Cấp 2.");
    }
}
