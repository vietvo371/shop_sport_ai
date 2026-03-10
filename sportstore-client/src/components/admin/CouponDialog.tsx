'use client';

import { useEffect } from "react";
import { useForm } from "react-hook-form";
import { zodResolver } from "@hookform/resolvers/zod";
import * as z from "zod";
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogHeader,
    DialogTitle,
    DialogFooter,
} from "@/components/ui/dialog";
import {
    Form,
    FormControl,
    FormField,
    FormItem,
    FormLabel,
    FormMessage,
} from "@/components/ui/form";
import { Input } from "@/components/ui/input";
import { Button } from "@/components/ui/button";
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from "@/components/ui/select";
import { useCreateCoupon, useUpdateCoupon } from "@/hooks/useAdminCoupons";
import { Loader2, Ticket, Calculator, Banknote, Calendar } from "lucide-react";

const couponSchema = z.object({
    ma_code: z.string().min(3, "Mã code phải có ít nhất 3 ký tự").max(50),
    loai_giam: z.enum(["phan_tram", "so_tien_co_dinh"]),
    gia_tri: z.coerce.number().min(0, "Giá trị không được âm"),
    gia_tri_don_hang_min: z.coerce.number().min(0).optional(),
    gioi_han_su_dung: z.coerce.number().min(1, "Giới hạn sử dụng phải ít nhất là 1").optional(),
    bat_dau_luc: z.string().optional(),
    het_han_luc: z.string().optional(),
}).refine((data) => {
    if (data.bat_dau_luc && data.het_han_luc) {
        return new Date(data.het_han_luc) > new Date(data.bat_dau_luc);
    }
    return true;
}, {
    message: "Ngày hết hạn phải sau ngày bắt đầu",
    path: ["het_han_luc"],
});

interface CouponDialogProps {
    open: boolean;
    onOpenChange: (open: boolean) => void;
    coupon?: any;
}

