<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Models\DanhGia;
use App\Models\SanPham;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group 6. Quản trị viên (Admin)
 * @subgroup Quản lý Đánh giá
 * @authenticated
 */
class DanhGiaAdminController extends Controller
{
    /**
     * Danh sách đánh giá (Admin)
     *
     * @queryParam da_duyet boolean Lọc theo trạng thái duyệt (true/false). Example: false
     */
    public function index(Request $request): JsonResponse
    {
        if (!auth()->user()->hasPermission('duyet_danh_gia')) {
            return ApiResponse::error('Bạn không có quyền xem danh sách đánh giá.', 403);
        }

        $reviews = DanhGia::with('nguoiDung', 'sanPham')
            ->when($request->da_duyet !== null, fn ($q) => $q->where('da_duyet', $request->boolean('da_duyet')))
            ->latest()->paginate(20);
        return ApiResponse::paginate($reviews, '[Admin] Danh sách đánh giá');
    }

    /**
     * Duyệt đánh giá
     *
     * Admin xác nhận duyệt để đánh giá hiển thị công khai trên ứng dụng. Hệ thống tự tính lại sao trung bình của sản phẩm.
     * 
     * @urlParam id int required ID đánh giá. Example: 1
     */
    public function approve(int $id): JsonResponse
    {
        if (!auth()->user()->hasPermission('duyet_danh_gia')) {
            return ApiResponse::error('Bạn không có quyền duyệt đánh giá.', 403);
        }

        $review = DanhGia::findOrFail($id);
        $review->update(['da_duyet' => true]);

        // Tính lại điểm đánh giá sản phẩm
        $sanPham = $review->sanPham;
        $avg = DanhGia::where('san_pham_id', $sanPham->id)->where('da_duyet', true)->avg('so_sao') ?? 0;
        $count = DanhGia::where('san_pham_id', $sanPham->id)->where('da_duyet', true)->count();
        $sanPham->update(['diem_danh_gia' => round($avg, 2), 'so_luot_danh_gia' => $count]);

        return ApiResponse::success($review, '[Admin] Đã duyệt đánh giá');
    }

    /**
     * Xóa đánh giá
     */
    public function destroy(int $id): JsonResponse
    {
        if (!auth()->user()->hasPermission('duyet_danh_gia')) {
            return ApiResponse::error('Bạn không có quyền xóa đánh giá.', 403);
        }

        DanhGia::findOrFail($id)->delete();
        return ApiResponse::deleted('[Admin] Đã xóa đánh giá');
    }
}
