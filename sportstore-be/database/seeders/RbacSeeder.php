<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VaiTro;
use App\Models\Quyen;
use App\Models\NguoiDung;
use Illuminate\Support\Facades\DB;

class RbacSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Định nghĩa các quyền
        $permissions = [
            // Sản phẩm
            ['ten' => 'Xem sản phẩm (Admin)', 'ma_slug' => 'xem_sp', 'nhom' => 'Sản phẩm'],
            ['ten' => 'Thêm sản phẩm', 'ma_slug' => 'them_sp', 'nhom' => 'Sản phẩm'],
            ['ten' => 'Sửa sản phẩm', 'ma_slug' => 'sua_sp', 'nhom' => 'Sản phẩm'],
            ['ten' => 'Xóa sản phẩm', 'ma_slug' => 'xoa_sp', 'nhom' => 'Sản phẩm'],

            // Danh mục & Thương hiệu
            ['ten' => 'Quản lý Catalog', 'ma_slug' => 'quan_ly_catalog', 'nhom' => 'Catalog'],

            // Đơn hàng
            ['ten' => 'Xem đơn hàng', 'ma_slug' => 'xem_don', 'nhom' => 'Đơn hàng'],
            ['ten' => 'Cập nhật trạng thái đơn', 'ma_slug' => 'cap_nhat_don', 'nhom' => 'Đơn hàng'],
            ['ten' => 'Hủy đơn hàng', 'ma_slug' => 'huy_don', 'nhom' => 'Đơn hàng'],
            ['ten' => 'In hóa đơn', 'ma_slug' => 'in_hoa_don', 'nhom' => 'Đơn hàng'],

            // Đánh giá
            ['ten' => 'Duyệt đánh giá', 'ma_slug' => 'duyet_danh_gia', 'nhom' => 'Đánh giá'],

            // Marketing
            ['ten' => 'Quản lý Banner', 'ma_slug' => 'quan_ly_banner', 'nhom' => 'Marketing'],
            ['ten' => 'Quản lý Mã giảm giá', 'ma_slug' => 'ma_giam_gia', 'nhom' => 'Marketing'],
            ['ten' => 'Gửi thông báo quảng bá', 'ma_slug' => 'gui_quang_ba', 'nhom' => 'Marketing'],

            // Hệ thống & Báo cáo
            ['ten' => 'Xem báo cáo doanh thu', 'ma_slug' => 'xem_doanh_thu', 'nhom' => 'Báo cáo'],
            ['ten' => 'Quản lý người dùng', 'ma_slug' => 'quan_ly_user', 'nhom' => 'Hệ thống'],
            ['ten' => 'Cài đặt hệ thống', 'ma_slug' => 'cai_dat_he_thong', 'nhom' => 'Hệ thống'],
            ['ten' => 'Quản lý phân quyền', 'ma_slug' => 'phan_quyen', 'nhom' => 'Hệ thống'],
        ];

        foreach ($permissions as $p) {
            Quyen::updateOrCreate(['ma_slug' => $p['ma_slug']], $p);
        }

        // 2. Định nghĩa các vai trò
        $roles = [
            ['ten' => 'Siêu quản trị', 'ma_slug' => 'super_admin'],
            ['ten' => 'Quản lý', 'ma_slug' => 'manager'],
            ['ten' => 'Nhân viên', 'ma_slug' => 'staff'],
            ['ten' => 'Marketing', 'ma_slug' => 'marketer'],
            ['ten' => 'Khách hàng', 'ma_slug' => 'customer'],
        ];

        foreach ($roles as $r) {
            VaiTro::updateOrCreate(['ma_slug' => $r['ma_slug']], $r);
        }

        // 3. Gán quyền cho vai trò
        $superAdmin = VaiTro::where('ma_slug', 'super_admin')->first();
        $manager = VaiTro::where('ma_slug', 'manager')->first();
        $staff = VaiTro::where('ma_slug', 'staff')->first();
        $marketer = VaiTro::where('ma_slug', 'marketer')->first();

        // Super Admin lấy tất cả
        $allPermissions = Quyen::all();
        $superAdmin->quyen()->sync($allPermissions->pluck('id'));

        // Manager (Sản phẩm, Đơn hàng, Coupon, Báo cáo)
        $managerPermissions = Quyen::whereIn('nhom', ['Sản phẩm', 'Catalog', 'Đơn hàng', 'Đánh giá'])
            ->orWhereIn('ma_slug', ['ma_giam_gia', 'xem_doanh_thu'])
            ->get();
        $manager->quyen()->sync($managerPermissions->pluck('id'));

        // Staff (Đơn hàng, Đánh giá)
        $staffPermissions = Quyen::whereIn('nhom', ['Đơn hàng', 'Đánh giá'])
            ->orWhere('ma_slug', 'xem_sp')
            ->get();
        $staff->quyen()->sync($staffPermissions->pluck('id'));

        // Marketer (Banner, Coupon, Thông báo)
        $marketerPermissions = Quyen::whereIn('nhom', ['Marketing'])
            ->orWhere('ma_slug', 'xem_sp')
            ->get();
        $marketer->quyen()->sync($marketerPermissions->pluck('id'));

        // 4. Di chuyển dữ liệu từ enum vai_tro sang bảng pivot
        // Lấy tất cả người dùng
        $users = NguoiDung::all();
        $customerRole = VaiTro::where('ma_slug', 'customer')->first();

        foreach ($users as $user) {
            if ($user->vai_tro === 'quan_tri') {
                $user->vaiTro()->syncWithoutDetaching([$superAdmin->id]);
            } else {
                $user->vaiTro()->syncWithoutDetaching([$customerRole->id]);
            }
        }
    }
}
