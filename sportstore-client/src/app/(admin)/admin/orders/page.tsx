'use client';

import { ShoppingBag } from "lucide-react";

export default function AdminOrdersPage() {
    return (
        <div className="flex flex-col items-center justify-center h-[60vh] text-slate-500">
            <div className="bg-white p-8 rounded-full shadow-sm border border-slate-100 mb-4 text-primary">
                <ShoppingBag className="h-12 w-12" />
            </div>
            <h1 className="text-xl font-bold text-slate-900 mb-2">Quản lý Đơn hàng</h1>
            <p className="italic">Tính năng này đang được phát triển...</p>
        </div>
    );
}
