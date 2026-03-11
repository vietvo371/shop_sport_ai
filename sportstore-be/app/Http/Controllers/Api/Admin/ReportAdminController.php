<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Models\DonHang;
use App\Models\NguoiDung;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

/**
 * @group 6. Quản trị viên (Admin)
 * @subgroup Báo cáo & Thống kê
 * @authenticated
 */
class ReportAdminController extends Controller
{
    /**
     * Tổng quan thống kê (Overview)
     *
     * @queryParam period string Khoảng thời gian (today, week, month, year). Default: month
     */
    public function overview(Request $request): JsonResponse
    {
        $period = $request->query('period', 'month');
        $from = $request->query('from');
        $to = $request->query('to');
        $dateQuery = $this->getDateRange($period, $from, $to);
        $startDate = $dateQuery['start'];
        $endDate = $dateQuery['end'];

        // Lấy khoảng thời gian trước đó để tính % tăng trưởng (tham khảo)
        $previousStartDate = $dateQuery['prev_start'];
        $previousEndDate = $dateQuery['prev_end'];

        // 1. Tổng doanh thu (Chỉ tính đơn đã giao)
        $totalRevenue = DonHang::where('trang_thai', 'da_giao')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('tong_tien');

        $prevRevenue = DonHang::where('trang_thai', 'da_giao')
            ->whereBetween('created_at', [$previousStartDate, $previousEndDate])
            ->sum('tong_tien');

        // 2. Tổng số đơn hàng mới
        $totalOrders = DonHang::whereBetween('created_at', [$startDate, $endDate])->count();
        $prevOrders = DonHang::whereBetween('created_at', [$previousStartDate, $previousEndDate])->count();

        // 3. Khách hàng mới
        $newCustomers = NguoiDung::where('vai_tro', 'khach_hang')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();
        $prevCustomers = NguoiDung::where('vai_tro', 'khach_hang')
            ->whereBetween('created_at', [$previousStartDate, $previousEndDate])
            ->count();
            
        // 4. Sản phẩm đã bán
        $productsSold = DB::table('chi_tiet_don_hang')
            ->join('don_hang', 'chi_tiet_don_hang.don_hang_id', '=', 'don_hang.id')
            ->where('don_hang.trang_thai', 'da_giao')
            ->whereBetween('don_hang.created_at', [$startDate, $endDate])
            ->sum('chi_tiet_don_hang.so_luong') ?? 0;

        $prevProductsSold = DB::table('chi_tiet_don_hang')
            ->join('don_hang', 'chi_tiet_don_hang.don_hang_id', '=', 'don_hang.id')
            ->where('don_hang.trang_thai', 'da_giao')
            ->whereBetween('don_hang.created_at', [$previousStartDate, $previousEndDate])
            ->sum('chi_tiet_don_hang.so_luong') ?? 0;

        $paymentMethods = DB::table('don_hang')
            ->select('phuong_thuc_tt', DB::raw('COUNT(*) as usage_count'), DB::raw('SUM(tong_tien) as total_amount'))
            ->where('trang_thai', 'da_giao')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('phuong_thuc_tt')
            ->get();

        return ApiResponse::success([
            'revenue' => [
                'value' => (float) $totalRevenue,
                'growth' => $this->calculateGrowth($totalRevenue, $prevRevenue)
            ],
            'orders' => [
                'value' => $totalOrders,
                'growth' => $this->calculateGrowth($totalOrders, $prevOrders)
            ],
            'customers' => [
                'value' => $newCustomers,
                'growth' => $this->calculateGrowth($newCustomers, $prevCustomers)
            ],
            'products_sold' => [
                'value' => (int) $productsSold,
                'growth' => $this->calculateGrowth($productsSold, $prevProductsSold)
            ],
            'payment_sources' => $paymentMethods,
        ], '[Admin] Dữ liệu tổng quan báo cáo');
    }

