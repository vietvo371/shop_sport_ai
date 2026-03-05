import axios, { AxiosError, AxiosResponse, InternalAxiosRequestConfig } from 'axios'
import Cookies from 'js-cookie'

const TOKEN_KEY = 'sportstore_token'

/**
 * Axios instance — BẮT BUỘC dùng cho mọi API call trong sportstore-client.
 * Tự động đính kèm Bearer token và xử lý 401.
 *
 * ✅ ĐÚNG: import apiClient from '@/lib/api'
 * ❌ SAI:  import axios from 'axios' + tự gọi trực tiếp
 */
const apiClient = axios.create({
  baseURL: process.env.NEXT_PUBLIC_API_URL ?? 'http://localhost:8000/api/v1',
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json',
  },
  timeout: 15000,
})

// ─── Request Interceptor ─────────────────────────────────────────────────────
// Tự động đính kèm token từ cookie vào mọi request
apiClient.interceptors.request.use(
  (config: InternalAxiosRequestConfig) => {
    const token = Cookies.get(TOKEN_KEY)
    if (token && config.headers) {
      config.headers.Authorization = `Bearer ${token}`
    }
    return config
  },
  (error) => Promise.reject(error)
)

// ─── Response Interceptor ────────────────────────────────────────────────────
// Xử lý lỗi global: 401 → redirect login
apiClient.interceptors.response.use(
  (response: AxiosResponse) => response,
  (error: AxiosError) => {
    if (error.response?.status === 401) {
      // Xóa token cũ và redirect về login
      Cookies.remove(TOKEN_KEY)
      if (typeof window !== 'undefined') {
        window.location.href = '/login'
      }
    }
    return Promise.reject(error)
  }
)

// ─── Token Helpers ───────────────────────────────────────────────────────────
export const setToken = (token: string) => {
  Cookies.set(TOKEN_KEY, token, {
    expires: 7,       // 7 ngày
    sameSite: 'lax',
    secure: process.env.NODE_ENV === 'production',
  })
}

export const removeToken = () => {
  Cookies.remove(TOKEN_KEY)
}

export const getToken = () => Cookies.get(TOKEN_KEY)

export default apiClient
