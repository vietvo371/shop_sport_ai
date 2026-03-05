import { create } from 'zustand'
import { persist } from 'zustand/middleware'
import type { User } from '@/types'
import { removeToken, setToken } from '@/lib/api'

interface AuthState {
    user: User | null
    isAuthenticated: boolean
    // Actions
    login: (user: User, token: string) => void
    logout: () => void
    updateUser: (user: Partial<User>) => void
}

/**
 * Zustand store cho Auth state.
 * Tự động lưu vào localStorage qua persist middleware.
 *
 * Dùng: const { user, isAuthenticated, login, logout } = useAuthStore()
 */
export const useAuthStore = create<AuthState>()(
    persist(
        (set) => ({
            user: null,
            isAuthenticated: false,

            login: (user, token) => {
                setToken(token)
                set({ user, isAuthenticated: true })
            },

            logout: () => {
                removeToken()
                set({ user: null, isAuthenticated: false })
            },

            updateUser: (updates) =>
                set((state) => ({
                    user: state.user ? { ...state.user, ...updates } : null,
                })),
        }),
        {
            name: 'sportstore-auth',
            partialize: (state) => ({ user: state.user, isAuthenticated: state.isAuthenticated }),
        }
    )
)
