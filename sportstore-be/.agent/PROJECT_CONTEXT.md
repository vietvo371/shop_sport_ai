# PROJECT CONTEXT — sportstore-be

**Cập nhật lần cuối:** 03/2025
**Trạng thái:** Khởi tạo — chưa có code
**Dành cho:** AI Agent tiếp tục dự án

---

## 🎯 Tổng quan dự án

**Tên:** SportStore API (sportstore-be)
**Loại:** RESTful API backend cho website bán đồ thể thao
**Laravel:** 10.x
**Database:** MySQL 8.0
**Auth:** Laravel Sanctum (Bearer Token)
**Đề tài:** KLTN — Đại học Duy Tân 2025

---

## 🏗️ Kiến trúc tổng thể (Monorepo)

```
KLTN_94_NGOC/
├── sportstore-client/   (Next.js 14 — port 3000)
├── sportstore-be/       (Laravel 10 — port 8000)  ← BẠN ĐANG Ở ĐÂY
└── sportstore-ai/       (FastAPI Python — port 8001)
```

**Luồng giao tiếp:**
```
Frontend → sportstore-be (REST API) → MySQL
                                    → Gemini API (chatbot)
                                    → sportstore-ai (recommendations)
```

---

## 📁 Cấu trúc dự án

```
sportstore-be/
├── .agent/                         ← Context cho AI agent (đọc trước)
├── app/
│   ├── Http/
│   │   ├── Controllers/Api/        ← Thin controllers
│   │   │   ├── Auth/               (AuthController)
│   │   │   ├── Product/            (ProductController, CategoryController...)
│   │   │   ├── Cart/               (CartController)
│   │   │   ├── Order/              (OrderController)
│   │   │   ├── Chatbot/            (ChatbotController)
│   │   │   └── Recommendation/     (RecommendationController)
│   │   ├── Helpers/
│   │   │   └── ApiResponse.php     ← Dùng cho mọi response
│   │   ├── Middleware/
│   │   └── Requests/               ← FormRequest validation
│   ├── Models/                     ← Eloquent models
│   └── Services/                   ← Toàn bộ business logic
│       ├── AuthService.php
│       ├── ProductService.php
│       ├── CategoryService.php
│       ├── CartService.php
│       ├── OrderService.php
│       ├── CouponService.php
│       ├── ReviewService.php
│       ├── WishlistService.php
│       ├── NotificationService.php
│       ├── AI/ChatbotService.php
│       └── Recommendation/RecommendationService.php
├── database/
│   ├── migrations/                 ← Schema (tham chiếu docs/architecture/database.dbml)
│   └── seeders/
└── routes/
    └── api.php
```

---

## 🔑 Key files cần biết

| File | Vai trò |
|------|---------|
| `app/Http/Helpers/ApiResponse.php` | **BẮT BUỘC** dùng cho mọi JSON response |
| `app/Services/AI/ChatbotService.php` | Proxy Gemini — không gọi Gemini ở nơi khác |
| `app/Services/Recommendation/RecommendationService.php` | Proxy Python AI |
| `routes/api.php` | Toàn bộ API routes |
| `.env` | `GEMINI_API_KEY`, `AI_SERVICE_URL=http://localhost:8001` |

---

## 🌐 API Conventions

**Base URL:** `/api/v1/`
**Format response:** JSON theo chuẩn `ApiResponse`
**Auth:** `Authorization: Bearer {sanctum_token}`

### Nhóm routes:
```
/api/v1/auth/*          → Public (register, login)
/api/v1/products/*      → Public (browse) + Auth (wishlist)
/api/v1/cart/*          → Auth required
/api/v1/orders/*        → Auth required
/api/v1/chatbot/*       → Public (guest + user)
/api/v1/recommendations → Public (guest) + Auth (personalized)
/api/v1/admin/*         → Role: quan_tri
```

---

## 🗄️ Database

**Schema đầy đủ:** `../docs/architecture/database.dbml`
**Nghiệp vụ:** `../docs/architecture/database-business-logic.md`

**Tên bảng (tiếng Việt snake_case):**
- `nguoi_dung` (có cờ `is_master` bảo vệ), `token_truy_cap`
- `san_pham`, `danh_muc`, `thuong_hieu`, `bien_the_san_pham`, `hinh_anh_san_pham`
- `dia_chi`, `gio_hang`, `gio_hang_san_pham`
- `don_hang`, `chi_tiet_don_hang`, `lich_su_trang_thai_don`, `thanh_toan`
- `ma_giam_gia`, `lich_su_dung_ma`
- `danh_gia`, `hinh_anh_danh_gia`
- `yeu_thich`
- `phien_chatbot`, `tin_nhan_chatbot`
- `hanh_vi_nguoi_dung`
- `thong_bao`

---

## 🔐 Security Rules

- Sanctum: `auth:sanctum` middleware cho routes cần auth
- Admin check: Middleware kiểm tra `nguoi_dung.vai_tro = 'quan_tri'`
- **Gemini API Key** chỉ ở `.env` phía backend — không expose ra frontend
- Master Protection: Tài khoản có `is_master = true` không thể bị xóa hoặc chỉnh sửa quyền hạn/trạng thái qua Admin API thông thường. Bảo vệ bởi Eloquent `deleting` hook.
- Mass assignment: dùng `$fillable` hoặc `$guarded` trên mọi Model
- **QUAN TRỌNG:** `is_master` chỉ được set qua Seeder hoặc DB direct, không bao giờ expose qua `register` hoặc `update` user thông thường.

---

## 🤖 AI Services

### Gemini Chatbot
```php
// Trong ChatbotService.php
// Package: google-gemini-php/laravel
$response = Gemini::geminiPro()->generateContent([...history...]);
```

### Python Recommendation
```php
// Trong RecommendationService.php
$response = Http::get(config('services.ai.url') . "/api/v1/recommend/user/{$userId}");
return $response->json('data');
```

---

## ⚠️ Critical Rules

1. ❗ `ApiResponse` cho **mọi** JSON response
2. ❗ Business logic CHỈ trong **Service layer**
3. ❗ DB schema thay đổi → phải thảo luận trước
4. ❗ Gemini + AI Service → chỉ gọi qua **Service class**
5. ✅ Mỗi action = 1 FormRequest riêng
6. ✅ Cập nhật `IMPLEMENTATION_STATUS.md` sau mỗi module
