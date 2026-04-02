# 📚 Tài liệu Nghiệp vụ Database — SportStore

> **File:** `docs/architecture/database-business-logic.md`
> **Liên quan:** [`database.dbml`](./database.dbml)
> **Cập nhật:** 03/2025

---

## Mục lục

1. [Đăng ký & Đăng nhập](#1-đăng-ký--đăng-nhập)
2. [Quản lý Danh mục & Sản phẩm](#2-quản-lý-danh-mục--sản-phẩm)
3. [Tracking Hành vi → Recommendation ML](#3-tracking-hành-vi--recommendation-ml)
4. [Giỏ hàng](#4-giỏ-hàng)
5. [Đặt hàng (Checkout)](#5-đặt-hàng-checkout)
6. [Thanh toán](#6-thanh-toán)
7. [Theo dõi Trạng thái Đơn hàng](#7-theo-dõi-trạng-thái-đơn-hàng)
8. [Đánh giá Sản phẩm](#8-đánh-giá-sản-phẩm)
9. [AI Chatbot (Gemini)](#9-ai-chatbot-gemini)
10. [Wishlist](#10-wishlist)
11. [Mã giảm giá (Coupon)](#11-mã-giảm-giá-coupon)
12. [Thông báo](#12-thông-báo)
13. [Banner & Slider](#13-banner--slider)
14. [Phân quyền (RBAC)](#14-phân-quyền-rbac)
25: 15. [Bảng Size (Size Chart)](#15-bảng-size-size-chart)

---

## 1. Đăng ký & Đăng nhập

**Bảng liên quan:** `nguoi_dung`, `token_truy_cap`

### Luồng đăng ký

```
[Client] POST /api/auth/register
    → Validate email unique (nguoi_dung.email)
    → Hash mật khẩu bcrypt → lưu nguoi_dung
    → Trả về thông tin user
```

### Luồng đăng nhập

```
[Client] POST /api/auth/login
    → Kiểm tra email + mat_khau (bcrypt verify)
    → Tạo token → lưu vào token_truy_cap
    → Trả về token cho client lưu localStorage/cookie
```

### Luồng xác thực mỗi request

```
[Client] Header: Authorization: Bearer {token}
    → Laravel Sanctum tra cứu token_truy_cap
    → Xác định nguoi_dung hiện tại
    → Cho phép hoặc từ chối request
```

### Các cột quan trọng

| Cột | Ý nghĩa nghiệp vụ |
|-----|-------------------|
| `mat_khau` | Lưu dạng hash, không bao giờ lưu plain text |
| `is_master` | `true` = Tài khoản Master (không thể xóa/khóa bừa bãi) |
| `vai_tro` | `quan_tri` = toàn quyền, `khach_hang` = chỉ mua hàng |
| `trang_thai` | `false` = tài khoản bị khóa, không thể đăng nhập |
| `xac_thuc_email_luc` | `null` = chưa xác thực email |
| `token_truy_cap.het_han_luc` | Token hết hạn → bắt đăng nhập lại |

---

## 2. Quản lý Danh mục & Sản phẩm

**Bảng liên quan:** `danh_muc`, `thuong_hieu`, `san_pham`, `bien_the_san_pham`, `hinh_anh_san_pham`

### Cấu trúc danh mục đa cấp

`danh_muc` tự tham chiếu chính nó qua `danh_muc_cha_id`:

```
Thể thao (id=1, cha=null)
├── Giày (id=2, cha=1)
│   ├── Giày chạy bộ (id=5, cha=2)
│   └── Giày bóng đá (id=6, cha=2)
└── Quần áo (id=3, cha=1)
    ├── Áo thun (id=7, cha=3)
    └── Quần short (id=8, cha=3)
```

### Cấu trúc sản phẩm + biến thể

Một sản phẩm có thể có nhiều biến thể (size, màu). Mỗi biến thể quản lý tồn kho độc lập:

```
san_pham: Giày Nike Air Max (gia_goc = 2.500.000đ)
├── bien_the_san_pham: Size 40 - Màu Đỏ  | ton_kho=5 | gia_rieng=null
├── bien_the_san_pham: Size 41 - Màu Đỏ  | ton_kho=3 | gia_rieng=null
├── bien_the_san_pham: Size 40 - Màu Đen  | ton_kho=0 | gia_rieng=2.700.000đ
└── hinh_anh_san_pham: [anh1.jpg, anh2.jpg, anh3.jpg]
```

> **Quy tắc giá:** Nếu `bien_the_san_pham.gia_rieng` không null → dùng giá biến thể. Ngược lại → dùng `san_pham.gia_goc` (hoặc `gia_khuyen_mai` nếu có).

### Cập nhật tự động

| Sự kiện | Cột được cập nhật |
|---------|-------------------|
| User xem trang SP | `san_pham.luot_xem += 1` |
| Đơn hàng giao thành công | `san_pham.da_ban += số lượng` |
| Admin duyệt đánh giá | `san_pham.diem_danh_gia` = tính lại avg, `so_luot_danh_gia += 1` |

---

## 3. Tracking Hành vi → Recommendation ML

**Bảng liên quan:** `hanh_vi_nguoi_dung`

### Mục đích

Bảng này là **nguồn dữ liệu đầu vào** cho Python ML Service để xây dựng mô hình đề xuất sản phẩm cá nhân hóa dựa trên hành vi thực tế của người dùng.

### Các hành vi và Trọng số (Behavior Weights)

Hệ thống quy đổi mỗi hành vi thành một điểm số (score) để tính toán mức độ quan tâm của User đối với Item:

| `hanh_vi` | Khi nào ghi | Trọng số (Score) |
|-----------|-------------|------------------|
| `mua_hang` | Thanh toán đơn hàng thành công | **5.0** |
| `them_gio_hang` | Thêm sản phẩm vào giỏ | **4.0** |
| `yeu_thich` | Nhấn nút yêu thích (Wishlist) | **3.0** |
| `click` | Click vào thẻ sản phẩm ở danh sách | **2.0** |
| `xem` | Truy cập trang chi tiết sản phẩm | **1.0** |

### Thuật toán Recommendation

Python ML Service sử dụng thuật toán **Item-Based Collaborative Filtering** với các bước:
1. **Ma trận User-Item:** Xây dựng ma trận phân tán (sparse matrix) chứa tổng điểm tương tác của từng User cho từng Sản phẩm.
2. **Cosine Similarity:** Tính toán độ tương đồng giữa các sản phẩm dựa trên tập người dùng đã tương tác với chúng. Hai sản phẩm có "véc-tơ hành vi" càng giống nhau thì độ tương đồng càng cao.
3. **Dự báo (Rating Prediction):** Với một User cụ thể, hệ thống tìm các sản phẩm họ chưa xem nhưng có độ tương đồng cao nhất với những sản phẩm họ đã từng thích/mua.

### Xử lý Cold-Start & Fallback (Cực kỳ quan trọng)

| Tình huống | Giải pháp xử lý |
|------------|-----------------|
| **Khách vãng lai** | Sử dụng `ma_phien` (Session ID). Trả về **Popular Items** (Sản phẩm phổ biến nhất toàn sàn). |
| **User mới (Cold-start)** | User chưa có hành vi → Trả về **Popular Items**. |
| **User đã xem hết SP** | Nếu không còn sản phẩm mới để gợi ý → Trộn thêm các sản phẩm phổ biến chưa tương tác. |

> **Cách tính Popular Items:** Tính tổng điểm (weight) của tất cả hành vi trên toàn bộ hệ thống (bao gồm cả khách vãng lai) cho từng sản phẩm và lấy Top N sản phẩm có tổng điểm cao nhất.

---

## 4. Giỏ hàng

**Bảng liên quan:** `gio_hang`, `gio_hang_san_pham`, `san_pham`, `bien_the_san_pham`

### Nguyên tắc thiết kế

- Mỗi user (hoặc session) có **đúng 1 giỏ hàng** active
- Giỏ hàng tồn tại độc lập, user có thể thêm/xóa/sửa số lượng bất kỳ lúc nào

### Luồng thêm vào giỏ

```
[Client] POST /api/cart/items { san_pham_id, bien_the_id, so_luong }
    → Kiểm tra bien_the_san_pham.ton_kho >= so_luong
    → Tìm hoặc tạo gio_hang của user/session
    → Upsert gio_hang_san_pham:
        - Nếu đã có item này → cộng thêm so_luong
        - Chưa có → tạo mới, lưu don_gia tại thời điểm thêm
```

### Lưu ý quan trọng

> `gio_hang_san_pham.don_gia` lưu giá **tại thời điểm thêm vào giỏ**, không phải giá hiện tại. Nếu admin đổi giá sản phẩm sau đó, giỏ hàng **không tự cập nhật** - cần hiển thị cảnh báo cho user.

---

## 5. Đặt hàng (Checkout)

**Bảng liên quan:** `don_hang`, `chi_tiet_don_hang`, `dia_chi`, `ma_giam_gia`, `lich_su_dung_ma`

### Luồng đặt hàng

```
[Client] POST /api/orders
    {
        dia_chi_id,
        phuong_thuc_tt,
        ma_coupon (tùy chọn),
        ghi_chu
    }

Bước 1: Validate
    → Kiểm tra gio_hang có item không
    → Kiểm tra từng bien_the_san_pham.ton_kho còn đủ
    → Validate ma_coupon (nếu có)

Bước 2: Tạo don_hang
    → Sinh ma_don_hang (vd: DH20250305001)
    → Tính tam_tinh, so_tien_giam, phi_van_chuyen, tong_tien
    → SNAPSHOT địa chỉ vào: ten_nguoi_nhan, sdt_nguoi_nhan, dia_chi_giao_hang

Bước 3: Tạo chi_tiet_don_hang
    → Copy từng item từ gio_hang
    → SNAPSHOT tên SP, biến thể, giá vào chi_tiet_don_hang

Bước 4: Cập nhật tồn kho
    → bien_the_san_pham.ton_kho -= so_luong

Bước 5: Ghi nhận coupon
    → lich_su_dung_ma.da_su_dung += 1

Bước 6: Xóa gio_hang
    → Xóa toàn bộ gio_hang_san_pham của user

Bước 7: Tạo thong_bao
    → Gửi thông báo "Đặt hàng thành công" cho user
```

### Tại sao phải Snapshot?

| Vấn đề | Giải pháp |
|--------|-----------|
| Admin đổi giá SP sau khi order | `chi_tiet_don_hang.don_gia` lưu giá cũ vẫn đúng |
| User thay đổi địa chỉ sau khi order | `don_hang.dia_chi_giao_hang` đã snapshot → không mất |
| Sản phẩm bị xóa | `chi_tiet_don_hang.ten_san_pham` vẫn còn tên để hiển thị |

---

## 6. Thanh toán

**Bảng liên quan:** `thanh_toan`, `don_hang`

### COD (Thanh toán khi nhận hàng)

```
→ Tạo thanh_toan { trang_thai: 'cho_xu_ly' }
→ Khi giao hàng thành công:
    thanh_toan.trang_thai = 'thanh_cong'
    don_hang.trang_thai_tt = 'da_thanh_toan'
```

### VNPay / MoMo (Thanh toán online)

```
→ Tạo thanh_toan { trang_thai: 'cho_xu_ly' }
→ Redirect user đến cổng thanh toán
→ Cổng callback về Laravel:
    thanh_toan.ma_giao_dich = "VNP_TXN_123"
    thanh_toan.phan_hoi_cong_tt = { ...raw JSON... }  ← lưu để đối soát
    thanh_toan.trang_thai = 'thanh_cong' / 'that_bai'
    thanh_toan.thanh_toan_luc = now()
→ Nếu thành công: cập nhật don_hang.trang_thai_tt = 'da_thanh_toan'
```

> **Lưu `phan_hoi_cong_tt`:** Lưu nguyên JSON từ VNPay/MoMo để đối soát khi có khiếu nại hoặc sai lệch tiền.

---

## 7. Theo dõi Trạng thái Đơn hàng

**Bảng liên quan:** `don_hang`, `lich_su_trang_thai_don`, `thong_bao`

### Vòng đời đơn hàng

```
cho_xac_nhan
    → da_xac_nhan    (Admin xác nhận đơn)
    → dang_xu_ly     (Đang đóng gói)
    → dang_giao      (Đã bàn giao vận chuyển)
    → da_giao        (Giao thành công ✅)

Hoặc:
    → da_huy         (Hủy ở bất kỳ bước nào trước khi giao)
    → hoan_tra       (Trả hàng sau khi đã giao)
```

### Ghi log mỗi lần đổi trạng thái

```
Mỗi khi don_hang.trang_thai thay đổi:
    → INSERT lich_su_trang_thai_don {
        don_hang_id,
        trang_thai: 'dang_giao',
        ghi_chu: 'Đã bàn giao GHTK - Mã vận đơn: GHTK123',
        cap_nhat_boi: admin_user_id,
        created_at: now()
    }
    → INSERT thong_bao cho user {
        tieu_de: 'Đơn hàng DH001 đang được giao'
        du_lieu_them: { don_hang_id: 1 }
    }
```

> **`cap_nhat_boi`:** Lưu ID admin để kiểm tra ai đã thay đổi trạng thái → phục vụ audit log.

---

## 8. Đánh giá Sản phẩm

**Bảng liên quan:** `danh_gia`, `hinh_anh_danh_gia`, `san_pham`

### Quy tắc nghiệp vụ

| Quy tắc | Cơ chế database |
|---------|-----------------|
| Chỉ được đánh giá SP đã mua | `danh_gia.don_hang_id NOT NULL` , verify với `chi_tiet_don_hang` |
| Mỗi đơn chỉ đánh giá 1 lần | Unique index `(san_pham_id, nguoi_dung_id, don_hang_id)` |
| Đánh giá cần admin duyệt | `da_duyet = false` → không hiển thị trên trang web |
| Cập nhật điểm SP | Sau khi duyệt → tính lại `san_pham.diem_danh_gia` |

### Luồng đánh giá

```
[Client] POST /api/reviews
    → Verify don_hang_id thuộc user này và đã da_giao
    → Tạo danh_gia { da_duyet: false }
    → Upload ảnh → tạo hinh_anh_danh_gia

[Admin] PUT /api/admin/reviews/{id}/approve
    → danh_gia.da_duyet = true
    → Cập nhật san_pham:
        diem_danh_gia = AVG(so_sao) WHERE da_duyet=true
        so_luot_danh_gia = COUNT(*) WHERE da_duyet=true
```

---

## 9. AI Chatbot (Gemini)

**Bảng liên quan:** `phien_chatbot`, `tin_nhan_chatbot`

### Mục đích lưu database

- **Lịch sử hội thoại:** Gửi toàn bộ lịch sử phiên lên Gemini → chatbot nhớ ngữ cảnh
- **Theo dõi chi phí:** `so_token` mỗi tin nhắn → tính tổng chi phí API
- **Phân tích nội dung:** Review câu hỏi phổ biến để cải thiện prompt

### Luồng hoạt động

```
Frontend → POST /api/chatbot/message { noi_dung: "Giày size 42 giá rẻ?" }
    ↓
Laravel:
    1. Tìm hoặc tạo phien_chatbot (theo ma_phien trong session)
    2. Lưu tin nhắn user vào tin_nhan_chatbot { vai_tro: 'nguoi_dung' }
    3. Lấy toàn bộ lịch sử phiên từ tin_nhan_chatbot
    4. Gọi Gemini API với context:
        - System prompt: "Bạn là trợ lý tư vấn của SportStore..."
        - Danh sách SP hiện có (inject từ database)
        - Lịch sử hội thoại
    5. Nhận response từ Gemini
    6. Lưu tin nhắn bot vào tin_nhan_chatbot { vai_tro: 'tro_ly', so_token: N }
    7. Trả response về Frontend
```

> **Bảo mật:** Frontend **không** gọi Gemini trực tiếp → API Key Gemini chỉ nằm ở Laravel backend.

---

## 10. Wishlist

**Bảng liên quan:** `yeu_thich`, `san_pham`

### Nghiệp vụ đơn giản

```
Thêm: INSERT yeu_thich (nguoi_dung_id, san_pham_id)
      → Nếu đã tồn tại: bỏ qua (hoặc báo lỗi 409)

Xóa: DELETE yeu_thich WHERE nguoi_dung_id=? AND san_pham_id=?

Lấy danh sách: SELECT * FROM yeu_thich
               JOIN san_pham ON san_pham.id = yeu_thich.san_pham_id
               WHERE nguoi_dung_id = ?
```

> **Đóng góp cho ML:** Hành vi `yeu_thich` cũng được ghi vào `hanh_vi_nguoi_dung` → dữ liệu training mô hình recommendation.

---

## 11. Mã giảm giá (Coupon)

**Bảng liên quan:** `ma_giam_gia`, `lich_su_dung_ma`

### Các loại giảm giá

| `loai_giam` | Ví dụ | Công thức |
|-------------|-------|-----------|
| `phan_tram` | Giảm 20% | `so_tien_giam = tam_tinh × 20%`, tối đa `giam_toi_da` |
| `so_tien_co_dinh` | Giảm 50.000đ | `so_tien_giam = 50.000` (nếu đủ điều kiện) |

### Checklist validate khi áp coupon

```
1. Mã tồn tại trong ma_giam_gia?
2. trang_thai = true?
3. Hiện tại trong khoảng (bat_dau_luc, het_han_luc)?
4. tam_tinh >= gia_tri_don_hang_min?
5. da_su_dung < gioi_han_su_dung? (hoặc gioi_han_su_dung IS NULL)
6. User chưa dùng mã này? (kiểm tra lich_su_dung_ma)
```

---

## 12. Thông báo

**Bảng liên quan:** `thong_bao`

### Các loại thông báo (`loai`)

| Giá trị | Khi nào tạo |
|---------|-------------|
| `trang_thai_don` | Đơn hàng đổi trạng thái |
| `khuyen_mai` | Admin broadcast khuyến mãi mới |
| `danh_gia_duoc_duyet` | Review được admin duyệt |
| `he_thong` | Thông báo hệ thống chung |

### Trường `du_lieu_them` (JSON)

Lưu thêm dữ liệu tuỳ theo `loai` để Frontend biết redirect đến đâu:

```json
// loai = 'trang_thai_don'
{ "don_hang_id": 42, "ma_don_hang": "DH20250305001" }

// loai = 'khuyen_mai'
{ "san_pham_id": 15, "ma_giam_gia": "SALE30" }
```

### Đánh dấu đã đọc

```
PUT /api/notifications/{id}/read
    → thong_bao.da_doc_luc = now()

// Đếm thông báo chưa đọc (hiển thị badge)
SELECT COUNT(*) FROM thong_bao
WHERE nguoi_dung_id = ? AND da_doc_luc IS NULL
```

---

## 13. Banner & Slider

**Bảng liên quan:** `banners`

### Quản lý hiển thị Slider trang chủ

- Bảng `banners` lưu trữ các hình ảnh slider chính hiển thị trên trang chủ Frontend.
- Các trường quan trọng:
  - `tieu_de`: Tên chiến dịch hoặc mô tả ngắn gọn.
  - `hinh_anh`: Đường dẫn URL ảnh (thường kích thước lớn 16:9 hoặc tỷ lệ ngang).
  - `duong_dan`: Link điều hướng khi người dùng click vào banner.
  - `thu_tu`: Trọng số/vị trí sắp xếp (số càng nhỏ càng lên trước).
  - `trang_thai`: Boolean `true`/`false` để bật tắt nhanh banner mà không cần xóa đi.

---

## Sơ đồ tổng quan quan hệ

```
nguoi_dung
    ├── token_truy_cap          (xác thực)
    ├── dia_chi[]               (địa chỉ giao hàng)
    ├── gio_hang                (1 giỏ hàng active)
    │       └── gio_hang_san_pham[]
    ├── don_hang[]              (lịch sử đơn hàng)
    │       ├── chi_tiet_don_hang[]
    │       ├── lich_su_trang_thai_don[]
    │       └── thanh_toan
    ├── danh_gia[]              (đánh giá sản phẩm)
    ├── yeu_thich[]             (wishlist)
    ├── hanh_vi_nguoi_dung[]    (tracking → ML)
    ├── phien_chatbot[]         (AI chatbot)
    └── thong_bao[]             (notifications)

san_pham
    ├── bien_the_san_pham[]     (size, màu)
    ├── hinh_anh_san_pham[]     (gallery)
    ├── danh_gia[]              (reviews)
    └── danh_muc (cha → con)

thuong_hieu
    ├── san_pham[]
    └── bang_size[]             (quy tắc tra cứu size)

banners[]                       (slider trang chủ, quảng cáo)
```

---

## 14. Phân quyền (RBAC)

**Bảng liên quan:** `vai_tro`, `quyen`, `vai_tro_quyen`, `nguoi_dung_vai_tro`

### Mục tiêu
Chuyển đổi từ hệ thống phân quyền cứng (`enum`) sang hệ thống linh hoạt, cho phép quản lý quyền hạn chi tiết cho từng nhân viên.

### Cấu trúc mô hình
- **`vai_tro` (Roles)**: Nhóm các quyền (ví dụ: Quản lý kho, CSKH).
- **`quyen` (Permissions)**: Các hành động cụ thể trong hệ thống (ví dụ: `tao_san_pham`, `duyet_don_hang`).
- **`vai_tro_quyen`**: Thiết lập vai trò nào có những quyền nào.
- **`nguoi_dung_vai_tro`**: Gán vai trò cho người dùng (một người có thể có nhiều vai trò).

### Luồng kiểm tra quyền
```
User → Đăng nhập → Load danh sách permissions từ các roles của user
    ↓
Middleware: CheckPermission('tao_san_pham')
    ↓
Kiểm tra trong cache/database xem user có quyền này không
    ↓
Cho phép (200) hoặc Từ chối (403)
```

### Các nhóm quyền dự kiến
| Nhóm | Quyền ví dụ |
|------|-------------|
| Sản phẩm | `xem_sp`, `them_sp`, `sua_sp`, `xoa_sp` |
| Đơn hàng | `xem_don`, `cap_nhat_don`, `huy_don` |
| Thông báo | `gui_quang_ba`, `xem_lich_su_tb` |
| Hệ hệ thống | `quan_ly_user`, `xem_bao_cao`, `cai_dat_he_thong` |

---

## 15. Bảng Size (Size Chart)
526: 
527: **Bảng liên quan:** `bang_size`, `thuong_hieu`
528: 
529: ### Mục tiêu
530: Cung cấp công cụ tra cứu và gợi ý size tự động cho khách hàng dựa trên thông số cơ thể, giúp giảm tỷ lệ đổi trả hàng do sai kích cỡ.
531: 
532: ### Cấu trúc dữ liệu `bang_size`
533: 
534: | Cột | Ý nghĩa | Ghi chú |
535: |-----|---------|---------|
536: | `thuong_hieu_id` | Liên kết thương hiệu | `null` nếu là quy tắc chung toàn sàn |
537: | `loai` | Phân loại sản phẩm | `ao`, `quan`, `giay` |
538: | `ten_size` | Tên size hiển thị | S, M, L, XL, 39, 40, 41... |
539: | `chieu_cao_min/max` | Khoảng chiều cao (cm) | Dùng cho `ao` và `quan` |
540: | `can_nang_min/max` | Khoảng cân nặng (kg) | Dùng cho `ao` và `quan` |
541: | `chieu_dai_chan_min/max`| Khoảng dài chân (mm) | Dùng cho `giay` |
542: 
543: ### Thuật toán gợi ý size tự động
544: 
545: Khi người dùng nhập thông số (ví dụ: Cao 165cm, Nặng 60kg), hệ thống thực hiện:
546: 
547: 1.  **Xác định `loai`:** Dựa trên danh mục của sản phẩm hiện tại.
2.  **Xác định `thuong_hieu_id`:** Lấy từ sản phẩm.
3.  **Tra cứu quy tắc (Priority Logic):**
    - **Ưu tiên 1:** Tìm trong `bang_size` có `thuong_hieu_id` trùng khớp.
    - **Ưu tiên 2 (Fallback):** Nếu không thấy, tìm trong các quy tắc chung (`thuong_hieu_id IS NULL`).
4.  **So khớp thông số:**
    - Đối với **Áo/Quần**: Tìm bản ghi có `chieu_cao_min <= cao <= chieu_cao_max` **VÀ** `can_nang_min <= nang <= can_nang_max`.
    - Đối với **Giày**: Tìm bản ghi có `chieu_dai_chan_min <= dai <= chieu_dai_chan_max`.
5.  **Kết quả:** Trả về `ten_size` phù hợp nhất.

