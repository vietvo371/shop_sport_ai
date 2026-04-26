<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BannerSeeder extends Seeder
{
    public function run(): void
    {
        // Xóa dữ liệu banners cũ
        DB::table('banners')->truncate();

        // Danh sách các file dataset
        $files = [
            // 'nike_full_dataset.json',
            'wika_full_dataset.json',
            'kaiwin_full_dataset.json',
            'kamito_full_dataset.json',
        ];

        $now = now();
        $totalCount = 0;
        $thuTu = 1;

        foreach ($files as $file) {
            $jsonPath = database_path("seeders/{$file}");

            if (!file_exists($jsonPath)) {
                $this->command->warn("Không tìm thấy file {$file}, bỏ qua.");
                continue;
            }

            $json = file_get_contents($jsonPath);
            $data = json_decode($json, true);

            if (!isset($data['banners']) || empty($data['banners'])) {
                $this->command->info("File {$file} không có dữ liệu banners.");
                continue;
            }

            $banners = $data['banners'];
            $count = 0;

            foreach ($banners as $banner) {
                DB::table('banners')->insert([
                    'tieu_de'    => $banner['title'] ?? ('Banner ' . $thuTu),
                    'hinh_anh'   => $banner['image'],
                    'duong_dan'  => $banner['link'] ?? '/',
                    'vi_tri'     => 'home_main',
                    'trang_thai' => true,
                    'thu_tu'     => $thuTu++,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
                $count++;
                $totalCount++;
            }

            $this->command->info("✅ {$file}: Đã thêm {$count} banners");
        }

        $this->command->info("🎉 BannerSeeder: Tổng cộng đã tạo {$totalCount} Slide Banners");
    }
}
