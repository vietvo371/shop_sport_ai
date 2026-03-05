# IMPLEMENTATION STATUS — sportstore-client

**Cập nhật:** 03/2025
**Trạng thái tổng thể:** 🟡 Đang setup

---

## Foundation

| Hạng mục | Status | Files | Ghi chú |
|----------|--------|-------|---------|
| Next.js scaffold | 🟢 DONE | `package.json`, `tsconfig.json` | v14, TS, Tailwind |
| Packages | 🟢 DONE | `yarn.lock` | axios, zustand, react-query, js-cookie |
| API Client | 🔴 TODO | `src/lib/api.ts` | Axios instance + interceptors |
| Types | 🔴 TODO | `src/types/*.ts` | Match BE ApiResponse shape |
| React Query setup | 🔴 TODO | `src/lib/queryClient.ts` | Provider trong layout |
| Zustand stores | 🔴 TODO | `src/store/*.ts` | auth, cart, ui |

## Pages & Features

| Module | Status | Files | Ghi chú |
|--------|--------|-------|---------|
| Layout (Header/Footer) | 🔴 TODO | `src/components/layout/` | Nav, cart icon, auth menu |
| Trang chủ `/` | 🔴 TODO | `src/app/(shop)/page.tsx` | Hero, featured, recs |
| Danh sách SP `/products` | 🔴 TODO | `src/app/(shop)/products/` | Filter, search, pagination |
| Chi tiết SP `[slug]` | 🔴 TODO | `src/app/(shop)/products/[slug]/` | Gallery, variants, reviews |
| Auth (`/login`, `/register`) | 🔴 TODO | `src/app/(auth)/` | Form + Zustand auth store |
| Giỏ hàng (Drawer) | 🔴 TODO | `src/components/cart/` | Slide-in drawer |
| Checkout `/checkout` | 🔴 TODO | `src/app/(shop)/checkout/` | Form, coupon, summary |
| Đơn hàng `/orders` | 🔴 TODO | `src/app/(shop)/orders/` | List + detail |
| AI Chatbot Widget | 🔴 TODO | `src/components/chatbot/` | Float widget, session |
| Wishlist `/wishlist` | 🔴 TODO | `src/app/(shop)/wishlist/` | - |
| Recommendation Section | 🔴 TODO | `src/components/recommendation/` | Homepage + Product detail |
| Admin `/admin` | 🔴 TODO | `src/app/(admin)/admin/` | Product, Order, Coupon CRUD |
| Profile `/profile` | 🔴 TODO | `src/app/(shop)/profile/` | Info + addresses |

---

## Legend

- 🔴 TODO — Chưa làm
- 🟡 IN PROGRESS — Đang làm
- 🟢 DONE — Hoàn thành
- ⚠️ ISSUES — Có vấn đề cần xử lý

---

## Log thay đổi

### Session 1 — 03/2025 — Setup
- Scaffold Next.js 14 với TypeScript + TailwindCSS + App Router
- Cài yarn packages: axios, zustand, react-query, js-cookie
- Tạo `.agent/` context files
