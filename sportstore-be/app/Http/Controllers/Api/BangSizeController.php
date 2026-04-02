<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Models\BangSize;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group 2. Sản phẩm & Danh mục (Khách hàng)
 * @subgroup Bảng Size
 *
 * API tra cứu bảng size để hỗ trợ khách hàng chọn kích cỡ sản phẩm.
 */
class BangSizeController extends Controller
{
    /**
     * Tra cứu bảng size
     *
     * Trả về danh sách quy tắc size dựa trên thương hiệu và loại sản phẩm.
     * 
     * @queryParam loai string required Loại sản phẩm: `ao`, `quan`, `giay`. Example: ao
     * @queryParam thuong_hieu_id int ID thương hiệu (nếu có quy tắc riêng). Example: 1
     */
    public function index(Request $request): JsonResponse
    {
        $request->validate([
            'loai' => 'required|in:ao,quan,giay',
            'thuong_hieu_id' => 'nullable|integer'
        ]);

        $loai = $request->input('loai');
        $brandId = $request->input('thuong_hieu_id');

        $query = BangSize::where('loai', $loai);

        if ($brandId) {
            // Thử tìm quy tắc của riêng thương hiệu đó trước
            $hasBrandRules = (clone $query)->where('thuong_hieu_id', $brandId)->exists();
            if ($hasBrandRules) {
                $query->where('thuong_hieu_id', $brandId);
            } else {
                // Nếu thương hiệu không có quy tắc riêng, dùng quy tắc chung (null)
                $query->whereNull('thuong_hieu_id');
            }
        } else {
            $query->whereNull('thuong_hieu_id');
        }

        $sizeCharts = $query->orderBy('chieu_cao_min', 'asc')
                           ->orderBy('chieu_dai_chan_min', 'asc')
                           ->get();

        return ApiResponse::success($sizeCharts, 'Bảng size cho ' . $loai);
    }
}
