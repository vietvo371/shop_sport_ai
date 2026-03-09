<?php

namespace Database\Seeders;

use App\Models\DanhGia;
use App\Models\NguoiDung;
use App\Models\SanPham;
use Illuminate\Database\Seeder;

class DanhGiaSeeder extends Seeder
{
    public function run(): void
    {
        // Require users and products
        $users = NguoiDung::all();
        $products = SanPham::all();

        if ($users->isEmpty() || $products->isEmpty()) {
            $this->command->warn('Không có người dùng hoặc sản phẩm nào. Bỏ qua seeding DanhGia.');
            return;
        }

        // Xóa sạch đánh giá cũ để tránh lệch count so với số lượt đánh giá cache trong bảng san_pham
        DanhGia::query()->delete();

        $this->command->info('Bắt đầu sinh đánh giá ảo cho tất cả Sản phẩm...');

        $sampleReviews = [
            ['so_sao' => 5, 'tieu_de' => 'Tuyệt vời!', 'noi_dung' => 'Sản phẩm quá đẹp, chất liệu rất tốt. Form chuẩn y hình, mình mặc vừa in. Đáng tiền lắm nha mọi người.', 'da_duyet' => true],
            ['so_sao' => 4, 'tieu_de' => 'Khá tốt', 'noi_dung' => 'Giao hàng nhanh, đóng gói cẩn thận. Hình mẫu lên đẹp, tuy nhiên chất vải hơi mỏng xíu xiu so với kỳ vọng, nhưng ráp lên form rất ok.', 'da_duyet' => true],
            ['so_sao' => 5, 'tieu_de' => 'Hàng chính hãng xịn', 'noi_dung' => 'Quá đỉnh, mang êm chân cực kỳ luôn. Anh em nào chơi thể thao nhiều nên xúc một đôi, đệm lót siêu mềm bảo vệ đầu gối tốt.', 'da_duyet' => true],
            ['so_sao' => 5, 'tieu_de' => 'Rất hài lòng', 'noi_dung' => 'Shop hỗ trợ nhiệt tình, tư vấn size siêu chuẩn. Mẫu đẹp xuất sắc, ra sân ai cũng hỏiii. Mười điểmmm !!!', 'da_duyet' => true],
            ['so_sao' => 3, 'tieu_de' => 'Tạm ổn', 'noi_dung' => 'Mua sale nên giá khá rẻ. Nhưng đường chỉ may đôi chỗ bị lỗi, hi vọng NSX cải thiện. Tổng thể ngoại hình mang đi chơi vẫn ổn.', 'da_duyet' => true],
            ['so_sao' => 4, 'tieu_de' => 'Thiết kế đẹp', 'noi_dung' => 'Màu sắc y chang hình, form thể thao khỏe khoắn. Giá hơi chát một tí nhưng chất lượng chấp nhận được. Xài bền sẽ ủng hộ tiếp.', 'da_duyet' => true],
        ];

        foreach ($products as $product) {
            // Pick a random number of reviews for each product (2 to 5)
            // But don't exceed the number of available users
            $maxReviews = min(rand(2, 5), $users->count());
            
            // Randomly pick unique users
            $reviewers = $users->shuffle()->take($maxReviews);
            
            $totalStars = 0;
            $actualCount = 0;

            foreach ($reviewers as $user) {
                $reviewMock = $sampleReviews[array_rand($sampleReviews)];
                $daysSub = rand(1, 30);
                
                DanhGia::updateOrCreate(
                    [
                        'san_pham_id' => $product->id,
                        'nguoi_dung_id' => $user->id,
                    ],
                    [
                        'don_hang_id' => null,
                        'so_sao' => $reviewMock['so_sao'],
                        'tieu_de' => $reviewMock['tieu_de'],
                        'noi_dung' => $reviewMock['noi_dung'],
                        'da_duyet' => true,
                        'created_at' => now()->subDays($daysSub),
                    ]
                );

                $totalStars += $reviewMock['so_sao'];
                $actualCount++;
            }

            // Update product's pre-calculated aggregations strictly on what was actually seeded
            $product->update([
                'diem_danh_gia' => round($totalStars / $actualCount, 2),
                'so_luot_danh_gia' => $actualCount
            ]);
        }

        $this->command->info('Đã seed xong Review (DanhGia) và cập nhật điểm số (diem_danh_gia) vào bảng san_pham thành công!');
    }
}
