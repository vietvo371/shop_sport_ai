<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Models\BangSize;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/**
 * @group 12. Quản lý Bảng Size
 * @subgroup Cấu hình Chatbot & Tư vấn
 *
 * API dành cho Admin để quản lý các quy tắc chọn size sản phẩm.
 */
class BangSizeAdminController extends Controller
{
    /**
     * Danh sách Bảng Size
     * 
     * Lấy danh sách toàn bộ các quy tắc size trong hệ thống.
     * 
     * @queryParam loai string Lọc theo loại (ao, quan, giay). Example: ao
     * @queryParam thuong_hieu_id int Lọc theo thương hiệu. Example: 1
     */
    public function index(Request $request): JsonResponse
    {
        $query = BangSize::with('thuongHieu');

        if ($request->has('loai')) {
            $query->where('loai', $request->loai);
        }

        if ($request->has('thuong_hieu_id')) {
            $query->where('thuong_hieu_id', $request->thuong_hieu_id);
        }

        $items = $query->latest()->get();
        return ApiResponse::success($items, 'Lấy danh sách bảng size thành công');
    }

    /**
     * Thêm mới Quy tắc Size
     * 
     * Tạo một quy tắc quy đổi size mới.
     * 
     * @bodyParam thuong_hieu_id int ID thương hiệu (null nếu dùng chung). Example: 1
     * @bodyParam loai string required Loại đồ thể thao (ao, quan, giay). Example: ao
     * @bodyParam ten_size string required Tên size hiển thị. Example: XL
     * @bodyParam chieu_cao_min number Chiều cao tối thiểu (cm). Example: 175
     * @bodyParam chieu_cao_max number Chiều cao tối đa (cm). Example: 185
     * @bodyParam can_nang_min number Cân nặng tối thiểu (kg). Example: 70
     * @bodyParam can_nang_max number Cân nặng tối đa (kg). Example: 80
     * @bodyParam chieu_dai_chan_min number Độ dài chân tối thiểu (mm) cho Giày. Example: 255
     * @bodyParam chieu_dai_chan_max number Độ dài chân tối đa (mm) cho Giày. Example: 265
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'thuong_hieu_id'     => 'nullable|exists:thuong_hieu,id',
            'loai'                => ['required', Rule::in(['ao', 'quan', 'giay'])],
            'ten_size'            => 'required|string|max:50',
            'chieu_cao_min'       => 'nullable|numeric|min:0',
            'chieu_cao_max'       => 'nullable|numeric|gte:chieu_cao_min',
            'can_nang_min'        => 'nullable|numeric|min:0',
            'can_nang_max'        => 'nullable|numeric|gte:can_nang_min',
            'chieu_dai_chan_min'  => 'nullable|numeric|min:0',
            'chieu_dai_chan_max'  => 'nullable|numeric|gte:chieu_dai_chan_min',
            'mo_ta'               => 'nullable|string',
        ]);

        $item = BangSize::create($data);
        return ApiResponse::success($item, 'Thêm quy tắc size thành công', 201);
    }

    /**
     * Cập nhật Quy tắc Size
     * 
     * Thay đổi thông số của một quy tắc size hiện có.
     */
    public function update(Request $request, $id): JsonResponse
    {
        $item = BangSize::findOrFail($id);

        $data = $request->validate([
            'thuong_hieu_id'     => 'nullable|exists:thuong_hieu,id',
            'loai'                => ['sometimes', 'required', Rule::in(['ao', 'quan', 'giay'])],
            'ten_size'            => 'sometimes|required|string|max:50',
            'chieu_cao_min'       => 'nullable|numeric|min:0',
            'chieu_cao_max'       => 'nullable|numeric|gte:chieu_cao_min',
            'can_nang_min'        => 'nullable|numeric|min:0',
            'can_nang_max'        => 'nullable|numeric|gte:can_nang_min',
            'chieu_dai_chan_min'  => 'nullable|numeric|min:0',
            'chieu_dai_chan_max'  => 'nullable|numeric|gte:chieu_dai_chan_min',
            'mo_ta'               => 'nullable|string',
        ]);

        $item->update($data);
        return ApiResponse::success($item, 'Cập nhật quy tắc size thành công');
    }

    /**
     * Xóa Quy tắc Size
     * 
     * Gỡ bỏ một quy tắc size khỏi hệ thống.
     */
    public function destroy($id): JsonResponse
    {
        $item = BangSize::findOrFail($id);
        $item->delete();
        return ApiResponse::success(null, 'Xóa quy tắc size thành công');
    }
}
