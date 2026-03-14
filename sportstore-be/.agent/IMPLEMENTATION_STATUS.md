# IMPLEMENTATION STATUS — sportstore-be

**Cập nhật:** 03/2025
**Trạng thái tổng thể:** 🟢 Hoàn thiện Core Backend (95%)

---

## Modules

| Module | Status | Files | Ghi chú |
|----------------|-------|---------|
| Setup & Config | 🟢 DONE | `.env`, `config/`, `composer.json` | Laravel 11, Sanctum, CORS |
| ApiResponse Helper | 🟢 DONE | `app/Http/Helpers/ApiResponse.php` | Standardized JSON structure |
| Auth | 🟢 DONE | `AuthController`, `NguoiDung` | Sanctum Bearer tokens |
| Database Migrations | 🟢 DONE | `database/migrations/` | Full schema (24 tables) |
| Seeders | 🟢 DONE | `database/seeders/` | Realistic data seeding |
| API Standardization | 🟢 DONE | Service Layer | Prevention of Double-Unwrapping |
| Category & Brand | 🟢 DONE | `DanhMucController`, `ThuongHieuController` | - |
| Product | 🟢 DONE | `SanPhamController`, `SanPhamService` | Slug-based, variants, prices |
| Cart | 🟢 DONE | `GioHangController`, `GioHangService` | User-based cart management |
| Order | 🟢 DONE | `DonHangController`, `DonHangService` | Checkout flow, order codes |
| Payment | 🟢 DONE | `ThanhToan` | COD support |
| Review | 🟢 DONE | `DanhGiaController` | Submit, moderation (pending) |
| Wishlist | 🟢 DONE | `YeuThichController` | Toggle logic |
| Coupon | 🟢 DONE | `MaGiamGiaController` | Validation & usage tracking |
| Notification | 🟢 DONE | `ThongBaoController` | DB notifications |
| RBAC (Phân quyền) | 🟢 DONE | `VaiTro`, `Quyen`, `HasPermissions` | Hệ thống quyền hạn động |
| AI Chatbot (Gemini) | 🟢 DONE | `ChatbotController` | Proxying to Gemini API |
| Recommendation | 🟢 DONE | `RecommendationController` | User behavior tracking |

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

### Session 4 — 03/2025 — RBAC Implementation & Standardization
- Hoàn thiện hệ thống Phân quyền động (RBAC) với các bảng Tiếng Việt.
- Tích hợp kiểm tra quyền chi tiết (Granular Permissions) vào toàn bộ Admin Controllers.
- Chuẩn hóa quy trình giao tiếp API: Codify `ApiResponse` và ngăn chặn lỗi Double-Unwrapping.
### Session 7 — 03/2025 — Master Protection & Cleanup
- Revert các thay đổi RBAC phức tạp (xóa `id_vai_tro`) để quay về trạng thái ổn định.
- Thêm cột `is_master` vào bảng `nguoi_dung` để bảo vệ tài khoản Super Admin.
- Triển khai cơ chế bảo mật chặn xóa/sửa tài khoản Master ở cả BE và FE.
- Cập nhật toàn bộ tài liệu dự án và database docs.
