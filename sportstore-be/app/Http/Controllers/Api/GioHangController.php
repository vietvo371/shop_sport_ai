<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Services\GioHangService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group 3. Giỏ hàng & Thanh toán
 * @subgroup Quản lý Giỏ hàng
 *
 * Cho phép khách hàng thêm, sửa, xóa sản phẩm trong giỏ hàng.
 * Hỗ trợ cả khách vãng lai (lưu qua Header `X-Session-ID`) và người dùng đã đăng nhập (lưu qua User ID).
 */
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

    private function formatCartResponse($cart): array
    {
        if (!$cart) {
            return ['items' => [], 'tong_so_luong' => 0, 'tam_tinh' => 0];
        }
        return [
            'id'           => $cart->id,
            'items'        => $cart->items,
            'tong_so_luong'=> $cart->tong_so_luong,
            'tam_tinh'     => $cart->tam_tinh,
        ];
    }

    /**
     * Lấy thông tin giỏ hàng
     *
     * Lấy danh sách sản phẩm, tổng số lượng và số tiền tạm tính hiện có trong giỏ.
     * @header X-Session-ID ID phiên làm việc (nếu người dùng chưa đăng nhập)
     */
    public function show(Request $request): JsonResponse
    {
        ['nguoiDungId' => $uid, 'maPhien' => $sid] = $this->getCartSession($request);
        $cart = $this->service->getCart($uid, $sid);

        return ApiResponse::success($this->formatCartResponse($cart), 'Giỏ hàng');
    }

    /**
     * Thêm sản phẩm vào giỏ
     *
     * @header X-Session-ID ID phiên làm việc (nếu người dùng chưa đăng nhập)
     * @bodyParam san_pham_id int required ID của sản phẩm muốn thêm. Example: 1
     * @bodyParam bien_the_id int ID của biến thể (kích thước, màu sắc). Null nếu sản phẩm không có biến thể. Example: null
     * @bodyParam so_luong int required Số lượng muốn thêm (1-99). Example: 1
     */
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
        $this->service->addItem($cart, $data['san_pham_id'], $data['bien_the_id'] ?? null, $data['so_luong']);

        $cart = $this->service->getCart($uid, $sid);
        return ApiResponse::created($this->formatCartResponse($cart), 'Đã thêm vào giỏ hàng');
    }

    /**
     * Cập nhật số lượng sản phẩm
     *
     * @urlParam id int required ID của item trong giỏ hàng (không phải san_pham_id)
     * @header X-Session-ID ID phiên làm việc (nếu người dùng chưa đăng nhập)
     * @bodyParam so_luong int required Số lượng mới muốn cập nhật (1-99). Example: 2
     */
    public function updateItem(Request $request, int $id): JsonResponse
    {
        $data = $request->validate(['so_luong' => 'required|integer|min:1|max:99']);
        ['nguoiDungId' => $uid, 'maPhien' => $sid] = $this->getCartSession($request);
        $cart = $this->service->getOrCreate($uid, $sid);
        $this->service->updateItem($cart, $id, $data['so_luong']);

        $cart = $this->service->getCart($uid, $sid);
        return ApiResponse::success($this->formatCartResponse($cart), 'Đã cập nhật số lượng');
    }

    /**
     * Xóa sản phẩm khỏi giỏ
     *
     * @urlParam id int required ID của item trong giỏ hàng (không phải san_pham_id)
     * @header X-Session-ID ID phiên làm việc (nếu người dùng chưa đăng nhập)
     */
    public function removeItem(Request $request, int $id): JsonResponse
    {
        ['nguoiDungId' => $uid, 'maPhien' => $sid] = $this->getCartSession($request);
        $cart = $this->service->getOrCreate($uid, $sid);
        $this->service->removeItem($cart, $id);

        $cart = $this->service->getCart($uid, $sid);
        return ApiResponse::success($this->formatCartResponse($cart), 'Đã xóa sản phẩm khỏi giỏ hàng');
    }

    /**
     * Xóa toàn bộ giỏ hàng
     *
     * Dùng khi người dùng muốn dọn dẹp giỏ hoặc sau khi đặt hàng thành công.
     * @header X-Session-ID ID phiên làm việc (nếu người dùng chưa đăng nhập)
     */
    public function clear(Request $request): JsonResponse
    {
        ['nguoiDungId' => $uid, 'maPhien' => $sid] = $this->getCartSession($request);
        $cart = $this->service->getCart($uid, $sid);
        if ($cart) {
            $this->service->clear($cart);
        }
        return ApiResponse::deleted('Đã xóa toàn bộ giỏ hàng');
    }

    /**
     * Hợp nhất giỏ hàng Guest vào tài khoản sau khi đăng nhập.
     *
     * Khi user đăng nhập, client gửi danh sách sản phẩm đã thêm khi còn là guest.
     * Backend sẽ merge vào giỏ hàng hiện có của user (tăng số lượng nếu trùng).
     *
     * @authenticated
     * @bodyParam items array required Danh sách sản phẩm từ giỏ hàng guest.
     * @bodyParam items[].san_pham_id int required ID sản phẩm. Example: 1
     * @bodyParam items[].bien_the_id int ID biến thể. Example: null
     * @bodyParam items[].so_luong int required Số lượng. Example: 2
     */
    public function mergeGuestCart(Request $request): JsonResponse
    {
        $request->validate([
            'items'                => 'required|array|min:1',
            'items.*.san_pham_id'  => 'required|integer|exists:san_pham,id',
            'items.*.bien_the_id'  => 'nullable|integer|exists:bien_the_san_pham,id',
            'items.*.so_luong'     => 'required|integer|min:1|max:99',
        ]);

        $uid  = $request->user()->id;
        $cart = $this->service->getOrCreate($uid, null);

        foreach ($request->items as $item) {
            $this->service->addItem(
                $cart,
                $item['san_pham_id'],
                $item['bien_the_id'] ?? null,
                $item['so_luong']
            );
        }

        $cart = $this->service->getCart($uid, null);
        return ApiResponse::success($this->formatCartResponse($cart), 'Đã hợp nhất giỏ hàng khách vào tài khoản');
    }
}
