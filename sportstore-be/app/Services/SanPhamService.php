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
            $danhMuc = $filters['danh_muc'];
            $cat = is_numeric($danhMuc) 
                ? \App\Models\DanhMuc::find($danhMuc)
                : \App\Models\DanhMuc::where('duong_dan', $danhMuc)->first();

            if ($cat) {
                // Gom ID của Cha và tất cả cá thể Con (Trực hệ 1 cấp)
                $catIds = [$cat->id];
                $childIds = \App\Models\DanhMuc::where('danh_muc_cha_id', $cat->id)->pluck('id')->toArray();
                if (!empty($childIds)) {
                    $catIds = array_merge($catIds, $childIds);
                }
                $query->whereIn('danh_muc_id', $catIds);
            } else {
                // Fallback nếu không tìm thấy Model DanhMuc trước khi Query
                if (is_numeric($danhMuc)) {
                    $query->where('danh_muc_id', $danhMuc);
                } else {
                    $query->whereHas('danhMuc', function ($q) use ($danhMuc) {
                        $q->where('duong_dan', $danhMuc);
                    });
                }
            }
        }

        // Lọc theo thương hiệu
        if (!empty($filters['thuong_hieu'])) {
            $thuongHieu = $filters['thuong_hieu'];
            if (is_numeric($thuongHieu)) {
                $query->where('thuong_hieu_id', $thuongHieu);
            } else {
                $query->whereHas('thuongHieu', function ($q) use ($thuongHieu) {
                    $q->where('duong_dan', $thuongHieu);
                });
            }
        }

        // Lọc theo giá (Sử dụng giá hiển thị: gia_khuyen_mai ?? gia_goc)
        if (isset($filters['gia_min']) && $filters['gia_min'] !== '') {
            $query->whereRaw('COALESCE(gia_khuyen_mai, gia_goc) >= ?', [$filters['gia_min']]);
        }
        if (isset($filters['gia_max']) && $filters['gia_max'] !== '') {
            $query->whereRaw('COALESCE(gia_khuyen_mai, gia_goc) <= ?', [$filters['gia_max']]);
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
            'gia_tang'    => $query->orderByRaw('COALESCE(gia_khuyen_mai, gia_goc) asc'),
            'gia_giam'    => $query->orderByRaw('COALESCE(gia_khuyen_mai, gia_goc) desc'),
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
    public function findBySlug(string $slug, $user = null): ?SanPham
    {
        $product = SanPham::with([
            'danhMuc',
            'thuongHieu',
            'hinhAnh',
            'bienThe' => fn($q) => $q->where('trang_thai', true),
            'danhGia' => fn($q) => $q->where('da_duyet', true)->with('nguoiDung')->latest()->take(10),
        ])->where('duong_dan', $slug)->where('trang_thai', true)->first();

        // Nếu không có user từ middleware, thử lấy từ token nếu có (đối với route public)
        if (!$user) {
            $user = auth('sanctum')->user();
        }

        if ($product && $user) {
            // Kiểm tra xem user đã mua SP này trong đơn hàng 'da_giao' chưa
            $orderItem = \App\Models\ChiTietDonHang::where('san_pham_id', $product->id)
                ->whereHas('donHang', function ($q) use ($user) {
                    $q->where('nguoi_dung_id', $user->id)
                        ->where('trang_thai', 'da_giao');
                })
                ->latest('id')
                ->first();

            // Kiểm tra xem đã đánh giá chưa
            $hasReviewed = \App\Models\DanhGia::where('san_pham_id', $product->id)
                ->where('nguoi_dung_id', $user->id)
                ->exists();

            $product->can_review = $orderItem && !$hasReviewed;
            $product->has_reviewed = $hasReviewed;
            $product->eligible_order_id = $orderItem ? $orderItem->don_hang_id : null;
        } else if ($product) {
            $product->can_review = false;
            $product->has_reviewed = false;
            $product->eligible_order_id = null;
        }

        return $product;
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
    public function adminIndex(array $filters = []): LengthAwarePaginator
    {
        $query = SanPham::with(['danhMuc', 'thuongHieu', 'anhChinh', 'hinhAnh', 'bienThe']);

        // Tìm kiếm theo tên hoặc SKU
        if (!empty($filters['tu_khoa'])) {
            $keyword = $filters['tu_khoa'];
            $query->where(function($q) use ($keyword) {
                $q->where('ten_san_pham', 'like', "%$keyword%")
                  ->orWhere('ma_sku', 'like', "%$keyword%");
            });
        }

        // Lọc theo danh mục
        if (!empty($filters['danh_muc_id'])) {
            $query->where('danh_muc_id', $filters['danh_muc_id']);
        }

        // Lọc theo thương hiệu
        if (!empty($filters['thuong_hieu_id'])) {
            $query->where('thuong_hieu_id', $filters['thuong_hieu_id']);
        }

        // Lọc theo trạng thái
        if (isset($filters['trang_thai']) && $filters['trang_thai'] !== '') {
            $query->where('trang_thai', (bool)$filters['trang_thai']);
        }

        // Lọc theo nổi bật
        if (isset($filters['noi_bat']) && $filters['noi_bat'] !== '') {
            $query->where('noi_bat', (bool)$filters['noi_bat']);
        }

        // Sắp xếp
        $sapXep = $filters['sap_xep'] ?? 'moi_nhat';
        match ($sapXep) {
            'gia_tang' => $query->orderByRaw('COALESCE(gia_khuyen_mai, gia_goc) asc'),
            'gia_giam' => $query->orderByRaw('COALESCE(gia_khuyen_mai, gia_goc) desc'),
            'ban_chay' => $query->orderBy('da_ban', 'desc'),
            'ton_kho'  => $query->orderBy('so_luong_ton_kho', 'asc'),
            default    => $query->latest(),
        };

        $perPage = (int) ($filters['per_page'] ?? 20);
        return $query->paginate($perPage);
    }

    public function generateUniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $slug = \Illuminate\Support\Str::slug($name);
        $originalSlug = $slug;
        $count = 1;

        while (SanPham::where('duong_dan', $slug)
            ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
            ->exists()
        ) {
            $slug = $originalSlug . '-' . $count++;
        }

        return $slug;
    }

    public function create(array $data): SanPham
    {
        return \DB::transaction(function () use ($data) {
            $bienThe = $data['bien_the'] ?? [];
            $hinhAnh = $data['hinh_anh'] ?? [];
            unset($data['bien_the'], $data['hinh_anh']);

            $product = SanPham::create($data);

            // Lưu biến thể
            foreach ($bienThe as $bt) {
                $product->bienThe()->create($bt);
            }

            // Lưu hình ảnh
            foreach ($hinhAnh as $ha) {
                $product->hinhAnh()->create($ha);
            }

            return $product->load(['danhMuc', 'thuongHieu', 'bienThe', 'hinhAnh']);
        });
    }

    public function update(SanPham $sanPham, array $data): SanPham
    {
        return \DB::transaction(function () use ($sanPham, $data) {
            $bienThe = $data['bien_the'] ?? null;
            $hinhAnh = $data['hinh_anh'] ?? null;
            unset($data['bien_the'], $data['hinh_anh']);

            $sanPham->update($data);

            // Cập nhật biến thể (Sync logic)
            if ($bienThe !== null) {
                $existingIds = $sanPham->bienThe()->pluck('id')->toArray();
                $newIds = [];

                foreach ($bienThe as $bt) {
                    if (isset($bt['id']) && in_array($bt['id'], $existingIds)) {
                        $sanPham->bienThe()->where('id', $bt['id'])->update($bt);
                        $newIds[] = $bt['id'];
                    } else {
                        $created = $sanPham->bienThe()->create($bt);
                        $newIds[] = $created->id;
                    }
                }

                // Xóa các biến thể không còn trong danh sách mới
                $toDelete = array_diff($existingIds, $newIds);
                if (!empty($toDelete)) {
                    $sanPham->bienThe()->whereIn('id', $toDelete)->delete();
                }
            }

            // Cập nhật hình ảnh
            if ($hinhAnh !== null) {
                $sanPham->hinhAnh()->delete();
                foreach ($hinhAnh as $ha) {
                    $sanPham->hinhAnh()->create($ha);
                }
            }

            return $sanPham->fresh(['danhMuc', 'thuongHieu', 'bienThe', 'hinhAnh']);
        });
    }

    public function delete(SanPham $sanPham): void
    {
        \DB::transaction(function () use ($sanPham) {
            $sanPham->bienThe()->delete();
            $sanPham->hinhAnh()->delete();
            $sanPham->delete();
        });
    }
}
