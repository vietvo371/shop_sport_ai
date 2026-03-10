'use client';

import { useAuthStore } from "@/store/auth.store";
import { useRouter } from "next/navigation";
import { useEffect, useState } from "react";
import { AdminSidebar } from "@/components/admin/AdminSidebar";
import { Loader2 } from "lucide-react";

export default function AdminLayout({
    children,
}: {
    children: React.ReactNode;
}) {
    const { user, isAuthenticated } = useAuthStore();
    const router = useRouter();
    const [isAuthorized, setIsAuthorized] = useState(false);

    useEffect(() => {
        // Wait for hydration and check auth
        if (!isAuthenticated) {
            router.push("/login?callbackUrl=/admin");
            return;
        }

        if (user?.vai_tro !== "quan_tri") {
            router.push("/");
            return;
        }

        setIsAuthorized(true);
    }, [isAuthenticated, user, router]);

    if (!isAuthorized) {
        return (
            <div className="flex h-screen w-full items-center justify-center bg-slate-50">
                <div className="text-center space-y-4">
                    <Loader2 className="h-10 w-10 animate-spin text-primary mx-auto" />
                    <p className="text-slate-500 font-medium">Đang xác thực quyền truy cập...</p>
                </div>
            </div>
        );
    }

    return (
        <div className="flex min-h-screen bg-slate-50">
            <AdminSidebar />
            <div className="flex-1 flex flex-col">
                <header className="h-16 bg-white border-b border-slate-200 sticky top-0 z-30 flex items-center px-8 justify-between">
                    <h2 className="text-sm font-semibold text-slate-500 uppercase tracking-widest">Hệ thống quản trị</h2>
                    <div className="flex items-center gap-4">
                        <span className="text-sm font-medium text-slate-700">{user?.ho_va_ten}</span>
                        <div className="h-8 w-8 rounded-full bg-primary/10 text-primary flex items-center justify-center text-xs font-bold ring-2 ring-white">
                            {user?.ho_va_ten?.charAt(0) || 'A'}
                        </div>
                    </div>
                </header>
                <main className="p-8 flex-1">
                    {children}
                </main>
            </div>
        </div>
    );
}
