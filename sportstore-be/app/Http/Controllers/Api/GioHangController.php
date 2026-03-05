<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Services\GioHangService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GioHangController extends Controller
{
    public function __construct(private GioHangService $service) {}

    private function getCartSession(Request $request): array
    {
        return [
            'nguoiDungId' => $request->user()?->id,
            'maPhien'     => $request->header('X-Session-ID'),
        ];
    }

    public function show(Request $request): JsonResponse
    {
        ['nguoiDungId' => $uid, 'maPhien' => $sid] = $this->getCartSession($request);
        $cart = $this->service->getCart($uid, $sid);

        if (!$cart) {
            return ApiResponse::success(['items' => [], 'tong_so_luong' => 0, 'tam_tinh' => 0], 'Giỏ hàng trống');
        }

        return ApiResponse::success([
            'id'           => $cart->id,
            'items'        => $cart->items,
            'tong_so_luong'=> $cart->tong_so_luong,
            'tam_tinh'     => $cart->tam_tinh,
        ], 'Giỏ hàng');
    }

    public function addItem(Request $request): JsonResponse
    {
        $data = $request->validate([
            'san_pham_id' => 'required|integer|exists:san_pham,id',
            'bien_the_id' => 'nullable|integer|exists:bien_the_san_pham,id',
            'so_luong'    => 'required|integer|min:1|max:99',
        ], [
            'san_pham_id.required' => 'Vui lòng chọn sản phẩm.',
            'san_pham_id.exists'   => 'Sản phẩm không tồn tại.',
            'so_luong.required'    => 'Vui lòng nhập số lượng.',
        ]);

        ['nguoiDungId' => $uid, 'maPhien' => $sid] = $this->getCartSession($request);
        $cart = $this->service->getOrCreate($uid, $sid);
        $item = $this->service->addItem($cart, $data['san_pham_id'], $data['bien_the_id'] ?? null, $data['so_luong']);

        return ApiResponse::created($item->load('sanPham', 'bienThe'), 'Đã thêm vào giỏ hàng');
    }

    public function updateItem(Request $request, int $id): JsonResponse
    {
        $data = $request->validate(['so_luong' => 'required|integer|min:1|max:99']);
        ['nguoiDungId' => $uid, 'maPhien' => $sid] = $this->getCartSession($request);
        $cart = $this->service->getOrCreate($uid, $sid);
        $item = $this->service->updateItem($cart, $id, $data['so_luong']);

        return ApiResponse::success($item, 'Đã cập nhật số lượng');
    }

    public function removeItem(Request $request, int $id): JsonResponse
    {
        ['nguoiDungId' => $uid, 'maPhien' => $sid] = $this->getCartSession($request);
        $cart = $this->service->getOrCreate($uid, $sid);
        $this->service->removeItem($cart, $id);

        return ApiResponse::deleted('Đã xóa sản phẩm khỏi giỏ hàng');
    }

    public function clear(Request $request): JsonResponse
    {
        ['nguoiDungId' => $uid, 'maPhien' => $sid] = $this->getCartSession($request);
        $cart = $this->service->getCart($uid, $sid);
        if ($cart) {
            $this->service->clear($cart);
        }
        return ApiResponse::deleted('Đã xóa toàn bộ giỏ hàng');
    }
}
