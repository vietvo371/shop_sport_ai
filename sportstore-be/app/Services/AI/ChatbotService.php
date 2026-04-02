<?php

namespace App\Services\AI;

use App\Models\BangSize;
use App\Models\PhienChatbot;
use App\Models\SanPham;
use App\Models\TinNhanChatbot;
use App\Models\ThuongHieu;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

/**
 * ChatbotService — Chatbot AI thông minh cho SportStore.
 *
 * Flow hội thoại:
 *  1. Greeting  → Chào lại, không gợi sản phẩm.
 *  2. Giày      → Hỏi độ dài chân nếu chưa có.
 *  3. Áo/Quần  → Hỏi chiều cao/cân nặng nếu chưa có.
 *  4. Đủ info   → Tra bảng size → Gợi ý sản phẩm qua AI.
 */
class ChatbotService
{
    private string $apiKey;
    private string $model;
    private string $apiUrl = 'https://api.groq.com/openai/v1/chat/completions';

    /** Intent constants */
    private const INTENT_GREETING  = 'greeting';
    private const INTENT_SHOES     = 'shoes';
    private const INTENT_CLOTHING  = 'clothing';
    private const INTENT_SIZE_ONLY = 'size_only'; // Chỉ có số liệu, chưa rõ loại SP
    private const INTENT_GENERAL   = 'general';

    public function __construct()
    {
        $this->apiKey = config('services.groq.key', '');
        $this->model  = config('services.groq.model', 'llama-3.3-70b-versatile');
    }

    // ─────────────────────────────────────────────────────────────
    // PUBLIC API
    // ─────────────────────────────────────────────────────────────

    public function getHistory(string $maPhien): ?PhienChatbot
    {
        return PhienChatbot::where('ma_phien', $maPhien)->first();
    }

    public function sendMessage(string $maPhien, string $noiDung, ?int $nguoiDungId = null): array
    {
        // 1. Tìm hoặc tạo phiên
        $phien = PhienChatbot::where('ma_phien', $maPhien)->first() ?? PhienChatbot::create([
            'ma_phien'      => $maPhien,
            'nguoi_dung_id' => $nguoiDungId,
            'bat_dau_luc'   => now(),
        ]);

        if (!$phien->nguoi_dung_id && $nguoiDungId) {
            $phien->update(['nguoi_dung_id' => $nguoiDungId]);
        }

        // 2. Lưu tin nhắn vào DB
        TinNhanChatbot::create([
            'phien_id' => $phien->id,
            'vai_tro'  => 'nguoi_dung',
            'noi_dung' => $noiDung,
        ]);

        // 3. Lấy lịch sử (chỉ lấy tin nhắn người dùng để phân tích)
        $lichSu = $phien->tinNhan()->latest()->take(10)->get()->reverse()->values();

        // 4. Nhận diện Intent từ tin nhắn hiện tại + lịch sử
        $intent = $this->detectIntent($noiDung, $lichSu);

        // 5. Gộp số liệu cơ thể từ TOÀN BỘ lịch sử chat + tin nhắn hiện tại
        $measurements = $this->extractMeasurementsFromHistory($lichSu);

        // 6. Kiểm tra còn thiếu thông tin không?
        $missingQuestion = $this->getMissingInfo($intent, $measurements, $lichSu);

        if ($missingQuestion !== null) {
            // Thiếu info → Bot hỏi lại, không gọi AI
            TinNhanChatbot::create([
                'phien_id' => $phien->id,
                'vai_tro'  => 'tro_ly',
                'noi_dung' => $missingQuestion,
                'so_token' => 0,
            ]);
            return ['phien' => $phien, 'reply' => $missingQuestion];
        }

        // 7. Đủ thông tin → Tra bảng size và tìm sản phẩm
        $brandId     = $this->detectBrand($noiDung);
        $sizeAdvice  = $this->getSizeAdvice($measurements, $brandId, $intent);
        $productCtx  = $this->searchRelevantProducts($noiDung, $intent, $sizeAdvice, $brandId);

        // 8. Xây dựng Prompt và gọi AI
        $systemPrompt = $this->buildSystemPrompt($sizeAdvice);
        $messages     = $this->buildMessages($lichSu, $systemPrompt, $productCtx);

        try {
            $response = Http::timeout(15)->withHeaders([
                'Content-Type'  => 'application/json',
                'Authorization' => "Bearer {$this->apiKey}",
            ])->post($this->apiUrl, [
                'model'       => $this->model,
                'messages'    => $messages,
                'temperature' => 0.5,
                'max_tokens'  => 1024,
            ]);

            if ($response->failed()) {
                throw new \Exception('Groq API failed: ' . $response->status());
            }

            $reply   = $response->json('choices.0.message.content') ?? 'Xin lỗi, tôi chưa thể trả lời lúc này.';
            $soToken = $response->json('usage.total_tokens') ?? 0;
        } catch (\Exception $e) {
            $reply   = 'Xin lỗi, hệ thống AI đang bận. Bạn hãy thử lại sau vài giây nhé!';
            $soToken = 0;
        }

        // 9. Lưu câu trả lời của AI
        TinNhanChatbot::create([
            'phien_id' => $phien->id,
            'vai_tro'  => 'tro_ly',
            'noi_dung' => $reply,
            'so_token' => $soToken,
        ]);

        return ['phien' => $phien, 'reply' => $reply];
    }

