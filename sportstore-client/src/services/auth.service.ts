import apiClient from '@/lib/api';
import { AuthResponse } from '@/types/auth.types';

export const authService = {
    login: async (credentials: Record<string, string>): Promise<AuthResponse> => {
        try {
            const response: any = await apiClient.post('/auth/login', credentials);
            return response.data;
        } catch (error) {
            console.error('Login failed:', error);
            throw error;
        }
    },

    register: async (data: Record<string, string>): Promise<AuthResponse> => {
        try {
            const response: any = await apiClient.post('/auth/register', data);
            return response.data;
        } catch (error) {
            console.error('Registration failed:', error);
            throw error;
        }
    },

    logout: async (): Promise<void> => {
        try {
            await apiClient.post('/auth/logout');
        } catch (error) {
            console.error('Logout failed:', error);
            throw error;
        }
    },

    getMe: async (): Promise<any> => {
        const response: any = await apiClient.get('/auth/me');
        return response.data;
    },

    updateProfile: async (data: Record<string, string>): Promise<any> => {
        const response: any = await apiClient.put('/auth/me', data);
        return response.data;
    },
};
