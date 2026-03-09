import apiClient from '@/lib/api';
import { Order, OrderPayload } from '@/types/order.types';
import { PaginatedResponse } from '@/types/api.types';

export const orderService = {
    getOrders: async (page = 1, limit = 10): Promise<PaginatedResponse<Order>> => {
        const response: any = await apiClient.get('/orders', { params: { page, limit } });
        return response.data;
    },

    getOrderDetails: async (code: string): Promise<Order> => {
        const response: any = await apiClient.get(`/orders/${code}`);
        return response.data;
    },

    placeOrder: async (payload: OrderPayload): Promise<Order> => {
        const response: any = await apiClient.post('/orders/checkout', payload);
        return response.data;
    },
};
