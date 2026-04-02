<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the SportStore database.
     *
     * Thứ tự quan trọng — phụ thuộc FK:
     * 1. ThuongHieu  (không phụ thuộc ai)
     * 2. DanhMuc     (self-ref nhưng cha trước con)
     * 3. NguoiDung   (không phụ thuộc ai)
     * 4. SanPham     (phụ thuộc ThuongHieu + DanhMuc)
     * 5. MaGiamGia   (không phụ thuộc ai)
     */
    public function run(): void
    {
        $this->call([
            ThuongHieuSeeder::class,
            DanhMucSeeder::class,
            NguoiDungSeeder::class,
            SanPhamSeeder::class,
            HinhAnhSanPhamSeeder::class,  // ← phải sau SanPhamSeeder
            MaGiamGiaSeeder::class,
            BannerSeeder::class,
            StandardRBACSeeder::class, // ← Phân quyền chuẩn
            ChatbotSeeder::class,      // ← Chatbot data
            DonHangSeeder::class,
            DanhGiaSeeder::class, // DanhGia cần SanPham và NguoiDung
            HanhViNguoiDungSeeder::class, // ← Lượt xem sản phẩm
            BangSizeSeeder::class,
        ]);
    }
}
