'use client';

import { useForm } from "react-hook-form";
import { zodResolver } from "@hookform/resolvers/zod";
import * as z from "zod";
import {
    Form,
    FormControl,
    FormDescription,
    FormField,
    FormItem,
    FormLabel,
    FormMessage
} from "@/components/ui/form";
import { Input } from "@/components/ui/input";
import { Button } from "@/components/ui/button";
import { Textarea } from "@/components/ui/textarea";
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue
} from "@/components/ui/select";
import { Checkbox } from "@/components/ui/checkbox";
import { useAdminMetadata } from "@/hooks/useAdmin";
import { Loader2, Save, X } from "lucide-react";
import { useRouter } from "next/navigation";
import { Product } from "@/types/product.types";
import { toast } from "sonner";
import { adminService } from "@/services/admin.service";
import { useMutation, useQueryClient } from "@tanstack/react-query";

const productSchema = z.object({
    ten_san_pham: z.string().min(3, "Tên sản phẩm ít nhất 3 ký tự"),
    danh_muc_id: z.string().min(1, "Vui lòng chọn danh mục"),
    thuong_hieu_id: z.string().optional(),
    gia_goc: z.number().min(0, "Giá gốc không được âm"),
    gia_khuyen_mai: z.number().min(0).optional().nullable(),
    mo_ta_ngan: z.string().max(500, "Mô tả ngắn tối đa 500 ký tự").optional(),
    mo_ta_day_du: z.string().optional(),
    trang_thai: z.boolean(),
    noi_bat: z.boolean(),
});

type ProductFormValues = z.infer<typeof productSchema>;

interface ProductFormProps {
    initialData?: Product;
    isEdit?: boolean;
}