    // ─────────────────────────────────────────────────────────────
    // INTENT DETECTION
    // ─────────────────────────────────────────────────────────────

    /**
     * Nhận diện ý định của người dùng.
     * Ưu tiên: tin nhắn hiện tại → nếu không rõ → xem lại lịch sử để kế thừa context.
     */
    private function detectIntent(string $query, Collection $lichSu): string
    {
        $q = mb_strtolower($query);

        // Chào hỏi
        if ($this->isGreetingOnly($q)) {
            return self::INTENT_GREETING;
        }

        // Nhận diện từ khóa giày
        $shoeWords = ['giày', 'dép', 'sneaker', 'boot', 'sandal', 'footwear', 'giầy'];
        foreach ($shoeWords as $w) {
            if (mb_stripos($q, $w) !== false) return self::INTENT_SHOES;
        }

        // Nhận diện từ khóa áo/quần (clothing)
        $clothWords = ['áo', 'quần', 'hoodie', 'jacket', 'polo', 'tshirt', 't-shirt', 'vest', 'shorts', 'short'];
        foreach ($clothWords as $w) {
            if (mb_stripos($q, $w) !== false) return self::INTENT_CLOTHING;
        }

        // Có số liệu cơ thể nhưng không rõ muốn gì
        $hasMeasurement = $this->detectMeasurements($q);
        if ($hasMeasurement['height'] || $hasMeasurement['weight'] || $hasMeasurement['foot']) {
            // Kiểm tra context trước
            $prevIntent = $this->getIntentFromHistory($lichSu);
            return $prevIntent !== self::INTENT_GENERAL ? $prevIntent : self::INTENT_SIZE_ONLY;
        }

        // Kế thừa intent từ lịch sử (ví dụ: Bot vừa hỏi về giày → lượt này nhập số liệu)
        $prevIntent = $this->getIntentFromHistory($lichSu);
        if ($prevIntent !== self::INTENT_GENERAL) {
            return $prevIntent;
        }

        return self::INTENT_GENERAL;
    }

    /**
     * Trích xuất intent từ lịch sử (dựa trên câu hỏi cuối của Bot).
     */
    private function getIntentFromHistory(Collection $lichSu): string
    {
        // Lấy tin nhắn cuối cùng của Bot để xem Bot đang hỏi về gì
        $lastBotMsg = $lichSu->where('vai_tro', 'tro_ly')->last();
        if (!$lastBotMsg) return self::INTENT_GENERAL;

        $content = mb_strtolower($lastBotMsg->noi_dung);

        if (mb_stripos($content, 'chân') !== false || mb_stripos($content, 'giày') !== false) {
            return self::INTENT_SHOES;
        }
        if (mb_stripos($content, 'chiều cao') !== false || mb_stripos($content, 'cân nặng') !== false || mb_stripos($content, 'áo') !== false) {
            return self::INTENT_CLOTHING;
        }

        return self::INTENT_GENERAL;
    }

