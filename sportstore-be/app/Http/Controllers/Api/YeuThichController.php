<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Models\SanPham;
use App\Models\YeuThich;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class YeuThichController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $wishlist = YeuThich::where('nguoi_dung_id', $request->user()->id)
            ->with('sanPham.anhChinh')
            ->latest()
            ->paginate(20);

        return ApiResponse::paginate($wishlist, 'Danh sách yêu thích');
    }

    public function toggle(Request $request, int $productId): JsonResponse
    {
        $uid = $request->user()->id;
        $existing = YeuThich::where('nguoi_dung_id', $uid)->where('san_pham_id', $productId)->first();

        if ($existing) {
            $existing->delete();
            return ApiResponse::deleted('Đã xóa khỏi danh sách yêu thích');
        }

        YeuThich::create(['nguoi_dung_id' => $uid, 'san_pham_id' => $productId]);
        return ApiResponse::created(null, 'Đã thêm vào danh sách yêu thích');
    }
}
