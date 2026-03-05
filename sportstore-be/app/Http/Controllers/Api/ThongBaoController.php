<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Models\ThongBao;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ThongBaoController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $notifications = ThongBao::where('nguoi_dung_id', $request->user()->id)
            ->latest('created_at')->paginate(20);
        return ApiResponse::paginate($notifications, 'Danh sách thông báo');
    }

    public function markRead(Request $request, int $id): JsonResponse
    {
        ThongBao::where('nguoi_dung_id', $request->user()->id)
            ->findOrFail($id)->update(['da_doc_luc' => now()]);
        return ApiResponse::success(null, 'Đã đánh dấu đã đọc');
    }

    public function markAllRead(Request $request): JsonResponse
    {
        ThongBao::where('nguoi_dung_id', $request->user()->id)
            ->whereNull('da_doc_luc')->update(['da_doc_luc' => now()]);
        return ApiResponse::success(null, 'Đã đọc tất cả thông báo');
    }
}
