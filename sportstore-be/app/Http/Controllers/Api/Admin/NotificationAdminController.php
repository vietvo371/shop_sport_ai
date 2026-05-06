<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Models\NguoiDung;
use App\Models\ThongBao;
use App\Services\PromotionTargetingService;
use App\Events\NewNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ThongBaoMail;

/**
 * @group 6. Quản trị viên (Admin)
 * @subgroup Quản lý Thông báo
 * @authenticated
 */
class NotificationAdminController extends Controller
{
    public function __construct(
        private readonly PromotionTargetingService $targetingService
    ) {}

    /**
     * Gửi thông báo (Broadcast hoặc Targeted)
     *
     * @bodyParam tieu_de string required Tiêu đề thông báo.
     * @bodyParam noi_dung string required Nội dung thông báo.
     * @bodyParam loai string required Loại thông báo (khuyen_mai, he_thong). Example: khuyen_mai
     * @bodyParam du_lieu_them object Dữ liệu tùy chỉnh (JSON).
     * @bodyParam gui_email boolean Gửi kèm email.
     * @bodyParam che_do string Chế độ gửi (tat_ca hoặc muc_tieu). Default: tat_ca
     * @bodyParam danh_muc_ids array Mảng ID danh mục (bắt buộc khi che_do = muc_tieu).
     */
    public function broadcast(Request $request): JsonResponse
    {
        if (!$request->user()->hasPermission('gui_quang_ba')) {
            return ApiResponse::error('Bạn không có quyền gửi thông báo quảng bá.', 403);
        }

        $validated = $request->validate([
            'tieu_de'       => 'required|string|max:255',
            'noi_dung'      => 'required|string',
            'loai'          => 'required|string|in:khuyen_mai,he_thong',
            'du_lieu_them'  => 'nullable|array',
            'gui_email'     => 'nullable|boolean',
            'che_do'        => 'nullable|string|in:tat_ca,muc_tieu',
            'danh_muc_ids'  => 'nullable|array',
            'danh_muc_ids.*' => 'integer|exists:danh_muc,id',
        ], [
            'tieu_de.required'  => 'Vui lòng nhập tiêu đề thông báo.',
            'noi_dung.required' => 'Vui lòng nhập nội dung thông báo.',
            'loai.in'           => 'Loại thông báo không hợp lệ (khuyen_mai, he_thong).',
        ]);

        $cheDoGoi = $validated['che_do'] ?? 'tat_ca';

        if ($cheDoGoi === 'muc_tieu') {
            if (empty($validated['danh_muc_ids'])) {
                return ApiResponse::error('Vui lòng chọn ít nhất một danh mục khi gửi theo mục tiêu.', 422);
            }
            $userIds = $this->targetingService->findTargetUsers($validated['danh_muc_ids']);
        } else {
            $userIds = NguoiDung::where('trang_thai', true)
                ->where('vai_tro', 'khach_hang')
                ->pluck('id');
        }

        if ($userIds->isEmpty()) {
            $msg = $cheDoGoi === 'muc_tieu'
                ? 'Không tìm thấy khách hàng nào phù hợp với danh mục đã chọn.'
                : 'Không tìm thấy người dùng nào để gửi thông báo.';
            return ApiResponse::error($msg, 404);
        }

        // Gắn thêm metadata targeting vào du_lieu_them
        $duLieuThem = $validated['du_lieu_them'] ?? [];
        if ($cheDoGoi === 'muc_tieu') {
            $duLieuThem['targeting'] = [
                'che_do'       => 'muc_tieu',
                'danh_muc_ids' => $validated['danh_muc_ids'],
                'so_nguoi_nhan' => $userIds->count(),
            ];
        }

        try {
            DB::transaction(function () use ($userIds, $validated, $duLieuThem) {
                $now = now();
                $data = [];

                foreach ($userIds as $id) {
                    $data[] = [
                        'nguoi_dung_id' => $id,
                        'loai'          => $validated['loai'],
                        'tieu_de'       => $validated['tieu_de'],
                        'noi_dung'      => $validated['noi_dung'],
                        'du_lieu_them'  => !empty($duLieuThem) ? json_encode($duLieuThem) : null,
                        'created_at'    => $now,
                    ];
                }

                foreach (array_chunk($data, 500) as $chunk) {
                    ThongBao::insert($chunk);
                }

                // Broadcast realtime cho từng user
                $insertedNotifications = ThongBao::whereIn('nguoi_dung_id', $userIds)
                    ->where('tieu_de', $validated['tieu_de'])
                    ->where('created_at', $now)
                    ->get();

                foreach ($insertedNotifications as $thongBao) {
                    event(new NewNotification($thongBao));
                }
            });

            if (!empty($validated['gui_email']) && $validated['gui_email']) {
                $userEmails = NguoiDung::whereIn('id', $userIds)
                    ->whereNotNull('email')
                    ->where('email', '!=', '')
                    ->pluck('email')
                    ->toArray();

                if (!empty($userEmails)) {
                    $hanhDongUrl = null;
                    if (isset($duLieuThem['link'])) {
                        $frontendUrl = config('app.frontend_url', env('FRONTEND_URL', 'http://localhost:3000'));
                        $hanhDongUrl = rtrim($frontendUrl, '/') . '/' . ltrim($duLieuThem['link'], '/');
                    }

                    Mail::bcc($userEmails)->queue(new ThongBaoMail(
                        tieuDe:       $validated['tieu_de'],
                        noiDung:      $validated['noi_dung'],
                        loai:         $validated['loai'],
                        hanhDongUrl:  $hanhDongUrl,
                        hanhDongText: 'Xem chi tiết'
                    ));
                }
            }

            $label = $cheDoGoi === 'muc_tieu' ? 'khách hàng mục tiêu' : 'người dùng';
            return ApiResponse::success(null, "Đã gửi thông báo thành công tới {$userIds->count()} {$label}");
        } catch (\Exception $e) {
            return ApiResponse::serverError('Lỗi khi gửi thông báo: ' . $e->getMessage());
        }
    }

    /**
     * Preview số lượng khách hàng mục tiêu theo danh mục
     *
     * @bodyParam danh_muc_ids array required Mảng ID danh mục cần phân tích.
     */
    public function previewTargetCount(Request $request): JsonResponse
    {
        if (!$request->user()->hasPermission('gui_quang_ba')) {
            return ApiResponse::error('Bạn không có quyền.', 403);
        }

        $validated = $request->validate([
            'danh_muc_ids'   => 'required|array|min:1',
            'danh_muc_ids.*' => 'integer|exists:danh_muc,id',
        ], [
            'danh_muc_ids.required' => 'Vui lòng chọn ít nhất một danh mục.',
        ]);

        $preview = $this->targetingService->previewTargetCount($validated['danh_muc_ids']);

        return ApiResponse::success($preview, 'Thống kê khách hàng mục tiêu');
    }

    /**
     * Danh sách lịch sử thông báo quảng bá (Gần đây)
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
