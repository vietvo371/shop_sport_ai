'use client';

import { useState } from "react";
import { useAdminCoupons } from "@/hooks/useAdminCoupons";
import { CouponTable } from "@/components/admin/CouponTable";
import { CouponDialog } from "@/components/admin/CouponDialog";
import {
    Ticket,
    Plus,
    Search,
    Filter,
    ChevronLeft,
    ChevronRight,
    Loader2,
    Activity,
    Calendar,
    Zap
} from "lucide-react";
import { Input } from "@/components/ui/input";
import { Button } from "@/components/ui/button";

export default function CouponManagementPage() {
    const [page, setPage] = useState(1);
    const [search, setSearch] = useState("");
    const [isDialogOpen, setIsDialogOpen] = useState(false);
    const [selectedCoupon, setSelectedCoupon] = useState<any>(null);

    const { data: response, isLoading } = useAdminCoupons({
        page,
        search: search || undefined
    });

    const coupons = response?.data || [];
    const meta = response?.meta;

    const handleAddClick = () => {
        setSelectedCoupon(null);
        setIsDialogOpen(true);
    };

    const handleEditClick = (coupon: any) => {
        setSelectedCoupon(coupon);
        setIsDialogOpen(true);
    };

    return (
        <div className="p-8 space-y-8 animate-in fade-in duration-700">
            {/* Header Section */}
            <div className="flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div className="space-y-3">
                    <div className="flex items-center gap-3">
                        <div className="p-3 bg-primary/10 rounded-2xl shadow-sm border border-primary/5">
                            <Ticket className="h-6 w-6 text-primary" />
                        </div>
                        <div>
                            <h1 className="text-3xl font-black text-slate-900 tracking-tight uppercase italic">Quản Lý Ưu Đãi</h1>
                            <p className="text-slate-500 font-medium flex items-center gap-2 mt-0.5">
                                <Zap className="h-4 w-4 text-amber-500" />
                                Thiết lập mã giảm giá và chiến dịch khuyến mãi
                            </p>
                        </div>
                    </div>
                </div>

                <Button
                    onClick={handleAddClick}
                    className="h-14 px-8 rounded-2xl bg-slate-900 hover:bg-slate-800 text-white font-black text-sm uppercase tracking-widest shadow-xl shadow-slate-200 transition-all active:scale-95 gap-3"
                >
                    <Plus className="h-5 w-5" />
                    Tạo mã mới
                </Button>
            </div>

            {/* Quick Stats Summary */}
            <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div className="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex items-center gap-5">
                    <div className="h-12 w-12 rounded-2xl bg-primary/5 flex items-center justify-center text-primary">
                        <Activity className="h-6 w-6" />
                    </div>
                    <div>
                        <p className="text-[10px] font-black text-slate-400 uppercase tracking-widest">Đang hoạt động</p>
                        <p className="text-2xl font-black text-slate-900">{meta?.total || 0}</p>
                    </div>
                </div>
                <div className="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex items-center gap-5">
                    <div className="h-12 w-12 rounded-2xl bg-emerald-50 flex items-center justify-center text-emerald-500">
                        <Zap className="h-6 w-6" />
                    </div>
                    <div>
                        <p className="text-[10px] font-black text-slate-400 uppercase tracking-widest">Tiết kiệm khách hàng</p>
                        <p className="text-2xl font-black text-slate-900">... VNĐ</p>
                    </div>
                </div>
                <div className="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex items-center gap-5">
                    <div className="h-12 w-12 rounded-2xl bg-amber-50 flex items-center justify-center text-amber-500">
                        <Calendar className="h-6 w-6" />
                    </div>
                    <div>
                        <p className="text-[10px] font-black text-slate-400 uppercase tracking-widest">Chiến dịch tháng</p>
                        <p className="text-2xl font-black text-slate-900">... mã</p>
                    </div>
                </div>
            </div>

            {/* Filter & Search Bar */}
            <div className="bg-white p-4 rounded-[2rem] border border-slate-100 shadow-sm flex flex-col md:flex-row items-center gap-6">
                <div className="relative w-full group">
                    <Search className="absolute left-4 top-1/2 -translate-y-1/2 h-4 w-4 text-slate-400 group-focus-within:text-primary transition-colors" />
                    <Input
                        placeholder="Tìm kiếm mã code hoặc mô tả ưu đãi..."
                        className="pl-11 h-12 bg-slate-50 border-slate-100 rounded-2xl font-bold focus-visible:ring-primary/20 focus-visible:border-primary/30 transition-all uppercase"
                        value={search}
                        onChange={(e) => setSearch(e.target.value)}
                    />
                </div>

                <Button variant="outline" className="h-12 px-6 rounded-2xl border-slate-100 font-black text-xs uppercase tracking-widest hover:bg-slate-50 gap-2 shrink-0 text-slate-600">
                    <Filter className="h-4 w-4" />
                    Lọc nâng cao
                </Button>
            </div>

            {/* Main Content */}
            {isLoading ? (
                <div className="h-[400px] flex flex-col items-center justify-center gap-4 bg-white rounded-3xl border border-dashed border-slate-200">
                    <Loader2 className="h-10 w-10 animate-spin text-primary" />
                    <p className="text-slate-400 font-black animate-pulse uppercase tracking-widest text-[10px]">Đang tải danh sách ưu đãi...</p>
                </div>
            ) : (
                <div className="space-y-6">
                    <CouponTable coupons={coupons} onEdit={handleEditClick} />

                    {/* Pagination */}
                    {meta && meta.last_page > 1 && (
                        <div className="flex items-center justify-between bg-white p-4 rounded-2xl border border-slate-100 shadow-sm">
                            <p className="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-2">
                                Trang {meta.current_page} / {meta.last_page} • {meta.total} mã giảm giá
                            </p>
                            <div className="flex gap-2">
                                <Button
                                    variant="outline"
                                    size="sm"
                                    className="h-10 rounded-xl px-4 border-slate-100 font-bold disabled:opacity-30"
                                    onClick={() => setPage(p => Math.max(1, p - 1))}
                                    disabled={page === 1}
                                >
                                    <ChevronLeft className="h-4 w-4 mr-1" /> Trước
                                </Button>
                                <Button
                                    variant="outline"
                                    size="sm"
                                    className="h-10 rounded-xl px-4 border-slate-100 font-bold disabled:opacity-30"
                                    onClick={() => setPage(p => Math.min(meta.last_page, p + 1))}
                                    disabled={page === meta.last_page}
                                >
                                    Sau <ChevronRight className="h-4 w-4 ml-1" />
                                </Button>
                            </div>
                        </div>
                    )}
                </div>
            )}

            <CouponDialog
                open={isDialogOpen}
                onOpenChange={setIsDialogOpen}
                coupon={selectedCoupon}
            />
        </div>
    );
}
