import apiClient from '@/lib/api';
import { PaginatedResponse } from '@/types/api.types';
import { Product } from '@/types/product.types';

export const productService = {
    getFeaturedProducts: async (limit: number = 8): Promise<Product[]> => {
        try {
            // Assuming a GET /products endpoint handles featured or basic list
            // The interceptor unwraps the axios response.
            const response: PaginatedResponse<Product> = await apiClient.get('/products', {
                params: { limit, noi_bat: 1, sort: 'newest' },
            });
            return response.data || [];
        } catch (error) {
            console.error('Failed to fetch featured products:', error);
            return [];
        }
    },

    getProducts: async (params: any = {}): Promise<PaginatedResponse<Product>> => {
        try {
            const response: any = await apiClient.get('/products', { params });
            return response as PaginatedResponse<Product>;
        } catch (error) {
            console.error('Failed to fetch products API:', error);
            throw error;
        }
    },

    getProductBySlug: async (slug: string): Promise<Product> => {
        try {
            const response: any = await apiClient.get(`/products/${slug}`);
            return response.data;
        } catch (error) {
            console.error(`Failed to fetch product ${slug}:`, error);
            throw error;
        }
    },
};
