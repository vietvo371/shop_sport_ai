import { create } from 'zustand'
import type { CartItem } from '@/types'

interface CartState {
    items: CartItem[]
    isOpen: boolean
    // Computed
    totalItems: () => number
    totalPrice: () => number
    // Actions
    setItems: (items: CartItem[]) => void
    openCart: () => void
    closeCart: () => void
    toggleCart: () => void
    clear: () => void
}

/**
 * Zustand store cho Cart UI state.
 * Dữ liệu thật fetch từ BE qua React Query.
 * Store này chỉ giữ: danh sách items đã fetch + trạng thái drawer.
 *
 * Dùng: const { items, isOpen, totalItems, openCart } = useCartStore()
 */
export const useCartStore = create<CartState>()((set, get) => ({
    items: [],
    isOpen: false,

    totalItems: () => get().items.reduce((sum, item) => sum + item.so_luong, 0),

    totalPrice: () =>
        get().items.reduce((sum, item) => sum + item.don_gia * item.so_luong, 0),

    setItems: (items) => set({ items }),

    openCart: () => set({ isOpen: true }),

    closeCart: () => set({ isOpen: false }),

    toggleCart: () => set((state) => ({ isOpen: !state.isOpen })),

    clear: () => set({ items: [] }),
}))
