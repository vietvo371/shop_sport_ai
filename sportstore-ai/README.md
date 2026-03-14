# SportStore - Python ML Recommendation Engine

Dự án này là Microservice đảm nhiệm chức năng phân tích dữ liệu và Học máy (Machine Learning) cho ứng dụng thương mại điện tử SportStore. Service chạy trên framework **FastAPI** và kết nối trực tiếp đến **MySQL Database** để chạy thuật toán **Lọc cộng tác theo vật phẩm (Item-Based Collaborative Filtering)**.

## 1. Yêu cầu hệ thống
- Python 3.10 trở lên
- Trình quản lý gói `pip`

## 2. Hướng dẫn cài đặt và chạy (Dành cho Demo)

Di chuyển vào thư mục `sportstore-ai`:
```bash
cd sportstore-ai
```

### Cách 1: Chạy trực tiếp qua CMD / Terminal (Khuyên dùng để thầy cô xem Text màu Log trực tiếp)
Hệ thống được thiết kế với giao diện Log có màu để dễ dàng theo dõi việc AI nạp dữ liệu, tính ma trận điểm và trả kết quả.

```bash
# 1. Tạo môi trường ảo (nếu chưa có)
python3 -m venv venv

# 2. Kích hoạt môi trường ảo
# Trên Mac/Linux:
source venv/bin/activate
# Trên Windows:
venv\Scripts\activate

# 3. Cài đặt các thư viện Data Science
pip install -r requirements.txt

# 4. Khởi động AI Server
uvicorn main:app --host 0.0.0.0 --port 8001 --reload
```

Sau khi chạy lệnh số 4, màn hình sẽ dừng lại và hiển thị log sống.
Bạn có thể thao tác (click, mua hàng, thêm giỏ) trên Frontend Website, lúc này Terminal của FastAPI sẽ nháy dòng code nổi bật màu báo hiệu tính năng ML đang thực thi thuật toán phân tích hành vi của bạn trong quá khứ so với Data hệ thống!

### Cách 2: Chạy dưới nền (Dành cho môi trường Server thực tế)
Nếu không muốn treo Terminal của Editor, bạn có thể chạy chế độ nền:
```bash
nohup uvicorn main:app --host 0.0.0.0 --port 8001 --reload > uvicorn.log 2>&1 &
```
Để tắt tiến trình nền:
```bash
pkill -f uvicorn
```
