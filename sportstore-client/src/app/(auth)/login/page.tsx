'use client';

import { useState } from 'react';
import { useMutation } from '@tanstack/react-query';
import { useRouter } from 'next/navigation';
import Link from 'next/link';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Card, CardHeader, CardContent, CardFooter, CardTitle, CardDescription } from '@/components/ui/card';
import { authService } from '@/services/auth.service';
import { useAuthStore } from '@/store/auth.store';

export default function LoginPage() {
    const router = useRouter();
    const setAuth = useAuthStore((state) => state.setAuth);

    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [errorMsg, setErrorMsg] = useState('');

    const loginMutation = useMutation({
        mutationFn: () => authService.login({ email, mat_khau: password }),
        onSuccess: (data) => {
            setAuth(data.user, data.token);
            router.push('/');
        },
        onError: (error: any) => {
            if (error?.errors) {
                const firstError = Object.values(error.errors)[0] as string[];
                setErrorMsg(firstError[0] || 'Dữ liệu không hợp lệ');
            } else {
                setErrorMsg(error?.message || 'Email hoặc mật khẩu không chính xác.');
            }
        },
    });

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        setErrorMsg('');
        loginMutation.mutate();
    };

    return (
        <div className="container mx-auto px-4 py-8 lg:py-12 flex items-center justify-center min-h-[85vh]">
            <div className="flex flex-col lg:flex-row w-full max-w-5xl rounded-3xl shadow-2xl overflow-hidden border border-slate-100 bg-white">

                {/* Left Side - Visual Banner */}
                <div className="hidden lg:flex lg:w-1/2 bg-slate-900 relative p-12 overflow-hidden group">
                    <div className="absolute inset-0 bg-gradient-to-br from-slate-900 via-slate-800 to-primary/40 z-10 opacity-90" />

                    {/* Decorative abstract elements */}
                    <div className="absolute -top-24 -left-24 w-64 h-64 rounded-full bg-primary/20 blur-3xl z-10" />
                    <div className="absolute -bottom-24 -right-24 w-80 h-80 rounded-full bg-blue-500/20 blur-3xl z-10" />

                    <div className="absolute inset-0 z-0">
                        {/* Optionally use a real sports background if available, fallback to a cool pattern or placeholder */}
                        <div className="w-full h-full bg-[url('/placeholder.png')] bg-cover bg-center opacity-20 mix-blend-luminosity group-hover:scale-105 transition-transform duration-[20s] ease-linear" />
                    </div>

                    <div className="relative z-20 text-white flex flex-col justify-between h-full w-full">
                        <div>
                            <Link href="/">
                                <span className="text-2xl font-black tracking-tighter cursor-pointer hover:text-primary transition-colors">
                                    SPORTSTORE
                                </span>
                            </Link>
                        </div>
                        <div className="mb-12">
                            <h2 className="text-5xl font-extrabold tracking-tight mb-6 leading-tight">
                                Vượt Qua<br />
                                Khởi Đầu Mới.
                            </h2>
                            <p className="text-lg text-slate-300 font-light max-w-sm leading-relaxed">
                                Nâng tầm phong cách thể thao của bạn. Đăng nhập để nhận ưu đãi và mua sắm dễ dàng hơn.
                            </p>
                        </div>
                    </div>
                </div>

                {/* Right Side - Form Container */}
                <div className="w-full lg:w-1/2 p-8 sm:p-12 lg:p-16 flex flex-col justify-center bg-white relative">
                    <div className="max-w-md w-full mx-auto space-y-8">
                        <div className="text-center lg:text-left space-y-2">
                            <h1 className="text-3xl font-bold tracking-tight text-slate-900">
                                Chào Mừng Trở Lại
                            </h1>
                            <p className="text-muted-foreground">
                                Vui lòng đăng nhập vào tài khoản của bạn.
                            </p>
                        </div>

                        <form onSubmit={handleSubmit} className="space-y-6">
                            {errorMsg && (
                                <div className="p-4 text-sm font-medium text-destructive bg-destructive/10 border border-destructive/20 rounded-xl animate-in fade-in slide-in-from-top-2">
                                    {errorMsg}
                                </div>
                            )}

                            <div className="space-y-4">
                                <div className="space-y-2">
                                    <label className="text-sm font-semibold text-slate-700" htmlFor="email">
                                        Email
                                    </label>
                                    <Input
                                        id="email"
                                        type="email"
                                        placeholder="Nhập email của bạn"
                                        required
                                        value={email}
                                        onChange={(e) => setEmail(e.target.value)}
                                        className="h-12 px-4 rounded-xl bg-slate-50 border-slate-200 focus:bg-white transition-colors"
                                    />
                                </div>

                                <div className="space-y-2">
                                    <div className="flex items-center justify-between">
                                        <label className="text-sm font-semibold text-slate-700" htmlFor="password">
                                            Mật khẩu
                                        </label>
                                        <Link href="#" className="text-sm font-medium text-primary hover:text-primary/80 transition-colors">
                                            Quên mật khẩu?
                                        </Link>
                                    </div>
                                    <Input
                                        id="password"
                                        type="password"
                                        placeholder="••••••••"
                                        required
                                        value={password}
                                        onChange={(e) => setPassword(e.target.value)}
                                        className="h-12 px-4 rounded-xl bg-slate-50 border-slate-200 focus:bg-white transition-colors"
                                    />
                                </div>
                            </div>

                            <Button
                                type="submit"
                                className="w-full h-12 text-base font-semibold rounded-xl shadow-lg shadow-primary/20 hover:shadow-primary/30 transition-all"
                                disabled={loginMutation.isPending}
                            >
                                {loginMutation.isPending ? 'Đang xác thực...' : 'Đăng Nhập'}
                            </Button>
                        </form>

                        <div className="text-center text-sm text-slate-600">
                            Bạn chưa có tài khoản?{' '}
                            <Link href="/register" className="font-bold text-primary hover:underline transition-all">
                                Hãy đăng ký ngay
                            </Link>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    );
}
