# ARCHITECTURE — sportstore-client

## Stack

| Công nghệ | Vai trò |
|-----------|---------|
| Next.js 14 (App Router) | Framework |
| TypeScript (strict) | Type safety |
| TailwindCSS | Styling |
| Shadcn UI | Component library |
| Axios | HTTP client |
| React Query | Server state (API data) |
| Zustand | Client state (auth, cart, UI) |
| js-cookie | Token storage (httpOnly workaround) |

---

## Cấu trúc thư mục

```
src/
├── app/                        ← Next.js App Router pages
│   ├── (auth)/                 ← Route group: login, register
│   │   ├── login/page.tsx
│   │   └── register/page.tsx
│   ├── (shop)/                 ← Route group: public shop pages
│   │   ├── page.tsx            (trang chủ)
│   │   ├── products/
│   │   │   ├── page.tsx        (danh sách)
│   │   │   └── [slug]/page.tsx (chi tiết)
│   │   ├── categories/[slug]/page.tsx
│   │   ├── checkout/page.tsx
│   │   ├── orders/
│   │   │   ├── page.tsx
│   │   │   ├── [code]/page.tsx
│   │   │   └── [code]/success/page.tsx
│   │   └── wishlist/page.tsx
│   ├── (admin)/                ← Route group: admin pages
│   │   └── admin/...
│   ├── layout.tsx
│   └── globals.css
│
├── components/
│   ├── ui/                     ← Shadcn base components
│   ├── layout/                 ← Header, Footer, Sidebar
│   ├── product/                ← ProductCard, ProductGrid, ProductDetail
│   ├── cart/                   ← CartDrawer, CartItem, CartSummary
│   ├── chatbot/                ← ChatWidget, ChatBubble, ChatInput
│   ├── checkout/               ← CheckoutForm, AddressSelector
│   ├── order/                  ← OrderCard, OrderTimeline
│   ├── recommendation/         ← RecommendedSection
│   └── common/                 ← Loading, Error, Empty states
│
├── hooks/                      ← Custom hooks (useCart, useAuth, useProducts...)
├── lib/
│   ├── api.ts                  ← Axios instance + interceptors ← QUAN TRỌNG
│   ├── utils.ts                ← Helper functions
│   └── queryClient.ts          ← React Query client config
├── services/                   ← API calls grouped by domain
│   ├── auth.service.ts         (login, register, logout, profile)
│   ├── product.service.ts      (list, detail, search)
│   ├── cart.service.ts         (get, add, update, remove)
│   ├── order.service.ts        (create, list, detail)
│   ├── chatbot.service.ts      (sendMessage)
│   ├── recommendation.service.ts (getUserRecs, getSimilar)
│   └── wishlist.service.ts     (toggle, list)
├── store/                      ← Zustand stores
│   ├── auth.store.ts           (user, token, isAuthenticated)
│   ├── cart.store.ts           (items, count, isOpen)
│   └── ui.store.ts             (modals, toasts)
└── types/                      ← TypeScript interfaces
    ├── api.types.ts            (ApiResponse<T>, PaginatedResponse<T>)
    ├── auth.types.ts           (User, LoginRequest...)
    ├── product.types.ts        (Product, Variant, Category...)
    ├── order.types.ts          (Order, OrderItem, OrderStatus...)
    └── chatbot.types.ts        (Message, Session...)
```

---

## API Client (`src/lib/api.ts`)

```typescript
// ✅ Mọi request đều qua apiClient
import apiClient from '@/lib/api'

const res = await apiClient.get('/products')
const data = res.data.data  // ApiResponse<T>.data
```

**Interceptor tự động:**
- Request: đính kèm Bearer token từ cookie
- Response 401: redirect về `/login`
- Response: unwrap `response.data` theo chuẩn BE

---

## Response format (match BE `ApiResponse`)

```typescript
// src/types/api.types.ts
interface ApiResponse<T> {
  success: boolean
  message: string
  data: T
}

interface PaginatedResponse<T> extends ApiResponse<T[]> {
  meta: {
    current_page: number
    last_page: number
    per_page: number
    total: number
  }
}
```

---

## State management

```
Server data (products, orders...) → React Query (useQuery/useMutation)
Auth state (user, token)          → Zustand auth.store
Cart state (items, count)         → Zustand cart.store
UI state (drawer open, modal)     → Zustand ui.store
```

---

## Quy tắc component

```
Server Component (default):   page.tsx, layout.tsx, data-fetching components
Client Component ('use client'): interactive UI, hooks, event handlers
```

---

## ENV Variables

```env
NEXT_PUBLIC_API_URL=http://localhost:8000/api/v1
NEXT_PUBLIC_APP_NAME=SportStore
```

---

## Mapping BE → FE (luôn đồng bộ)

| BE endpoint | FE service | FE page/component |
|-------------|------------|-------------------|
| `POST /auth/login` | `auth.service.ts` | `/login` |
| `GET /products` | `product.service.ts` | `/products` |
| `POST /cart/items` | `cart.service.ts` | `CartDrawer` |
| `POST /orders` | `order.service.ts` | `/checkout` |
| `POST /chatbot/message` | `chatbot.service.ts` | `ChatWidget` |
| `GET /recommendations` | `recommendation.service.ts` | `RecommendedSection` |
