# AGENT HANDOFF PROMPT — sportstore-be

**Copy toàn bộ nội dung dưới đây và paste vào chat với agent mới.**

---

```
Bạn đang tiếp tục dự án sportstore-be — Laravel 10 API backend cho website bán đồ thể thao (KLTN Đại học Duy Tân 2025).

## 📁 BẮT ĐẦU: Đọc các file sau theo thứ tự

1. @[.agent/PROJECT_CONTEXT.md]     ← Kiến trúc, stack, file map, conventions
2. @[.agent/SCOPE.md]               ← Ranh giới in/out of scope
3. @[.agent/ARCHITECTURE.md]        ← 4-layer pattern, ApiResponse, route conventions
4. @[.agent/IMPLEMENTATION_STATUS.md] ← Tiến độ hiện tại

## ⚠️ CRITICAL RULES (đọc ngay)

1. ApiResponse::success() / ApiResponse::error() cho MỌI response
2. Business logic CHỈ trong Service layer (app/Services/)
3. Controller CỰC KỲ thin — chỉ gọi service + trả response
4. Gemini API + Python AI → chỉ gọi qua Service class
5. DB schema thay đổi → hỏi trước, không tự thay
6. Plan trước → chờ duyệt → implement sau

## 🗄️ Database Schema

- DBML: @[../docs/architecture/database.dbml]
- Nghiệp vụ: @[../docs/architecture/database-business-logic.md]
- Tên bảng: tiếng Việt snake_case (nguoi_dung, san_pham, don_hang...)

## 🧪 Dev commands

```bash
php artisan serve          # port 8000
php artisan migrate:fresh --seed
php artisan test
php artisan route:list
```

## 🎯 Nhiệm vụ tiếp theo

Xem @[.agent/IMPLEMENTATION_STATUS.md] để biết module nào cần làm tiếp.
Module ưu tiên: Setup → ApiResponse → Auth → Migrations → Product → Cart → Order → Chatbot → Recommendation

## 📞 Context dự án

- Frontend: Next.js 14 tại sportstore-client/ (port 3000)
- AI Service: FastAPI Python tại sportstore-ai/ (port 8001)
- GEMINI_API_KEY: trong .env (không expose ra ngoài)
- AI_SERVICE_URL: http://localhost:8001

Bắt đầu bằng cách đọc .agent/PROJECT_CONTEXT.md!
```
