<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;

/**
 * @group 6. Quản trị viên (Admin)
 * @subgroup Quản lý Banner
 * @authenticated
 */
class BannerAdminController extends Controller
{
    /**
     * Danh sách Banner
     *
     * @queryParam search string Tìm kiếm theo tiêu đề.
     * @queryParam trang_thai integer Lọc theo trạng thái (1: Hiện, 0: Ẩn).
     * @queryParam per_page integer Số lượng item trên 1 trang. Default: 10
     */
    public function index(Request $request): JsonResponse
    {
        if (!$request->user()->hasPermission('quan_ly_banner')) {
            return ApiResponse::error('Bạn không có quyền xem banner.', 403);
        }
        $query = Banner::query();

        if ($request->has('search')) {
            $query->where('tieu_de', 'like', '%' . $request->search . '%');
        }

        if ($request->has('trang_thai')) {
            $query->where('trang_thai', $request->trang_thai);
        }

        $banners = $query->orderBy('thu_tu', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate($request->get('per_page', 10));

        return ApiResponse::paginate($banners, 'Lấy danh sách banner thành công');
    }

    /**
     * Thêm mới Banner
     *
     * @bodyParam tieu_de string required Tiêu đề banner.
     * @bodyParam hinh_anh string required Đường dẫn ảnh banner (Upload qua API /admin/upload).
     * @bodyParam duong_dan string Đường dẫn khi click vào banner.
     * @bodyParam thu_tu integer Thứ tự hiển thị.
     * @bodyParam trang_thai integer Trạng thái (1: Hiện, 0: Ẩn). Default: 1.
     */
    public function store(Request $request): JsonResponse
    {
        if (!$request->user()->hasPermission('quan_ly_banner')) {
            return ApiResponse::error('Bạn không có quyền thêm banner.', 403);
        }
        $validated = $request->validate([
            'tieu_de'    => 'required|string|max:255',
            'hinh_anh'   => 'required|string',
            'duong_dan'  => 'nullable|string|max:255',
            'thu_tu'     => 'nullable|integer',
            'trang_thai' => 'nullable|boolean',
        ], [
            'tieu_de.required'  => 'Vui lòng nhập tiêu đề banner.',
            'hinh_anh.required' => 'Vui lòng upload hình ảnh banner.',
        ]);

        $banner = Banner::create($validated);

        return ApiResponse::success($banner, 'Tạo banner thành công', 201);
    }

    /**
     * Chi tiết Banner
     */
    public function show(string $id): JsonResponse
    {
        if (!auth()->user()->hasPermission('quan_ly_banner')) {
            return ApiResponse::error('Bạn không có quyền xem chi tiết banner.', 403);
        }
        $banner = Banner::find($id);

        if (!$banner) {
            return ApiResponse::error('Không tìm thấy banner', 404);
        }

        return ApiResponse::success($banner, 'Lấy thông tin banner thành công');
    }

    /**
     * Cập nhật Banner
     */
    public function update(Request $request, string $id): JsonResponse
    {
        if (!$request->user()->hasPermission('quan_ly_banner')) {
            return ApiResponse::error('Bạn không có quyền cập nhật banner.', 403);
        }
        $banner = Banner::find($id);

        if (!$banner) {
            return ApiResponse::error('Không tìm thấy banner', 404);
        }

        $validated = $request->validate([
            'tieu_de'    => 'required|string|max:255',
            'hinh_anh'   => 'required|string',
            'duong_dan'  => 'nullable|string|max:255',
            'thu_tu'     => 'nullable|integer',
            'trang_thai' => 'nullable|boolean',
        ], [
            'tieu_de.required'  => 'Vui lòng nhập tiêu đề banner.',
            'hinh_anh.required' => 'Vui lòng cung cấp đường dẫn hình ảnh.',
        ]);

        $banner->update($validated);

        return ApiResponse::success($banner, 'Cập nhật banner thành công');
    }

    /**
     * Xóa Banner
     */
    public function destroy(string $id): JsonResponse
    {
        if (!auth()->user()->hasPermission('quan_ly_banner')) {
            return ApiResponse::error('Bạn không có quyền xóa banner.', 403);
        }
        $banner = Banner::find($id);

        if (!$banner) {
            return ApiResponse::error('Không tìm thấy banner', 404);
        }

        $banner->delete();

        return ApiResponse::success(null, 'Xóa banner thành công');
    }

    /**
     * Bật/tắt trạng thái hiển thị
     */
    public function toggleStatus(string $id): JsonResponse
    {
        if (!auth()->user()->hasPermission('quan_ly_banner')) {
            return ApiResponse::error('Bạn không có quyền thay đổi trạng thái banner.', 403);
        }
        $banner = Banner::find($id);

        if (!$banner) {
            return ApiResponse::error('Không tìm thấy banner', 404);
        }

        $banner->trang_thai = !$banner->trang_thai;
        $banner->save();

        return ApiResponse::success([
            'id' => $banner->id,
            'trang_thai' => $banner->trang_thai
        ], 'Cập nhật trạng thái thành công');
    }
}
