export interface Category {
    id: number;
    danh_muc_cha_id: number | null;
    ten: string;
    duong_dan: string;
    hinh_anh: string | null;
    mo_ta: string | null;
    thu_tu: number;
    trang_thai: boolean;
}

export interface Brand {
    id: number;
    ten: string;
    duong_dan: string;
    logo: string | null;
    mo_ta: string | null;
}

export interface ProductVariant {
    id: number;
    san_pham_id: number;
    ma_sku: string | null;
    kich_co: string | null;
    mau_sac: string | null;
    ma_mau_hex: string | null;
    hinh_anh: string | null;
    gia_rieng: number | null;
    ton_kho: number;
    trang_thai: boolean;
}

export interface ProductImage {
    id: number;
    san_pham_id: number;
    duong_dan_anh: string;
    url?: string;
    chu_thich: string | null;
    thu_tu: number;
    la_anh_chinh: boolean;
}

export interface Product {
    id: number;
    danh_muc_id: number;
    thuong_hieu_id: number;
    ten_san_pham: string;
    duong_dan: string;
    ma_sku: string | null;
    mo_ta_ngan: string | null;
    mo_ta_day_du: string | null;
    gia_goc: number;
    gia_khuyen_mai: number | null;
    so_luong_ton_kho: number;
    noi_bat: boolean;
    trang_thai: boolean;
    da_ban: number;
    luot_xem: number;
    diem_danh_gia: number;
    so_luot_danh_gia: number;

    // Relationships(optional, based on API response inclusion)
    danh_muc?: Category;
    thuong_hieu?: Brand;
    bien_the_san_pham?: ProductVariant[];
    hinh_anh_san_pham?: ProductImage[];
}
