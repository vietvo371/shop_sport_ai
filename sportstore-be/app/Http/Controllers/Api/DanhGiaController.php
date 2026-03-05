<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Models\DanhGia;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DanhGiaController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'san_pham_id' => 'required|integer|exists:san_pham,id',
            'don_hang_id' => 'nullable|integer|exists:don_hang,id',
            'so_sao'      => 'required|integer|min:1|max:5',
            'tieu_de'     => 'nullable|string|max:200',
            'noi_dung'    => 'nullable|string|max:1000',
        ]);

        $existing = DanhGia::where('san_pham_id', $data['san_pham_id'])
            ->where('nguoi_dung_id', $request->user()->id)
            ->exists();

        if ($existing) {
            return ApiResponse::error('Bạn đã đánh giá sản phẩm này rồi', 422);
        }

        $review = DanhGia::create([...$data, 'nguoi_dung_id' => $request->user()->id, 'da_duyet' => false]);
        return ApiResponse::created($review, 'Đánh giá đã gửi, đang chờ duyệt');
    }

    public function show(int $id): JsonResponse
    {
        $review = DanhGia::with('nguoiDung', 'hinhAnh')->findOrFail($id);
        return ApiResponse::success($review, 'Chi tiết đánh giá');
    }
}
