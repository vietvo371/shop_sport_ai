<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// ─────────────────────────────────────────────────────────────
// PUBLIC ROUTES — không cần đăng nhập
// ─────────────────────────────────────────────────────────────

// Auth
Route::prefix('auth')->group(function () {
    Route::post('register', [\App\Http\Controllers\Api\Auth\AuthController::class, 'register']);
    Route::post('login',    [\App\Http\Controllers\Api\Auth\AuthController::class, 'login']);

    // Password Reset
    Route::post('password/email', [\App\Http\Controllers\Api\Auth\ForgotPasswordController::class, 'sendResetLinkEmail']);
    Route::post('password/reset', [\App\Http\Controllers\Api\Auth\ResetPasswordController::class, 'reset']);

    // Google OAuth
    Route::get('google/redirect',  [\App\Http\Controllers\Api\Auth\GoogleAuthController::class, 'redirectUrl']);
    Route::post('google/callback', [\App\Http\Controllers\Api\Auth\GoogleAuthController::class, 'handleCallback']);

    // Xác thực email
    Route::get('email/verify/{id}/{hash}', [\App\Http\Controllers\Api\Auth\EmailVerificationController::class, 'verify'])
        ->name('verification.verify'); // Không dùng signed để user click từ frontend dễ hơn (nếu cần bảo mật cao hơn có thể thêm sau)
    
    Route::middleware('auth:sanctum')->post('email/resend', [\App\Http\Controllers\Api\Auth\EmailVerificationController::class, 'resend']);
});

// Catalog — public browse
Route::get('categories',        [\App\Http\Controllers\Api\DanhMucController::class, 'index']);
Route::get('categories/{slug}', [\App\Http\Controllers\Api\DanhMucController::class, 'show']);
Route::get('brands',            [\App\Http\Controllers\Api\ThuongHieuController::class, 'index']);

Route::get('products',          [\App\Http\Controllers\Api\SanPhamController::class, 'index']);
Route::get('products/{slug}',   [\App\Http\Controllers\Api\SanPhamController::class, 'show']);

Route::get('banners',           [\App\Http\Controllers\Api\BannerController::class, 'index']);

// Chatbot — cả guest lẫn user đều dùng được
Route::post('chatbot/message',  [\App\Http\Controllers\Api\Chatbot\ChatbotController::class, 'sendMessage']);
Route::get('chatbot/history',   [\App\Http\Controllers\Api\Chatbot\ChatbotController::class, 'history']);

// Recommendations — public (sẽ trả kết quả generic nếu không có user)
Route::get('recommendations',   [\App\Http\Controllers\Api\Recommendation\RecommendationController::class, 'index']);
Route::get('recommendations/{productId}/related', [\App\Http\Controllers\Api\Recommendation\RecommendationController::class, 'relatedProducts']);
Route::post('behaviors',        [\App\Http\Controllers\Api\Recommendation\RecommendationController::class, 'recordBehavior']);

// Bảng size — tra cứu kích cỡ
Route::get('size-charts',       [\App\Http\Controllers\Api\BangSizeController::class, 'index']);

