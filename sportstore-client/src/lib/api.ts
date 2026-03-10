import axios, { AxiosInstance, AxiosResponse, InternalAxiosRequestConfig } from 'axios';
import Cookies from 'js-cookie';

const apiClient: AxiosInstance = axios.create({
  baseURL: process.env.NEXT_PUBLIC_API_URL || 'http://localhost:8000/api/v1',
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json',
  },
  timeout: 15000,
});

// Interceptor for Request
apiClient.interceptors.request.use(
  (config: InternalAxiosRequestConfig) => {
    const token = Cookies.get('token');
    if (token && config.headers) {
      config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
  },
  (error) => {
    return Promise.reject(error);
  }
);

// Interceptor for Response
apiClient.interceptors.response.use(
  (response: AxiosResponse) => {
    // Unwrap the generic API Response so we don't have to keep doing res.data.data
    return response.data;
  },
  (error) => {
    // Handle 401 Unauthorized
    if (error.response?.status === 401) {
      Cookies.remove('token');
      Cookies.remove('user');
      if (typeof window !== 'undefined' && window.location.pathname !== '/login') {
        window.location.href = '/login';
      }
    }

    // Format error to match ApiResponse structure
    const formattedError = error.response?.data || {
      success: false,
      message: error.message || 'Có lỗi xảy ra',
    };

    // Add status code for easier handling in components
    if (error.response) {
      formattedError.status = error.response.status;
    }

    return Promise.reject(formattedError);
  }
);

export default apiClient;
