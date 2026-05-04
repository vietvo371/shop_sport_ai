# SportStore — Chi tiết Dự án Khóa luận Tốt nghiệp

> **Đề tài:** Xây dựng Website Thương mại Điện tử Bán đồ Thể thao Tích hợp AI Chatbot và Hệ thống Đề xuất Cá nhân hóa  
> **Trường:** Đại học Duy Tân | Trung tâm CSE  
> **GVHD:** Nguyễn Mạnh Đức  
> **Thời gian:** 03/2025 – 05/2025

---

## 1. Mục tiêu đề tài

- Xây dựng nền tảng TMĐT hoàn chỉnh chuyên bán đồ thể thao
- Tích hợp AI Chatbot (Google Gemini) hỗ trợ tư vấn sản phẩm cho khách hàng
- Xây dựng hệ thống đề xuất sản phẩm cá nhân hóa bằng Machine Learning (Item-Based Collaborative Filtering)
- Áp dụng kiến trúc Microservice, phân tách rõ ràng Frontend – Backend – AI Service

---

## 2. Kiến trúc hệ thống

```
┌─────────────────────────────────────────────────────────────┐
│                      CLIENT (Browser)                        │
└───────────────────────────┬─────────────────────────────────┘
                            │ HTTPS
┌───────────────────────────▼─────────────────────────────────┐
│            sportstore-client (Next.js 16 + React 19)         │
│         TypeScript · TailwindCSS · Shadcn UI · Zustand       │
└────────────┬──────────────────────────────────┬─────────────┘
             │ REST API (Axios)                  │
┌────────────▼────────────────┐    ┌────────────▼─────────────┐
│   sportstore-be (Laravel 12) │    │  sportstore-ai (FastAPI)  │
│  Sanctum · Eloquent · MySQL  │    │  scikit-learn · pandas    │
│  Google Gemini (Chatbot)     │    │  Cosine Similarity        │
└──────────────────────────────┘    └───────────────────────────┘
             │                                   │
             └──────────── MySQL Database ───────┘
```

### Ports

| Service | Port | Mô tả |
|---------|------|--------|
| Frontend (Next.js) | 3000 | Giao diện người dùng |
| Backend (Laravel) | 8000 | REST API chính |
| AI Service (FastAPI) | 8001 | Microservice ML |

---

## 3. Công nghệ sử dụng

### 3.1 Frontend — `sportstore-client/`

| Công nghệ | Phiên bản | Mục đích |
|-----------|-----------|----------|
| Next.js | 16.1.6 | Framework React fullstack (App Router) |
| React | 19.2.3 | UI Library |
| TypeScript | - | Type safety |
| TailwindCSS | 4.x | Styling utility-first |
| Shadcn UI (Radix) | 1.4.3 | Component library |
| Zustand | 5.0.11 | State management |
| TanStack React Query | 5.90 | Server state & caching |
| React Hook Form + Zod | 7.71 / 4.3 | Form validation |
| Recharts | 2.15.4 | Biểu đồ thống kê Admin |
| Framer Motion | 12.36 | Animation |
| Axios | 1.13 | HTTP client |

### 3.2 Backend — `sportstore-be/`

| Công nghệ | Phiên bản | Mục đích |
|-----------|-----------|----------|
| Laravel | 12.x | PHP Framework |
| Laravel Sanctum | 4.0 | Token-based Authentication |
| Laravel Socialite | 5.25 | OAuth (Google Login) |
| Eloquent ORM | - | Database abstraction |
| MySQL | 8.0+ | Relational database |
| Scribe | 5.8 | API documentation |
| Google Gemini API | - | AI Chatbot |

### 3.3 AI/ML Service — `sportstore-ai/`

| Công nghệ | Mục đích |
|-----------|----------|
| FastAPI | Web framework Python (async) |
| scikit-learn | Tính Cosine Similarity |
| pandas | Xử lý dữ liệu hành vi |
| SQLAlchemy + PyMySQL | Kết nối MySQL |
| Colorama | Log màu real-time |

---

## 4. Cơ sở dữ liệu — Các bảng chính