    /**
     * Dữ liệu biểu đồ doanh thu (Revenue Chart)
     *
     * @queryParam period string Khoảng thời gian (week, month, year). Default: month
     */
    public function revenueChart(Request $request): JsonResponse
    {
        $period = $request->query('period', 'month');
        $from = $request->query('from');
        $to = $request->query('to');
        $dateQuery = $this->getDateRange($period, $from, $to);
        $startDate = $dateQuery['start'];
        $endDate = $dateQuery['end'];

        // Tùy theo period mà ta group by ngày hoặc tháng
        $groupByFormat = '%Y-%m-%d'; // Mặc định group theo ngày
        if ($period === 'year') {
            $groupByFormat = '%Y-%m'; // Nếu là năm, group theo tháng
        }

        $chartData = DonHang::where('trang_thai', 'da_giao')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->select(
                DB::raw("DATE_FORMAT(created_at, '{$groupByFormat}') as date"),
                DB::raw('SUM(tong_tien) as revenue')
            )
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        return ApiResponse::success($chartData, '[Admin] Dữ liệu biểu đồ doanh thu');
    }

    /**
     * Top sản phẩm bán chạy (Top Products)
     */
    public function topProducts(Request $request): JsonResponse
    {
        $limit = $request->query('limit', 5);
        $period = $request->query('period', 'month');
        $from = $request->query('from');
        $to = $request->query('to');
        $dateQuery = $this->getDateRange($period, $from, $to);
        $startDate = $dateQuery['start'];
        $endDate = $dateQuery['end'];

        $topProducts = DB::table('chi_tiet_don_hang')
            ->join('don_hang', 'chi_tiet_don_hang.don_hang_id', '=', 'don_hang.id')
            ->join('san_pham', 'chi_tiet_don_hang.san_pham_id', '=', 'san_pham.id')
            ->leftJoin('hinh_anh_san_pham', function($join) {
                 $join->on('san_pham.id', '=', 'hinh_anh_san_pham.san_pham_id')
                      ->where('hinh_anh_san_pham.la_anh_chinh', 1);
            })
            ->where('don_hang.trang_thai', 'da_giao')
            ->whereBetween('don_hang.created_at', [$startDate, $endDate])
            ->select(
                'san_pham.id',
                'san_pham.ten_san_pham',
                'san_pham.gia_goc',
                'san_pham.gia_khuyen_mai',
                DB::raw('MAX(hinh_anh_san_pham.duong_dan_anh) as image'),
                DB::raw('SUM(chi_tiet_don_hang.so_luong) as total_sold'),
                DB::raw('SUM(chi_tiet_don_hang.thanh_tien) as total_revenue')
            )
            ->groupBy('san_pham.id', 'san_pham.ten_san_pham', 'san_pham.gia_goc', 'san_pham.gia_khuyen_mai')
            ->orderByDesc('total_sold')
            ->limit($limit)
            ->get();

        return ApiResponse::success($topProducts, '[Admin] Top sản phẩm bán chạy');
    }

    /**
     * Thống kê sản phẩm tĩnh (Total, low_stock, views...)
     */
    public function productStats(Request $request): JsonResponse
    {
        $period = $request->query('period', 'month');
        $from = $request->query('from');
        $to = $request->query('to');
        $dateQuery = $this->getDateRange($period, $from, $to);
        $startDate = $dateQuery['start'];
        $endDate = $dateQuery['end'];

        $totalActive = DB::table('san_pham')->count();
        $totalViews = DB::table('san_pham')->sum('luot_xem') ?? 0;
        
        // Count low stock items from bien_the_san_pham
        $lowStock = DB::table('bien_the_san_pham')->where('ton_kho', '<', 5)->count();

        // Count reviews in period
        $periodReviews = DB::table('danh_gia')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();

        return ApiResponse::success([
            'total_active' => $totalActive,
            'total_views' => (int) $totalViews,
            'low_stock' => $lowStock,
            'period_reviews' => $periodReviews
        ], '[Admin] Thống kê sản phẩm');
    }

