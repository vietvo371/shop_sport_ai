'use client';

import { Card, CardContent, CardHeader, CardTitle, CardDescription } from "@/components/ui/card";
import { Button } from "@/components/ui/button";
import {
    Users,
    ShoppingCart,
    Package,
    DollarSign,
    TrendingUp,
    ArrowUpRight,
    Trophy,
    Activity
} from "lucide-react";

import { useAdminDashboard } from "@/hooks/useAdmin";
import { formatCurrency } from "@/lib/utils";
import { Loader2 } from "lucide-react";
import {
    AreaChart,
    Area,
    XAxis,
    YAxis,
    CartesianGrid,
    Tooltip,
    ResponsiveContainer,
    PieChart,
    Pie,
    Cell,
    BarChart,
    Bar,
    Legend
} from 'recharts';

const COLORS = ['#0ea5e9', '#f59e0b', '#10b981', '#8b5cf6', '#ef4444', '#6366f1'];

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

    const { stats, recent_orders, charts, top_products } = response.data;

    const statItems = [
        { name: 'Doanh thu', value: formatCurrency(stats.total_revenue), icon: DollarSign, color: 'text-emerald-600', bg: 'bg-emerald-50', trend: '+12.5%' },
        { name: 'Đơn hàng', value: stats.total_orders.toLocaleString(), icon: ShoppingCart, color: 'text-blue-600', bg: 'bg-blue-50', trend: '+8.2%' },
        { name: 'Sản phẩm', value: stats.total_products.toLocaleString(), icon: Package, color: 'text-amber-600', bg: 'bg-amber-50', trend: '+2.4%' },
        { name: 'Khách hàng', value: stats.total_users.toLocaleString(), icon: Users, color: 'text-violet-600', bg: 'bg-violet-50', trend: '+5.1%' },
    ];

    return (
        <div className="space-y-8 animate-in fade-in duration-700">
            <div className="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h1 className="text-3xl font-black text-slate-900 tracking-tight">Dashboard Overview</h1>
                    <p className="text-slate-500 mt-1 font-medium">Theo dõi hiệu suất kinh doanh của SportStore trong thời gian thực.</p>
                </div>
                <div className="flex items-center gap-2 bg-white p-1.5 rounded-2xl shadow-sm border border-slate-100/60">
                    <span className="text-[10px] font-black uppercase tracking-widest text-slate-400 px-3">Live Status</span>
                    <div className="h-2 w-2 rounded-full bg-emerald-500 animate-pulse mr-2" />
                </div>
            </div>

            {/* Stats Grid */}
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                {statItems.map((stat) => (
                    <Card key={stat.name} className="border-none shadow-sm hover:shadow-xl transition-all duration-300 group overflow-hidden bg-white ring-1 ring-slate-100">
                        <CardHeader className="flex flex-row items-center justify-between pb-2">
                            <CardTitle className="text-xs font-bold text-slate-400 uppercase tracking-wider">{stat.name}</CardTitle>
                            <div className={`${stat.bg} p-2.5 rounded-xl group-hover:scale-110 transition-transform`}>
                                <stat.icon className={`h-5 w-5 ${stat.color}`} />
                            </div>
                        </CardHeader>
                        <CardContent>
                            <div className="text-2xl font-black text-slate-900">{stat.value}</div>
                            <div className="flex items-center gap-1 mt-2 text-[10px] text-emerald-600 font-bold bg-emerald-50 w-fit px-2 py-0.5 rounded-full">
                                <TrendingUp className="h-3 w-3" />
                                <span>{stat.trend} <span className="text-slate-400 font-medium">vs tháng trước</span></span>
                            </div>
                        </CardContent>
                    </Card>
                ))}
            </div>

            {/* Charts Section */}
            <div className="grid grid-cols-1 lg:grid-cols-3 gap-8">
                {/* Revenue Chart */}
                <Card className="lg:col-span-2 border-none shadow-sm shadow-slate-100/50 bg-white ring-1 ring-slate-100 overflow-hidden">
                    <CardHeader className="flex flex-row items-center justify-between">
                        <div>
                            <CardTitle className="text-lg font-black text-slate-800">Biểu đồ Doanh thu</CardTitle>
                            <CardDescription>Thống kê doanh thu 6 tháng gần nhất</CardDescription>
                        </div>
                        <Activity className="h-5 w-5 text-slate-300" />
                    </CardHeader>
                    <CardContent className="pt-4 h-[350px]">
                        <ResponsiveContainer width="100%" height="100%">
                            <AreaChart data={charts.revenue}>
                                <defs>
                                    <linearGradient id="colorTotal" x1="0" y1="0" x2="0" y2="1">
                                        <stop offset="5%" stopColor="#0ea5e9" stopOpacity={0.1} />
                                        <stop offset="95%" stopColor="#0ea5e9" stopOpacity={0} />
                                    </linearGradient>
                                </defs>
                                <CartesianGrid strokeDasharray="3 3" vertical={false} stroke="#f1f5f9" />
                                <XAxis
                                    dataKey="month"
                                    axisLine={false}
                                    tickLine={false}
                                    tick={{ fontSize: 12, fill: '#94a3b8' }}
                                    dy={10}
                                />
                                <YAxis
                                    axisLine={false}
                                    tickLine={false}
                                    tick={{ fontSize: 12, fill: '#94a3b8' }}
                                    tickFormatter={(value) => `${value / 1000000}M`}
                                />
                                <Tooltip
                                    contentStyle={{ borderRadius: '12px', border: 'none', boxShadow: '0 10px 15px -3px rgb(0 0 0 / 0.1)' }}
                                    formatter={(value) => formatCurrency(Number(value))}
                                />
                                <Area
                                    type="monotone"
                                    dataKey="total"
                                    stroke="#0ea5e9"
                                    strokeWidth={3}
                                    fillOpacity={1}
                                    fill="url(#colorTotal)"
                                />
                            </AreaChart>
                        </ResponsiveContainer>
                    </CardContent>
                </Card>

                {/* Category Distribution */}
                <Card className="border-none shadow-sm shadow-slate-100/50 bg-white ring-1 ring-slate-100 flex flex-col">
                    <CardHeader>
                        <CardTitle className="text-lg font-black text-slate-800">Cơ cấu Sản phẩm</CardTitle>
                        <CardDescription>Phân bổ theo danh mục</CardDescription>
                    </CardHeader>
                    <CardContent className="flex-1 min-h-[300px] flex items-center justify-center">
                        <ResponsiveContainer width="100%" height="100%">
                            <PieChart>
                                <Pie
                                    data={charts.category_distribution}
                                    cx="50%"
                                    cy="50%"
                                    innerRadius={60}
                                    outerRadius={80}
                                    paddingAngle={5}
                                    dataKey="value"
                                >
                                    {charts.category_distribution.map((entry, index) => (
                                        <Cell key={`cell-${index}`} fill={COLORS[index % COLORS.length]} />
                                    ))}
                                </Pie>
                                <Tooltip />
                                <Legend verticalAlign="bottom" iconType="circle" />
                            </PieChart>
                        </ResponsiveContainer>
                    </CardContent>
                </Card>
            </div>

            <div className="grid grid-cols-1 lg:grid-cols-2 gap-8">
                {/* Top Products */}
                <Card className="border-none shadow-sm shadow-slate-100/50 bg-white ring-1 ring-slate-100 overflow-hidden">
                    <CardHeader className="flex flex-row items-center justify-between border-b border-slate-50">
                        <div>
                            <CardTitle className="text-lg font-black text-slate-800">Sản phẩm Bán chạy</CardTitle>
                            <CardDescription>Top 5 sản phẩm đạt hiệu suất tốt nhất</CardDescription>
                        </div>
                        <Trophy className="h-5 w-5 text-amber-500" />
                    </CardHeader>
                    <CardContent className="p-0">
                        <div className="divide-y divide-slate-50">
                            {top_products.map((product, index) => (
                                <div key={product.id} className="flex items-center gap-4 p-4 hover:bg-slate-50/50 transition-colors group">
                                    <div className={`h-8 w-8 rounded-full flex items-center justify-center font-black text-xs ${index === 0 ? 'bg-amber-100 text-amber-600' :
                                        index === 1 ? 'bg-slate-200 text-slate-600' :
                                            index === 2 ? 'bg-orange-100 text-orange-600' :
                                                'bg-slate-50 text-slate-400'
                                        }`}>
                                        {index + 1}
                                    </div>
                                    <div className="flex-1 min-w-0">
                                        <p className="text-sm font-bold text-slate-800 line-clamp-1 group-hover:text-primary transition-colors cursor-pointer">{product.ten_san_pham}</p>
                                        <p className="text-xs text-slate-400">ID: #{product.id}</p>
                                    </div>
                                    <div className="text-right">
                                        <p className="text-sm font-black text-slate-800">{product.total_sold}</p>
                                        <p className="text-[10px] font-bold text-slate-400 uppercase tracking-tighter">Đã bán</p>
                                    </div>
                                </div>
                            ))}
                        </div>
                    </CardContent>
                </Card>

                {/* Recent Activity */}
                <Card className="border-none shadow-sm shadow-slate-100/50 bg-white ring-1 ring-slate-100 flex flex-col h-full">
                    <CardHeader className="flex flex-row items-center justify-between border-b border-slate-50">
                        <div>
                            <CardTitle className="text-lg font-black text-slate-800">Hoạt động Gần đây</CardTitle>
                            <CardDescription>Các đơn hàng vừa được ghi nhận</CardDescription>
                        </div>
                        <Button variant="ghost" size="sm" className="text-xs font-bold text-primary hover:bg-primary/5">Xem tất cả</Button>
                    </CardHeader>
                    <CardContent className="p-0 flex-1 overflow-y-auto">
                        <div className="divide-y divide-slate-50">
                            {recent_orders.length > 0 ? recent_orders.map((order) => (
                                <div key={order.id} className="flex items-center gap-4 p-4 hover:bg-slate-50/50 transition-colors group">
                                    <div className="h-10 w-10 rounded-xl bg-slate-50 flex-shrink-0 flex items-center justify-center text-slate-400 group-hover:bg-primary/10 group-hover:text-primary transition-all">
                                        <ShoppingCart className="h-5 w-5" />
                                    </div>
                                    <div className="flex-1 min-w-0">
                                        <p className="text-sm font-bold text-slate-900 line-clamp-1">{order.khach_hang}</p>
                                        <p className="text-[10px] text-slate-500 flex items-center gap-2 mt-0.5">
                                            <span className="font-mono text-primary font-bold">{order.ma_don_hang}</span>
                                            <span className="opacity-30">•</span>
                                            <span>{order.thoi_gian}</span>
                                        </p>
                                    </div>
                                    <div className="text-right">
                                        <p className="text-sm font-black text-emerald-600">{formatCurrency(order.tong_tien)}</p>
                                        <span className={`text-[10px] px-2 py-0.5 rounded-full font-black uppercase tracking-tighter ${order.trang_thai === 'cho_xac_nhan' ? 'bg-amber-100 text-amber-600' :
                                            order.trang_thai === 'da_giao' ? 'bg-emerald-100 text-emerald-600' :
                                                'bg-slate-100 text-slate-500'
                                            }`}>
                                            {order.trang_thai.replace('_', ' ')}
                                        </span>
                                    </div>
                                </div>
                            )) : (
                                <div className="text-center py-12 text-slate-400 font-medium italic">Chưa có hoạt động mới</div>
                            )}
                        </div>
                    </CardContent>
                </Card>
            </div>
        </div>
    );
}

