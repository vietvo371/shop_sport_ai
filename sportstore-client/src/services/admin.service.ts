import apiClient from "@/lib/api";
import { ApiResponse, PaginatedResponse } from "@/types/api.types";
import { Product } from "@/types/product.types";

export interface DashboardStats {
    stats: {
        total_revenue: number;
        total_orders: number;
        total_products: number;
        total_users: number;
    };
    recent_orders: Array<{
        id: number;
        ma_don_hang: string;
        khach_hang: string;
        tong_tien: number;
        trang_thai: string;
        thoi_gian: string;
    }>;
}

export const adminService = {
    getDashboardStats: async (): Promise<ApiResponse<DashboardStats>> => {
        return apiClient.get('/admin/dashboard');
    },

    // Products
    getProducts: async (page = 1): Promise<PaginatedResponse<Product>> => {
        return apiClient.get(`/admin/products?page=${page}`);
    },
    getProduct: async (id: number): Promise<ApiResponse<Product>> => {
        return apiClient.get(`/admin/products/${id}`);
    },
    createProduct: async (data: any): Promise<ApiResponse<Product>> => {
        return apiClient.post('/admin/products', data);
    },
    updateProduct: async (id: number, data: any): Promise<ApiResponse<Product>> => {
        return apiClient.put(`/admin/products/${id}`, data);
    },
    deleteProduct: async (id: number): Promise<ApiResponse<any>> => {
        return apiClient.delete(`/admin/products/${id}`);
    },

    // Metadata for forms
    getAllCategories: async (): Promise<ApiResponse<any[]>> => {
        return apiClient.get('/categories');
    },
    getAllBrands: async (): Promise<ApiResponse<any[]>> => {
        return apiClient.get('/brands');
    },

    // Upload
    uploadImage: async (file: File, folder: string = 'products'): Promise<ApiResponse<{ url: string; path: string; filename: string }>> => {
        const formData = new FormData();
        formData.append('image', file);
        formData.append('folder', folder);
        return apiClient.post('/admin/upload', formData, {
            headers: {
                'Content-Type': 'multipart/form-data',
            },
        });
    },
};

export const adminKeys = {
    all: ['admin'] as const,
};