    // ─────────────────────────────────────────────────────────────
    // MISSING INFO CHECK
    // ─────────────────────────────────────────────────────────────

    /**
     * Kiểm tra xem có thiếu thông tin cần thiết không.
     * Trả về câu hỏi bổ sung hoặc null nếu đã đủ.
     *
     * Logic "hỏi tối đa 2 lần": nếu Bot đã hỏi rồi mà khách vẫn không cung cấp → bỏ qua, tiếp tục.
     */
    private function getMissingInfo(string $intent, array $measurements, Collection $lichSu): ?string
    {
        // Nếu là greeting → không hỏi thêm
        if ($intent === self::INTENT_GREETING) return null;

        // Đếm số lần Bot đã hỏi về thông tin còn thiếu trong phiên này
        $botAskedCount = $lichSu->where('vai_tro', 'tro_ly')->filter(function ($msg) {
            $c = mb_strtolower($msg->noi_dung);
            return mb_stripos($c, 'chân') !== false
                || mb_stripos($c, 'chiều cao') !== false
                || mb_stripos($c, 'cân nặng') !== false
                || mb_stripos($c, 'áo, quần hay giày') !== false;
        })->count();

        // Đã hỏi 2 lần mà khách không cung cấp → tiếp tục với dữ liệu có sẵn
        if ($botAskedCount >= 2) return null;

        switch ($intent) {
            case self::INTENT_SHOES:
                if (!$measurements['foot']) {
                    return "Để tư vấn size giày chính xác, bạn cho tôi biết **chân bạn dài bao nhiêu cm** nhé? (Đo từ gót đến đầu ngón chân dài nhất) 👟";
                }
                break;

            case self::INTENT_CLOTHING:
                if (!$measurements['height'] && !$measurements['weight']) {
                    return "Để tư vấn size áo/quần phù hợp, bạn cho tôi biết **chiều cao và cân nặng** của bạn nhé? (Ví dụ: 1m7, 70kg) 📏";
                }
                break;

            case self::INTENT_SIZE_ONLY:
                // Có số liệu nhưng không rõ muốn tư vấn loại gì
                if (!$measurements['foot'] || (!$measurements['height'] && !$measurements['weight'])) {
                    return "Bạn muốn tôi tư vấn size **áo, quần hay giày** ạ? 😊";
                }
                break;
        }

        return null;
    }

    // ─────────────────────────────────────────────────────────────
    // MEASUREMENTS
    // ─────────────────────────────────────────────────────────────

    /**
     * Tổng hợp số liệu cơ thể từ TOÀN BỘ tin nhắn của người dùng trong phiên.
     * Tin nhắn mới nhất được ưu tiên (override).
     */
    private function extractMeasurementsFromHistory(Collection $lichSu): array
    {
        $result = ['height' => null, 'weight' => null, 'foot' => null];

        // Duyệt từ cũ đến mới, tin mới sẽ override
        $userMessages = $lichSu->where('vai_tro', 'nguoi_dung');
        foreach ($userMessages as $msg) {
            $m = $this->detectMeasurements($msg->noi_dung);
            if ($m['height']) $result['height'] = $m['height'];
            if ($m['weight']) $result['weight'] = $m['weight'];
            if ($m['foot'])   $result['foot']   = $m['foot'];
        }

        return $result;
    }