export function ProductForm({ initialData, isEdit = false }: ProductFormProps) {
    const { categories, brands, isLoading: isLoadingMetadata } = useAdminMetadata();
    const router = useRouter();
    const queryClient = useQueryClient();

    const form = useForm<ProductFormValues>({
        resolver: zodResolver(productSchema),
        defaultValues: initialData ? {
            ten_san_pham: initialData.ten_san_pham,
            danh_muc_id: initialData.danh_muc_id.toString(),
            thuong_hieu_id: initialData.thuong_hieu_id?.toString() || undefined,
            gia_goc: initialData.gia_goc,
            gia_khuyen_mai: initialData.gia_khuyen_mai,
            mo_ta_ngan: initialData.mo_ta_ngan || "",
            mo_ta_day_du: initialData.mo_ta_day_du || "",
            trang_thai: !!initialData.trang_thai,
            noi_bat: !!initialData.noi_bat,
        } : {
            ten_san_pham: "",
            danh_muc_id: "",
            thuong_hieu_id: undefined,
            gia_goc: 0,
            gia_khuyen_mai: null,
            mo_ta_ngan: "",
            mo_ta_day_du: "",
            trang_thai: true,
            noi_bat: false,
        },
    });

    const mutation = useMutation({
        mutationFn: (values: ProductFormValues) => {
            const data = {
                ...values,
                danh_muc_id: parseInt(values.danh_muc_id),
                thuong_hieu_id: values.thuong_hieu_id ? parseInt(values.thuong_hieu_id) : null,
            };
            return isEdit && initialData
                ? adminService.updateProduct(initialData.id, data)
                : adminService.createProduct(data);
        },
        onSuccess: () => {
            toast.success(isEdit ? "Cập nhật sản phẩm thành công" : "Tạo sản phẩm thành công");
            queryClient.invalidateQueries({ queryKey: ['admin', 'products'] });
            router.push("/admin/products");
            router.refresh();
        },
        onError: (error: any) => {
            toast.error(error.message || "Có lỗi xảy ra");
        }
    });

    const onSubmit = (values: ProductFormValues) => {
        mutation.mutate(values);
    };

    if (isLoadingMetadata) {
        return (
            <div className="flex items-center justify-center h-64">
                <Loader2 className="h-8 w-8 animate-spin text-primary" />
            </div>
        );
    }

    return (
        <Form {...form}>
            <form onSubmit={form.handleSubmit(onSubmit)} className="space-y-8 max-w-4xl">
                <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {/* Ten san pham */}
                    <FormField
                        control={form.control}
                        name="ten_san_pham"
                        render={({ field }) => (
                            <FormItem className="md:col-span-2">
                                <FormLabel>Tên sản phẩm</FormLabel>
                                <FormControl>
                                    <Input placeholder="Nhập tên sản phẩm..." {...field} />
                                </FormControl>
                                <FormMessage />
                            </FormItem>
                        )}
                    />

                    {/* Danh muc */}
                    <FormField
                        control={form.control}
                        name="danh_muc_id"
                        render={({ field }) => (
                            <FormItem>
                                <FormLabel>Danh mục</FormLabel>
                                <Select onValueChange={field.onChange} defaultValue={field.value}>
                                    <FormControl>
                                        <SelectTrigger>
                                            <SelectValue placeholder="Chọn danh mục" />
                                        </SelectTrigger>
                                    </FormControl>
                                    <SelectContent>
                                        {categories.map((cat: any) => (
                                            <SelectItem key={cat.id} value={cat.id.toString()}>
                                                {cat.ten}
                                            </SelectItem>
                                        ))}
                                    </SelectContent>
                                </Select>
                                <FormMessage />
                            </FormItem>
                        )}
                    />

                    {/* Thuong hieu */}
                    <FormField
                        control={form.control}
                        name="thuong_hieu_id"
                        render={({ field }) => (
                            <FormItem>
                                <FormLabel>Thương hiệu</FormLabel>
                                <Select onValueChange={field.onChange} defaultValue={field.value}>
                                    <FormControl>
                                        <SelectTrigger>
                                            <SelectValue placeholder="Chọn thương hiệu" />
                                        </SelectTrigger>
                                    </FormControl>
                                    <SelectContent>
                                        {brands.map((brand: any) => (
                                            <SelectItem key={brand.id} value={brand.id.toString()}>
                                                {brand.ten}
                                            </SelectItem>
                                        ))}
                                    </SelectContent>
                                </Select>
                                <FormMessage />
                            </FormItem>
                        )}
                    />

                    {/* Gia goc */}
                    <FormField
                        control={form.control}
                        name="gia_goc"
                        render={({ field }) => (
                            <FormItem>
                                <FormLabel>Giá gốc (₫)</FormLabel>
                                <FormControl>
                                    <Input
                                        type="number"
                                        {...field}
                                        onChange={(e) => field.onChange(parseFloat(e.target.value) || 0)}
                                    />
                                </FormControl>
                                <FormMessage />
                            </FormItem>
                        )}
                    />

                    {/* Gia khuyen mai */}
                    <FormField
                        control={form.control}
                        name="gia_khuyen_mai"
                        render={({ field }) => (
                            <FormItem>
                                <FormLabel>Giá khuyến mãi (₫)</FormLabel>
                                <FormControl>
                                    <Input
                                        type="number"
                                        {...field}
                                        value={field.value || ""}
                                        onChange={(e) => {
                                            const val = e.target.value;
                                            field.onChange(val === "" ? null : parseFloat(val));
                                        }}
                                    />
                                </FormControl>
                                <FormDescription>Để trống nếu không giảm giá</FormDescription>
                                <FormMessage />
                            </FormItem>
                        )}
                    />

                    {/* Mo ta ngan */}
                    <FormField
                        control={form.control}
                        name="mo_ta_ngan"
                        render={({ field }) => (
                            <FormItem className="md:col-span-2">
                                <FormLabel>Mô tả ngắn</FormLabel>
                                <FormControl>
                                    <Textarea
                                        placeholder="Tóm tắt đặc điểm nổi bật..."
                                        className="h-20"
                                        {...field}
                                    />
                                </FormControl>
                                <FormMessage />
                            </FormItem>
                        )}
                    />

                    {/* Mo ta day du */}
                    <FormField
                        control={form.control}
                        name="mo_ta_day_du"
                        render={({ field }) => (
                            <FormItem className="md:col-span-2">
                                <FormLabel>Mô tả chi tiết</FormLabel>
                                <FormControl>
                                    <Textarea
                                        placeholder="Thông tin chi tiết kỹ thuật, chất liệu..."
                                        className="min-h-[200px]"
                                        {...field}
                                    />
                                </FormControl>
                                <FormMessage />
                            </FormItem>
                        )}
                    />

                    {/* Switches */}
                    <div className="flex gap-8 md:col-span-2 bg-slate-50 p-4 rounded-lg border border-slate-100">
                        <FormField
                            control={form.control}
                            name="trang_thai"
                            render={({ field }) => (
                                <FormItem className="flex flex-row items-start space-x-3 space-y-0">
                                    <FormControl>
                                        <Checkbox
                                            checked={field.value}
                                            onCheckedChange={field.onChange}
                                        />
                                    </FormControl>
                                    <div className="space-y-1 leading-none">
                                        <FormLabel>Mở bán ngay</FormLabel>
                                        <p className="text-xs text-slate-500 italic">Hiện sản phẩm trên cửa hàng</p>
                                    </div>
                                </FormItem>
                            )}
                        />

                        <FormField
                            control={form.control}
                            name="noi_bat"
                            render={({ field }) => (
                                <FormItem className="flex flex-row items-start space-x-3 space-y-0">
                                    <FormControl>
                                        <Checkbox
                                            checked={field.value}
                                            onCheckedChange={field.onChange}
                                        />
                                    </FormControl>
                                    <div className="space-y-1 leading-none">
                                        <FormLabel>Sản phẩm nổi bật</FormLabel>
                                        <p className="text-xs text-slate-500 italic">Đưa lên trang chủ</p>
                                    </div>
                                </FormItem>
                            )}
                        />
                    </div>
                </div>

                <div className="flex items-center gap-4 pt-4 border-t border-slate-100">
                    <Button
                        type="submit"
                        disabled={mutation.isPending}
                        className="min-w-[140px]"
                    >
                        {mutation.isPending ? (
                            <>
                                <Loader2 className="mr-2 h-4 w-4 animate-spin" />
                                Đang lưu...
                            </>
                        ) : (
                            <>
                                <Save className="mr-2 h-4 w-4" />
                                {isEdit ? "Cập nhật" : "Tạo sản phẩm"}
                            </>
                        )}
                    </Button>
                    <Button
                        type="button"
                        variant="ghost"
                        onClick={() => router.back()}
                        disabled={mutation.isPending}
                    >
                        <X className="mr-2 h-4 w-4" /> Hủy
                    </Button>
                </div>
            </form>
        </Form>
    );
}
