<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Models\ThuongHieu;
use Illuminate\Http\JsonResponse;

class ThuongHieuController extends Controller
{
    public function index(): JsonResponse
    {
        $brands = ThuongHieu::where('trang_thai', true)
            ->orderBy('ten')
            ->get(['id', 'ten', 'duong_dan', 'logo']);

        return ApiResponse::success($brands, 'Danh sách thương hiệu');
    }
}
