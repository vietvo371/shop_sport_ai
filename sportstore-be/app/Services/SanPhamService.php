<?php

namespace App\Services;

use App\Models\SanPham;
use App\Models\HanhViNguoiDung;
use Illuminate\Pagination\LengthAwarePaginator;

class SanPhamService
{
    /**
     * Danh sách sản phẩm với filter, search, paginate.
     */
    public function index(array $filters): LengthAwarePaginator
    {
        $query = SanPham::with(['danhMuc', 'thuongHieu', 'anhChinh'])
            ->where('trang_thai', true);

        // Lọc theo danh mục
        if (!empty($filters['danh_muc'])) {
            $query->where('danh_muc_id', $filters['danh_muc']);
        }

        // Lọc theo thương hiệu
        if (!empty($filters['thuong_hieu'])) {
            $query->where('thuong_hieu_id', $filters['thuong_hieu']);
        }

        // Lọc theo giá
        if (!empty($filters['gia_min'])) {
            $query->where('gia_goc', '>=', $filters['gia_min']);
        }
        if (!empty($filters['gia_max'])) {
            $query->where('gia_goc', '<=', $filters['gia_max']);
        }

        // Tìm kiếm
        if (!empty($filters['tu_khoa'])) {
            $query->where('ten_san_pham', 'like', '%' . $filters['tu_khoa'] . '%');
        }

        // Chỉ nổi bật
        if (!empty($filters['noi_bat'])) {
            $query->where('noi_bat', true);
        }

        // Sắp xếp
        $sapXep = $filters['sap_xep'] ?? 'moi_nhat';
        match ($sapXep) {
            'gia_tang'    => $query->orderBy('gia_goc', 'asc'),
            'gia_giam'    => $query->orderBy('gia_goc', 'desc'),
            'ban_chay'    => $query->orderBy('da_ban', 'desc'),
            'danh_gia'    => $query->orderBy('diem_danh_gia', 'desc'),
            default       => $query->latest(),
        };

        $perPage = min((int) ($filters['per_page'] ?? 12), 50);
        return $query->paginate($perPage);
    }

    /**
     * Chi tiết sản phẩm theo slug.
     */
    public function findBySlug(string $slug): ?SanPham
    {
        return SanPham::with([
            'danhMuc',
            'thuongHieu',
            'hinhAnh',
            'bienThe' => fn($q) => $q->where('trang_thai', true),
            'danhGia' => fn($q) => $q->where('da_duyet', true)->with('nguoiDung')->latest()->take(10),
        ])->where('duong_dan', $slug)->where('trang_thai', true)->first();
    }

    /**
     * Tăng lượt xem.
     */
    public function tangLuotXem(SanPham $sanPham): void
    {
        $sanPham->increment('luot_xem');
    }

    /**
     * Ghi nhận hành vi xem/click để phục vụ ML.
     */
    public function ghiHanhVi(int $sanPhamId, string $hanhVi, ?int $nguoiDungId, ?string $maPhien): void
    {
        HanhViNguoiDung::create([
            'nguoi_dung_id' => $nguoiDungId,
            'ma_phien'      => $maPhien,
            'san_pham_id'   => $sanPhamId,
            'hanh_vi'       => $hanhVi,
        ]);
    }

    // ── Admin methods ──────────────────────────────────────
    public function adminIndex(): LengthAwarePaginator
    {
        return SanPham::with(['danhMuc', 'thuongHieu'])->latest()->paginate(20);
    }

    public function create(array $data): SanPham
    {
        return SanPham::create($data);
    }

    public function update(SanPham $sanPham, array $data): SanPham
    {
        $sanPham->update($data);
        return $sanPham->fresh(['danhMuc', 'thuongHieu']);
    }

    public function delete(SanPham $sanPham): void
    {
        $sanPham->delete();
    }
}
