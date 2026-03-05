# SCOPE — sportstore-be

## ✅ IN SCOPE (MVP)

### Auth
- Đăng ký, đăng nhập, đăng xuất (Sanctum)
- Xem / cập nhật profile
- Quản lý địa chỉ giao hàng

### Catalog
- CRUD sản phẩm, danh mục, thương hiệu (Admin)
- Xem danh sách, lọc, tìm kiếm, chi tiết sản phẩm (Public)
- Quản lý biến thể (size, màu) và hình ảnh

### Giỏ hàng & Đặt hàng
- Thêm/xóa/sửa số lượng trong giỏ hàng
- Checkout: tính giá, áp coupon, chọn địa chỉ
- Xem lịch sử đơn hàng, chi tiết đơn hàng
- Admin: quản lý trạng thái đơn hàng

### Mã giảm giá
- Validate và áp dụng coupon khi checkout
- CRUD coupon (Admin)

### AI Chatbot
- Proxy nhận message từ Frontend → gọi Gemini API → trả lời
- Lưu lịch sử phiên chat vào database
- Inject context sản phẩm vào system prompt

### Recommendation
- Ghi nhận hành vi người dùng (view, cart, purchase...)
- Proxy lấy gợi ý từ Python AI microservice

### Wishlist & Đánh giá
- Thêm/xóa yêu thích
- Đánh giá sản phẩm (chỉ khi đã mua), Admin duyệt

### Thông báo
- Tạo notification khi đổi trạng thái đơn hàng
- Đánh dấu đã đọc

---

## ❌ OUT OF SCOPE

- Admin dashboard UI (Frontend lo)
- Tích hợp thanh toán thật (chỉ mock COD + stub VNPay)
- ML model training (Python AI Service lo)
- Push notification thật (FCM/APNs)
- Multi-vendor / marketplace

## ⏳ DEFER (sau MVP)

- Analytics & reporting dashboard
- Flash sale / time-limited promotions
- Loyalty points / reward system
- Product comparison
