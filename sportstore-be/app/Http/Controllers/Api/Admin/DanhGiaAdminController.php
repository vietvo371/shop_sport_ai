<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Models\DanhGia;
use App\Models\SanPham;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DanhGiaAdminController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $reviews = DanhGia::with('nguoiDung', 'sanPham')
            ->when($request->da_duyet !== null, fn ($q) => $q->where('da_duyet', $request->boolean('da_duyet')))
            ->latest()->paginate(20);
        return ApiResponse::paginate($reviews, '[Admin] Danh sách đánh giá');
    }

    public function approve(int $id): JsonResponse
    {
        $review = DanhGia::findOrFail($id);
        $review->update(['da_duyet' => true]);

        // Tính lại điểm đánh giá sản phẩm
        $sanPham = $review->sanPham;
        $avg = DanhGia::where('san_pham_id', $sanPham->id)->where('da_duyet', true)->avg('so_sao') ?? 0;
        $count = DanhGia::where('san_pham_id', $sanPham->id)->where('da_duyet', true)->count();
        $sanPham->update(['diem_danh_gia' => round($avg, 2), 'so_luot_danh_gia' => $count]);

        return ApiResponse::success($review, '[Admin] Đã duyệt đánh giá');
    }

    public function destroy(int $id): JsonResponse
    {
        DanhGia::findOrFail($id)->delete();
        return ApiResponse::deleted('[Admin] Đã xóa đánh giá');
    }
}
