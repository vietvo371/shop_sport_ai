# SCOPE — sportstore-ai

## ✅ IN SCOPE (MVP)

### Recommendation System (Hệ thống Gợi ý)
- Phân tích data hành vi khách hàng: Xem, Click, Thêm vào giỏ, Mua hàng, Yêu thích.
- Chấm điểm tổng hợp (Behavior Weights Rating).
- Chạy thuật toán Item-Based Collaborative Filtering để tìm ra độ tương đồng giữa các sản phẩm.
- Giải quyết bài toán Cold Start (User ẩn danh, User chưa có hành vi): fallback về Popular Products, Top Trending.
- Cung cấp API Mock / ML cho Backend gọi:
  - `GET /api/v1/recommend/popular`
  - `GET /api/v1/recommend/user/{user_id}`

### System Infrastructure
- Khởi chạy Web Server bằng FastAPI port 8001.
- Giao tiếp Database MySQL dùng SQLAlchemy và PyMySQL.
- Logging Console trực quan bằng `colorama`.

---

## ❌ OUT OF SCOPE

- Lưu trữ Database độc lập (Ai service sử dụng chung DB của Backend).
- Đăng nhập/Xác thực Bearer Token (Ai Service tin tưởng các Request nội bộ do Frontend/Backend gọi tới).
- Phân quyền RBAC.
- Quản trị giao diện (Admin Dashboard).

## ⏳ DEFER (sau MVP)

- Tối ưu hóa Big Data bằng PySpark.
- Đổi Data Storage cho behavior caching sang Redis.
- A/B Testing Algorithms (so sánh SVD Matrix Factorization với Item-based CF).
