<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Models\NguoiDung;
use App\Models\ThongBao;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * @group 6. Quản trị viên (Admin)
 * @subgroup Quản lý Thông báo
 * @authenticated
 */
class NotificationAdminController extends Controller
{
    /**
     * Gửi thông báo tới toàn bộ người dùng (Broadcast)
     *
     * @bodyParam tieu_de string required Tiêu đề thông báo.
     * @bodyParam noi_dung string required Nội dung thông báo.
     * @bodyParam loai string required Loại thông báo (khuyen_mai, he_thong). Example: khuyen_mai
     * @bodyParam du_lieu_them object Dữ liệu tùy chỉnh (JSON).
     */
    public function broadcast(Request $request): JsonResponse
    {
        if (!$request->user()->hasPermission('gui_quang_ba')) {
            return ApiResponse::error('Bạn không có quyền gửi thông báo quảng bá.', 403);
        }
        $validated = $request->validate([
            'tieu_de'      => 'required|string|max:255',
            'noi_dung'     => 'required|string',
            'loai'         => 'required|string|in:khuyen_mai,he_thong',
            'du_lieu_them' => 'nullable|array',
        ], [
            'tieu_de.required' => 'Vui lòng nhập tiêu đề thông báo.',
            'noi_dung.required' => 'Vui lòng nhập nội dung thông báo.',
            'loai.in' => 'Loại thông báo không hợp lệ (khuyen_mai, he_thong).',
        ]);

        // Lấy toàn bộ người dùng active (khách hàng)
        $userIds = NguoiDung::where('trang_thai', true)
            ->where('vai_tro', 'khach_hang')
            ->pluck('id');

        if ($userIds->isEmpty()) {
            return ApiResponse::error('Không tìm thấy người dùng nào để gửi thông báo', 404);
        }

        try {
            DB::transaction(function () use ($userIds, $validated) {
                $now = now();
                $data = [];

                foreach ($userIds as $id) {
                    $data[] = [
                        'nguoi_dung_id' => $id,
                        'loai'          => $validated['loai'],
                        'tieu_de'       => $validated['tieu_de'],
                        'noi_dung'      => $validated['noi_dung'],
                        'du_lieu_them'  => isset($validated['du_lieu_them']) ? json_encode($validated['du_lieu_them']) : null,
                        'created_at'    => $now,
                        // Not set da_doc_luc to keep it NULL (unread)
                    ];
                }

                // Chunking to avoid large SQL payload limits if user count is huge
                foreach (array_chunk($data, 500) as $chunk) {
                    ThongBao::insert($chunk);
                }
            });

            return ApiResponse::success(null, 'Đã gửi thông báo quảng bá thành công tới ' . $userIds->count() . ' người dùng');
        } catch (\Exception $e) {
            return ApiResponse::serverError('Lỗi khi gửi thông báo: ' . $e->getMessage());
        }
    }

    /**
     * Danh sách lịch sử thông báo quảng bá (Gần đây)
     * 
     * Note: Class này hiện chỉ lưu thông báo cho từng user. 
     * Để quản lý lịch sử broadcast chuẩn, có thể cần bảng riêng, 
     * nhưng tạm thời lấy các thông báo mới nhất không phân biệt user id để admin xem lại.
     */
    public function history(): JsonResponse
    {
        if (!auth()->user()->hasPermission('gui_quang_ba')) {
            return ApiResponse::error('Bạn không có quyền xem lịch sử thông báo.', 403);
        }
        $history = ThongBao::with('nguoiDung:id,ho_va_ten,email')
            ->latest()
            ->paginate(20);
            
        return ApiResponse::paginate($history, 'Lịch sử thông báo');
    }
}
