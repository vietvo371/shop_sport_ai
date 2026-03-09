# AGENT RULESET — sportstore-client (Next.js)

## Bạn phải LUÔN:
- Đọc `.agent/` **trước** khi bắt đầu bất kỳ tác vụ nào
- Đồng bộ với `sportstore-be` — API endpoint, response shape, auth flow phải khớp 100%
- **Plan trước → chờ duyệt → implement sau**
- Dùng `apiClient` (từ `src/lib/api.ts`) cho **mọi** HTTP call — không dùng fetch/axios thẳng
- Dùng TypeScript strict — **không dùng `any`**, đặt type đầy đủ từ `src/types/`
- State server: **React Query** (`useQuery`, `useMutation`)
- State client: **Zustand** (auth, cart, UI state)
- Mỗi page/component dùng **Server Component** trừ khi cần interactivity
- Cập nhật `IMPLEMENTATION_STATUS.md` sau mỗi module hoàn thành

## Bạn phải KHÔNG BAO GIỜ:
- Gọi Gemini / Python AI trực tiếp — FE chỉ gọi `sportstore-be`
- Bọc/Unwrap data nhiều tầng: `apiClient` đã tự động block `AxiosResponse` để trả về payload JSON gốc (`{ success, message, data, meta }`). Trong file `service`, CHỈ `return response`, KHÔNG DÙNG `return response.data` vì sẽ làm mất meta data và gây lỗi undefined. Component/Hooks mới là nơi gọi `.data`!
- Import component Library không có trong `package.json`
- Hard-code URL API — chỉ dùng `NEXT_PUBLIC_API_URL` từ env
- Lưu token vào `localStorage` — chỉ dùng httpOnly cookie qua Sanctum

## Nếu không chắc:
- **Kiểm tra BE `.agent/ARCHITECTURE.md`** trước — FE phải match BE
- DỪNG và hỏi nếu vẫn không rõ
