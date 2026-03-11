# ARCHITECTURE — sportstore-be

## Design Pattern (4 tầng)

```
[HTTP Request]
      │
      ▼
FormRequest          ← Validate input, rules, messages
      │
      ▼
Controller           ← Thin: chỉ nhận request, gọi service, trả response
      │
      ▼
Service Layer        ← Toàn bộ business logic, query, tính toán
      │
      ▼
Model (Eloquent)     ← Định nghĩa relations, scopes, accessors
      │
      ▼
ApiResponse Helper   ← Chuẩn hóa JSON response
```

---

## Quy tắc từng tầng

### Controller — `app/Http/Controllers/Api/`
```php
// ✅ ĐÚNG: Controller dùng inline validate + gọi service
public function store(Request $request): JsonResponse
{
    $data = $request->validate([
        'ten_san_pham' => 'required|string|max:200',
        'gia_goc'      => 'required|numeric|min:0',
    ], [
        'ten_san_pham.required' => 'Vui lòng nhập tên sản phẩm.',
    ]);

    $product = $this->sanPhamService->create($data);
    return ApiResponse::created($product, 'Tạo sản phẩm thành công');
}

// ❌ SAI: Viết query/logic trong controller
public function store(Request $request): JsonResponse
{
    $product = SanPham::create([...]); // SAI!
    return response()->json($product); // SAI!
}
```

### Validation — inline trong Controller
- Dùng **`$request->validate()`** trực tiếp trong controller — **không cần tạo FormRequest riêng**
- Luôn kèm mảng messages tiếng Việt để FE hiển thị đúng
- Validation vẫn tự throw `ValidationException` → `bootstrap/app.php` bắt và trả `ApiResponse::validationError()`

### Service Layer — `app/Services/`
```
app/Services/
├── AuthService.php
├── ProductService.php
├── CategoryService.php
├── CartService.php
├── OrderService.php
├── CouponService.php
├── ReviewService.php
├── WishlistService.php
├── NotificationService.php
├── AI/
│   └── ChatbotService.php          ← Proxy Gemini API
└── Recommendation/
    └── RecommendationService.php   ← Proxy Python FastAPI
```

### ApiResponse Helper — `app/Http/Helpers/ApiResponse.php`

```php
// Thành công
ApiResponse::success($data, 'message', 200);

// Thành công có phân trang
ApiResponse::paginate($paginator, ProductResource::class, 'message');

// Lỗi
ApiResponse::error('message', 422, $validationErrors);

// Không tìm thấy
ApiResponse::notFound('Sản phẩm không tồn tại');

// Unauthorized
ApiResponse::unauthorized('Vui lòng đăng nhập');
```

**Format chuẩn mọi response:**
```json
{
  "success": true,
  "message": "Thành công",
  "data": { ... },
  "meta": { ... }   // optional: pagination
}
```

---

## Route naming convention

```
GET    /api/v1/products              → products.index
POST   /api/v1/products              → products.store
GET    /api/v1/products/{id}         → products.show
PUT    /api/v1/products/{id}         → products.update
DELETE /api/v1/products/{id}         → products.destroy

POST   /api/v1/chatbot/message       → chatbot.message
GET    /api/v1/recommendations        → recommendations.index
```

---

## Auth Middleware

```
Không cần auth:  browse sản phẩm, xem chi tiết, chatbot (guest)
Cần auth:sanctum: cart, order, wishlist, review, profile
Cần vai_tro=admin: toàn quyền quản trị
Hệ thống RBAC mới: Sử dụng middleware `CheckPermission` để kiểm tra quyền hạn chi tiết (`quyen`) gán qua `vai_tro`.
```

---

## AI Services (ngoài Laravel)

```
Laravel → POST http://localhost:8001/api/v1/recommend/user/{id}
       ← [san_pham_id, san_pham_id, ...]

Laravel → Gemini API (google-gemini-php/laravel)
       ← text response
```
> Cả 2 đều được wrap trong Service class — Controller không gọi trực tiếp.
