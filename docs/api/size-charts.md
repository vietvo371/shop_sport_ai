# 🔌 API Bảng Size (Size Chart)

Tài liệu đặc tả các endpoint phục vụ tra cứu và quản lý bảng size.

- **Base URL:** `{{host}}/api/v1`
- **Auth:** `Bearer Token` (yêu cầu cho các endpoint admin)

---

## 1. Tra cứu Bảng Size (Public)

Lấy danh sách tất cả các quy tắc size để hiển thị hoặc tính toán gợi ý tại Frontend.

- **Endpoint:** `GET /size-charts`
- **Quyền hạn:** Tự do (Guest/Customer)
- **Query Params:**
    - `loai`: `ao`, `quan`, `giay` (Lọc theo loại)
    - `thuong_hieu_id`: ID thương hiệu (Lọc theo thương hiệu)

### Response (200 OK)
```json
{
    "success": true,
    "message": "Lấy danh sách bảng size thành công",
    "data": [
        {
            "id": 1,
            "thuong_hieu_id": null,
            "loai": "ao",
            "ten_size": "M",
            "chieu_cao_min": 160.0,
            "chieu_cao_max": 170.0,
            "can_nang_min": 55.0,
            "can_nang_max": 65.0,
            "chieu_dai_chan_min": null,
            "chieu_dai_chan_max": null,
            "mo_ta": "Size M chuẩn quốc tế"
        }
    ]
}
```

---

## 2. Quản lý Bảng Size (Admin)

### 2.1. Danh sách Admin
Trả về danh sách bảng size kèm phân trang và tìm kiếm chi tiết.
- **Endpoint:** `GET /admin/size-charts`
- **Quyền hạn:** `quan_tri`

### 2.2. Tạo mới quy tắc
- **Endpoint:** `POST /admin/size-charts`
- **Body:**
```json
{
    "thuong_hieu_id": 1,
    "loai": "giay",
    "ten_size": "42.5",
    "chieu_dai_chan_min": 260,
    "chieu_dai_chan_max": 265,
    "mo_ta": "Size giày Nike chính hãng"
}
```

### 2.3. Cập nhật quy tắc
- **Endpoint:** `PUT /admin/size-charts/{id}`

### 2.4. Xóa quy tắc
- **Endpoint:** `DELETE /admin/size-charts/{id}`

---

## 3. Mã lỗi thường gặp

| Mã lỗi | Diễn giải |
|---|---|
| `401 Unauthorized` | Token hết hạn hoặc không hợp lệ |
| `403 Forbidden` | Tài khoản không có quyền `quan_tri` |
| `422 Unprocessable Entity` | Dữ liệu đầu vào không hợp lệ (ví dụ: `min` > `max`) |
