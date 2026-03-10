'use client';

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
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from "@/components/ui/select";
import { Switch } from "@/components/ui/switch";
import { Button } from "@/components/ui/button";
import { useUpdateUser } from "@/hooks/useAdminUsers";
import { Loader2, ShieldCheck, UserCog, Ban, CheckCircle2 } from "lucide-react";
import { useEffect } from "react";

const userSchema = z.object({
    vai_tro: z.enum(["khach_hang", "quan_tri"]),
    trang_thai: z.boolean(),
});

interface UserEditDialogProps {
    open: boolean;
    onOpenChange: (open: boolean) => void;
    user: any;
}

export function UserEditDialog({ open, onOpenChange, user }: UserEditDialogProps) {
    const updateUser = useUpdateUser();

    const form = useForm<z.infer<typeof userSchema>>({
        resolver: zodResolver(userSchema),
        defaultValues: {
            vai_tro: "khach_hang",
            trang_thai: true,
        },
    });

    useEffect(() => {
        if (user && open) {
            form.reset({
                vai_tro: user.vai_tro,
                trang_thai: user.trang_thai,
            });
        }
    }, [user, open, form]);

    const onSubmit = async (values: z.infer<typeof userSchema>) => {
        await updateUser.mutateAsync({ id: user.id, data: values });
        onOpenChange(false);
    };

    return (
        <Dialog open={open} onOpenChange={onOpenChange}>
            <DialogContent className="sm:max-w-[450px] rounded-[2.5rem] p-0 overflow-hidden border-none shadow-2xl">
                <div className="bg-slate-900 p-8 text-white relative overflow-hidden">
                    <div className="absolute top-0 right-0 w-64 h-64 bg-primary/20 rounded-full blur-3xl -mr-32 -mt-32" />
                    <div className="relative z-10 space-y-2">
                        <div className="flex items-center gap-3">
                            <div className="h-12 w-12 rounded-2xl bg-white/10 flex items-center justify-center backdrop-blur-md border border-white/10 shadow-lg">
                                <UserCog className="h-6 w-6 text-primary" />
                            </div>
                            <DialogTitle className="text-2xl font-black tracking-tight uppercase">
                                Thiết lập tài khoản
                            </DialogTitle>
                        </div>
                        <DialogDescription className="text-slate-400 font-medium">
                            Chỉnh sửa quyền hạn và trạng thái hoạt động của người dùng
                        </DialogDescription>
                    </div>
                </div>

                <div className="p-8">
                    <Form {...form}>
                        <form onSubmit={form.handleSubmit(onSubmit)} className="space-y-8">
                            <div className="space-y-6">
                                <div className="flex items-center gap-4 p-4 bg-slate-50 rounded-2xl border border-slate-100">
                                    <div className="h-10 w-10 rounded-full bg-white flex items-center justify-center border border-slate-200 shadow-sm overflow-hidden">
                                        {user?.anh_dai_dien ? (
                                            <img src={user.anh_dai_dien} alt={user.ho_va_ten} className="h-full w-full object-cover" />
                                        ) : (
                                            <span className="font-black text-slate-400 text-xs">{user?.ho_va_ten?.charAt(0)}</span>
                                        )}
                                    </div>
                                    <div className="flex flex-col">
                                        <span className="font-black text-slate-900 text-sm leading-none">{user?.ho_va_ten}</span>
                                        <span className="text-[10px] font-bold text-slate-400 mt-1 uppercase tracking-wider">{user?.email}</span>
                                    </div>
                                </div>

                                <FormField
                                    control={form.control}
                                    name="vai_tro"
                                    render={({ field }) => (
                                        <FormItem>
                                            <FormLabel className="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Vai trò hệ thống</FormLabel>
                                            <Select onValueChange={field.onChange} defaultValue={field.value} value={field.value}>
                                                <FormControl>
                                                    <SelectTrigger className="h-14 bg-slate-50 border-slate-100 rounded-2xl font-bold text-slate-900 focus:ring-primary/20 transition-all">
                                                        <SelectValue placeholder="Chọn vai trò" />
                                                    </SelectTrigger>
                                                </FormControl>
                                                <SelectContent className="rounded-2xl border-slate-100 shadow-xl p-1">
                                                    <SelectItem value="khach_hang" className="rounded-xl font-bold py-3 px-4 focus:bg-slate-50">
                                                        <div className="flex items-center gap-3">
                                                            <div className="h-8 w-8 rounded-lg bg-blue-50 flex items-center justify-center text-blue-500">
                                                                <CheckCircle2 className="h-4 w-4" />
                                                            </div>
                                                            <span>Khách hàng</span>
                                                        </div>
                                                    </SelectItem>
                                                    <SelectItem value="quan_tri" className="rounded-xl font-bold py-3 px-4 focus:bg-slate-50">
                                                        <div className="flex items-center gap-3">
                                                            <div className="h-8 w-8 rounded-lg bg-amber-50 flex items-center justify-center text-amber-500">
                                                                <ShieldCheck className="h-4 w-4" />
                                                            </div>
                                                            <span>Quản trị viên</span>
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
                                    name="trang_thai"
                                    render={({ field }) => (
                                        <FormItem className="flex items-center justify-between p-5 bg-slate-50 rounded-2xl border border-slate-100">
                                            <div className="space-y-0.5">
                                                <FormLabel className="text-sm font-black text-slate-900">Trạng thái tài khoản</FormLabel>
                                                <div className="flex items-center gap-2">
                                                    {field.value ? (
                                                        <span className="text-[10px] font-black text-emerald-500 uppercase flex items-center gap-1.5">
                                                            <CheckCircle2 className="h-3 w-3" /> Tài khoản đang hoạt động
                                                        </span>
                                                    ) : (
                                                        <span className="text-[10px] font-black text-rose-500 uppercase flex items-center gap-1.5">
                                                            <Ban className="h-3 w-3" /> Tài khoản đang bị khoá
                                                        </span>
                                                    )}
                                                </div>
                                            </div>
                                            <FormControl>
                                                <Switch
                                                    checked={field.value}
                                                    onCheckedChange={field.onChange}
                                                    className="data-[state=checked]:bg-emerald-500"
                                                />
                                            </FormControl>
                                        </FormItem>
                                    )}
                                />
                            </div>

                            <DialogFooter className="gap-3 sm:justify-start">
                                <Button
                                    type="submit"
                                    className="h-14 flex-1 rounded-[1.25rem] bg-slate-900 hover:bg-slate-800 text-white font-black text-sm uppercase tracking-widest shadow-xl shadow-slate-200 transition-all active:scale-95 disabled:opacity-50"
                                    disabled={updateUser.isPending}
                                >
                                    {updateUser.isPending ? <Loader2 className="h-5 w-5 animate-spin mr-2" /> : null}
                                    Lưu thay đổi
                                </Button>
                                <Button
                                    type="button"
                                    variant="outline"
                                    className="h-14 rounded-[1.25rem] border-slate-100 font-black text-xs uppercase tracking-widest text-slate-500 hover:bg-slate-50 transition-all px-8"
                                    onClick={() => onOpenChange(false)}
                                >
                                    Hủy
                                </Button>
                            </DialogFooter>
                        </form>
                    </Form>
                </div>
            </DialogContent>
        </Dialog>
    );
}
