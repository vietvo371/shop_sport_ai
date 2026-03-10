'use client';

import { useAdminProducts } from "@/hooks/useAdmin";
import { adminService, adminKeys } from "@/services/admin.service";
import { useMutation, useQueryClient } from "@tanstack/react-query";
import { toast } from "sonner";
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow
} from "@/components/ui/table";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import {
    Plus,
    Search,
    MoreHorizontal,
    Edit,
    Trash2,
    Eye,
    ChevronLeft,
    ChevronRight,
    Loader2
} from "lucide-react";
import Image from "next/image";
import Link from "next/link";
import { formatCurrency } from "@/lib/utils";
import { useState } from "react";
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from "@/components/ui/dropdown-menu";
import { Badge } from "@/components/ui/badge";

export default function AdminProductsPage() {
    const [page, setPage] = useState(1);
    const { data: response, isLoading } = useAdminProducts(page);
    const queryClient = useQueryClient();

    const deleteMutation = useMutation({
        mutationFn: (id: number) => adminService.deleteProduct(id),
        onSuccess: () => {
            queryClient.invalidateQueries({ queryKey: [...adminKeys.all, 'products'] });
            toast.success("Xóa sản phẩm thành công");
        },
        onError: () => {
            toast.error("Có lỗi xảy ra khi xóa sản phẩm");
        }
    });

    const handleDelete = (id: number) => {
        if (window.confirm("Bạn có chắc chắn muốn xóa sản phẩm này?")) {
            deleteMutation.mutate(id);
        }
    };

    const products = response?.data || [];
    const meta = response?.meta;

    return (
        <div className="space-y-6">
            <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h1 className="text-2xl font-bold text-slate-900">Quản lý Sản phẩm</h1>
                    <p className="text-slate-500 text-sm italic">Danh sách toàn bộ sản phẩm trong hệ thống.</p>
                </div>
                <Button asChild className="shadow-lg shadow-primary/20">
                    <Link href="/admin/products/new">
                        <Plus className="h-4 w-4 mr-2" /> Thêm sản phẩm
                    </Link>
                </Button>
            </div>

            {/* Filters & Search */}
            <div className="flex gap-4 items-center bg-white p-4 rounded-xl shadow-sm border border-slate-100">
                <div className="relative flex-1 max-w-sm">
                    <Search className="absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-slate-400" />
                    <Input
                        placeholder="Tìm tên sản phẩm..."
                        className="pl-10 bg-slate-50 border-none focus-visible:ring-1 focus-visible:ring-slate-200"
                    />
                </div>
                {/* Add category filter here later */}
            </div>

            {/* Products Table */}
            <div className="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
                {isLoading ? (
                    <div className="flex items-center justify-center h-64">
                        <Loader2 className="h-8 w-8 animate-spin text-primary" />
                    </div>
                ) : (
                    <>
                        <Table>
                            <TableHeader className="bg-slate-50/50">
                                <TableRow>
                                    <TableHead className="w-[80px]">Ảnh</TableHead>
                                    <TableHead>Tên sản phẩm</TableHead>
                                    <TableHead>Danh mục</TableHead>
                                    <TableHead>Giá gốc</TableHead>
                                    <TableHead>Giá KM</TableHead>
                                    <TableHead>Trạng thái</TableHead>
                                    <TableHead className="text-right">Thao tác</TableHead>
                                </TableRow>
                            </TableHeader>
                            <TableBody>
                                {products.length > 0 ? products.map((product) => (
                                    <TableRow key={product.id} className="hover:bg-slate-50/50 transition-colors group">
                                        <TableCell>
                                            <div className="relative h-12 w-12 rounded-lg overflow-hidden border border-slate-100 bg-slate-50">
                                                <Image
                                                    src={product.anh_chinh?.duong_dan_anh || '/placeholder.png'}
                                                    alt={product.ten_san_pham}
                                                    fill
                                                    className="object-cover group-hover:scale-110 transition-transform duration-300"
                                                />
                                            </div>
                                        </TableCell>
                                        <TableCell>
                                            <div className="flex flex-col">
                                                <span className="font-bold text-slate-900 group-hover:text-primary transition-colors line-clamp-1">
                                                    {product.ten_san_pham}
                                                </span>
                                                <span className="text-[10px] text-slate-400 font-mono tracking-tighter uppercase">
                                                    ID: {product.id} • Slug: {product.duong_dan}
                                                </span>
                                            </div>
                                        </TableCell>
                                        <TableCell>
                                            <Badge variant="secondary" className="bg-slate-100 text-slate-600 border-none font-medium">
                                                {product.danh_muc?.ten}
                                            </Badge>
                                        </TableCell>
                                        <TableCell className="font-medium text-slate-600">
                                            {formatCurrency(product.gia_goc)}
                                        </TableCell>
                                        <TableCell className="font-bold text-primary">
                                            {product.gia_khuyen_mai ? formatCurrency(product.gia_khuyen_mai) : '-'}
                                        </TableCell>
                                        <TableCell>
                                            <Badge className={product.trang_thai
                                                ? "bg-emerald-50 text-emerald-600 border-emerald-100"
                                                : "bg-rose-50 text-rose-600 border-rose-100"}>
                                                {product.trang_thai ? 'Mở bán' : 'Ẩn'}
                                            </Badge>
                                        </TableCell>
                                        <TableCell className="text-right">
                                            <DropdownMenu>
                                                <DropdownMenuTrigger asChild>
                                                    <Button variant="ghost" className="h-8 w-8 p-0">
                                                        <MoreHorizontal className="h-4 w-4" />
                                                    </Button>
                                                </DropdownMenuTrigger>
                                                <DropdownMenuContent align="end" className="w-40 p-1">
                                                    <DropdownMenuLabel className="text-[10px] uppercase text-slate-400 px-2 py-1.5">Hành động</DropdownMenuLabel>
                                                    <DropdownMenuItem asChild>
                                                        <Link href={`/products/${product.duong_dan}`} target="_blank" className="flex items-center">
                                                            <Eye className="mr-2 h-4 w-4" /> Xem shop
                                                        </Link>
                                                    </DropdownMenuItem>
                                                    <DropdownMenuItem asChild>
                                                        <Link href={`/admin/products/${product.id}`} className="flex items-center">
                                                            <Edit className="mr-2 h-4 w-4" /> Chỉnh sửa
                                                        </Link>
                                                    </DropdownMenuItem>
                                                    <DropdownMenuSeparator />
                                                    <DropdownMenuItem
                                                        className="text-rose-600 focus:text-rose-600 focus:bg-rose-50 cursor-pointer"
                                                        onClick={() => handleDelete(product.id)}
                                                        disabled={deleteMutation.isPending}
                                                    >
                                                        <Trash2 className="mr-2 h-4 w-4" /> Xóa sản phẩm
                                                    </DropdownMenuItem>
                                                </DropdownMenuContent>
                                            </DropdownMenu>
                                        </TableCell>
                                    </TableRow>
                                )) : (
                                    <TableRow>
                                        <TableCell colSpan={7} className="h-32 text-center text-slate-400 italic">
                                            Không có sản phẩm nào
                                        </TableCell>
                                    </TableRow>
                                )}
                            </TableBody>
                        </Table>

                        {/* Pagination */}
                        {meta && meta.last_page > 1 && (
                            <div className="p-4 border-t border-slate-50 bg-slate-50/30 flex items-center justify-between">
                                <p className="text-xs text-slate-500 italic">
                                    Hiển thị {products.length} trên tổng số {meta.total} sản phẩm
                                </p>
                                <div className="flex items-center gap-1">
                                    <Button
                                        variant="outline"
                                        size="icon"
                                        className="h-8 w-8"
                                        disabled={page === 1}
                                        onClick={() => setPage(p => p - 1)}
                                    >
                                        <ChevronLeft className="h-4 w-4" />
                                    </Button>
                                    <div className="flex items-center gap-1 px-4 text-sm font-bold text-slate-700">
                                        Trang {page} / {meta.last_page}
                                    </div>
                                    <Button
                                        variant="outline"
                                        size="icon"
                                        className="h-8 w-8"
                                        disabled={page === meta.last_page}
                                        onClick={() => setPage(p => p + 1)}
                                    >
                                        <ChevronRight className="h-4 w-4" />
                                    </Button>
                                </div>
                            </div>
                        )}
                    </>
                )}
            </div>
        </div>
    );
}
