<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Models\Banner;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $banners = Banner::where('trang_thai', true)
                        ->orderBy('thu_tu', 'asc')
                        ->get();
                        
        return ApiResponse::success($banners, 'Danh sách Banner');
    }
}
