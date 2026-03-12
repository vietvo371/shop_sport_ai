<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class NguoiDungSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Tạo Super Admin (Master)
        DB::table('nguoi_dung')->insert([
            'ho_va_ten'     => 'Quản Trị Viên',
            'email'         => 'admin@sportstore.vn',
            'mat_khau'      => Hash::make('Admin@2025'),
            'so_dien_thoai' => '0901234567',
            'vai_tro'       => 'quan_tri',
            'is_master'     => true,
            'trang_thai'    => true,
            'created_at'    => now()->subYear(),
            'updated_at'    => now()->subYear(),
        ]);

        // 2. Tạo các nhân viên quản lý
        // vai_tro = 'quan_tri' để bộ lọc "Nhân viên" tại Admin hoạt động đúng
        $staffAccounts = [
            [
                'ho_va_ten'     => 'Nguyễn Quản Lý',
                'email'         => 'manager@sportstore.vn',
                'mat_khau'      => Hash::make('Manager@2025'),
                'so_dien_thoai' => '0912345678',
            ],
            [
                'ho_va_ten'     => 'Trần Nhân Viên',
                'email'         => 'staff@sportstore.vn',
                'mat_khau'      => Hash::make('Staff@2025'),
                'so_dien_thoai' => '0923456789',
            ],
            [
                'ho_va_ten'     => 'Lê Marketing',
                'email'         => 'marketer@sportstore.vn',
                'mat_khau'      => Hash::make('Marketer@2025'),
                'so_dien_thoai' => '0934567890',
            ],
            [
                'ho_va_ten'     => 'Phạm Kho Vận',
                'email'         => 'staff2@sportstore.vn',
                'mat_khau'      => Hash::make('Staff@2025'),
                'so_dien_thoai' => '0945678901',
            ],
        ];

        foreach ($staffAccounts as $staff) {
            DB::table('nguoi_dung')->insert(array_merge($staff, [
                'vai_tro'    => 'quan_tri', // bắt buộc để filter admin hiển thị đúng
                'trang_thai' => true,
                'created_at' => now()->subDays(rand(30, 180)),
                'updated_at' => now()->subDays(rand(1, 30)),
            ]));
        }

        // 3. Tạo tập hợp Khách hàng (30 người)
        $ho = ['Nguyễn', 'Trần', 'Lê', 'Phạm', 'Hoàng', 'Phan', 'Vũ', 'Đặng', 'Bùi', 'Đỗ'];
        $dem = ['Văn', 'Thị', 'Minh', 'Anh', 'Đức', 'Quang', 'Hồng', 'Ngọc', 'Tuấn', 'Thanh'];
        $ten = ['An', 'Bình', 'Chi', 'Dũng', 'Em', 'Hạnh', 'Khánh', 'Linh', 'Nam', 'Oanh', 'Phúc', 'Quân', 'Sơn', 'Trang', 'Việt'];

        $this->command->info('Đang tạo 30 khách hàng ảo...');

        for ($i = 1; $i <= 30; $i++) {
            $fullName = $ho[array_rand($ho)] . ' ' . $dem[array_rand($dem)] . ' ' . $ten[array_rand($ten)];
            $email = Str::slug($fullName, '.') . $i . '@gmail.com';
            $createdAt = now()->subDays(rand(1, 90));

            $userId = DB::table('nguoi_dung')->insertGetId([
                'ho_va_ten'     => $fullName,
                'email'         => $email,
                'mat_khau'      => Hash::make('User@2025'),
                'so_dien_thoai' => '09' . rand(10000000, 99999999),
                'vai_tro'       => 'khach_hang',
                'trang_thai'    => true,
                'created_at'    => $createdAt,
                'updated_at'    => $createdAt,
            ]);

            // 80% có địa chỉ
            if (rand(1, 10) <= 8) {
                DB::table('dia_chi')->insert([
                    'nguoi_dung_id'  => $userId,
                    'ho_va_ten'      => $fullName,
                    'so_dien_thoai'  => '09' . rand(10000000, 99999999),
                    'tinh_thanh'     => 'Hà Nội',
                    'quan_huyen'     => 'Cầu Giấy',
                    'phuong_xa'      => 'Dịch Vọng',
                    'dia_chi_cu_the' => rand(1, 500) . ' Đường Cầu Giấy',
                    'la_mac_dinh'    => true,
                    'created_at'     => $createdAt,
                    'updated_at'     => $createdAt,
                ]);
            }
        }

        $this->command->info('✅ NguoiDungSeeder: 1 super admin, 4 nhân viên (quan_tri), 30 khách hàng.');
    }
}