| Bảng | Mô tả |
|------|--------|
| `nguoi_dung` | Thông tin người dùng |
| `san_pham` | Sản phẩm thể thao |
| `bien_the_san_pham` | Biến thể (size, màu, giá, tồn kho) |
| `danh_muc` | Danh mục sản phẩm |
| `thuong_hieu` | Thương hiệu |
| `gio_hang` / `gio_hang_san_pham` | Giỏ hàng |
| `don_hang` / `chi_tiet_don_hang` | Đơn hàng |
| `thanh_toan` | Thanh toán (VNPay, MoMo) |
| `danh_gia` / `hinh_anh_danh_gia` | Đánh giá & ảnh |
| `ma_giam_gia` / `lich_su_dung_ma` | Mã giảm giá |
| `dia_chi` | Địa chỉ giao hàng |
| `yeu_thich` | Wishlist |
| `hanh_vi_nguoi_dung` | Tracking hành vi (xem, click, mua, yêu thích) — Input cho ML |
| `phien_chatbot` / `tin_nhan_chatbot` | Lịch sử chat AI |
| `thong_bao` | Thông báo |
| `banner` / `bang_size` | Banner & Bảng size |
| `vai_tro` / `quyen` | RBAC (Role-Based Access Control) |

---

## 5. Chức năng chi tiết

### 5.1 Phía Khách hàng (Shop)

| # | Chức năng | Chi tiết |
|---|-----------|----------|
| 1 | Đăng ký / Đăng nhập | Email+Password, Google OAuth, xác thực email |
| 2 | Trang chủ | Banner carousel, sản phẩm nổi bật, đề xuất AI |
| 3 | Danh sách sản phẩm | Lọc (danh mục, thương hiệu, giá), phân trang |
| 4 | Chi tiết sản phẩm | Ảnh gallery, biến thể size/màu, bảng size, đánh giá, sản phẩm tương tự (ML) |
| 5 | Giỏ hàng | Thêm/sửa/xóa, merge giỏ guest khi login |
| 6 | Checkout | Chọn địa chỉ, mã giảm giá, chọn phương thức thanh toán |
| 7 | Thanh toán | COD, VNPay, MoMo |
| 8 | Quản lý đơn hàng | Xem lịch sử, chi tiết, trạng thái |
| 9 | Wishlist | Thêm/xóa yêu thích |
| 10 | Đánh giá | Viết review + upload ảnh |
| 11 | Thông báo | Nhận thông báo đơn hàng, khuyến mãi |
| 12 | AI Chatbot | Tư vấn sản phẩm bằng Google Gemini |
| 13 | Đề xuất cá nhân hóa | Sản phẩm phổ biến + gợi ý theo hành vi cá nhân |
| 14 | Profile | Cập nhật thông tin, avatar, quản lý địa chỉ |
| 15 | Quên/Reset mật khẩu | Gửi email reset link |

### 5.2 Phía Admin

| # | Chức năng | Chi tiết |
|---|-----------|----------|
| 1 | Dashboard | Thống kê doanh thu, đơn hàng, người dùng (biểu đồ) |
| 2 | Quản lý sản phẩm | CRUD sản phẩm + biến thể + ảnh |
| 3 | Quản lý danh mục & thương hiệu | Catalog management |
| 4 | Quản lý đơn hàng | Xem, cập nhật trạng thái, lịch sử trạng thái |
| 5 | Quản lý người dùng | Xem, khóa/mở, phân role |
| 6 | Quản lý mã giảm giá | CRUD coupon với điều kiện |
| 7 | Quản lý đánh giá | Duyệt/ẩn review |
| 8 | Quản lý banner | CRUD banner + vị trí hiển thị |
| 9 | Quản lý bảng size | Cấu hình size chart |
| 10 | Báo cáo | Doanh thu, top sản phẩm, xuất report |
| 11 | Phân quyền RBAC | Tạo vai trò, gán quyền chi tiết |
| 12 | Thông báo | Gửi thông báo cho người dùng |
| 13 | Quản lý admin | Thêm/sửa tài khoản nhân viên |

---

## 6. Thuật toán ML — Item-Based Collaborative Filtering

### 6.1 Luồng hoạt động

```
[Hành vi người dùng] → [Bảng hanh_vi_nguoi_dung]
        ↓
[FastAPI nhận request] → [Query hành vi từ MySQL]
        ↓
[Quy đổi hành vi → Điểm số]
   • mua_hang: 5.0
   • them_gio_hang: 4.0
   • yeu_thich: 3.0
   • click: 2.0
   • xem: 1.0
        ↓
[Tạo User-Item Matrix (pandas)]
        ↓
[Tính Cosine Similarity giữa các Item (scikit-learn)]
        ↓
[Trả về Top-N sản phẩm đề xuất]
```

