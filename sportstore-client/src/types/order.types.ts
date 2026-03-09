export interface OrderPayload {
    dia_chi_id: number;
    phuong_thuc_tt: 'cod' | 'chuyen_khoan' | 'vnpay' | 'momo';
    ma_coupon?: string;
    ghi_chu?: string;
}

export interface OrderItem {
    id: number;
    don_hang_id: number;
    san_pham_id: number;
    bien_the_id: number | null;
    ten_san_pham: string;
    phong_loai: string | null;
    so_luong: number;
    don_gia: number;
    thanh_tien: number;
    anh_san_pham: string | null;
}

export interface Order {
    id: number;
    nguoi_dung_id: number;
    ma_don_hang: string;
    ho_ten_nguoi_nhan: string;
    so_dien_thoai_nhan: string;
    dia_chi_nhan: string;
    ghi_chu: string | null;
    tong_tien_hang: number;
    phi_van_chuyen: number;
    giam_gia: number;
    tong_thanh_toan: number;
    phuong_thuc_tt: string;
    trang_thai_tt: string;
    trang_thai_don_hang: string;
    ngay_dat_hang: string;
    items?: OrderItem[];
}
