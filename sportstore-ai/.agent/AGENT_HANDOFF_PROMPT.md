# AGENT HANDOFF PROMPT — sportstore-ai

**Copy toàn bộ nội dung dưới đây và paste vào chat với agent mới.**

---

```
Bạn đang tiếp tục dự án sportstore-ai — AI Microservice viết bằng Python FastAPI (KLTN Đại học Duy Tân 2026).

## 📁 BẮT ĐẦU: Đọc các file sau theo thứ tự

1. @[.agent/SCOPE.md]               ← Ranh giới in/out of scope
2. @[.agent/IMPLEMENTATION_STATUS.md] ← Tiến độ hiện tại
3. @[database.py]                     ← Connection string & Session MySQL
4. @[ml_engine.py]                    ← Lõi thuật toán ML (Collaborative Filtering)

## ⚠️ CRITICAL RULES (đọc ngay)

1. MỌI API trả về từ `main.py` ĐỀU PHẢI theo format: {"success": true/false, "message": "...", "data": [...]}
2. Service này kết nối trực tiếp đến bảng `hanh_vi_nguoi_dung` của database MySQL chung với Laravel Backend. Không dùng SQLite hay DB phụ.
3. Luôn sử dụng `sys_logger.py` để in log có màu sắc cho đẹp khi demo trên Terminal.
4. AI Service phải luôn chạy ở Port 8001.
5. Không thay đổi Logic của các API Endpoints hiện tại vì Frontend và Backend đã fix cứng gọi vào đây.

## 🧪 Dev commands

```bash
# Kích hoạt môi trường ảo
source venv/bin/activate
# Chạy ASGI Server (Trực tiếp Demo)
uvicorn main:app --host 0.0.0.0 --port 8001 --reload
# Chạy ẩn (Nohup)
nohup uvicorn main:app --host 0.0.0.0 --port 8001 --reload > uvicorn.log 2>&1 &
```

## 🎯 Nhiệm vụ tiếp theo

Xem @[.agent/IMPLEMENTATION_STATUS.md] để biết service còn cần tối ưu những gì (Hiện tại Recommendation đã DONE).

## 📞 Context dự án

- Frontend: Next.js 14 tại sportstore-client/ (port 3000)
- Backend API: Laravel 10 tại sportstore-be/ (port 8000)
- Database: MySQL (port 3306) với Database name là `sportstore_be`
- Thư viện Core ML: `pandas`, `scikit-learn`.

```
