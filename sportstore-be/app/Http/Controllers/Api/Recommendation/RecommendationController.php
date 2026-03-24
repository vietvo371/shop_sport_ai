<?php

namespace App\Http\Controllers\Api\Recommendation;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Models\HanhViNguoiDung;
use App\Models\SanPham;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RecommendationController extends Controller
{
    /**
     * Lấy gợi ý sản phẩm từ Python AI service hoặc trả fallback.
     */
    public function index(Request $request): JsonResponse
    {
        // Sử dụng auth('sanctum') thay vì $request->user() để hỗ trợ Auth tùy chọn cho public middleware
        $user = auth('sanctum')->user();
        $aiUrl = config('services.ai_service.url');

        try {
            $endpoint = $user
                ? "{$aiUrl}/api/v1/recommend/user/{$user->id}"
                : "{$aiUrl}/api/v1/recommend/popular";

            $response = Http::timeout(3)->get($endpoint);

            if ($response->successful()) {
                $ids = $response->json('data', []);
                $products = SanPham::with(['anhChinh', 'danhMuc'])
                    ->whereIn('id', $ids)
                    ->where('trang_thai', true)
                    ->get();
                return ApiResponse::success($products, 'Gợi ý sản phẩm');
            }
        } catch (\Throwable $e) {
            // AI service không khả dụng → fallback
        }

        // Fallback: trả sản phẩm bán chạy
        $fallback = SanPham::with(['anhChinh', 'danhMuc'])
            ->where('trang_thai', true)
            ->orderBy('da_ban', 'desc')
            ->take(8)
            ->get();

        return ApiResponse::success($fallback, 'Sản phẩm phổ biến');
    }

    /**
     * Lấy sản phẩm tương tự (cho trang chi tiết sản phẩm).
     */
    public function relatedProducts(int $productId): JsonResponse
    {
        $aiUrl = config('services.ai_service.url');

        try {
            $response = Http::timeout(3)->get("{$aiUrl}/api/v1/recommend/item/{$productId}");

            if ($response->successful()) {
                $ids = $response->json('data', []);
                $products = SanPham::with(['anhChinh', 'danhMuc'])
                    ->whereIn('id', $ids)
                    ->where('trang_thai', true)
                    ->get();
                return ApiResponse::success($products, 'Sản phẩm tương tự');
            }
        } catch (\Throwable $e) {
            // AI service không khả dụng → fallback
        }

        // Fallback: sản phẩm cùng danh mục hoặc thương hiệu
        $product = SanPham::find($productId);
        if (!$product) {
            return ApiResponse::success([], 'Không tìm thấy sản phẩm gốc');
        }

        $fallback = SanPham::with(['anhChinh', 'danhMuc'])
            ->where('trang_thai', true)
            ->where('id', '!=', $productId)
            ->where(function ($q) use ($product) {
                $q->where('danh_muc_id', $product->danh_muc_id)
                  ->orWhere('thuong_hieu_id', $product->thuong_hieu_id);
            })
            ->orderBy('da_ban', 'desc')
            ->take(12)
            ->get();

        return ApiResponse::success($fallback, 'Sản phẩm liên quan');
    }

    /**
     * Ghi nhận hành vi người dùng cho ML.
     */
    public function recordBehavior(Request $request): JsonResponse
    {
        $data = $request->validate([
            'san_pham_id'   => 'required|integer|exists:san_pham,id',
            'hanh_vi'       => 'required|in:xem,click,them_gio_hang,mua_hang,yeu_thich',
            'thoi_gian_xem_s' => 'nullable|integer|min:0',
        ]);

        $user = auth('sanctum')->user();

        HanhViNguoiDung::create([
            'nguoi_dung_id'   => $user?->id,
            'ma_phien'        => $request->header('X-Session-ID'),
            'san_pham_id'     => $data['san_pham_id'],
            'hanh_vi'         => $data['hanh_vi'],
            'thoi_gian_xem_s' => $data['thoi_gian_xem_s'] ?? null,
        ]);

        return ApiResponse::success(null, 'Đã ghi nhận hành vi');
    }
}
