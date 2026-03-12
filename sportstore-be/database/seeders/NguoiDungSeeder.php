<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class NguoiDungSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            // Admin
            [
                'ho_va_ten'     => 'Quản Trị Viên',
                'email'         => 'admin@sportstore.vn',
                'mat_khau'      => Hash::make('Admin@2025'),
                'so_dien_thoai' => '0901234567',
                'vai_tro'       => 'quan_tri',
                'is_master'     => true,
                'trang_thai'    => true,
            ],
            // Test users
            [
                'ho_va_ten'     => 'Nguyễn Văn An',
                'email'         => 'an.nguyen@gmail.com',
                'mat_khau'      => Hash::make('User@2025'),
                'so_dien_thoai' => '0912345678',
                'vai_tro'       => 'khach_hang',
                'trang_thai'    => true,
            ],
            [
                'ho_va_ten'     => 'Trần Thị Bích',
                'email'         => 'bich.tran@gmail.com',
                'mat_khau'      => Hash::make('User@2025'),
                'so_dien_thoai' => '0923456789',
                'vai_tro'       => 'khach_hang',
                'trang_thai'    => true,
            ],
            [
                'ho_va_ten'     => 'Lê Minh Cường',
                'email'         => 'cuong.le@gmail.com',
                'mat_khau'      => Hash::make('User@2025'),
                'so_dien_thoai' => '0934567890',
                'vai_tro'       => 'khach_hang',
                'trang_thai'    => true,
            ],
            [
                'ho_va_ten'     => 'Phạm Thị Dung',
                'email'         => 'dung.pham@gmail.com',
                'mat_khau'      => Hash::make('User@2025'),
                'so_dien_thoai' => '0945678901',
                'vai_tro'       => 'khach_hang',
                'trang_thai'    => true,
            ],
        ];

        foreach ($users as $user) {
            DB::table('nguoi_dung')->insert(array_merge($user, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        // Thêm địa chỉ mặc định cho test users (id 2-5)
        $addresses = [
            ['nguoi_dung_id' => 2, 'ho_va_ten' => 'Nguyễn Văn An',  'so_dien_thoai' => '0912345678', 'tinh_thanh' => 'Hà Nội',       'quan_huyen' => 'Cầu Giấy',    'phuong_xa' => 'Dịch Vọng',      'dia_chi_cu_the' => '123 Trần Duy Hưng', 'la_mac_dinh' => true],
            ['nguoi_dung_id' => 3, 'ho_va_ten' => 'Trần Thị Bích',  'so_dien_thoai' => '0923456789', 'tinh_thanh' => 'Hồ Chí Minh', 'quan_huyen' => 'Bình Thạnh',  'phuong_xa' => 'Phường 25',      'dia_chi_cu_the' => '45 Xô Viết Nghệ Tĩnh', 'la_mac_dinh' => true],
            ['nguoi_dung_id' => 4, 'ho_va_ten' => 'Lê Minh Cường',  'so_dien_thoai' => '0934567890', 'tinh_thanh' => 'Đà Nẵng',     'quan_huyen' => 'Hải Châu',    'phuong_xa' => 'Phước Ninh',     'dia_chi_cu_the' => '78 Phan Châu Trinh', 'la_mac_dinh' => true],
            ['nguoi_dung_id' => 5, 'ho_va_ten' => 'Phạm Thị Dung',  'so_dien_thoai' => '0945678901', 'tinh_thanh' => 'Hồ Chí Minh', 'quan_huyen' => 'Quận 1',      'phuong_xa' => 'Bến Nghé',       'dia_chi_cu_the' => '12 Lê Lợi', 'la_mac_dinh' => true],
        ];

        foreach ($addresses as $addr) {
            DB::table('dia_chi')->insert(array_merge($addr, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        $this->command->info('✅ NguoiDungSeeder: 1 admin + 4 khách hàng + 4 địa chỉ đã tạo');
        $this->command->info('   📧 Admin: admin@sportstore.vn / Admin@2025');
        $this->command->info('   📧 User:  an.nguyen@gmail.com / User@2025');
    }
}
