<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BannerSeeder extends Seeder
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

        if (!isset($data['banners'])) {
            $this->command->info('Không có dữ liệu banners trong JSON.');
            return;
        }

        $banners = $data['banners'];
        $now = now();
        $count = 0;

        foreach ($banners as $index => $banner) {
            DB::table('banners')->insert([
                'tieu_de'    => $banner['title'] ?? ('Banner ' . ($index + 1)),
                'hinh_anh'   => $banner['image'],
                'duong_dan'  => $banner['link'] ?? '/',
                'trang_thai' => true,
                'thu_tu'     => $index + 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
            $count++;
        }

        $this->command->info("✅ BannerSeeder: Đã tạo {$count} Slide Banners từ JSON");
    }
}
