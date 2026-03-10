'use client';

import Link from 'next/link';
import { usePathname } from 'next/navigation';
import {
    LayoutDashboard,
    Package,
    ShoppingCart,
    Star,
    Ticket,
    Users,
    Settings,
    Home
} from 'lucide-react';
import { cn } from '@/lib/utils';

const sidebarItems = [
    { name: 'Dashboard', href: '/admin', icon: LayoutDashboard },
    { name: 'Sản phẩm', href: '/admin/products', icon: Package },
    { name: 'Đơn hàng', href: '/admin/orders', icon: ShoppingCart },
    { name: 'Đánh giá', href: '/admin/reviews', icon: Star },
    { name: 'Mã giảm giá', href: '/admin/coupons', icon: Ticket },
    { name: 'Người dùng', href: '/admin/users', icon: Users },
];

export function AdminSidebar() {
    const pathname = usePathname();

    return (
        <aside className="w-64 bg-slate-900 text-slate-300 flex flex-col h-screen sticky top-0 border-r border-slate-800">
            <div className="p-6 border-b border-slate-800">
                <Link href="/" className="flex items-center gap-2 group">
                    <span className="text-xl font-bold tracking-tighter text-white group-hover:text-primary transition-colors">
                        SPORTSTORE <span className="text-xs text-primary block mt-1">ADMIN PORTAL</span>
                    </span>
                </Link>
            </div>

            <nav className="flex-1 p-4 space-y-1">
                {sidebarItems.map((item) => {
                    const isActive = pathname === item.href;
                    return (
                        <Link
                            key={item.href}
                            href={item.href}
                            className={cn(
                                "flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-all",
                                isActive
                                    ? "bg-primary text-white shadow-lg shadow-primary/20"
                                    : "hover:bg-slate-800 hover:text-white"
                            )}
                        >
                            <item.icon className={cn("h-5 w-5", isActive ? "text-white" : "text-slate-400")} />
                            {item.name}
                        </Link>
                    );
                })}
            </nav>

            <div className="p-4 mt-auto border-t border-slate-800">
                <Link
                    href="/"
                    className="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium hover:bg-slate-800 hover:text-white transition-all text-slate-400"
                >
                    <Home className="h-5 w-5" />
                    Quay lại Cửa hàng
                </Link>
                <div className="mt-4 px-4 py-3 rounded-lg bg-slate-800/50 border border-slate-700/50">
                    <p className="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Phiên bản</p>
                    <p className="text-xs text-slate-400">SportStore Admin v1.0</p>
                </div>
            </div>
        </aside>
    );
}
