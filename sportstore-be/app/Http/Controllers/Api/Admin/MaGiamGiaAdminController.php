<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Models\MaGiamGia;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group 6. Quản trị viên (Admin)
 * @subgroup Quản lý Mã giảm giá
 * @authenticated
 */
class MaGiamGiaAdminController extends Controller
{
    /**
     * Danh sách mã giảm giá (Admin)
     */
    public function index(Request $request): JsonResponse
    {
        if (!$request->user()->hasPermission('ma_giam_gia')) {
            return ApiResponse::error('Bạn không có quyền truy cập mã giảm giá.', 403);
        }
        $query = MaGiamGia::query();

        if ($request->has('search') && $request->search) {
            $query->where('ma_code', 'like', '%' . $request->search . '%');
        }

        $query->orderByDesc('created_at');

        return ApiResponse::paginate($query->paginate(20), '[Admin] Danh sách mã giảm giá');
    }

    /**
     * Cấp mã giảm giá mới
     *
     * @bodyParam ma_code string required Mã code duy nhất. Example: SUMMER25
     * @bodyParam loai_giam string required Loại giảm (phan_tram, so_tien_co_dinh). Example: phan_tram
     * @bodyParam gia_tri numeric required Mức giảm (%, VNĐ). Example: 10
     * @bodyParam gia_tri_don_hang_min numeric Đơn thiểu áp dụng. Example: 300000
     * @bodyParam gioi_han_su_dung int Tổng lượt dùng tối đa. Example: 100
     * @bodyParam bat_dau_luc date Thời gian khởi động. Example: 2025-06-01
     * @bodyParam het_han_luc date Thời gian kết thúc. Example: 2025-06-30
     */
    public function store(Request $request): JsonResponse
    {
        if (!$request->user()->hasPermission('ma_giam_gia')) {
            return ApiResponse::error('Bạn không có quyền tạo mã giảm giá.', 403);
        }
        $rules = [
            'ma_code'               => 'required|string|max:50|unique:ma_giam_gia',
            'loai_giam'             => 'required|in:phan_tram,so_tien_co_dinh',
            'gia_tri'               => 'required|numeric|min:0',
            'gia_tri_don_hang_min'  => 'nullable|numeric|min:0',
            'gioi_han_su_dung'      => 'nullable|integer|min:1',
            'bat_dau_luc'           => 'nullable|date',
            'het_han_luc'           => 'nullable|date|after:bat_dau_luc',
        ];

        $messages = [
            'ma_code.required' => 'Vui lòng nhập mã giảm giá.',
            'ma_code.unique' => 'Mã giảm giá này đã tồn tại, vui lòng chọn mã khác.',
            'ma_code.max' => 'Mã giảm giá không được vượt quá 50 ký tự.',
            'loai_giam.required' => 'Vui lòng chọn loại giảm giá.',
            'gia_tri.required' => 'Vui lòng nhập giá trị giảm.',
            'gia_tri.min' => 'Giá trị giảm không được âm.',
            'gia_tri_don_hang_min.min' => 'Giá trị đơn hàng tối thiểu không được âm.',
            'gioi_han_su_dung.min' => 'Giới hạn sử dụng phải từ 1 trở lên.',
            'het_han_luc.after' => 'Thời gian kết thúc phải sau thời gian bắt đầu.',
        ];

        $data = $request->validate($rules, $messages);
        return ApiResponse::created(MaGiamGia::create($data), '[Admin] Tạo mã giảm giá thành công');
    }
    public function show(int $id): JsonResponse { 
        if (!auth()->user()->hasPermission('ma_giam_gia')) return ApiResponse::error('Bạn không có quyền xem mã giảm giá.', 403);
        return ApiResponse::success(MaGiamGia::findOrFail($id), '[Admin] Chi tiết mã giảm giá'); 
    }
    public function update(Request $request, int $id): JsonResponse
    {
        if (!$request->user()->hasPermission('ma_giam_gia')) {
            return ApiResponse::error('Bạn không có quyền cập nhật mã giảm giá.', 403);
        }
        $coupon = MaGiamGia::findOrFail($id);
        
        $rules = [
            'ma_code'               => 'sometimes|string|max:50|unique:ma_giam_gia,ma_code,' . $id,
            'loai_giam'             => 'sometimes|in:phan_tram,so_tien_co_dinh',
            'gia_tri'               => 'sometimes|numeric|min:0',
            'gia_tri_don_hang_min'  => 'nullable|numeric|min:0',
            'gioi_han_su_dung'      => 'nullable|integer|min:1',
            'bat_dau_luc'           => 'nullable|date',
            'het_han_luc'           => 'nullable|date|after_or_equal:bat_dau_luc',
            'trang_thai'            => 'nullable|boolean',
        ];

        $messages = [
            'ma_code.unique' => 'Mã giảm giá này đã tồn tại, vui lòng chọn mã khác.',
            'ma_code.max' => 'Mã giảm giá không được vượt quá 50 ký tự.',
            'gia_tri.min' => 'Giá trị giảm không được âm.',
            'gia_tri_don_hang_min.min' => 'Giá trị đơn hàng tối thiểu không được âm.',
            'gioi_han_su_dung.min' => 'Giới hạn sử dụng phải từ 1 trở lên.',
            'het_han_luc.after_or_equal' => 'Thời gian kết thúc phải sau thời gian bắt đầu.',
        ];
        
        $data = $request->validate($rules, $messages);
        
        $coupon->update($data);
        return ApiResponse::success($coupon, '[Admin] Cập nhật mã giảm giá');
    }
    public function destroy(int $id): JsonResponse { 
        if (!auth()->user()->hasPermission('ma_giam_gia')) return ApiResponse::error('Bạn không có quyền xóa mã giảm giá.', 403);
        MaGiamGia::findOrFail($id)->delete(); 
        return ApiResponse::deleted('[Admin] Đã xóa mã giảm giá'); 
    }
}
