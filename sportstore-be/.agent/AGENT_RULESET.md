# AGENT RULESET — SportStore Backend

## Bạn phải LUÔN:
- Đọc toàn bộ `.agent/` **trước** khi bắt đầu bất kỳ tác vụ nào
- **Plan trước → chờ user duyệt → implement sau**
- Cập nhật `IMPLEMENTATION_STATUS.md` sau mỗi module hoàn thành
- Dùng `ApiResponse::success()`, `ApiResponse::error()`, hoặc `ApiResponse::paginate()` cho mọi response
- Đặt business logic vào **Service layer**, không viết trong Controller
- Validate input qua **FormRequest**, không trong Controller hay Service

## Bạn phải KHÔNG BAO GIỜ:
- Thay đổi DB schema mà không có sự cho phép rõ ràng
- Gọi Gemini API trực tiếp từ Controller (phải qua `ChatbotService`)
- Gọi Python AI Service trực tiếp từ Controller (phải qua `RecommendationService`)
- Đặt query Eloquent phức tạp vào Controller
- Trả response raw `response()->json()` — phải dùng `ApiResponse`.
- **Cấu trúc ApiResponse bắt buộc**: `{ "success": boolean, "message": string, "data": any }`. Với phân trang, dùng `ApiResponse::paginate()` để thêm metadata `meta`.
- Đảm bảo tính nhất quán: Mọi endpoint Admin và Client đều phải trả về payload theo format này để FE không bị lỗi phân tích dữ liệu.
- Implement tính năng ngoài SCOPE.md mà không hỏi

## Nếu không chắc:
- **DỪNG LẠI và hỏi** — đừng tự đoán
