<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Services\SanPhamService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SanPhamController extends Controller
{
    public function __construct(private SanPhamService $service) {}

    public function index(Request $request): JsonResponse
    {
        $products = $this->service->index($request->all());

        // Ghi nhận hành vi xem danh sách (nếu có search)
        if ($request->filled('tu_khoa') && $request->user()) {
            // Không ghi ở đây, chỉ ghi ở show()
        }

        return ApiResponse::paginate($products, 'Danh sách sản phẩm');
    }

    public function show(Request $request, string $slug): JsonResponse
    {
        $product = $this->service->findBySlug($slug);

        if (!$product) {
            return ApiResponse::notFound('Sản phẩm không tồn tại hoặc đã ngừng bán');
        }

        // Tăng lượt xem + ghi hành vi
        $this->service->tangLuotXem($product);
        $this->service->ghiHanhVi(
            $product->id,
            'xem',
            $request->user()?->id,
            $request->header('X-Session-ID')
        );

        return ApiResponse::success($product, 'Chi tiết sản phẩm');
    }
}
