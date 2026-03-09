export interface User {
    id: number;
    email: string;
    ho_va_ten: string;
    so_dien_thoai: string | null;
    vai_tro: 'khach_hang' | 'quan_tri';
    anh_dai_dien: string | null;
    trang_thai: boolean;
    xac_thuc_email_luc: string | null;
}

export interface AuthResponse {
    user: User;
    token: string;
}
