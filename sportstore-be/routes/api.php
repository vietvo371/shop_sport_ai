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

    // Hành vi người dùng (ML tracking)
    Route::post('behaviors', [\App\Http\Controllers\Api\Recommendation\RecommendationController::class, 'recordBehavior']);

    // Wishlist
    Route::get('wishlist',              [\App\Http\Controllers\Api\YeuThichController::class, 'index']);
    Route::post('wishlist/{productId}', [\App\Http\Controllers\Api\YeuThichController::class, 'toggle']);

    // Giỏ hàng
    Route::get('cart',              [\App\Http\Controllers\Api\GioHangController::class, 'show']);
    Route::post('cart/items',       [\App\Http\Controllers\Api\GioHangController::class, 'addItem']);
    Route::put('cart/items/{id}',   [\App\Http\Controllers\Api\GioHangController::class, 'updateItem']);
    Route::delete('cart/items/{id}',[\App\Http\Controllers\Api\GioHangController::class, 'removeItem']);
    Route::delete('cart',           [\App\Http\Controllers\Api\GioHangController::class, 'clear']);

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

    // ─── ADMIN ONLY ───────────────────────────────────────
    Route::prefix('admin')->middleware(\App\Http\Middleware\AdminMiddleware::class)->group(function () {

        Route::get('dashboard', [\App\Http\Controllers\Api\Admin\DashboardAdminController::class, 'index']);

        // Products CRUD
        Route::apiResource('products',   \App\Http\Controllers\Api\Admin\SanPhamAdminController::class);
        Route::apiResource('categories', \App\Http\Controllers\Api\Admin\DanhMucAdminController::class);
        Route::apiResource('brands',     \App\Http\Controllers\Api\Admin\ThuongHieuAdminController::class);

        // Orders management
        Route::get('orders',                    [\App\Http\Controllers\Api\Admin\DonHangAdminController::class, 'index']);
        Route::get('orders/{id}',               [\App\Http\Controllers\Api\Admin\DonHangAdminController::class, 'show']);
        Route::put('orders/{id}/status',        [\App\Http\Controllers\Api\Admin\DonHangAdminController::class, 'updateStatus']);

        // Coupons CRUD
        Route::apiResource('coupons', \App\Http\Controllers\Api\Admin\MaGiamGiaAdminController::class);

        // Reviews moderation
        Route::get('reviews',              [\App\Http\Controllers\Api\Admin\DanhGiaAdminController::class, 'index']);
        Route::put('reviews/{id}/approve', [\App\Http\Controllers\Api\Admin\DanhGiaAdminController::class, 'approve']);
        Route::delete('reviews/{id}',      [\App\Http\Controllers\Api\Admin\DanhGiaAdminController::class, 'destroy']);

        // Users management
        Route::apiResource('users', \App\Http\Controllers\Api\Admin\NguoiDungAdminController::class);

        // Reports & Statistics
        Route::prefix('reports')->group(function () {
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
        Route::apiResource('banners', \App\Http\Controllers\Api\Admin\BannerAdminController::class);
        Route::patch('banners/{banner}/status', [\App\Http\Controllers\Api\Admin\BannerAdminController::class, 'toggleStatus']);

        // Notifications
        Route::post('notifications/broadcast', [\App\Http\Controllers\Api\Admin\NotificationAdminController::class, 'broadcast']);
        Route::get('notifications/history', [\App\Http\Controllers\Api\Admin\NotificationAdminController::class, 'history']);
    });
});
