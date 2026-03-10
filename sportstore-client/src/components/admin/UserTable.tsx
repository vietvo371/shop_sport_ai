'use client';

import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow
} from "@/components/ui/table";
import { Badge } from "@/components/ui/badge";
import { Button } from "@/components/ui/button";
import {
    Users,
    Edit,
    Trash2,
    ShieldCheck,
    CheckCircle2,
    XCircle,
    AlertCircle,
    Mail,
    Phone
} from "lucide-react";
import { formatDate } from "@/lib/utils";
import { useDeleteUser } from "@/hooks/useAdminUsers";
import {
    AlertDialog,
    AlertDialogAction,
    AlertDialogCancel,
    AlertDialogContent,
    AlertDialogDescription,
    AlertDialogFooter,
    AlertDialogHeader,
    AlertDialogTitle,
    AlertDialogTrigger,
} from "@/components/ui/alert-dialog";
import {
    Tooltip,
    TooltipContent,
    TooltipProvider,
    TooltipTrigger,
} from "@/components/ui/tooltip";

interface UserTableProps {
    users: any[];
    onEdit: (user: any) => void;
}

export function UserTable({ users, onEdit }: UserTableProps) {
    const deleteUser = useDeleteUser();

    return (
        <div className="bg-white rounded-[2.5rem] border border-slate-100 overflow-hidden shadow-sm shadow-slate-200/50">
            <Table>
                <TableHeader className="bg-slate-50/50">
                    <TableRow className="hover:bg-transparent border-slate-100">
                        <TableHead className="py-6 px-8 text-[11px] font-black text-slate-400 uppercase tracking-widest w-[30%]">Thông tin người dùng</TableHead>
                        <TableHead className="py-6 text-center text-[11px] font-black text-slate-400 uppercase tracking-widest w-[15%]">Vai trò</TableHead>
                        <TableHead className="py-6 text-center text-[11px] font-black text-slate-400 uppercase tracking-widest w-[15%]">Ngày tham gia</TableHead>
                        <TableHead className="py-6 text-center text-[11px] font-black text-slate-400 uppercase tracking-widest w-[15%]">Trạng thái</TableHead>
                        <TableHead className="py-6 px-8 text-right text-[11px] font-black text-slate-400 uppercase tracking-widest w-[25%]">Thao tác</TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    {users.length === 0 ? (
                        <TableRow>
                            <TableCell colSpan={5} className="h-80 text-center">
                                <div className="flex flex-col items-center justify-center gap-3 text-slate-300">
                                    <div className="h-16 w-16 rounded-3xl bg-slate-50 flex items-center justify-center">
                                        <Users className="h-8 w-8 opacity-20" />
                                    </div>
                                    <p className="font-black uppercase tracking-widest text-[11px]">Không tìm thấy người dùng nào</p>
                                </div>
                            </TableCell>
                        </TableRow>
                    ) : (
                        users.map((user) => (
                            <TableRow key={user.id} className="hover:bg-slate-50/50 transition-all border-slate-50 last:border-0 group">
                                <TableCell className="py-6 px-8">
                                    <div className="flex items-center gap-4">
                                        <div className="h-12 w-12 rounded-2xl bg-slate-100 flex items-center justify-center text-slate-400 text-lg font-black border border-slate-200 overflow-hidden shrink-0">
                                            {user.anh_dai_dien ? (
                                                <img src={user.anh_dai_dien} alt={user.ho_va_ten} className="h-full w-full object-cover" />
                                            ) : (
                                                user.ho_va_ten?.charAt(0)
                                            )}
                                        </div>
                                        <div className="flex flex-col min-w-0">
                                            <span className="font-black text-slate-900 tracking-tight text-base truncate">{user.ho_va_ten}</span>
                                            <div className="flex flex-col gap-0.5 mt-1">
                                                <span className="text-[10px] font-bold text-slate-400 flex items-center gap-1.5 truncate">
                                                    <Mail className="h-3 w-3" /> {user.email}
                                                </span>
                                                {user.so_dien_thoai && (
                                                    <span className="text-[10px] font-bold text-slate-400 flex items-center gap-1.5 truncate">
                                                        <Phone className="h-3 w-3" /> {user.so_dien_thoai}
                                                    </span>
                                                )}
                                            </div>
                                        </div>
                                    </div>
                                </TableCell>
                                <TableCell className="py-6 text-center">
                                    {user.vai_tro === 'quan_tri' ? (
                                        <Badge className="bg-amber-50 text-amber-600 border-amber-100 px-3 py-1.5 text-[10px] font-black uppercase tracking-wider rounded-xl gap-1.5 shadow-sm shadow-amber-200/20">
                                            <ShieldCheck className="h-3.5 w-3.5" />
                                            Admin
                                        </Badge>
                                    ) : (
                                        <Badge className="bg-blue-50 text-blue-600 border-blue-100 px-3 py-1.5 text-[10px] font-black uppercase tracking-wider rounded-xl gap-1.5 shadow-sm shadow-blue-200/20">
                                            <CheckCircle2 className="h-3.5 w-3.5" />
                                            User
                                        </Badge>
                                    )}
                                </TableCell>
                                <TableCell className="py-6 text-center">
                                    <span className="text-[11px] font-black text-slate-500 uppercase tracking-widest">{formatDate(user.batch_dau_luc || user.created_at)}</span>
                                </TableCell>
                                <TableCell className="py-6 text-center">
                                    {user.trang_thai ? (
                                        <div className="flex items-center justify-center gap-1.5 text-emerald-500 font-black text-[10px] uppercase tracking-widest">
                                            <div className="h-1.5 w-1.5 rounded-full bg-emerald-500 animate-pulse" />
                                            Hoạt động
                                        </div>
                                    ) : (
                                        <div className="flex items-center justify-center gap-1.5 text-rose-500 font-black text-[10px] uppercase tracking-widest">
                                            <div className="h-1.5 w-1.5 rounded-full bg-rose-500" />
                                            Đã khoá
                                        </div>
                                    )}
                                </TableCell>
                                <TableCell className="py-6 px-8 text-right">
                                    <div className="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <TooltipProvider>
                                            <Tooltip>
                                                <TooltipTrigger asChild>
                                                    <Button
                                                        size="sm"
                                                        variant="ghost"
                                                        className="h-10 w-10 rounded-xl p-0 hover:bg-slate-100 text-slate-600 shadow-sm transition-all active:scale-95"
                                                        onClick={() => onEdit(user)}
                                                    >
                                                        <Edit className="h-4 w-4" />
                                                    </Button>
                                                </TooltipTrigger>
                                                <TooltipContent className="bg-slate-900 border-slate-800 text-white font-bold text-[10px] uppercase tracking-wider py-2 px-3">Cấu hình</TooltipContent>
                                            </Tooltip>

                                            <AlertDialog>
                                                <AlertDialogTrigger asChild>
                                                    <Button
                                                        size="sm"
                                                        variant="ghost"
                                                        className="h-10 w-10 rounded-xl p-0 text-slate-400 hover:text-rose-600 hover:bg-rose-50 shadow-sm transition-all active:scale-95"
                                                    >
                                                        <Trash2 className="h-4 w-4" />
                                                    </Button>
                                                </AlertDialogTrigger>
                                                <AlertDialogContent className="rounded-[2.5rem] border-none shadow-2xl p-0 overflow-hidden">
                                                    <div className="p-8 pb-0">
                                                        <div className="h-14 w-14 rounded-2xl bg-rose-50 flex items-center justify-center text-rose-500 mb-6 border border-rose-100">
                                                            <AlertCircle className="h-7 w-7" />
                                                        </div>
                                                        <AlertDialogHeader>
                                                            <AlertDialogTitle className="text-2xl font-black text-slate-900 tracking-tight uppercase italic">Xoá người dùng này?</AlertDialogTitle>
                                                            <AlertDialogDescription className="text-slate-500 font-medium leading-relaxed mt-2">
                                                                Tài khoản của <span className="font-black text-slate-900">"{user.ho_va_ten}"</span> sẽ bị xoá vĩnh viễn khỏi hệ thống. Hành động này không thể hoàn tác.
                                                            </AlertDialogDescription>
                                                        </AlertDialogHeader>
                                                    </div>
                                                    <AlertDialogFooter className="p-8 pt-6 gap-3 sm:justify-start">
                                                        <AlertDialogAction
                                                            className="h-12 flex-1 rounded-2xl bg-rose-500 hover:bg-rose-600 font-black text-xs uppercase tracking-widest text-white shadow-lg shadow-rose-200"
                                                            onClick={() => deleteUser.mutate(user.id)}
                                                        >
                                                            Xác nhận xoá
                                                        </AlertDialogAction>
                                                        <AlertDialogCancel className="h-12 px-6 rounded-2xl border-slate-100 font-black text-[10px] uppercase tracking-widest text-slate-400 hover:bg-slate-50 transition-all">Huỷ bỏ</AlertDialogCancel>
                                                    </AlertDialogFooter>
                                                </AlertDialogContent>
                                            </AlertDialog>
                                        </TooltipProvider>
                                    </div>
                                </TableCell>
                            </TableRow>
                        ))
                    )}
                </TableBody>
            </Table>
        </div>
    );
}