    /**
     * ====== KHACH HANG (CUSTOMERS) ======
     */
    public function customerStats(Request $request): JsonResponse
    {
        $period = $request->query('period', 'month');
        $from = $request->query('from');
        $to = $request->query('to');
        $dateQuery = $this->getDateRange($period, $from, $to);
        $startDate = $dateQuery['start'];
        $endDate = $dateQuery['end'];

        $totalCustomers = NguoiDung::where('vai_tro', 'khach_hang')->count();
        $newCustomers = NguoiDung::where('vai_tro', 'khach_hang')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();
        
        // Calculate Conversion Rate: (Khách đã mua / Tổng phiên duyệt web hoặc Tổng khách)
        // Here we'll just ratio: Customers who placed order / Total Customers
        $buyersCount = DonHang::where('trang_thai', 'da_giao')->distinct('nguoi_dung_id')->count('nguoi_dung_id');
        $conversionRate = $totalCustomers > 0 ? round(($buyersCount / $totalCustomers) * 100, 1) : 0;

        // Returning Customers: Users with > 1 completed order
        $returningCustomers = DonHang::where('trang_thai', 'da_giao')
            ->select('nguoi_dung_id')
            ->groupBy('nguoi_dung_id')
            ->havingRaw('COUNT(id) > 1')
            ->get()
            ->count();

        return ApiResponse::success([
            'total' => $totalCustomers,
            'new_period' => $newCustomers,
            'conversion_rate' => $conversionRate,
            'returning' => $returningCustomers
        ], '[Admin] Thống kê khách hàng');
    }

    public function customerChart(Request $request): JsonResponse
    {
        $period = $request->query('period', 'month');
        $from = $request->query('from');
        $to = $request->query('to');
        $dateQuery = $this->getDateRange($period, $from, $to);
        $startDate = $dateQuery['start'];
        $endDate = $dateQuery['end'];

        $groupByFormat = $period === 'year' ? '%Y-%m' : '%Y-%m-%d';

        $chartData = NguoiDung::where('vai_tro', 'khach_hang')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->select(
                DB::raw("DATE_FORMAT(created_at, '{$groupByFormat}') as date"),
                DB::raw('COUNT(id) as new_users')
            )
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        return ApiResponse::success($chartData, '[Admin] Biểu đồ đăng ký mới');
    }

    public function topCustomers(Request $request): JsonResponse
    {
        $limit = $request->query('limit', 10);
        $period = $request->query('period', 'month');
        $from = $request->query('from');
        $to = $request->query('to');
        $dateQuery = $this->getDateRange($period, $from, $to);
        
        $top = DB::table('don_hang')
            ->join('nguoi_dung', 'don_hang.nguoi_dung_id', '=', 'nguoi_dung.id')
            ->where('don_hang.trang_thai', 'da_giao')
            ->whereBetween('don_hang.created_at', [$dateQuery['start'], $dateQuery['end']])
            ->select(
                'nguoi_dung.id',
                'nguoi_dung.ho_va_ten as ho_ten',
                'nguoi_dung.email',
                'nguoi_dung.anh_dai_dien',
                DB::raw('COUNT(don_hang.id) as total_orders'),
                DB::raw('SUM(don_hang.tong_tien) as total_spent')
            )
            ->groupBy('nguoi_dung.id', 'nguoi_dung.ho_va_ten', 'nguoi_dung.email', 'nguoi_dung.anh_dai_dien')
            ->orderByDesc('total_spent')
            ->limit($limit)
            ->get();

        return ApiResponse::success($top, '[Admin] Xếp hạng chi tiêu khách hàng');
    }

    /**
     * ====== MARKETING ======
     */
    public function marketingStats(Request $request): JsonResponse
    {
        $period = $request->query('period', 'month');
        $from = $request->query('from');
        $to = $request->query('to');
        $dateQuery = $this->getDateRange($period, $from, $to);

        $activeCoupons = DB::table('ma_giam_gia')
            ->where('trang_thai', 1)
            ->whereDate('bat_dau_luc', '<=', Carbon::now())
            ->whereDate('het_han_luc', '>=', Carbon::now())
            ->count();

        $couponUses = DB::table('lich_su_dung_ma')
            ->whereBetween('su_dung_luc', [$dateQuery['start'], $dateQuery['end']])
            ->count();

        // Total subsidy from delivered orders inside period
        $totalDiscountSponsored = DB::table('don_hang')
            ->where('trang_thai', 'da_giao')
            ->whereNotNull('ma_giam_gia_id')
            ->whereBetween('created_at', [$dateQuery['start'], $dateQuery['end']])
            ->sum('so_tien_giam') ?? 0;

        $avgSystemRating = DB::table('danh_gia')->avg('so_sao') ?? 0;

        return ApiResponse::success([
            'active_coupons' => $activeCoupons,
            'coupon_uses' => $couponUses,
            'total_sponsored' => (float) $totalDiscountSponsored,
            'avg_rating' => round($avgSystemRating, 1)
        ], '[Admin] Thống kê Marketing');
    }

