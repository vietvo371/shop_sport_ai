# Prompt tạo Slide & Bài thuyết trình bảo vệ Khóa luận

> Copy nội dung bên dưới và paste vào ChatGPT / Gemini / Claude để tạo slide PowerPoint và bài thuyết trình mẫu.

---

## PROMPT:

```
Tôi cần bạn tạo nội dung slide PowerPoint và bài thuyết trình cho buổi bảo vệ khóa luận tốt nghiệp. Dưới đây là thông tin dự án:

## THÔNG TIN CHUNG
- Đề tài: "Xây dựng Website Thương mại Điện tử Bán đồ Thể thao Tích hợp AI Chatbot và Hệ thống Đề xuất Cá nhân hóa"
- Trường: Đại học Duy Tân, Trung tâm CSE
- GVHD: Nguyễn Mạnh Đức
- Thời gian: 03/2025 – 05/2025
- Tên website: SportStore

## KIẾN TRÚC HỆ THỐNG
- Kiến trúc Microservice gồm 3 service:
  1. Frontend: Next.js 16, React 19, TypeScript, TailwindCSS, Shadcn UI, Zustand, TanStack Query
  2. Backend: Laravel 12, Sanctum Auth, MySQL, Eloquent ORM
  3. AI Service: FastAPI (Python), scikit-learn, pandas
- Ports: Frontend (3000), Backend (8000), AI (8001)

## CHỨC NĂNG CHÍNH

### Phía khách hàng:
- Đăng ký/Đăng nhập (Email, Google OAuth, xác thực email)
- Duyệt sản phẩm (lọc danh mục, thương hiệu, giá)
- Chi tiết sản phẩm (biến thể size/màu, bảng size, đánh giá, sản phẩm tương tự ML)
- Giỏ hàng (merge giỏ guest khi login)
- Checkout + Thanh toán (COD, VNPay, MoMo)
- AI Chatbot tư vấn sản phẩm (Google Gemini API)
- Đề xuất sản phẩm cá nhân hóa (Item-Based Collaborative Filtering)
- Wishlist, đánh giá + ảnh, thông báo, quản lý profile/địa chỉ

### Phía Admin:
- Dashboard thống kê doanh thu (biểu đồ Recharts)
- CRUD sản phẩm + biến thể, danh mục, thương hiệu
- Quản lý đơn hàng (cập nhật trạng thái)
- Quản lý người dùng + phân quyền RBAC (vai trò, quyền)
- Quản lý mã giảm giá, banner, bảng size, đánh giá, thông báo
- Báo cáo doanh thu

## THUẬT TOÁN ML — ITEM-BASED COLLABORATIVE FILTERING
- Thu thập hành vi người dùng: xem(1.0), click(2.0), yêu thích(3.0), thêm giỏ(4.0), mua(5.0)
- Tạo User-Item Matrix từ điểm hành vi
- Tính Cosine Similarity giữa các sản phẩm (scikit-learn)
- Trả về Top-N sản phẩm đề xuất
- 3 loại đề xuất: Popular (chung), Personalized (theo user), Similar Items (theo sản phẩm)

## AI CHATBOT
- Sử dụng Google Gemini API
- Laravel backend làm proxy
- Lưu lịch sử hội thoại
- Tư vấn sản phẩm thể thao theo nhu cầu khách

## CƠ SỞ DỮ LIỆU
- MySQL với 27 bảng chính
- Các bảng quan trọng: nguoi_dung, san_pham, bien_the_san_pham, don_hang, hanh_vi_nguoi_dung, phien_chatbot, vai_tro, quyen

## YÊU CẦU OUTPUT:

### 1. Slide PowerPoint (15-18 slides):
- Slide 1: Trang bìa (tên đề tài, sinh viên, GVHD, trường)
- Slide 2: Mục lục
- Slide 3: Đặt vấn đề & Mục tiêu
- Slide 4: Phạm vi đề tài
- Slide 5-6: Công nghệ sử dụng
- Slide 7: Kiến trúc hệ thống (vẽ sơ đồ)
- Slide 8: Sơ đồ CSDL (ERD tóm tắt)
- Slide 9-10: Chức năng phía khách hàng (kèm ảnh chụp màn hình placeholder)
- Slide 11: Chức năng phía Admin
- Slide 12-13: Thuật toán ML - Collaborative Filtering (giải thích + công thức Cosine Similarity)
- Slide 14: AI Chatbot (luồng hoạt động)
- Slide 15: Kết quả đạt được
- Slide 16: Ưu/Nhược điểm & Hướng phát triển
- Slide 17: Demo (link hoặc video)
- Slide 18: Q&A - Cảm ơn

### 2. Bài thuyết trình mẫu:
- Viết script thuyết trình cho từng slide (mỗi slide 30-60 giây)
- Tổng thời gian: 12-15 phút
- Giọng điệu: chuyên nghiệp, tự tin, rõ ràng
- Highlight những điểm mạnh: AI Chatbot, ML Recommendation, kiến trúc Microservice
- Chuẩn bị 5 câu hỏi phản biện thường gặp + câu trả lời gợi ý

### 3. Format:
- Nội dung slide ngắn gọn, dùng bullet points
- Bài thuyết trình viết dạng script đầy đủ câu
- Dùng tiếng Việt
- Gợi ý màu sắc/theme slide phù hợp (thể thao, năng động)
```

---

## GỢI Ý BỔ SUNG

Sau khi có nội dung slide, bạn có thể yêu cầu thêm:

```
Bây giờ hãy tạo thêm:
1. 10 câu hỏi phản biện khó mà hội đồng có thể hỏi + câu trả lời chi tiết
2. Phần giải thích công thức Cosine Similarity dễ hiểu cho người không chuyên
3. So sánh Item-Based CF vs Content-Based Filtering vs User-Based CF (bảng so sánh)
4. Giải thích tại sao chọn kiến trúc Microservice thay vì Monolithic
5. Kịch bản demo chi tiết từng bước (step-by-step) kèm ghi chú thời gian
```
