# IMPLEMENTATION STATUS — sportstore-be

**Cập nhật:** 03/2025
**Trạng thái tổng thể:** 🟢 Hoàn thiện Core Backend (95%)

---

## Modules

| Module | Status | Files | Ghi chú |
|--------|--------|-------|---------|
| Setup & Config | 🟢 DONE | `.env`, `config/`, `composer.json` | Laravel 11, Sanctum, CORS |
| ApiResponse Helper | 🟢 DONE | `app/Http/Helpers/ApiResponse.php` | Standardized JSON structure |
| Auth | 🟢 DONE | `AuthController`, `NguoiDung` | Sanctum Bearer tokens |
| Database Migrations | 🟢 DONE | `database/migrations/` | Full schema (24 tables) |
| Seeders | 🟢 DONE | `database/seeders/` | Realistic data seeding |
| Category & Brand | 🟢 DONE | `DanhMucController`, `ThuongHieuController` | - |
| Product | 🟢 DONE | `SanPhamController`, `SanPhamService` | Slug-based, variants, prices |
| Cart | 🟢 DONE | `GioHangController`, `GioHangService` | User-based cart management |
| Order | 🟢 DONE | `DonHangController`, `DonHangService` | Checkout flow, order codes |
| Payment | 🟢 DONE | `ThanhToan` | COD support |
| Review | 🟢 DONE | `DanhGiaController` | Submit, moderation (pending) |
| Wishlist | 🟢 DONE | `YeuThichController` | Toggle logic |
| Coupon | 🟢 DONE | `MaGiamGiaController` | Validation & usage tracking |
| Notification | 🟢 DONE | `ThongBaoController` | DB notifications |
| RBAC (Phân quyền) | 🟡 IN PROGRESS | `vai_tro`, `quyen`... | Hệ thống quyền hạn động |
| AI Chatbot (Gemini) | 🔴 TODO | `ChatbotController` | Proxying to Gemini API |
| Recommendation | 🔴 TODO | `RecommendationController` | User behavior tracking |

---

## Legend

- 🔴 TODO — Chưa làm
- 🟡 IN PROGRESS — Đang làm
- 🟢 DONE — Hoàn thành
- ⚠️ ISSUES — Có vấn đề cần xử lý

---

## Log thay đổi

### Session 1 — 03/2025 — Initial Build
- Hoàn thiện toàn bộ Database Schema và Migrations.
- Xây dựng hệ thống Service Layer & Repository Pattern cơ bản.
- Triển khai Authentication với Laravel Sanctum.
- Hoàn thiện Catalog API (Product, Category, Brand).
- Triển khai Giỏ hàng, Đơn hàng và Thanh toán COD.

### Session 2 — 03/2025 — Refinement
- Sửa lỗi eager loading ảnh chính cho Đơn hàng.
- Cập nhật `SanPhamService` hỗ trợ cờ `can_review`, `has_reviewed`.
- Tối ưu hóa phân trang với `ApiResponse::paginate()`.

### Session 3 — 03/2025 — Notifications & RBAC Planning
- Triển khai toàn diện hệ thống Thông báo (Notification & Broadcast).
- Thiết lập kế hoạch và cập nhật tài liệu cho hệ thống Phân quyền động (RBAC) với các bảng Tiếng Việt (`vai_tro`, `quyen`).
