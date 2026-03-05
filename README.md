# 🏋️ SportStore — E-Commerce Platform with AI Chatbot & Personalized Recommendation

> **Khóa luận tốt nghiệp** — Đại học Duy Tân | Trung tâm CSE
> GVHD: Nguyễn Mạnh Đức | Thời gian: 03/2025 – 05/2025

---

## 📌 Tổng quan

**SportStore** là nền tảng thương mại điện tử chuyên bán đồ thể thao, tích hợp:
- 🤖 **AI Chatbot** tư vấn sản phẩm (Google Gemini)
- 🎯 **Hệ thống đề xuất cá nhân hóa** bằng Machine Learning
- 🔐 **Xác thực bảo mật** với Laravel Sanctum
- 📦 **Kiến trúc Microservice** rõ ràng, dễ mở rộng

---

## 🏗️ Kiến trúc hệ thống

```
┌─────────────────────────────────────────────────────────┐
│                     CLIENT (Browser)                     │
└───────────────────────┬─────────────────────────────────┘
                        │ HTTP/HTTPS
┌───────────────────────▼─────────────────────────────────┐
│              sportstore-client (Next.js 14)              │
│         TypeScript · TailwindCSS · Shadcn UI             │
└───────────────────────┬─────────────────────────────────┘
                        │ REST API (Axios)
┌───────────────────────▼─────────────────────────────────┐
│              sportstore-api (Laravel 10)                 │
│       Sanctum Auth · Eloquent ORM · RESTful API          │
│              ┌──────────┴──────────┐                     │
│              │                     │                     │
│      Gemini API              sportstore-ai               │
│   (AI Chatbot proxy)     (FastAPI Recommendation)        │
└──────────────────────────────────────────────────────────┘
```

---

## 📁 Cấu trúc dự án

| Thư mục | Mô tả | Stack |
|---|---|---|
| [`sportstore-client/`](./sportstore-client/) | Frontend website | Next.js 14, TypeScript, TailwindCSS |
| [`sportstore-api/`](./sportstore-api/) | Backend RESTful API | Laravel 10, MySQL, Sanctum |
| [`sportstore-ai/`](./sportstore-ai/) | AI & ML Microservice | FastAPI, scikit-learn, pandas |
| [`docs/`](./docs/) | Tài liệu dự án | API specs, diagrams |

---

## 🚀 Quick Start

### Yêu cầu hệ thống
- Node.js ≥ 18
- PHP ≥ 8.2 + Composer
- Python ≥ 3.11
- MySQL ≥ 8.0

### Khởi chạy từng service

```bash
# 1. Frontend
cd sportstore-client && npm install && npm run dev

# 2. Backend
cd sportstore-api && composer install && php artisan serve

# 3. AI Service
cd sportstore-ai && pip install -r requirements.txt && uvicorn app.main:app --reload
```

---

## 🌐 Ports mặc định

| Service | Port |
|---|---|
| Frontend (Next.js) | `3000` |
| Backend (Laravel) | `8000` |
| AI Service (FastAPI) | `8001` |

---

## 👥 Thành viên nhóm

| Họ tên | MSSV | Vai trò |
|---|---|---|
| [Tên sinh viên] | [MSSV] | Fullstack Developer |

---

## 📄 License

MIT License — Khóa luận tốt nghiệp Đại học Duy Tân 2025
