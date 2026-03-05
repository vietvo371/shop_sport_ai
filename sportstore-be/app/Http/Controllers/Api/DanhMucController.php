<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Models\DanhMuc;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DanhMucController extends Controller
{
    public function index(): JsonResponse
    {
        $categories = DanhMuc::with('danhMucCon')
            ->whereNull('danh_muc_cha_id')
            ->where('trang_thai', true)
            ->orderBy('thu_tu')
            ->get();

        return ApiResponse::success($categories, 'Danh sách danh mục');
    }

    public function show(string $slug): JsonResponse
    {
        $category = DanhMuc::with(['danhMucCon', 'sanPham' => fn ($q) => $q->where('trang_thai', true)->limit(12)])
            ->where('duong_dan', $slug)
            ->where('trang_thai', true)
            ->first();

        if (!$category) {
            return ApiResponse::notFound('Danh mục không tồn tại');
        }

        return ApiResponse::success($category, 'Chi tiết danh mục');
    }
}