export function CouponDialog({ open, onOpenChange, coupon }: CouponDialogProps) {
    const isEdit = !!coupon;
    const createCoupon = useCreateCoupon();
    const updateCoupon = useUpdateCoupon();

    const form = useForm<z.infer<typeof couponSchema>>({
        resolver: zodResolver(couponSchema),
        defaultValues: {
            ma_code: "",
            loai_giam: "phan_tram",
            gia_tri: 0,
            gia_tri_don_hang_min: 0,
            gioi_han_su_dung: 100,
            bat_dau_luc: "",
            het_han_luc: "",
        },
    });

    useEffect(() => {
        if (coupon && open) {
            form.reset({
                ma_code: coupon.ma_code,
                loai_giam: coupon.loai_giam,
                gia_tri: coupon.gia_tri,
                gia_tri_don_hang_min: coupon.gia_tri_don_hang_min || 0,
                gioi_han_su_dung: coupon.gioi_han_su_dung || 100,
                bat_dau_luc: coupon.bat_dau_luc ? new Date(coupon.bat_dau_luc).toISOString().split('T')[0] : "",
                het_han_luc: coupon.het_han_luc ? new Date(coupon.het_han_luc).toISOString().split('T')[0] : "",
            });
        } else if (!isEdit && open) {
            form.reset({
                ma_code: "",
                loai_giam: "phan_tram",
                gia_tri: 0,
                gia_tri_don_hang_min: 0,
                gioi_han_su_dung: 100,
                bat_dau_luc: new Date().toISOString().split('T')[0],
                het_han_luc: "",
            });
        }
    }, [coupon, open, form, isEdit]);

    const onSubmit = async (values: z.infer<typeof couponSchema>) => {
        if (isEdit) {
            await updateCoupon.mutateAsync({ id: coupon.id, data: values });
        } else {
            await createCoupon.mutateAsync(values);
        }
        onOpenChange(false);
    };

    const isPending = createCoupon.isPending || updateCoupon.isPending;

    return (
        <Dialog open={open} onOpenChange={onOpenChange}>
            <DialogContent className="sm:max-w-[550px] rounded-[2.5rem] p-0 overflow-hidden border-none shadow-2xl">
                <div className="bg-slate-900 p-8 text-white relative overflow-hidden">
                    <div className="absolute top-0 right-0 w-64 h-64 bg-primary/20 rounded-full blur-3xl -mr-32 -mt-32" />
                    <div className="relative z-10 space-y-2">
                        <div className="flex items-center gap-3">
                            <div className="h-12 w-12 rounded-2xl bg-white/10 flex items-center justify-center backdrop-blur-md border border-white/10 shadow-lg">
                                <Ticket className="h-6 w-6 text-primary" />
                            </div>
                            <DialogTitle className="text-2xl font-black tracking-tight uppercase">
                                {isEdit ? "Chỉnh sửa mã" : "Tạo mã giảm giá"}
                            </DialogTitle>
                        </div>
                        <DialogDescription className="text-slate-400 font-medium">
                            {isEdit ? "Cập nhật thông tin và điều kiện áp dụng cho mã giảm giá" : "Thiết lập mã code và các chương trình ưu đãi mới cho cửa hàng"}
                        </DialogDescription>
                    </div>
                </div>

                <div className="p-8 pb-10">
                    <Form {...form}>
                        <form onSubmit={form.handleSubmit(onSubmit)} className="space-y-6">
                            <div className="grid grid-cols-2 gap-6">
                                <FormField
                                    control={form.control}
                                    name="ma_code"
                                    render={({ field }) => (
                                        <FormItem className="col-span-2">
                                            <FormLabel className="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Mã giảm giá (Code)</FormLabel>
                                            <FormControl>
                                                <div className="relative group">
                                                    <Ticket className="absolute left-4 top-1/2 -translate-y-1/2 h-4 w-4 text-slate-400 group-focus-within:text-primary transition-colors" />
                                                    <Input
                                                        placeholder="Vd: SUMMER2025"
                                                        {...field}
                                                        className="pl-11 h-12 bg-slate-50 border-slate-100 rounded-2xl font-bold text-slate-900 focus-visible:ring-primary/20 focus-visible:border-primary/30 uppercase"
                                                        disabled={isEdit}
                                                    />
                                                </div>
                                            </FormControl>
                                            <FormMessage className="text-[10px] font-bold" />
                                        </FormItem>
                                    )}
                                />

                                <FormField
                                    control={form.control}
                                    name="loai_giam"
                                    render={({ field }) => (
                                        <FormItem>
                                            <FormLabel className="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Loại giảm</FormLabel>
                                            <Select onValueChange={field.onChange} defaultValue={field.value}>
                                                <FormControl>
                                                    <SelectTrigger className="h-12 bg-slate-50 border-slate-100 rounded-2xl font-bold text-slate-900 focus:ring-primary/20">
                                                        <SelectValue placeholder="Chọn loại giảm" />
                                                    </SelectTrigger>
                                                </FormControl>
                                                <SelectContent className="rounded-2xl border-slate-100 shadow-xl">
                                                    <SelectItem value="phan_tram" className="rounded-xl font-bold py-3">
                                                        <div className="flex items-center gap-2">
                                                            <Calculator className="h-4 w-4 text-primary" />
                                                            Phần trăm (%)
                                                        </div>
                                                    </SelectItem>
                                                    <SelectItem value="so_tien_co_dinh" className="rounded-xl font-bold py-3">
                                                        <div className="flex items-center gap-2">
                                                            <Banknote className="h-4 w-4 text-emerald-500" />
                                                            Số tiền (VNĐ)
                                                        </div>
                                                    </SelectItem>
                                                </SelectContent>
                                            </Select>
                                            <FormMessage className="text-[10px] font-bold" />
                                        </FormItem>
                                    )}
                                />

                                <FormField
                                    control={form.control}
                                    name="gia_tri"
                                    render={({ field }) => (
                                        <FormItem>
                                            <FormLabel className="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Mức giảm</FormLabel>
                                            <FormControl>
                                                <Input
                                                    type="number"
                                                    {...field}
                                                    className="h-12 bg-slate-50 border-slate-100 rounded-2xl font-bold text-slate-900 focus-visible:ring-primary/20 focus-visible:border-primary/30"
                                                />
                                            </FormControl>
                                            <FormMessage className="text-[10px] font-bold" />
                                        </FormItem>
                                    )}
                                />

                                <FormField
                                    control={form.control}
                                    name="gia_tri_don_hang_min"
                                    render={({ field }) => (
                                        <FormItem>
                                            <FormLabel className="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Đơn tối thiểu</FormLabel>
                                            <FormControl>
                                                <Input
                                                    type="number"
                                                    {...field}
                                                    className="h-12 bg-slate-50 border-slate-100 rounded-2xl font-bold text-slate-900 focus-visible:ring-primary/20 focus-visible:border-primary/30"
                                                />
                                            </FormControl>
                                            <FormMessage className="text-[10px] font-bold" />
                                        </FormItem>
                                    )}
                                />

                                <FormField
                                    control={form.control}
                                    name="gioi_han_su_dung"
                                    render={({ field }) => (
                                        <FormItem>
                                            <FormLabel className="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Tổng lượt dùng</FormLabel>
                                            <FormControl>
                                                <Input
                                                    type="number"
                                                    {...field}
                                                    className="h-12 bg-slate-50 border-slate-100 rounded-2xl font-bold text-slate-900 focus-visible:ring-primary/20 focus-visible:border-primary/30"
                                                />
                                            </FormControl>
                                            <FormMessage className="text-[10px] font-bold" />
                                        </FormItem>
                                    )}
                                />

                                <FormField
                                    control={form.control}
                                    name="bat_dau_luc"
                                    render={({ field }) => (
                                        <FormItem>
                                            <FormLabel className="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Ngày bắt đầu</FormLabel>
                                            <FormControl>
                                                <div className="relative group">
                                                    <Calendar className="absolute left-4 top-1/2 -translate-y-1/2 h-4 w-4 text-slate-400 group-focus-within:text-primary transition-colors pointer-events-none" />
                                                    <Input
                                                        type="date"
                                                        {...field}
                                                        className="pl-11 h-12 bg-slate-50 border-slate-100 rounded-2xl font-bold text-slate-900 focus-visible:ring-primary/20 focus-visible:border-primary/30"
                                                    />
                                                </div>
                                            </FormControl>
                                            <FormMessage className="text-[10px] font-bold" />
                                        </FormItem>
                                    )}
                                />

                                <FormField
                                    control={form.control}
                                    name="het_han_luc"
                                    render={({ field }) => (
                                        <FormItem>
                                            <FormLabel className="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Ngày hết hạn</FormLabel>
                                            <FormControl>
                                                <div className="relative group">
                                                    <Calendar className="absolute left-4 top-1/2 -translate-y-1/2 h-4 w-4 text-slate-400 group-focus-within:text-error transition-colors pointer-events-none" />
                                                    <Input
                                                        type="date"
                                                        {...field}
                                                        className="pl-11 h-12 bg-slate-50 border-slate-100 rounded-2xl font-bold text-slate-900 focus-visible:ring-primary/20 focus-visible:border-primary/30"
                                                    />
                                                </div>
                                            </FormControl>
                                            <FormMessage className="text-[10px] font-bold" />
                                        </FormItem>
                                    )}
                                />
                            </div>

                            <DialogFooter className="mt-8 gap-3 sm:justify-start">
                                <Button
                                    type="submit"
                                    className="h-14 flex-1 rounded-[1.25rem] bg-slate-900 hover:bg-slate-800 text-white font-black text-sm uppercase tracking-widest shadow-xl shadow-slate-200 transition-all active:scale-95 disabled:opacity-50"
                                    disabled={isPending}
                                >
                                    {isPending ? <Loader2 className="h-5 w-5 animate-spin mr-2" /> : null}
                                    {isEdit ? "Cập nhật mã" : "Kích hoạt mã ngay"}
                                </Button>
                                <Button
                                    type="button"
                                    variant="outline"
                                    className="h-14 rounded-[1.25rem] border-slate-100 font-black text-xs uppercase tracking-widest text-slate-500 hover:bg-slate-50 transition-all px-8"
                                    onClick={() => onOpenChange(false)}
                                >
                                    Hủy bỏ
                                </Button>
                            </DialogFooter>
                        </form>
                    </Form>
                </div>
            </DialogContent>
        </Dialog>
    );
}