// ─────────────────────────────────────────────────────────────
// AUTHENTICATED ROUTES — cần Bearer token
// ─────────────────────────────────────────────────────────────
Route::middleware('auth:sanctum')->group(function () {

    // Auth
    Route::prefix('auth')->group(function () {
        Route::post('logout', [\App\Http\Controllers\Api\Auth\AuthController::class, 'logout']);
        Route::get('me',      [\App\Http\Controllers\Api\Auth\AuthController::class, 'me']);
        Route::put('me',      [\App\Http\Controllers\Api\Auth\AuthController::class, 'update']);
    });

    // Địa chỉ
    Route::apiResource('addresses', \App\Http\Controllers\Api\DiaChiController::class);

    // Wishlist
    Route::get('wishlist',              [\App\Http\Controllers\Api\YeuThichController::class, 'index']);
    Route::post('wishlist/{productId}', [\App\Http\Controllers\Api\YeuThichController::class, 'toggle']);

    // Giỏ hàng
    Route::get('cart',              [\App\Http\Controllers\Api\GioHangController::class, 'show']);
    Route::post('cart/items',       [\App\Http\Controllers\Api\GioHangController::class, 'addItem']);
    Route::put('cart/items/{id}',   [\App\Http\Controllers\Api\GioHangController::class, 'updateItem']);
    Route::delete('cart/items/{id}',[\App\Http\Controllers\Api\GioHangController::class, 'removeItem']);
    Route::delete('cart',           [\App\Http\Controllers\Api\GioHangController::class, 'clear']);
    Route::post('cart/merge',       [\App\Http\Controllers\Api\GioHangController::class, 'mergeGuestCart']); // hợp nhất giỏ hàng guest

    // Mã giảm giá — validate
    Route::post('coupons/validate', [\App\Http\Controllers\Api\MaGiamGiaController::class, 'validate']);

    // Đơn hàng
    Route::get('orders',        [\App\Http\Controllers\Api\DonHangController::class, 'index']);
    Route::post('orders',       [\App\Http\Controllers\Api\DonHangController::class, 'store']);
    Route::get('orders/{code}', [\App\Http\Controllers\Api\DonHangController::class, 'show']);

    // Đánh giá
    Route::post('reviews',     [\App\Http\Controllers\Api\DanhGiaController::class, 'store']);
    Route::get('reviews/{id}', [\App\Http\Controllers\Api\DanhGiaController::class, 'show']);

    // Thông báo
    Route::get('notifications',         [\App\Http\Controllers\Api\ThongBaoController::class, 'index']);
    Route::put('notifications/{id}/read',[\App\Http\Controllers\Api\ThongBaoController::class, 'markRead']);
    Route::put('notifications/read-all', [\App\Http\Controllers\Api\ThongBaoController::class, 'markAllRead']);

    // Thanh toán
    Route::prefix('payments')->group(function () {
        Route::post('create-url', [\App\Http\Controllers\Api\Payment\PaymentController::class, 'createPaymentUrl']);
        Route::get('vnpay-return', [\App\Http\Controllers\Api\Payment\PaymentController::class, 'vnpayReturn']);
        Route::get('momo-return', [\App\Http\Controllers\Api\Payment\PaymentController::class, 'momoReturn']);
        Route::post('momo-ipn', [\App\Http\Controllers\Api\Payment\PaymentController::class, 'momoIpn']);
    });

    // ─── ADMIN ONLY ───────────────────────────────────────
    Route::prefix('admin')->middleware(\App\Http\Middleware\AdminMiddleware::class)->group(function () {

        Route::get('dashboard', [\App\Http\Controllers\Api\Admin\DashboardAdminController::class, 'index'])
            ->middleware('quyen:xem_dashboard');

        // Products CRUD
        Route::apiResource('products', \App\Http\Controllers\Api\Admin\SanPhamAdminController::class)
            ->middleware('quyen:xem_sp');

        // Catalog (Categories & Brands)
        Route::apiResource('categories', \App\Http\Controllers\Api\Admin\DanhMucAdminController::class)
            ->middleware('quyen:quan_ly_catalog');
        Route::apiResource('brands', \App\Http\Controllers\Api\Admin\ThuongHieuAdminController::class)
            ->middleware('quyen:quan_ly_catalog');
        Route::apiResource('size-charts', \App\Http\Controllers\Api\Admin\BangSizeAdminController::class)
            ->middleware('quyen:quan_ly_catalog');

        // Orders management
        Route::middleware('quyen:xem_don')->group(function () {
            Route::get('orders',                    [\App\Http\Controllers\Api\Admin\DonHangAdminController::class, 'index']);
            Route::get('orders/{id}',               [\App\Http\Controllers\Api\Admin\DonHangAdminController::class, 'show']);
            Route::put('orders/{id}/status',        [\App\Http\Controllers\Api\Admin\DonHangAdminController::class, 'updateStatus'])
                ->middleware('quyen:cap_nhat_don');
        });

        // Coupons CRUD
        Route::apiResource('coupons', \App\Http\Controllers\Api\Admin\MaGiamGiaAdminController::class)
            ->middleware('quyen:ma_giam_gia');

        // Reviews moderation
        Route::middleware('quyen:duyet_danh_gia')->group(function () {
            Route::get('reviews',              [\App\Http\Controllers\Api\Admin\DanhGiaAdminController::class, 'index']);
            Route::put('reviews/{id}/approve', [\App\Http\Controllers\Api\Admin\DanhGiaAdminController::class, 'approve']);
            Route::delete('reviews/{id}',      [\App\Http\Controllers\Api\Admin\DanhGiaAdminController::class, 'destroy']);
        });

        // Users management
        Route::apiResource('users', \App\Http\Controllers\Api\Admin\NguoiDungAdminController::class)
            ->middleware('quyen:xem_user');

        // Reports & Statistics
        Route::prefix('reports')->middleware('quyen:xem_doanh_thu')->group(function () {
            Route::get('/overview', [\App\Http\Controllers\Api\Admin\ReportAdminController::class, 'overview']);
            Route::get('/revenue-chart', [\App\Http\Controllers\Api\Admin\ReportAdminController::class, 'revenueChart']);
            Route::get('/top-products', [\App\Http\Controllers\Api\Admin\ReportAdminController::class, 'topProducts']);
            
            // Product specific
            Route::get('/product-stats', [\App\Http\Controllers\Api\Admin\ReportAdminController::class, 'productStats']);
            
            // Customer specific
            Route::get('/customer-stats', [\App\Http\Controllers\Api\Admin\ReportAdminController::class, 'customerStats']);
            Route::get('/customer-chart', [\App\Http\Controllers\Api\Admin\ReportAdminController::class, 'customerChart']);
            Route::get('/top-customers', [\App\Http\Controllers\Api\Admin\ReportAdminController::class, 'topCustomers']);
            
            // Marketing specific
            Route::get('/marketing-stats', [\App\Http\Controllers\Api\Admin\ReportAdminController::class, 'marketingStats']);
            Route::get('/coupon-chart', [\App\Http\Controllers\Api\Admin\ReportAdminController::class, 'couponChart']);
            Route::get('/top-coupons', [\App\Http\Controllers\Api\Admin\ReportAdminController::class, 'topCoupons']);
            
            // Chatbot specific
            Route::get('/chatbot-stats', [\App\Http\Controllers\Api\Admin\ReportAdminController::class, 'chatbotStats']);
            Route::get('/chatbot-chart', [\App\Http\Controllers\Api\Admin\ReportAdminController::class, 'chatbotChart']);
            Route::get('/recent-chats', [\App\Http\Controllers\Api\Admin\ReportAdminController::class, 'recentChats']);
        });

        // Upload
        Route::post('upload', [\App\Http\Controllers\Api\Admin\UploadController::class, 'upload']);

        // Banners
        Route::apiResource('banners', \App\Http\Controllers\Api\Admin\BannerAdminController::class)
            ->middleware('quyen:quan_ly_banner');
        Route::patch('banners/{banner}/status', [\App\Http\Controllers\Api\Admin\BannerAdminController::class, 'toggleStatus'])
            ->middleware('quyen:quan_ly_banner');

        // Notifications
        Route::middleware('quyen:gui_quang_ba')->group(function () {
            Route::post('notifications/broadcast', [\App\Http\Controllers\Api\Admin\NotificationAdminController::class, 'broadcast']);
            Route::get('notifications/history', [\App\Http\Controllers\Api\Admin\NotificationAdminController::class, 'history']);
        });

        // RBAC Management
        Route::middleware('quyen:phan_quyen')->group(function () {
            Route::get('roles',               [\App\Http\Controllers\Api\Admin\RoleAdminController::class, 'index']);
            Route::post('roles',              [\App\Http\Controllers\Api\Admin\RoleAdminController::class, 'store']);
            Route::get('roles/{id}',          [\App\Http\Controllers\Api\Admin\RoleAdminController::class, 'show']);
            Route::put('roles/{id}',          [\App\Http\Controllers\Api\Admin\RoleAdminController::class, 'update']);
            Route::delete('roles/{id}',       [\App\Http\Controllers\Api\Admin\RoleAdminController::class, 'destroy']);
            Route::get('permissions',         [\App\Http\Controllers\Api\Admin\RoleAdminController::class, 'permissions']);
        });
    });
});