    /**
     * Trích xuất số liệu cơ thể từ một câu văn.
     */
    private function detectMeasurements(string $query): array
    {
        $res = ['height' => null, 'weight' => null, 'foot' => null];

        // Chiều cao: 1m80, 1m7, m80, m7, cao 170, 175cm
        if (preg_match('/(?<![.\d])([12])m(\d{2})/i', $query, $m)) {
            $res['height'] = (int)($m[1] . $m[2]);           // 1m80 → 180
        } elseif (preg_match('/(?<![.\d])([12])m(\d)/i', $query, $m)) {
            $res['height'] = (int)($m[1] . $m[2] . '0');     // 1m7  → 170
        } elseif (preg_match('/\bm(\d{2})\b/i', $query, $m)) {
            $res['height'] = (int)('1' . $m[1]);              // m75  → 175
        } elseif (preg_match('/\bm(\d)\b/i', $query, $m)) {
            $res['height'] = (int)('1' . $m[1] . '0');        // m7   → 170
        } elseif (preg_match('/(?:cao|height)[^\d]*(\d{2,3})/i', $query, $m)) {
            $res['height'] = (int)$m[1];
        } elseif (preg_match('/\b(1[5-9]\d|2[0-2]\d)\s*cm\b/i', $query, $m)) {
            $res['height'] = (int)$m[1];
        }

        // Cân nặng: 70kg, 70 ký, nặng 70
        if (preg_match('/\b(\d{2,3})\s*(?:kg|ký)\b/i', $query, $m)) {
            $res['weight'] = (int)$m[1];
        } elseif (preg_match('/\bnặng\s*(\d{2,3})\b/i', $query, $m)) {
            $res['weight'] = (int)$m[1];
        }

        // Độ dài chân: dài 26cm, 260mm, chân 26
        if (preg_match('/(?:chân|dài)[^\d]*(\d{2,3})(?:\s*(?:cm|mm))?/i', $query, $m)) {
            $val = (int)$m[1];
            $res['foot'] = ($val < 100) ? $val * 10 : $val;
        } elseif (preg_match('/\b(\d{2,3})\s*mm\b/i', $query, $m)) {
            $res['foot'] = (int)$m[1];
        }

        return $res;
    }

    // ─────────────────────────────────────────────────────────────
    // BRAND DETECTION
    // ─────────────────────────────────────────────────────────────

    private function detectBrand(string $query): ?int
    {
        $brands = ThuongHieu::select('id', 'ten')->get();
        foreach ($brands as $b) {
            if (mb_stripos($query, $b->ten) !== false) return $b->id;
        }
        return null;
    }

    // ─────────────────────────────────────────────────────────────
    // SIZE LOOKUP
    // ─────────────────────────────────────────────────────────────

    /**
     * Tra bảng size dựa trên số liệu và intent.
     * Intent giày → chỉ tra giày. Intent clothing → chỉ tra áo/quần.
     */
    private function getSizeAdvice(array $measurements, ?int $brandId, string $intent): array
    {
        $advice = [];

        $lookupClothing = in_array($intent, [self::INTENT_CLOTHING, self::INTENT_GENERAL, self::INTENT_SIZE_ONLY]);
        $lookupShoes    = in_array($intent, [self::INTENT_SHOES, self::INTENT_GENERAL, self::INTENT_SIZE_ONLY]);

        // Tư vấn áo/quần
        if ($lookupClothing && ($measurements['height'] || $measurements['weight'])) {
            $query = BangSize::whereIn('loai', ['ao', 'quan']);
            if ($brandId) {
                $brandRules = (clone $query)->where('thuong_hieu_id', $brandId)->get();
                $rules      = $brandRules->isNotEmpty() ? $brandRules : $query->whereNull('thuong_hieu_id')->get();
            } else {
                $rules = $query->whereNull('thuong_hieu_id')->get();
            }

            foreach ($rules as $r) {
                $matchH = !$r->chieu_cao_min || ($measurements['height'] && $measurements['height'] >= $r->chieu_cao_min && $measurements['height'] <= ($r->chieu_cao_max ?? 999));
                $matchW = !$r->can_nang_min  || ($measurements['weight'] && $measurements['weight'] >= $r->can_nang_min  && $measurements['weight'] <= ($r->can_nang_max  ?? 999));

                if ($matchH && $matchW) {
                    $advice[] = ['loai' => $r->loai, 'size' => $r->ten_size];
                }
            }
        }

        // Tư vấn giày
        if ($lookupShoes && $measurements['foot']) {
            $query = BangSize::where('loai', 'giay');
            if ($brandId) {
                $brandRules = (clone $query)->where('thuong_hieu_id', $brandId)->get();
                $rules      = $brandRules->isNotEmpty() ? $brandRules : $query->whereNull('thuong_hieu_id')->get();
            } else {
                $rules = $query->whereNull('thuong_hieu_id')->get();
            }

            foreach ($rules as $r) {
                if ($measurements['foot'] >= $r->chieu_dai_chan_min && $measurements['foot'] <= ($r->chieu_dai_chan_max ?? 999)) {
                    $advice[] = ['loai' => 'giay', 'size' => $r->ten_size];
                }
            }
        }

        return $advice;
    }

