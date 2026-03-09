import apiClient from '@/lib/api';
import { Address, AddressPayload } from '@/types/address.types';

export const addressService = {
    getAddresses: async (): Promise<Address[]> => {
        const response: any = await apiClient.get('/address');
        return response.data;
    },

    getAddress: async (id: number): Promise<Address> => {
        const response: any = await apiClient.get(`/address/${id}`);
        return response.data;
    },

    createAddress: async (payload: AddressPayload): Promise<Address> => {
        const response: any = await apiClient.post('/address', payload);
        return response.data;
    },

    updateAddress: async (id: number, payload: Partial<AddressPayload>): Promise<Address> => {
        const response: any = await apiClient.put(`/address/${id}`, payload);
        return response.data;
    },

    deleteAddress: async (id: number): Promise<void> => {
        await apiClient.delete(`/address/${id}`);
    },
};
