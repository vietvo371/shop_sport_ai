<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Models\DiaChi;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DiaChiController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        return ApiResponse::success($request->user()->diaChi, 'Danh sách địa chỉ');
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'ho_va_ten'       => 'required|string|max:100',
            'so_dien_thoai'   => 'required|string|max:20',
            'tinh_thanh'      => 'required|string|max:100',
            'quan_huyen'      => 'required|string|max:100',
            'phuong_xa'       => 'required|string|max:100',
            'dia_chi_cu_the'  => 'required|string|max:255',
            'la_mac_dinh'     => 'boolean',
        ]);

        $uid = $request->user()->id;
        if (!empty($data['la_mac_dinh'])) {
            DiaChi::where('nguoi_dung_id', $uid)->update(['la_mac_dinh' => false]);
        }

        $address = DiaChi::create(['nguoi_dung_id' => $uid, ...$data]);
        return ApiResponse::created($address, 'Đã thêm địa chỉ');
    }

    public function show(Request $request, int $id): JsonResponse
    {
        $address = DiaChi::where('nguoi_dung_id', $request->user()->id)->findOrFail($id);
        return ApiResponse::success($address, 'Chi tiết địa chỉ');
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $address = DiaChi::where('nguoi_dung_id', $request->user()->id)->findOrFail($id);
        $data = $request->validate([
            'ho_va_ten'      => 'sometimes|string|max:100',
            'so_dien_thoai'  => 'sometimes|string|max:20',
            'tinh_thanh'     => 'sometimes|string|max:100',
            'quan_huyen'     => 'sometimes|string|max:100',
            'phuong_xa'      => 'sometimes|string|max:100',
            'dia_chi_cu_the' => 'sometimes|string|max:255',
            'la_mac_dinh'    => 'boolean',
        ]);
        if (!empty($data['la_mac_dinh'])) {
            DiaChi::where('nguoi_dung_id', $request->user()->id)->update(['la_mac_dinh' => false]);
        }
        $address->update($data);
        return ApiResponse::success($address, 'Đã cập nhật địa chỉ');
    }

    public function destroy(Request $request, int $id): JsonResponse
    {
        DiaChi::where('nguoi_dung_id', $request->user()->id)->findOrFail($id)->delete();
        return ApiResponse::deleted('Đã xóa địa chỉ');
    }
}
