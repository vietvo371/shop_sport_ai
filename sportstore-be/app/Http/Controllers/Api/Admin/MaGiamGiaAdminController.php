<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Models\MaGiamGia;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MaGiamGiaAdminController extends Controller
{
    public function index(): JsonResponse
    {
        return ApiResponse::paginate(MaGiamGia::latest()->paginate(20), '[Admin] Danh sách mã giảm giá');
    }
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'ma_code'               => 'required|string|max:50|unique:ma_giam_gia',
            'loai_giam'             => 'required|in:phan_tram,so_tien_co_dinh',
            'gia_tri'               => 'required|numeric|min:0',
            'gia_tri_don_hang_min'  => 'nullable|numeric|min:0',
            'gioi_han_su_dung'      => 'nullable|integer|min:1',
            'bat_dau_luc'           => 'nullable|date',
            'het_han_luc'           => 'nullable|date|after:bat_dau_luc',
        ]);
        return ApiResponse::created(MaGiamGia::create($data), '[Admin] Tạo mã giảm giá thành công');
    }
    public function show(int $id): JsonResponse { return ApiResponse::success(MaGiamGia::findOrFail($id), '[Admin] Chi tiết mã giảm giá'); }
    public function update(Request $request, int $id): JsonResponse
    {
        $coupon = MaGiamGia::findOrFail($id);
        $coupon->update($request->validate(['trang_thai' => 'boolean', 'het_han_luc' => 'nullable|date']));
        return ApiResponse::success($coupon, '[Admin] Cập nhật mã giảm giá');
    }
    public function destroy(int $id): JsonResponse { MaGiamGia::findOrFail($id)->delete(); return ApiResponse::deleted('[Admin] Đã xóa mã giảm giá'); }
}
