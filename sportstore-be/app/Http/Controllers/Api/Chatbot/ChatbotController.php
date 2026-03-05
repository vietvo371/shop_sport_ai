<?php

namespace App\Http\Controllers\Api\Chatbot;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Services\AI\ChatbotService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChatbotController extends Controller
{
    public function __construct(private ChatbotService $service) {}

    public function sendMessage(Request $request): JsonResponse
    {
        $data = $request->validate([
            'noi_dung' => 'required|string|max:2000',
            'ma_phien' => 'nullable|string|max:100',
        ], [
            'noi_dung.required' => 'Vui lòng nhập tin nhắn.',
            'noi_dung.max'      => 'Tin nhắn không quá 2000 ký tự.',
        ]);

        $maPhien = $data['ma_phien'] ?? Str::uuid()->toString();

        $result = $this->service->sendMessage(
            maPhien: $maPhien,
            noiDung: $data['noi_dung'],
            nguoiDungId: $request->user()?->id,
        );

        return ApiResponse::success([
            'ma_phien' => $maPhien,
            'reply'    => $result['reply'],
        ], 'Nhận trả lời thành công');
    }

    public function history(Request $request): JsonResponse
    {
        $maPhien = $request->query('ma_phien');

        if (!$maPhien) {
            return ApiResponse::error('Thiếu mã phiên', 400);
        }

        $phien = $this->service->getHistory($maPhien);

        if (!$phien) {
            return ApiResponse::success(['messages' => []], 'Chưa có lịch sử');
        }

        return ApiResponse::success([
            'ma_phien' => $phien->ma_phien,
            'messages' => $phien->tinNhan,
        ], 'Lịch sử hội thoại');
    }
}
