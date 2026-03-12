<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VaiTro;
use App\Models\Quyen;
use Illuminate\Support\Facades\DB;

class StandardRBACSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Định nghĩa danh sách các quyền hạn chuẩn theo kế hoạch
        $permissions = [
            // Nhóm Sản phẩm
            ['ten' => 'Xem sản phẩm', 'ma_slug' => 'xem_sp', 'nhom' => 'Sản phẩm'],
            ['ten' => 'Thêm sản phẩm', 'ma_slug' => 'them_sp', 'nhom' => 'Sản phẩm'],
            ['ten' => 'Sửa sản phẩm', 'ma_slug' => 'sua_sp', 'nhom' => 'Sản phẩm'],
            ['ten' => 'Xóa sản phẩm', 'ma_slug' => 'xoa_sp', 'nhom' => 'Sản phẩm'],
            
            // Nhóm Catalog
            ['ten' => 'Quản lý danh mục & thương hiệu', 'ma_slug' => 'quan_ly_catalog', 'nhom' => 'Catalog'],
            
            // Nhóm Đơn hàng
            ['ten' => 'Xem đơn hàng', 'ma_slug' => 'xem_don', 'nhom' => 'Đơn hàng'],
            ['ten' => 'Cập nhật đơn hàng', 'ma_slug' => 'cap_nhat_don', 'nhom' => 'Đơn hàng'],
            ['ten' => 'Hủy đơn hàng', 'ma_slug' => 'huy_don', 'nhom' => 'Đơn hàng'],
            ['ten' => 'In hóa đơn', 'ma_slug' => 'in_hoa_don', 'nhom' => 'Đơn hàng'],
            
            // Nhóm Đánh giá
            ['ten' => 'Duyệt đánh giá', 'ma_slug' => 'duyet_danh_gia', 'nhom' => 'Đánh giá'],
            
            // Nhóm Marketing
            ['ten' => 'Quản lý Banner', 'ma_slug' => 'quan_ly_banner', 'nhom' => 'Marketing'],
            ['ten' => 'Quản lý Mã giảm giá', 'ma_slug' => 'ma_giam_gia', 'nhom' => 'Marketing'],
            ['ten' => 'Gửi thông báo quảng bá', 'ma_slug' => 'gui_quang_ba', 'nhom' => 'Marketing'],
            
            // Nhóm Báo cáo
            ['ten' => 'Xem báo cáo doanh thu', 'ma_slug' => 'xem_doanh_thu', 'nhom' => 'Báo cáo'],
            
            // Nhóm Hệ thống
            ['ten' => 'Xem bảng điều khiển', 'ma_slug' => 'xem_dashboard', 'nhom' => 'Hệ thống'],
            ['ten' => 'Xem danh sách người dùng', 'ma_slug' => 'xem_user', 'nhom' => 'Hệ thống'],
            ['ten' => 'Sửa thông tin người dùng', 'ma_slug' => 'sua_user', 'nhom' => 'Hệ thống'],
            ['ten' => 'Xóa người dùng', 'ma_slug' => 'go_bo_user', 'nhom' => 'Hệ thống'],
            ['ten' => 'Quản lý phân quyền', 'ma_slug' => 'phan_quyen', 'nhom' => 'Hệ thống'],
            ['ten' => 'Cài đặt hệ thống', 'ma_slug' => 'cai_dat_he_thong', 'nhom' => 'Hệ thống'],
        ];

        // 2. Tạo hoặc cập nhật các quyền
        foreach ($permissions as $p) {
            Quyen::updateOrCreate(
                ['ma_slug' => $p['ma_slug']],
                ['ten' => $p['ten'], 'nhom' => $p['nhom']]
            );
        }

        // Xóa quyền cũ không còn dùng (nếu có)
        Quyen::where('ma_slug', 'quan_ly_user')->delete();

        // 3. Tạo các vai trò cơ bản
        $roles = [
            ['ten' => 'Siêu quản trị', 'ma_slug' => 'super_admin'],
            ['ten' => 'Quản lý cửa hàng', 'ma_slug' => 'manager'],
            ['ten' => 'Nhân viên bán hàng', 'ma_slug' => 'staff'],
            ['ten' => 'Nhân viên Marketing', 'ma_slug' => 'marketer'],
            ['ten' => 'Khách hàng', 'ma_slug' => 'customer'],
        ];

        foreach ($roles as $r) {
            VaiTro::firstOrCreate(['ma_slug' => $r['ma_slug']], ['ten' => $r['ten']]);
        }

        // 4. Gán toàn bộ quyền cho Siêu quản trị
        $superAdmin = VaiTro::where('ma_slug', 'super_admin')->first();
        if ($superAdmin) {
            $allPermissions = Quyen::all();
            $superAdmin->quyen()->sync($allPermissions->pluck('id'));
        }

        // 5. Gán vai trò super_admin cho tài khoản admin mặc định nếu chưa có
        $adminUser = \App\Models\NguoiDung::where('email', 'admin@sportstore.vn')->first();
        if ($adminUser && $superAdmin) {
            $adminUser->cacVaiTro()->syncWithoutDetaching([$superAdmin->id]);
        }

        // 6. Gán quyền cho các vai trò khác
        
        // Manager: Gần như toàn quyền trừ Phân quyền & Cài đặt hệ thống
        $manager = VaiTro::where('ma_slug', 'manager')->first();
        if ($manager) {
            $managerPerms = Quyen::whereNotIn('ma_slug', ['phan_quyen', 'cai_dat_he_thong', 'go_bo_user'])->pluck('id');
            $manager->quyen()->sync($managerPerms);
        }

        // Staff: Chỉ xử lý Sản phẩm và Đơn hàng
        $staff = VaiTro::where('ma_slug', 'staff')->first();
        if ($staff) {
            $staffPerms = Quyen::whereIn('nhom', ['Sản phẩm', 'Đơn hàng', 'Catalog'])
                ->orWhere('ma_slug', 'xem_dashboard')
                ->pluck('id');
            $staff->quyen()->sync($staffPerms);
        }

        // Marketer: Banner, Coupon, Quảng bá và Báo cáo
        $marketer = VaiTro::where('ma_slug', 'marketer')->first();
        if ($marketer) {
            $marketerPerms = Quyen::whereIn('nhom', ['Marketing', 'Báo cáo'])
                ->orWhereIn('ma_slug', ['xem_dashboard', 'xem_sp'])
                ->pluck('id');
            $marketer->quyen()->sync($marketerPerms);
        }

        // 7. Gán RBAC role cho các nhân viên được tạo trong NguoiDungSeeder
        $staffMapping = [
            'manager@sportstore.vn'  => 'manager',
            'staff@sportstore.vn'    => 'staff',
            'marketer@sportstore.vn' => 'marketer',
            'staff2@sportstore.vn'   => 'staff',
        ];

        foreach ($staffMapping as $email => $roleSlug) {
            $user = \App\Models\NguoiDung::where('email', $email)->first();
            $role = VaiTro::where('ma_slug', $roleSlug)->first();
            if ($user && $role) {
                $user->cacVaiTro()->syncWithoutDetaching([$role->id]);
            }
        }

        $this->command->info('✅ StandardRBACSeeder: Phân quyền RBAC hoàn tất (super_admin, manager, staff, marketer).');
    }
}
