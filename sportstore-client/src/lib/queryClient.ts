import { QueryClient } from '@tanstack/react-query'

/**
 * React Query client config cho sportstore-client.
 * Dùng chung toàn app qua QueryClientProvider trong layout.tsx
 */
const queryClient = new QueryClient({
    defaultOptions: {
        queries: {
            staleTime: 1000 * 60 * 5,   // 5 phút — data không stale
            gcTime: 1000 * 60 * 10,     // 10 phút — giữ cache sau unmount
            retry: 1,                    // Retry 1 lần khi lỗi mạng
            refetchOnWindowFocus: false, // Không refetch khi focus lại tab
        },
        mutations: {
            retry: 0,
        },
    },
})

export default queryClient
