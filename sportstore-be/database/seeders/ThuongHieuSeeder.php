<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThuongHieuSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            [
                'ten' => 'Nike',
                'duong_dan' => 'nike',
                'logo' => 'https://upload.wikimedia.org/wikipedia/commons/a/a6/Logo_NIKE.svg',
                'mo_ta' => 'Thương hiệu thể thao hàng đầu toàn cầu, chuyên giày thể thao, quần áo và phụ kiện.',
                'trang_thai' => true,
            ],
            [
                'ten' => 'Wika',
                'duong_dan' => 'wika',
                'logo' => 'https://vicsport.vn/wp-content/uploads/2023/11/wika-logo.png',
                'mo_ta' => 'Thương hiệu thể thao Việt Nam, nổi bật với giày bóng đá và trang phục bóng đá.',
                'trang_thai' => true,
            ],
            [
                'ten' => 'Kamito',
                'duong_dan' => 'kamito',
                'logo' => 'https://file.hstatic.net/200000211685/collection/kamito_giay_bong_da_7ff1b85aacb847399de8b9ee269cbac7.png',
                'mo_ta' => 'Thương hiệu đỉnh cao Nhật Bản, nổi tiếng với các môn thể thao đa dụng và Pickleball.',
                'trang_thai' => true,
            ],
            [
                'ten' => 'Kaiwin',
                'duong_dan' => 'kaiwin',
                'logo' => 'https://vieclamnhamay.vn/uploads/images/2022/11/17/6375f92163b863_88482251.jpg',
                'mo_ta' => 'Nhà sản xuất trang phục, áo bóng đá, dụng cụ thể thao thiết kế hiện đại.',
                'trang_thai' => true,
            ]
        ];

        foreach ($brands as $brand) {
            DB::table('thuong_hieu')->updateOrInsert(
                ['ten' => $brand['ten']],
                [
                    'duong_dan' => $brand['duong_dan'],
                    'logo' => $brand['logo'],
                    'mo_ta' => $brand['mo_ta'],
                    'updated_at' => now(),
                ]
            );
        }

        $this->command->info('✅ ThuongHieuSeeder: Đã tạo 4 thương hiệu đại diện cho 4 file Dataset.');
    }
}