    // ─────────────────────────────────────────────────────────────
    // PRODUCT SEARCH
    // ─────────────────────────────────────────────────────────────

    private function searchRelevantProducts(string $query, string $intent, array $sizeAdvice, ?int $brandId): string
    {
        if ($intent === self::INTENT_GREETING) {
            return '(Khách chào hỏi — không cần gợi ý sản phẩm.)';
        }

        $qb = SanPham::where('trang_thai', true);

        // Lọc theo thương hiệu nếu có
        if ($brandId) {
            $qb->where('thuong_hieu_id', $brandId);
        }

        // Lọc theo loại sản phẩm dựa trên intent
        if ($intent === self::INTENT_SHOES) {
            $qb->where(function ($q) {
                $q->where('ten_san_pham', 'like', '%giày%')
                  ->orWhere('ten_san_pham', 'like', '%dép%')
                  ->orWhereHas('danhMuc', fn ($dq) => $dq->where('ten', 'like', '%giày%')->orWhere('ten', 'like', '%footwear%'));
            });
        } elseif ($intent === self::INTENT_CLOTHING) {
            $qb->where(function ($q) {
                $q->where('ten_san_pham', 'like', '%áo%')
                  ->orWhere('ten_san_pham', 'like', '%quần%')
                  ->orWhereHas('danhMuc', fn ($dq) => $dq->where('ten', 'like', '%áo%')->orWhere('ten', 'like', '%quần%'));
            });
        }

        // Lọc theo size còn hàng
        if (!empty($sizeAdvice)) {
            $sizes = collect($sizeAdvice)->pluck('size')->toArray();
            $qb->whereHas('bienThe', fn ($q) => $q->whereIn('kich_co', $sizes)->where('ton_kho', '>', 0));
        } else {
            $qb->whereHas('bienThe', fn ($q) => $q->where('ton_kho', '>', 0));
        }

        // Tìm theo từ khóa nếu không có size advice
        if (empty($sizeAdvice)) {
            $stopWords = ['tôi', 'mình', 'bạn', 'shop', 'cho', 'và', 'hoặc', 'với', 'có', 'thể', 'không', 'được', 'gì', 'nào', 'là', 'thì', 'của', 'trong', 'hay', 'muốn', 'cần', 'mua'];
            $keywords  = array_filter(
                explode(' ', mb_strtolower($query)),
                fn ($w) => mb_strlen($w) > 2 && !in_array($w, $stopWords)
            );

            if (!empty($keywords)) {
                $qb->where(function ($q) use ($keywords) {
                    foreach ($keywords as $word) {
                        $q->orWhere('ten_san_pham', 'like', "%{$word}%")
                          ->orWhereHas('thuongHieu', fn ($bq) => $bq->where('ten', 'like', "%{$word}%"));
                    }
                });
            }
        }

        $products = $qb->with(['anhChinh', 'thuongHieu'])->latest()->take(6)->get();

        if ($products->isEmpty()) {
            return '(Hiện không có sản phẩm phù hợp còn hàng trong hệ thống.)';
        }

        $url = rtrim(env('FRONTEND_URL', 'http://localhost:3000'), '/');
        return $products->map(function ($p) use ($url) {
            $price = number_format($p->gia_khuyen_mai ?? $p->gia_goc, 0, ',', '.') . '₫';
            $brand = $p->thuongHieu?->ten ? " — {$p->thuongHieu->ten}" : '';
            $img   = $p->anhChinh?->url ?? 'https://via.placeholder.com/150';
            
            // Format: ![ProductName](ImageURL) [ProductName](LinkURL) — Brand — Price
            return "![{$p->ten_san_pham}]({$img})\n[{$p->ten_san_pham}]({$url}/products/{$p->duong_dan}){$brand}\n**Giá: {$price}**";
        })->join("\n\n---\n\n"); // Ngăn cách các sản phẩm bằng đường kẻ gạch ngang cho đẹp
    }