    public function couponChart(Request $request): JsonResponse
    {
        $period = $request->query('period', 'month');
        $from = $request->query('from');
        $to = $request->query('to');
        $dateQuery = $this->getDateRange($period, $from, $to);

        // Chart shows usage breakdown by coupon code in period
        $chartData = DB::table('lich_su_dung_ma')
            ->join('ma_giam_gia', 'lich_su_dung_ma.ma_giam_gia_id', '=', 'ma_giam_gia.id')
            ->whereBetween('lich_su_dung_ma.su_dung_luc', [$dateQuery['start'], $dateQuery['end']])
            ->select(
                'ma_giam_gia.ma_code as name',
                DB::raw('COUNT(lich_su_dung_ma.id) as value')
            )
            ->groupBy('ma_giam_gia.ma_code')
            ->orderByDesc('value')
            ->limit(5)
            ->get();

        return ApiResponse::success($chartData, '[Admin] Biểu đồ phân bổ mã giảm giá');
    }

    public function topCoupons(Request $request): JsonResponse
    {
        $limit = $request->query('limit', 5);
        $period = $request->query('period', 'month');
        $from = $request->query('from');
        $to = $request->query('to');
        $dateQuery = $this->getDateRange($period, $from, $to);

        $top = DB::table('don_hang')
            ->join('ma_giam_gia', 'don_hang.ma_giam_gia_id', '=', 'ma_giam_gia.id')
            ->where('don_hang.trang_thai', 'da_giao')
            ->whereBetween('don_hang.created_at', [$dateQuery['start'], $dateQuery['end']])
            ->select(
                'ma_giam_gia.id',
                'ma_giam_gia.ma_code',
                DB::raw('COUNT(don_hang.id) as usage_count'),
                DB::raw('SUM(don_hang.so_tien_giam) as total_discount'),
                DB::raw('SUM(don_hang.tong_tien) as total_revenue')
            )
            ->groupBy('ma_giam_gia.id', 'ma_giam_gia.ma_code')
            ->orderByDesc('usage_count')
            ->limit($limit)
            ->get();

        return ApiResponse::success($top, '[Admin] Top mã giảm giá theo hiệu quả');
    }

    /**
     * ====== CHATBOT AI ======
     */
    public function chatbotStats(Request $request): JsonResponse
    {
        $period = $request->query('period', 'month');
        $from = $request->query('from');
        $to = $request->query('to');
        $dateQuery = $this->getDateRange($period, $from, $to);

        $sessionsCount = DB::table('phien_chatbot')
            ->whereBetween('created_at', [$dateQuery['start'], $dateQuery['end']])
            ->count();

        $messagesCount = DB::table('tin_nhan_chatbot')
            ->whereBetween('created_at', [$dateQuery['start'], $dateQuery['end']])
            ->count();
        
        $avgMessages = $sessionsCount > 0 ? round($messagesCount / $sessionsCount, 1) : 0;

        $totalTokens = DB::table('tin_nhan_chatbot')
            ->whereBetween('created_at', [$dateQuery['start'], $dateQuery['end']])
            ->sum('so_token') ?? 0;

        // Estimate Gemini cost: e.g. $0.0001 per 1K tokens
        $estimatedCost = ($totalTokens / 1000) * 0.0001;

        return ApiResponse::success([
            'total_sessions' => $sessionsCount,
            'avg_messages' => $avgMessages,
            'total_tokens' => (int) $totalTokens,
            'estimated_cost_usd' => round($estimatedCost, 4)
        ], '[Admin] Thống kê Chatbot');
    }

