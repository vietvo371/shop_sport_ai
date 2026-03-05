<?php

namespace App\Services\AI;

use App\Models\PhienChatbot;
use App\Models\SanPham;
use App\Models\TinNhanChatbot;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

/**
 * ChatbotService — Proxy giữa Laravel và Gemini API.
 *
 * ⚠️ Toàn bộ giao tiếp với Gemini phải qua class này.
 * Controller TUYỆT ĐỐI KHÔNG gọi Gemini trực tiếp.
 */
class ChatbotService
{
    private string $apiKey;
    private string $apiUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent';

    public function __construct()
    {
        $this->apiKey = config('services.gemini.key', '');
    }

    /**
     * Gửi tin nhắn và nhận reply từ Gemini.
     *
     * @param string   $maPhien    ID phiên chat (tạo mới nếu chưa có)
     * @param string   $noiDung    Nội dung tin nhắn từ user
     * @param int|null $nguoiDungId
     * @return array{ phien: PhienChatbot, reply: string }
     */
    public function sendMessage(string $maPhien, string $noiDung, ?int $nguoiDungId = null): array
    {
        // Lấy hoặc tạo phiên
        $phien = PhienChatbot::firstOrCreate(
            ['ma_phien' => $maPhien],
            ['nguoi_dung_id' => $nguoiDungId]
        );

        // Lưu tin nhắn người dùng
        TinNhanChatbot::create([
            'phien_id' => $phien->id,
            'vai_tro'  => 'nguoi_dung',
            'noi_dung' => $noiDung,
        ]);

        // Lấy lịch sử để context (tối đa 10 tin nhắn gần nhất)
        $lichSu = $phien->tinNhan()->latest()->take(10)->get()->reverse()->values();

        // Build Gemini request
        $systemPrompt = $this->buildSystemPrompt($noiDung);
        $contents = $this->buildContents($lichSu, $systemPrompt);

        // Inject sản phẩm liên quan nếu user hỏi về sản phẩm
        $sanPhamContext = $this->searchRelevantProducts($noiDung);

        $response = Http::withHeaders(['Content-Type' => 'application/json'])
            ->post("{$this->apiUrl}?key={$this->apiKey}", [
                'contents'         => $contents,
                'systemInstruction'=> [
                    'parts' => [['text' => $systemPrompt . "\n\n" . $sanPhamContext]],
                ],
                'generationConfig' => [
                    'temperature'     => 0.7,
                    'maxOutputTokens' => 1024,
                ],
            ]);

        $reply = $response->json('candidates.0.content.parts.0.text')
            ?? 'Xin lỗi, tôi không thể trả lời lúc này. Vui lòng thử lại.';

        $soToken = $response->json('usageMetadata.totalTokenCount') ?? 0;

        // Lưu reply
        TinNhanChatbot::create([
            'phien_id' => $phien->id,
            'vai_tro'  => 'tro_ly',
            'noi_dung' => $reply,
            'so_token' => $soToken,
        ]);

        return ['phien' => $phien, 'reply' => $reply];
    }

    /**
     * Lịch sử phiên chat.
     */
    public function getHistory(string $maPhien): ?PhienChatbot
    {
        return PhienChatbot::with('tinNhan')->where('ma_phien', $maPhien)->first();
    }

    private function buildSystemPrompt(string $query): string
    {
        return <<<PROMPT
Bạn là trợ lý tư vấn mua sắm đồ thể thao của SportStore.
Nhiệm vụ của bạn là:
- Tư vấn sản phẩm thể thao phù hợp với nhu cầu khách hàng
- Trả lời bằng tiếng Việt, thân thiện và ngắn gọn
- Không nói về các chủ đề không liên quan đến thể thao và mua sắm
- Nếu khách hỏi về sản phẩm cụ thể, giới thiệu các sản phẩm liên quan từ catalog
PROMPT;
    }

    private function buildContents(iterable $lichSu, string $nodeSystem = ''): array
    {
        return $lichSu->map(fn ($msg) => [
            'role'  => $msg->vai_tro === 'nguoi_dung' ? 'user' : 'model',
            'parts' => [['text' => $msg->noi_dung]],
        ])->toArray();
    }

    private function searchRelevantProducts(string $query): string
    {
        // Tìm sản phẩm liên quan theo từ khóa
        $products = SanPham::where('ten_san_pham', 'like', "%{$query}%")
            ->where('trang_thai', true)
            ->take(3)
            ->get(['ten_san_pham', 'gia_goc', 'gia_khuyen_mai', 'duong_dan']);

        if ($products->isEmpty()) {
            return '';
        }

        $list = $products->map(fn ($p) => "- {$p->ten_san_pham}: " . number_format($p->gia_khuyen_mai ?? $p->gia_goc, 0, ',', '.') . 'đ')->join("\n");

        return "Sản phẩm liên quan trong kho:\n{$list}";
    }
}