    // ─────────────────────────────────────────────────────────────
    // PROMPT BUILDERS
    // ─────────────────────────────────────────────────────────────

    private function buildSystemPrompt(array $sizeAdvice): string
    {
        $adviceSection = '';
        if (!empty($sizeAdvice)) {
            $adviceSection = "\n\n📐 **THÔNG TIN SIZE TỪ HỆ THỐNG** (tính từ số liệu khách vừa nhập):\n";
            foreach ($sizeAdvice as $a) {
                $type          = match ($a['loai']) { 'giay' => 'Giày', 'ao' => 'Áo', 'quan' => 'Quần', default => ucfirst($a['loai']) };
                $adviceSection .= "- {$type}: Size **{$a['size']}**\n";
            }
            $adviceSection .= "\n→ Hãy thông báo size này cho khách một cách TỰ TIN và LỊCH SỰ. CẦN giải thích vì sao size này phù hợp dựa trên số liệu khách nhập.";
        }

        return <<<PROMPT
Bạn là trợ lý AI chuyên nghiệp của **SportStore**.

QUY TẮC CẦN TUÂN THỦ NGHIÊM NGẶT:
1. **Chào hỏi**: Vui vẻ, hỏi thăm khách hàng. KHÔNG đề cập sản phẩm nếu khách chỉ chào.
2. **Tư vấn size**: Sử dụng ngay "THÔNG TIN SIZE TỪ HỆ THỐNG" kèm theo. Đây là dữ liệu chuẩn, hãy cung cấp cho khách một cách chuyên nghiệp.
3. **Đề xuất sản phẩm (ĐẶC BIỆT QUAN TRỌNG)**:
   - **CẤM TỰ BỊA TÊN SẢN PHẨM.** 
   - Bạn chỉ được quyền sử dụng danh sách sản phẩm ĐÃ CÓ (còn hàng) được cung cấp trong context dưới dây.
   - Luôn hiển thị đầy đủ: Ảnh sản phẩm, Tên sản phẩm kèm Link, và Giá. 
   - Trình bày dạng danh sách đẹp mắt.
4. **Link sản phẩm**: Giữ nguyên link Markdown được cung cấp (ví dụ: [Tên](Link)). Link phải bắt đầu bằng http://localhost:3000...
5. **Ngôn ngữ**: Tiếng Việt, thân thiện nhưng chuyên nghiệp. Sử dụng các emoji phù hợp.
{$adviceSection}
PROMPT;
    }

    private function buildMessages(Collection $lichSu, string $systemPrompt, string $context): array
    {
        $messages = [['role' => 'system', 'content' => $systemPrompt . "\n\n---\n**SẢN PHẨM ĐANG CÓ (còn hàng):**\n" . $context]];
        foreach ($lichSu as $msg) {
            $messages[] = [
                'role'    => $msg->vai_tro === 'nguoi_dung' ? 'user' : 'assistant',
                'content' => $msg->noi_dung,
            ];
        }
        return $messages;
    }

    // ─────────────────────────────────────────────────────────────
    // HELPERS
    // ─────────────────────────────────────────────────────────────

    private function isGreetingOnly(string $query): bool
    {
        $q         = mb_strtolower(trim($query));
        $greetings = ['xin chào', 'chào', 'hello', 'hi', 'hey', 'alo', 'yo', 'chào shop', 'chào bạn'];
        foreach ($greetings as $g) {
            if ($q === $g || $q === $g . '!' || $q === $g . '.') return true;
        }

        // Câu rất ngắn + không chứa từ khóa mua sắm
        $shoppingKw = ['size', 'giày', 'giầy', 'áo', 'quần', 'mua', 'tìm', 'sản phẩm', 'thể thao', 'cao', 'nặng', 'chân', 'kg', 'cm', 'mm', 'nike', 'adidas', 'dép'];
        if (mb_strlen($q) <= 20) {
            foreach ($shoppingKw as $kw) {
                if (mb_stripos($q, $kw) !== false) return false;
            }
            return true;
        }
        return false;
    }
}
