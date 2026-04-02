<?php

namespace Database\Seeders;

use App\Models\BangSize;
use App\Models\ThuongHieu;
use Illuminate\Database\Seeder;

class BangSizeSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Áo (Dùng chung)
        $aoData = [
            ['ten_size' => 'S',  'chieu_cao_min' => 150, 'chieu_cao_max' => 160, 'can_nang_min' => 45, 'can_nang_max' => 55],
            ['ten_size' => 'M',  'chieu_cao_min' => 160, 'chieu_cao_max' => 170, 'can_nang_min' => 55, 'can_nang_max' => 65],
            ['ten_size' => 'L',  'chieu_cao_min' => 170, 'chieu_cao_max' => 180, 'can_nang_min' => 65, 'can_nang_max' => 75],
            ['ten_size' => 'XL', 'chieu_cao_min' => 180, 'chieu_cao_max' => 190, 'can_nang_min' => 75, 'can_nang_max' => 85],
            ['ten_size' => 'XXL','chieu_cao_min' => 190, 'chieu_cao_max' => 200, 'can_nang_min' => 85, 'can_nang_max' => 95],
        ];

        foreach ($aoData as $data) {
            BangSize::create(array_merge($data, ['loai' => 'ao']));
            BangSize::create(array_merge($data, ['loai' => 'quan'])); // Quần dùng chung logic này cho mẫu
        }

        // 2. Giày (Dùng chung)
        $giayData = [
            ['ten_size' => '38', 'chieu_dai_chan_min' => 235, 'chieu_dai_chan_max' => 240],
            ['ten_size' => '39', 'chieu_dai_chan_min' => 240, 'chieu_dai_chan_max' => 245],
            ['ten_size' => '40', 'chieu_dai_chan_min' => 245, 'chieu_dai_chan_max' => 250],
            ['ten_size' => '41', 'chieu_dai_chan_min' => 250, 'chieu_dai_chan_max' => 255],
            ['ten_size' => '42', 'chieu_dai_chan_min' => 255, 'chieu_dai_chan_max' => 260],
            ['ten_size' => '43', 'chieu_dai_chan_min' => 260, 'chieu_dai_chan_max' => 265],
        ];

        foreach ($giayData as $data) {
            BangSize::create(array_merge($data, ['loai' => 'giay']));
        }

        // 3. Quy tắc riêng cho thương hiệu (Ví dụ: Nike)
        $nike = ThuongHieu::where('ten', 'like', '%Nike%')->first();
        if ($nike) {
            BangSize::create([
                'thuong_hieu_id' => $nike->id,
                'loai'           => 'giay',
                'ten_size'       => '42.5',
                'chieu_dai_chan_min' => 260,
                'chieu_dai_chan_max' => 265,
                'mo_ta'          => 'Size đặc biệt của Nike',
            ]);
        }
    }
}