    public function chatbotChart(Request $request): JsonResponse
    {
        $period = $request->query('period', 'month');
        $from = $request->query('from');
        $to = $request->query('to');
        $dateQuery = $this->getDateRange($period, $from, $to);

        $groupByFormat = $period === 'year' ? '%Y-%m' : '%Y-%m-%d';

        $chartData = DB::table('tin_nhan_chatbot')
            ->join('phien_chatbot', 'tin_nhan_chatbot.phien_id', '=', 'phien_chatbot.id')
            ->whereBetween('tin_nhan_chatbot.created_at', [$dateQuery['start'], $dateQuery['end']])
            ->select(
                DB::raw("DATE_FORMAT(tin_nhan_chatbot.created_at, '{$groupByFormat}') as date"),
                DB::raw('COUNT(DISTINCT phien_chatbot.id) as sessions'),
                DB::raw('SUM(tin_nhan_chatbot.so_token) as tokens')
            )
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        return ApiResponse::success($chartData, '[Admin] Biểu đồ Chatbot AI');
    }

    public function recentChats(Request $request): JsonResponse
    {
        $limit = $request->query('limit', 10);
        $period = $request->query('period', 'month');
        $from = $request->query('from');
        $to = $request->query('to');
        $dateQuery = $this->getDateRange($period, $from, $to);

        $recent = DB::table('phien_chatbot')
            ->leftJoin('nguoi_dung', 'phien_chatbot.nguoi_dung_id', '=', 'nguoi_dung.id')
            ->whereBetween('phien_chatbot.created_at', [$dateQuery['start'], $dateQuery['end']])
            ->select(
                'phien_chatbot.id',
                'phien_chatbot.created_at',
                'nguoi_dung.ho_va_ten as user_name',
                DB::raw('(SELECT COUNT(id) FROM tin_nhan_chatbot WHERE tin_nhan_chatbot.phien_id = phien_chatbot.id) as message_count'),
                DB::raw('(SELECT SUM(so_token) FROM tin_nhan_chatbot WHERE tin_nhan_chatbot.phien_id = phien_chatbot.id) as total_tokens')
            )
            ->orderByDesc('phien_chatbot.created_at')
            ->limit($limit)
            ->get();

        return ApiResponse::success($recent, '[Admin] Các phiên chat gần đây');
    }

    /* Helper functions */
    private function getDateRange($period, $from = null, $to = null)
    {
        $now = Carbon::now();
        $start = clone $now;
        
        $prevEnd = clone $now;
        $prevStart = clone $now;

        if ($from && $to) {
            $start = Carbon::parse($from)->startOfDay();
            $end = Carbon::parse($to)->endOfDay();
            
            $diffInDays = $start->diffInDays($end);
            $prevEnd = (clone $start)->subDay()->endOfDay();
            $prevStart = (clone $prevEnd)->subDays($diffInDays)->startOfDay();
            
            return [
                'start' => $start,
                'end' => $end,
                'prev_start' => $prevStart,
                'prev_end' => $prevEnd,
            ];
        }

        switch ($period) {
            case 'today':
                $start->startOfDay();
                $prevEnd->subDay()->endOfDay();
                $prevStart->subDay()->startOfDay();
                break;
            case 'week':
                $start->startOfWeek();
                $prevEnd->subWeek()->endOfWeek();
                $prevStart->subWeek()->startOfWeek();
                break;
            case 'year':
                $start->startOfYear();
                $prevEnd->subYear()->endOfYear();
                $prevStart->subYear()->startOfYear();
                break;
            case 'month':
            default:
                $start->startOfMonth();
                $prevEnd->subMonth()->endOfMonth();
                $prevStart->subMonth()->startOfMonth();
                break;
        }

        return [
            'start' => $start,
            'end' => clone $now,
            'prev_start' => $prevStart,
            'prev_end' => $prevEnd,
        ];
    }

    private function calculateGrowth($current, $previous)
    {
        if ($previous == 0) {
            return $current > 0 ? 100 : 0;
        }
        $growth = (($current - $previous) / $previous) * 100;
        return round($growth, 1);
    }
}