### 6.2 API Endpoints AI Service

| Method | Endpoint | Mô tả |
|--------|----------|--------|
| GET | `/api/v1/health` | Health check |
| GET | `/api/v1/test-db` | Kiểm tra kết nối MySQL |
| GET | `/api/v1/recommend/popular` | Top 8 sản phẩm phổ biến nhất |
| GET | `/api/v1/recommend/user/{user_id}` | Đề xuất cá nhân hóa cho user |
| GET | `/api/v1/recommend/item/{product_id}` | Sản phẩm tương tự (item-item) |

### 6.3 Ưu điểm thuật toán

- **Không cần thông tin sản phẩm** (chỉ dựa trên hành vi): phù hợp khi metadata sản phẩm không đầy đủ
- **Real-time**: tính toán trực tiếp từ DB, phản ánh hành vi mới nhất
- **Giải thích được**: "Người mua A cũng mua B" dễ hiểu với người dùng
- **Trọng số hành vi**: phân biệt mức độ quan tâm (xem ≠ mua)

---

## 7. AI Chatbot — Google Gemini

- Backend Laravel làm proxy gọi Gemini API
- Lưu lịch sử hội thoại (phien_chatbot, tin_nhan_chatbot)
- Chatbot hiểu ngữ cảnh sản phẩm thể thao, tư vấn theo nhu cầu
- Hỗ trợ cả guest và user đã đăng nhập

---

## 8. Bảo mật

- **Authentication**: Laravel Sanctum (token-based)
- **OAuth**: Google Login qua Socialite
- **RBAC**: Phân quyền chi tiết (vai_tro, quyen)
- **Email Verification**: Xác thực email khi đăng ký
- **CORS**: Cấu hình cho phép cross-origin
- **Inventory Check**: Kiểm tra tồn kho trước khi trừ số lượng (chống overselling)

---

## 9. Thanh toán tích hợp

| Phương thức | Mô tả |
|-------------|--------|
| COD | Thanh toán khi nhận hàng |
| VNPay | Cổng thanh toán trực tuyến (redirect) |
| MoMo | Ví điện tử MoMo (redirect) |

---

## 10. Hướng dẫn cài đặt & chạy

### Yêu cầu
- Node.js ≥ 18
- PHP ≥ 8.2 + Composer
- Python ≥ 3.11
- MySQL ≥ 8.0

### Khởi chạy

```bash
# Terminal 1 — Backend
cd sportstore-be
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve

# Terminal 2 — Frontend
cd sportstore-client
npm install
npm run dev

# Terminal 3 — AI Service
cd sportstore-ai
python3 -m venv venv && source venv/bin/activate
pip install -r requirements.txt
uvicorn app.main:app --host 0.0.0.0 --port 8001 --reload
```

Hoặc chạy script tổng hợp:
```bash
bash start_sportstore.sh
```

---

## 11. Cấu trúc thư mục tổng quan

```
KLTN_94_NGOC/
├── sportstore-client/          # Frontend Next.js 16
│   └── src/
│       ├── app/(shop)/         # Trang khách hàng
│       ├── app/(admin)/        # Trang quản trị
│       ├── app/(auth)/         # Đăng nhập/Đăng ký
│       ├── components/         # UI Components
│       ├── services/           # API services (Axios)
│       ├── store/              # Zustand stores
│       ├── hooks/              # Custom hooks
│       └── types/              # TypeScript types
├── sportstore-be/              # Backend Laravel 12
│   ├── app/Models/             # 27 Eloquent Models
│   ├── app/Http/Controllers/
│   │   └── Api/
│   │       ├── Auth/           # Authentication
│   │       ├── Admin/          # 14 Admin Controllers
│   │       ├── Chatbot/        # AI Chatbot
│   │       └── *.php           # Client Controllers
│   ├── routes/api.php          # RESTful routes
│   └── database/migrations/    # 20 migration files
├── sportstore-ai/              # AI/ML FastAPI
│   └── app/
│       ├── main.py             # API endpoints
│       ├── ml_engine.py        # Thuật toán CF
│       ├── database.py         # SQLAlchemy connection
│       └── sys_logger.py       # Color logging
└── docs/                       # Tài liệu
```
