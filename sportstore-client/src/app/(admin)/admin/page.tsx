'use client';

import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
import {
    Users,
    ShoppingCart,
    Package,
    DollarSign,
    TrendingUp,
    ArrowUpRight
} from "lucide-react";

import { useAdminDashboard } from "@/hooks/useAdmin";
import { formatCurrency } from "@/lib/utils";
import { Loader2 } from "lucide-react";

export default function AdminDashboard() {
    const { data: response, isLoading, isError } = useAdminDashboard();

    if (isLoading) {
        return (
            <div className="flex items-center justify-center h-96">
                <Loader2 className="h-8 w-8 animate-spin text-primary" />
            </div>
        );
    }

    if (isError || !response?.data) {
        return (
            <div className="p-8 text-center bg-rose-50 text-rose-600 rounded-xl border border-rose-100 italic">
                Lỗi khi tải dữ liệu thống kê. Vui lòng thử lại sau.
            </div>
        );
    }

    const { stats, recent_orders } = response.data;

    const statItems = [
        { name: 'Doanh thu', value: formatCurrency(stats.total_revenue), icon: DollarSign, color: 'text-emerald-600', bg: 'bg-emerald-50' },
        { name: 'Đơn hàng', value: stats.total_orders.toLocaleString(), icon: ShoppingCart, color: 'text-blue-600', bg: 'bg-blue-50' },
        { name: 'Sản phẩm', value: stats.total_products.toLocaleString(), icon: Package, color: 'text-amber-600', bg: 'bg-amber-50' },
        { name: 'Khách hàng', value: stats.total_users.toLocaleString(), icon: Users, color: 'text-violet-600', bg: 'bg-violet-50' },
    ];

    return (
        <div className="space-y-8">
            <div>
                <h1 className="text-3xl font-bold text-slate-900">Tổng quan</h1>
                <p className="text-slate-500 mt-1">Chào mừng bạn trở lại, đây là tình hình kinh doanh của SportStore hôm nay.</p>
            </div>

            {/* Stats Grid */}
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                {statItems.map((stat) => (
                    <Card key={stat.name} className="border-none shadow-sm hover:shadow-md transition-shadow">
                        <CardHeader className="flex flex-row items-center justify-between pb-2">
                            <CardTitle className="text-sm font-medium text-slate-500">{stat.name}</CardTitle>
                            <div className={`${stat.bg} p-2 rounded-lg`}>
                                <stat.icon className={`h-5 w-5 ${stat.color}`} />
                            </div>
                        </CardHeader>
                        <CardContent>
                            <div className="text-2xl font-bold text-slate-900">{stat.value}</div>
                            <div className="flex items-center gap-1 mt-1 text-xs text-emerald-600 font-medium">
                                <TrendingUp className="h-3 w-3" />
                                <span>+12.5% so với tháng trước</span>
                            </div>
                        </CardContent>
                    </Card>
                ))}
            </div>

            {/* Main Content Area */}
            <div className="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <Card className="lg:col-span-2 border-none shadow-sm h-[450px] flex items-center justify-center bg-white border border-slate-100 overflow-hidden">
                    <div className="text-center p-12">
                        <div className="h-16 w-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6">
                            <TrendingUp className="h-8 w-8 text-slate-200" />
                        </div>
                        <h3 className="text-lg font-bold text-slate-800 mb-2">Biểu đồ doanh thu</h3>
                        <p className="text-slate-400 max-w-xs mx-auto">Hệ thống đang thu thập dữ liệu để hiển thị biểu đồ chi tiết theo thời gian.</p>
                    </div>
                </Card>
                <Card className="border-none shadow-sm h-[450px] flex flex-col overflow-hidden">
                    <div className="p-6 border-b border-slate-50 bg-white">
                        <h3 className="font-bold text-slate-800">Hoạt động gần đây</h3>
                    </div>
                    <div className="flex-1 overflow-y-auto p-4 space-y-3 bg-slate-50/30">
                        {recent_orders.length > 0 ? recent_orders.map((order) => (
                            <div key={order.id} className="flex gap-3 items-start p-3 bg-white hover:shadow-sm border border-slate-100 rounded-xl transition-all cursor-pointer group">
                                <div className="h-10 w-10 rounded-full bg-slate-100 flex-shrink-0 flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-colors">
                                    <ShoppingCart className="h-5 w-5" />
                                </div>
                                <div className="flex-1 min-w-0">
                                    <p className="text-sm font-bold text-slate-900 line-clamp-1">{order.khach_hang}</p>
                                    <p className="text-xs text-slate-500 flex items-center gap-2 mt-0.5">
                                        <span className="font-mono text-primary">{order.ma_don_hang}</span>
                                        <span>•</span>
                                        <span>{order.thoi_gian}</span>
                                    </p>
                                </div>
                                <div className="text-right">
                                    <p className="text-sm font-bold text-slate-900">{formatCurrency(order.tong_tien)}</p>
                                    <span className={`text-[10px] px-2 py-0.5 rounded-full font-bold uppercase tracking-tighter ${order.trang_thai === 'cho_xac_nhan' ? 'bg-amber-100 text-amber-600' :
                                            order.trang_thai === 'da_giao' ? 'bg-emerald-100 text-emerald-600' :
                                                'bg-slate-100 text-slate-600'
                                        }`}>
                                        {order.trang_thai}
                                    </span>
                                </div>
                            </div>
                        )) : (
                            <div className="text-center py-12 text-slate-400">Chưa có hoạt động mới</div>
                        )}
                    </div>
                </Card>
            </div>
        </div>
    );
}

