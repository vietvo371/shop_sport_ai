<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>SportStore API Documentation</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.print.css") }}" media="print">

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet"
          href="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/styles/obsidian.min.css">
    <script src="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

    <style id="language-style">
        /* starts out as display none and is replaced with js later  */
                    body .content .bash-example code { display: none; }
                    body .content .javascript-example code { display: none; }
            </style>

    <script>
        var tryItOutBaseUrl = "http://localhost:8000";
        var useCsrf = Boolean();
        var csrfUrl = "/sanctum/csrf-cookie";
    </script>
    <script src="{{ asset("/vendor/scribe/js/tryitout-5.8.0.js") }}"></script>

    <script src="{{ asset("/vendor/scribe/js/theme-default-5.8.0.js") }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;]">

<a href="#" id="nav-button">
    <span>
        MENU
        <img src="{{ asset("/vendor/scribe/images/navbar.png") }}" alt="navbar-image"/>
    </span>
</a>
<div class="tocify-wrapper">
    
            <div class="lang-selector">
                                            <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                            <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                    </div>
    
    <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>

    <div id="toc">
                    <ul id="tocify-header-introduction" class="tocify-header">
                <li class="tocify-item level-1" data-unique="introduction">
                    <a href="#introduction">Introduction</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authenticating-requests" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authenticating-requests">
                    <a href="#authenticating-requests">Authenticating requests</a>
                </li>
                            </ul>
                    <ul id="tocify-header-1-dang-ky-dang-nhap" class="tocify-header">
                <li class="tocify-item level-1" data-unique="1-dang-ky-dang-nhap">
                    <a href="#1-dang-ky-dang-nhap">1. Đăng ký & Đăng nhập</a>
                </li>
                                    <ul id="tocify-subheader-1-dang-ky-dang-nhap" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="1-dang-ky-dang-nhap-xac-thuc-nguoi-dung-cac-api-lien-quan-den-dang-ky-dang-nhap-va-lay-thong-tin-phien-ban-nguoi-dung-hien-tai">
                                <a href="#1-dang-ky-dang-nhap-xac-thuc-nguoi-dung-cac-api-lien-quan-den-dang-ky-dang-nhap-va-lay-thong-tin-phien-ban-nguoi-dung-hien-tai">Xác thực người dùng

Các API liên quan đến đăng ký, đăng nhập và lấy thông tin phiên bản người dùng hiện tại</a>
                            </li>
                                                            <ul id="tocify-subheader-1-dang-ky-dang-nhap-xac-thuc-nguoi-dung-cac-api-lien-quan-den-dang-ky-dang-nhap-va-lay-thong-tin-phien-ban-nguoi-dung-hien-tai" class="tocify-subheader">
                                                                            <li class="tocify-item level-3" data-unique="1-dang-ky-dang-nhap-POSTapi-v1-auth-register">
                                            <a href="#1-dang-ky-dang-nhap-POSTapi-v1-auth-register">Đăng ký tài khoản</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="1-dang-ky-dang-nhap-POSTapi-v1-auth-login">
                                            <a href="#1-dang-ky-dang-nhap-POSTapi-v1-auth-login">Đăng nhập</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="1-dang-ky-dang-nhap-POSTapi-v1-auth-logout">
                                            <a href="#1-dang-ky-dang-nhap-POSTapi-v1-auth-logout">Đăng xuất</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="1-dang-ky-dang-nhap-GETapi-v1-auth-me">
                                            <a href="#1-dang-ky-dang-nhap-GETapi-v1-auth-me">Lấy thông tin cá nhân</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="1-dang-ky-dang-nhap-PUTapi-v1-auth-me">
                                            <a href="#1-dang-ky-dang-nhap-PUTapi-v1-auth-me">Cập nhật thông tin cá nhân</a>
                                        </li>
                                                                    </ul>
                                                                                <li class="tocify-item level-2" data-unique="1-dang-ky-dang-nhap-google-oauth">
                                <a href="#1-dang-ky-dang-nhap-google-oauth">Google OAuth</a>
                            </li>
                                                            <ul id="tocify-subheader-1-dang-ky-dang-nhap-google-oauth" class="tocify-subheader">
                                                                            <li class="tocify-item level-3" data-unique="1-dang-ky-dang-nhap-GETapi-v1-auth-google-redirect">
                                            <a href="#1-dang-ky-dang-nhap-GETapi-v1-auth-google-redirect">Lấy URL đăng nhập Google</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="1-dang-ky-dang-nhap-POSTapi-v1-auth-google-callback">
                                            <a href="#1-dang-ky-dang-nhap-POSTapi-v1-auth-google-callback">Xử lý callback từ Google</a>
                                        </li>
                                                                    </ul>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-2-san-pham-danh-muc-khach-hang" class="tocify-header">
                <li class="tocify-item level-1" data-unique="2-san-pham-danh-muc-khach-hang">
                    <a href="#2-san-pham-danh-muc-khach-hang">2. Sản phẩm & Danh mục (Khách hàng)</a>
                </li>
                                    <ul id="tocify-subheader-2-san-pham-danh-muc-khach-hang" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="2-san-pham-danh-muc-khach-hang-danh-muc-nen-tang-cho-phep-khach-hang-xem-danh-sach-cac-danh-muc-the-thao-hien-co">
                                <a href="#2-san-pham-danh-muc-khach-hang-danh-muc-nen-tang-cho-phep-khach-hang-xem-danh-sach-cac-danh-muc-the-thao-hien-co">Danh mục nền tảng

Cho phép khách hàng xem danh sách các danh mục thể thao hiện có.</a>
                            </li>
                                                            <ul id="tocify-subheader-2-san-pham-danh-muc-khach-hang-danh-muc-nen-tang-cho-phep-khach-hang-xem-danh-sach-cac-danh-muc-the-thao-hien-co" class="tocify-subheader">
                                                                            <li class="tocify-item level-3" data-unique="2-san-pham-danh-muc-khach-hang-GETapi-v1-categories">
                                            <a href="#2-san-pham-danh-muc-khach-hang-GETapi-v1-categories">Danh sách danh mục</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="2-san-pham-danh-muc-khach-hang-GETapi-v1-categories--slug-">
                                            <a href="#2-san-pham-danh-muc-khach-hang-GETapi-v1-categories--slug-">Chi tiết danh mục</a>
                                        </li>
                                                                    </ul>
                                                                                <li class="tocify-item level-2" data-unique="2-san-pham-danh-muc-khach-hang-thuong-hieu-lay-danh-sach-thuong-hieu-doi-tac-cua-he-thong">
                                <a href="#2-san-pham-danh-muc-khach-hang-thuong-hieu-lay-danh-sach-thuong-hieu-doi-tac-cua-he-thong">Thương hiệu

Lấy danh sách thương hiệu đối tác của hệ thống.</a>
                            </li>
                                                            <ul id="tocify-subheader-2-san-pham-danh-muc-khach-hang-thuong-hieu-lay-danh-sach-thuong-hieu-doi-tac-cua-he-thong" class="tocify-subheader">
                                                                            <li class="tocify-item level-3" data-unique="2-san-pham-danh-muc-khach-hang-GETapi-v1-brands">
                                            <a href="#2-san-pham-danh-muc-khach-hang-GETapi-v1-brands">Danh sách thương hiệu</a>
                                        </li>
                                                                    </ul>
                                                                                <li class="tocify-item level-2" data-unique="2-san-pham-danh-muc-khach-hang-cua-hang-nhom-api-hien-thi-thong-tin-san-pham-danh-cho-khach-hang-tham-quan-ung-dung">
                                <a href="#2-san-pham-danh-muc-khach-hang-cua-hang-nhom-api-hien-thi-thong-tin-san-pham-danh-cho-khach-hang-tham-quan-ung-dung">Cửa hàng

Nhóm API hiển thị thông tin sản phẩm dành cho khách hàng tham quan ứng dụng.</a>
                            </li>
                                                            <ul id="tocify-subheader-2-san-pham-danh-muc-khach-hang-cua-hang-nhom-api-hien-thi-thong-tin-san-pham-danh-cho-khach-hang-tham-quan-ung-dung" class="tocify-subheader">
                                                                            <li class="tocify-item level-3" data-unique="2-san-pham-danh-muc-khach-hang-GETapi-v1-products">
                                            <a href="#2-san-pham-danh-muc-khach-hang-GETapi-v1-products">Lấy danh sách sản phẩm</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="2-san-pham-danh-muc-khach-hang-GETapi-v1-products--slug-">
                                            <a href="#2-san-pham-danh-muc-khach-hang-GETapi-v1-products--slug-">Xem chi tiết sản phẩm</a>
                                        </li>
                                                                    </ul>
                                                                                <li class="tocify-item level-2" data-unique="2-san-pham-danh-muc-khach-hang-banner-trang-chu-quan-ly-hien-thi-banner-dong-tren-giao-dien-cua-hang">
                                <a href="#2-san-pham-danh-muc-khach-hang-banner-trang-chu-quan-ly-hien-thi-banner-dong-tren-giao-dien-cua-hang">Banner Trang chủ

Quản lý hiển thị Banner động trên giao diện Cửa hàng.</a>
                            </li>
                                                            <ul id="tocify-subheader-2-san-pham-danh-muc-khach-hang-banner-trang-chu-quan-ly-hien-thi-banner-dong-tren-giao-dien-cua-hang" class="tocify-subheader">
                                                                            <li class="tocify-item level-3" data-unique="2-san-pham-danh-muc-khach-hang-GETapi-v1-banners">
                                            <a href="#2-san-pham-danh-muc-khach-hang-GETapi-v1-banners">Danh sách Banner</a>
                                        </li>
                                                                    </ul>
                                                                                <li class="tocify-item level-2" data-unique="2-san-pham-danh-muc-khach-hang-danh-gia-san-pham">
                                <a href="#2-san-pham-danh-muc-khach-hang-danh-gia-san-pham">Đánh giá Sản phẩm</a>
                            </li>
                                                            <ul id="tocify-subheader-2-san-pham-danh-muc-khach-hang-danh-gia-san-pham" class="tocify-subheader">
                                                                            <li class="tocify-item level-3" data-unique="2-san-pham-danh-muc-khach-hang-POSTapi-v1-reviews">
                                            <a href="#2-san-pham-danh-muc-khach-hang-POSTapi-v1-reviews">Gửi đánh giá</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="2-san-pham-danh-muc-khach-hang-GETapi-v1-reviews--id-">
                                            <a href="#2-san-pham-danh-muc-khach-hang-GETapi-v1-reviews--id-">Chi tiết đánh giá</a>
                                        </li>
                                                                    </ul>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-3-gio-hang-thanh-toan" class="tocify-header">
                <li class="tocify-item level-1" data-unique="3-gio-hang-thanh-toan">
                    <a href="#3-gio-hang-thanh-toan">3. Giỏ hàng & Thanh toán</a>
                </li>
                                    <ul id="tocify-subheader-3-gio-hang-thanh-toan" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="3-gio-hang-thanh-toan-quan-ly-gio-hang-cho-phep-khach-hang-them-sua-xoa-san-pham-trong-gio-hang-ho-tro-ca-khach-vang-lai-luu-qua-header-x-session-id-va-nguoi-dung-da-dang-nhap-luu-qua-user-id">
                                <a href="#3-gio-hang-thanh-toan-quan-ly-gio-hang-cho-phep-khach-hang-them-sua-xoa-san-pham-trong-gio-hang-ho-tro-ca-khach-vang-lai-luu-qua-header-x-session-id-va-nguoi-dung-da-dang-nhap-luu-qua-user-id">Quản lý Giỏ hàng

Cho phép khách hàng thêm, sửa, xóa sản phẩm trong giỏ hàng.
Hỗ trợ cả khách vãng lai (lưu qua Header `X-Session-ID`) và người dùng đã đăng nhập (lưu qua User ID).</a>
                            </li>
                                                            <ul id="tocify-subheader-3-gio-hang-thanh-toan-quan-ly-gio-hang-cho-phep-khach-hang-them-sua-xoa-san-pham-trong-gio-hang-ho-tro-ca-khach-vang-lai-luu-qua-header-x-session-id-va-nguoi-dung-da-dang-nhap-luu-qua-user-id" class="tocify-subheader">
                                                                            <li class="tocify-item level-3" data-unique="3-gio-hang-thanh-toan-GETapi-v1-cart">
                                            <a href="#3-gio-hang-thanh-toan-GETapi-v1-cart">Lấy thông tin giỏ hàng</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="3-gio-hang-thanh-toan-POSTapi-v1-cart-items">
                                            <a href="#3-gio-hang-thanh-toan-POSTapi-v1-cart-items">Thêm sản phẩm vào giỏ</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="3-gio-hang-thanh-toan-PUTapi-v1-cart-items--id-">
                                            <a href="#3-gio-hang-thanh-toan-PUTapi-v1-cart-items--id-">Cập nhật số lượng sản phẩm</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="3-gio-hang-thanh-toan-DELETEapi-v1-cart-items--id-">
                                            <a href="#3-gio-hang-thanh-toan-DELETEapi-v1-cart-items--id-">Xóa sản phẩm khỏi giỏ</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="3-gio-hang-thanh-toan-DELETEapi-v1-cart">
                                            <a href="#3-gio-hang-thanh-toan-DELETEapi-v1-cart">Xóa toàn bộ giỏ hàng</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="3-gio-hang-thanh-toan-POSTapi-v1-cart-merge">
                                            <a href="#3-gio-hang-thanh-toan-POSTapi-v1-cart-merge">Hợp nhất giỏ hàng Guest vào tài khoản sau khi đăng nhập.</a>
                                        </li>
                                                                    </ul>
                                                                                <li class="tocify-item level-2" data-unique="3-gio-hang-thanh-toan-ma-giam-gia">
                                <a href="#3-gio-hang-thanh-toan-ma-giam-gia">Mã giảm giá</a>
                            </li>
                                                            <ul id="tocify-subheader-3-gio-hang-thanh-toan-ma-giam-gia" class="tocify-subheader">
                                                                            <li class="tocify-item level-3" data-unique="3-gio-hang-thanh-toan-POSTapi-v1-coupons-validate">
                                            <a href="#3-gio-hang-thanh-toan-POSTapi-v1-coupons-validate">Kiểm tra mã giảm giá</a>
                                        </li>
                                                                    </ul>
                                                                                <li class="tocify-item level-2" data-unique="3-gio-hang-thanh-toan-thanh-toan-lich-su-don-hang-cho-phep-khach-hang-xem-lich-su-mua-hang-chi-tiet-don-va-thuc-hien-dat-hang-checkout">
                                <a href="#3-gio-hang-thanh-toan-thanh-toan-lich-su-don-hang-cho-phep-khach-hang-xem-lich-su-mua-hang-chi-tiet-don-va-thuc-hien-dat-hang-checkout">Thanh toán & Lịch sử đơn hàng

Cho phép khách hàng xem lịch sử mua hàng, chi tiết đơn và thực hiện đặt hàng (Checkout).</a>
                            </li>
                                                            <ul id="tocify-subheader-3-gio-hang-thanh-toan-thanh-toan-lich-su-don-hang-cho-phep-khach-hang-xem-lich-su-mua-hang-chi-tiet-don-va-thuc-hien-dat-hang-checkout" class="tocify-subheader">
                                                                            <li class="tocify-item level-3" data-unique="3-gio-hang-thanh-toan-GETapi-v1-orders">
                                            <a href="#3-gio-hang-thanh-toan-GETapi-v1-orders">Danh sách Đơn hàng</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="3-gio-hang-thanh-toan-POSTapi-v1-orders">
                                            <a href="#3-gio-hang-thanh-toan-POSTapi-v1-orders">Đặt hàng (Checkout)</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="3-gio-hang-thanh-toan-GETapi-v1-orders--code-">
                                            <a href="#3-gio-hang-thanh-toan-GETapi-v1-orders--code-">Chi tiết đơn hàng</a>
                                        </li>
                                                                    </ul>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-4-thong-tin-ca-nhan-dia-chi" class="tocify-header">
                <li class="tocify-item level-1" data-unique="4-thong-tin-ca-nhan-dia-chi">
                    <a href="#4-thong-tin-ca-nhan-dia-chi">4. Thông tin cá nhân & Địa chỉ</a>
                </li>
                                    <ul id="tocify-subheader-4-thong-tin-ca-nhan-dia-chi" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="4-thong-tin-ca-nhan-dia-chi-so-dia-chi-quan-ly-so-dia-chi-giao-hang-cua-nguoi-dung">
                                <a href="#4-thong-tin-ca-nhan-dia-chi-so-dia-chi-quan-ly-so-dia-chi-giao-hang-cua-nguoi-dung">Sổ địa chỉ

Quản lý sổ địa chỉ giao hàng của người dùng.</a>
                            </li>
                                                            <ul id="tocify-subheader-4-thong-tin-ca-nhan-dia-chi-so-dia-chi-quan-ly-so-dia-chi-giao-hang-cua-nguoi-dung" class="tocify-subheader">
                                                                            <li class="tocify-item level-3" data-unique="4-thong-tin-ca-nhan-dia-chi-GETapi-v1-addresses">
                                            <a href="#4-thong-tin-ca-nhan-dia-chi-GETapi-v1-addresses">Danh sách địa chỉ</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="4-thong-tin-ca-nhan-dia-chi-POSTapi-v1-addresses">
                                            <a href="#4-thong-tin-ca-nhan-dia-chi-POSTapi-v1-addresses">Thêm địa chỉ mới</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="4-thong-tin-ca-nhan-dia-chi-GETapi-v1-addresses--id-">
                                            <a href="#4-thong-tin-ca-nhan-dia-chi-GETapi-v1-addresses--id-">Lấy chi tiết một địa chỉ</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="4-thong-tin-ca-nhan-dia-chi-PUTapi-v1-addresses--id-">
                                            <a href="#4-thong-tin-ca-nhan-dia-chi-PUTapi-v1-addresses--id-">Cập nhật địa chỉ</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="4-thong-tin-ca-nhan-dia-chi-DELETEapi-v1-addresses--id-">
                                            <a href="#4-thong-tin-ca-nhan-dia-chi-DELETEapi-v1-addresses--id-">Xóa địa chỉ</a>
                                        </li>
                                                                    </ul>
                                                                                <li class="tocify-item level-2" data-unique="4-thong-tin-ca-nhan-dia-chi-yeu-thich">
                                <a href="#4-thong-tin-ca-nhan-dia-chi-yeu-thich">Yêu thích</a>
                            </li>
                                                            <ul id="tocify-subheader-4-thong-tin-ca-nhan-dia-chi-yeu-thich" class="tocify-subheader">
                                                                            <li class="tocify-item level-3" data-unique="4-thong-tin-ca-nhan-dia-chi-GETapi-v1-wishlist">
                                            <a href="#4-thong-tin-ca-nhan-dia-chi-GETapi-v1-wishlist">Danh sách sản phẩm yêu thích</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="4-thong-tin-ca-nhan-dia-chi-POSTapi-v1-wishlist--productId-">
                                            <a href="#4-thong-tin-ca-nhan-dia-chi-POSTapi-v1-wishlist--productId-">Thêm/Xóa yêu thích</a>
                                        </li>
                                                                    </ul>
                                                                                <li class="tocify-item level-2" data-unique="4-thong-tin-ca-nhan-dia-chi-quan-ly-thong-bao-kiem-tra-cac-thong-bao-don-hang-khuyen-mai-he-thong-danh-rieng-cho-nguoi-dung">
                                <a href="#4-thong-tin-ca-nhan-dia-chi-quan-ly-thong-bao-kiem-tra-cac-thong-bao-don-hang-khuyen-mai-he-thong-danh-rieng-cho-nguoi-dung">Quản lý Thông báo

Kiểm tra các thông báo (đơn hàng, khuyến mãi, hệ thống...) dành riêng cho người dùng.</a>
                            </li>
                                                            <ul id="tocify-subheader-4-thong-tin-ca-nhan-dia-chi-quan-ly-thong-bao-kiem-tra-cac-thong-bao-don-hang-khuyen-mai-he-thong-danh-rieng-cho-nguoi-dung" class="tocify-subheader">
                                                                            <li class="tocify-item level-3" data-unique="4-thong-tin-ca-nhan-dia-chi-GETapi-v1-notifications">
                                            <a href="#4-thong-tin-ca-nhan-dia-chi-GETapi-v1-notifications">Lấy danh sách thông báo</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="4-thong-tin-ca-nhan-dia-chi-PUTapi-v1-notifications--id--read">
                                            <a href="#4-thong-tin-ca-nhan-dia-chi-PUTapi-v1-notifications--id--read">Đánh dấu 1 thông báo là đã đọc</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="4-thong-tin-ca-nhan-dia-chi-PUTapi-v1-notifications-read-all">
                                            <a href="#4-thong-tin-ca-nhan-dia-chi-PUTapi-v1-notifications-read-all">Đánh dấu toàn bộ là đã đọc</a>
                                        </li>
                                                                    </ul>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-6-quan-tri-vien-admin" class="tocify-header">
                <li class="tocify-item level-1" data-unique="6-quan-tri-vien-admin">
                    <a href="#6-quan-tri-vien-admin">6. Quản trị viên (Admin)</a>
                </li>
                                    <ul id="tocify-subheader-6-quan-tri-vien-admin" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="6-quan-tri-vien-admin-quan-ly-san-pham">
                                <a href="#6-quan-tri-vien-admin-quan-ly-san-pham">Quản lý Sản phẩm</a>
                            </li>
                                                            <ul id="tocify-subheader-6-quan-tri-vien-admin-quan-ly-san-pham" class="tocify-subheader">
                                                                            <li class="tocify-item level-3" data-unique="6-quan-tri-vien-admin-GETapi-v1-admin-products">
                                            <a href="#6-quan-tri-vien-admin-GETapi-v1-admin-products">Danh sách sản phẩm (Admin)</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="6-quan-tri-vien-admin-POSTapi-v1-admin-products">
                                            <a href="#6-quan-tri-vien-admin-POSTapi-v1-admin-products">Tạo sản phẩm mới</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="6-quan-tri-vien-admin-GETapi-v1-admin-products--id-">
                                            <a href="#6-quan-tri-vien-admin-GETapi-v1-admin-products--id-">GET api/v1/admin/products/{id}</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="6-quan-tri-vien-admin-PUTapi-v1-admin-products--id-">
                                            <a href="#6-quan-tri-vien-admin-PUTapi-v1-admin-products--id-">PUT api/v1/admin/products/{id}</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="6-quan-tri-vien-admin-DELETEapi-v1-admin-products--id-">
                                            <a href="#6-quan-tri-vien-admin-DELETEapi-v1-admin-products--id-">DELETE api/v1/admin/products/{id}</a>
                                        </li>
                                                                    </ul>
                                                                                <li class="tocify-item level-2" data-unique="6-quan-tri-vien-admin-quan-ly-danh-muc">
                                <a href="#6-quan-tri-vien-admin-quan-ly-danh-muc">Quản lý Danh mục</a>
                            </li>
                                                            <ul id="tocify-subheader-6-quan-tri-vien-admin-quan-ly-danh-muc" class="tocify-subheader">
                                                                            <li class="tocify-item level-3" data-unique="6-quan-tri-vien-admin-GETapi-v1-admin-categories">
                                            <a href="#6-quan-tri-vien-admin-GETapi-v1-admin-categories">Danh sách danh mục (Admin)</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="6-quan-tri-vien-admin-POSTapi-v1-admin-categories">
                                            <a href="#6-quan-tri-vien-admin-POSTapi-v1-admin-categories">Tạo danh mục mới</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="6-quan-tri-vien-admin-GETapi-v1-admin-categories--id-">
                                            <a href="#6-quan-tri-vien-admin-GETapi-v1-admin-categories--id-">GET api/v1/admin/categories/{id}</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="6-quan-tri-vien-admin-PUTapi-v1-admin-categories--id-">
                                            <a href="#6-quan-tri-vien-admin-PUTapi-v1-admin-categories--id-">PUT api/v1/admin/categories/{id}</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="6-quan-tri-vien-admin-DELETEapi-v1-admin-categories--id-">
                                            <a href="#6-quan-tri-vien-admin-DELETEapi-v1-admin-categories--id-">DELETE api/v1/admin/categories/{id}</a>
                                        </li>
                                                                    </ul>
                                                                                <li class="tocify-item level-2" data-unique="6-quan-tri-vien-admin-quan-ly-thuong-hieu">
                                <a href="#6-quan-tri-vien-admin-quan-ly-thuong-hieu">Quản lý Thương hiệu</a>
                            </li>
                                                            <ul id="tocify-subheader-6-quan-tri-vien-admin-quan-ly-thuong-hieu" class="tocify-subheader">
                                                                            <li class="tocify-item level-3" data-unique="6-quan-tri-vien-admin-GETapi-v1-admin-brands">
                                            <a href="#6-quan-tri-vien-admin-GETapi-v1-admin-brands">Danh sách thương hiệu (Admin)</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="6-quan-tri-vien-admin-POSTapi-v1-admin-brands">
                                            <a href="#6-quan-tri-vien-admin-POSTapi-v1-admin-brands">Tạo thương hiệu mới</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="6-quan-tri-vien-admin-GETapi-v1-admin-brands--id-">
                                            <a href="#6-quan-tri-vien-admin-GETapi-v1-admin-brands--id-">GET api/v1/admin/brands/{id}</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="6-quan-tri-vien-admin-PUTapi-v1-admin-brands--id-">
                                            <a href="#6-quan-tri-vien-admin-PUTapi-v1-admin-brands--id-">PUT api/v1/admin/brands/{id}</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="6-quan-tri-vien-admin-DELETEapi-v1-admin-brands--id-">
                                            <a href="#6-quan-tri-vien-admin-DELETEapi-v1-admin-brands--id-">DELETE api/v1/admin/brands/{id}</a>
                                        </li>
                                                                    </ul>
                                                                                <li class="tocify-item level-2" data-unique="6-quan-tri-vien-admin-quan-ly-don-hang">
                                <a href="#6-quan-tri-vien-admin-quan-ly-don-hang">Quản lý Đơn hàng</a>
                            </li>
                                                            <ul id="tocify-subheader-6-quan-tri-vien-admin-quan-ly-don-hang" class="tocify-subheader">
                                                                            <li class="tocify-item level-3" data-unique="6-quan-tri-vien-admin-GETapi-v1-admin-orders">
                                            <a href="#6-quan-tri-vien-admin-GETapi-v1-admin-orders">Danh sách đơn hàng (Admin)</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="6-quan-tri-vien-admin-GETapi-v1-admin-orders--id-">
                                            <a href="#6-quan-tri-vien-admin-GETapi-v1-admin-orders--id-">Chi tiết đơn hàng (Admin)</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="6-quan-tri-vien-admin-PUTapi-v1-admin-orders--id--status">
                                            <a href="#6-quan-tri-vien-admin-PUTapi-v1-admin-orders--id--status">Cập nhật trạng thái đơn</a>
                                        </li>
                                                                    </ul>
                                                                                <li class="tocify-item level-2" data-unique="6-quan-tri-vien-admin-quan-ly-ma-giam-gia">
                                <a href="#6-quan-tri-vien-admin-quan-ly-ma-giam-gia">Quản lý Mã giảm giá</a>
                            </li>
                                                            <ul id="tocify-subheader-6-quan-tri-vien-admin-quan-ly-ma-giam-gia" class="tocify-subheader">
                                                                            <li class="tocify-item level-3" data-unique="6-quan-tri-vien-admin-GETapi-v1-admin-coupons">
                                            <a href="#6-quan-tri-vien-admin-GETapi-v1-admin-coupons">Danh sách mã giảm giá (Admin)</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="6-quan-tri-vien-admin-POSTapi-v1-admin-coupons">
                                            <a href="#6-quan-tri-vien-admin-POSTapi-v1-admin-coupons">Cấp mã giảm giá mới</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="6-quan-tri-vien-admin-GETapi-v1-admin-coupons--id-">
                                            <a href="#6-quan-tri-vien-admin-GETapi-v1-admin-coupons--id-">GET api/v1/admin/coupons/{id}</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="6-quan-tri-vien-admin-PUTapi-v1-admin-coupons--id-">
                                            <a href="#6-quan-tri-vien-admin-PUTapi-v1-admin-coupons--id-">PUT api/v1/admin/coupons/{id}</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="6-quan-tri-vien-admin-DELETEapi-v1-admin-coupons--id-">
                                            <a href="#6-quan-tri-vien-admin-DELETEapi-v1-admin-coupons--id-">DELETE api/v1/admin/coupons/{id}</a>
                                        </li>
                                                                    </ul>
                                                                                <li class="tocify-item level-2" data-unique="6-quan-tri-vien-admin-quan-ly-danh-gia">
                                <a href="#6-quan-tri-vien-admin-quan-ly-danh-gia">Quản lý Đánh giá</a>
                            </li>
                                                            <ul id="tocify-subheader-6-quan-tri-vien-admin-quan-ly-danh-gia" class="tocify-subheader">
                                                                            <li class="tocify-item level-3" data-unique="6-quan-tri-vien-admin-GETapi-v1-admin-reviews">
                                            <a href="#6-quan-tri-vien-admin-GETapi-v1-admin-reviews">Danh sách đánh giá (Admin)</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="6-quan-tri-vien-admin-PUTapi-v1-admin-reviews--id--approve">
                                            <a href="#6-quan-tri-vien-admin-PUTapi-v1-admin-reviews--id--approve">Duyệt đánh giá</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="6-quan-tri-vien-admin-DELETEapi-v1-admin-reviews--id-">
                                            <a href="#6-quan-tri-vien-admin-DELETEapi-v1-admin-reviews--id-">Xóa đánh giá</a>
                                        </li>
                                                                    </ul>
                                                                                <li class="tocify-item level-2" data-unique="6-quan-tri-vien-admin-quan-ly-nguoi-dung">
                                <a href="#6-quan-tri-vien-admin-quan-ly-nguoi-dung">Quản lý Người dùng</a>
                            </li>
                                                            <ul id="tocify-subheader-6-quan-tri-vien-admin-quan-ly-nguoi-dung" class="tocify-subheader">
                                                                            <li class="tocify-item level-3" data-unique="6-quan-tri-vien-admin-GETapi-v1-admin-users">
                                            <a href="#6-quan-tri-vien-admin-GETapi-v1-admin-users">Danh sách người dùng (Admin)</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="6-quan-tri-vien-admin-POSTapi-v1-admin-users">
                                            <a href="#6-quan-tri-vien-admin-POSTapi-v1-admin-users">Thêm mới người dùng (Admin)</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="6-quan-tri-vien-admin-GETapi-v1-admin-users--id-">
                                            <a href="#6-quan-tri-vien-admin-GETapi-v1-admin-users--id-">Chi tiết người dùng (Admin)</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="6-quan-tri-vien-admin-PUTapi-v1-admin-users--id-">
                                            <a href="#6-quan-tri-vien-admin-PUTapi-v1-admin-users--id-">Cập nhật thông tin/trạng thái người dùng (Admin)</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="6-quan-tri-vien-admin-DELETEapi-v1-admin-users--id-">
                                            <a href="#6-quan-tri-vien-admin-DELETEapi-v1-admin-users--id-">Xóa người dùng (Admin)</a>
                                        </li>
                                                                    </ul>
                                                                                <li class="tocify-item level-2" data-unique="6-quan-tri-vien-admin-bao-cao-thong-ke">
                                <a href="#6-quan-tri-vien-admin-bao-cao-thong-ke">Báo cáo & Thống kê</a>
                            </li>
                                                            <ul id="tocify-subheader-6-quan-tri-vien-admin-bao-cao-thong-ke" class="tocify-subheader">
                                                                            <li class="tocify-item level-3" data-unique="6-quan-tri-vien-admin-GETapi-v1-admin-reports-overview">
                                            <a href="#6-quan-tri-vien-admin-GETapi-v1-admin-reports-overview">Tổng quan thống kê (Overview)</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="6-quan-tri-vien-admin-GETapi-v1-admin-reports-revenue-chart">
                                            <a href="#6-quan-tri-vien-admin-GETapi-v1-admin-reports-revenue-chart">Dữ liệu biểu đồ doanh thu (Revenue Chart)</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="6-quan-tri-vien-admin-GETapi-v1-admin-reports-top-products">
                                            <a href="#6-quan-tri-vien-admin-GETapi-v1-admin-reports-top-products">Top sản phẩm bán chạy (Top Products)</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="6-quan-tri-vien-admin-GETapi-v1-admin-reports-product-stats">
                                            <a href="#6-quan-tri-vien-admin-GETapi-v1-admin-reports-product-stats">Thống kê sản phẩm tĩnh (Total, low_stock, views.</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="6-quan-tri-vien-admin-GETapi-v1-admin-reports-customer-stats">
                                            <a href="#6-quan-tri-vien-admin-GETapi-v1-admin-reports-customer-stats">====== KHACH HANG (CUSTOMERS) ======</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="6-quan-tri-vien-admin-GETapi-v1-admin-reports-customer-chart">
                                            <a href="#6-quan-tri-vien-admin-GETapi-v1-admin-reports-customer-chart">GET api/v1/admin/reports/customer-chart</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="6-quan-tri-vien-admin-GETapi-v1-admin-reports-top-customers">
                                            <a href="#6-quan-tri-vien-admin-GETapi-v1-admin-reports-top-customers">GET api/v1/admin/reports/top-customers</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="6-quan-tri-vien-admin-GETapi-v1-admin-reports-marketing-stats">
                                            <a href="#6-quan-tri-vien-admin-GETapi-v1-admin-reports-marketing-stats">====== MARKETING ======</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="6-quan-tri-vien-admin-GETapi-v1-admin-reports-coupon-chart">
                                            <a href="#6-quan-tri-vien-admin-GETapi-v1-admin-reports-coupon-chart">GET api/v1/admin/reports/coupon-chart</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="6-quan-tri-vien-admin-GETapi-v1-admin-reports-top-coupons">
                                            <a href="#6-quan-tri-vien-admin-GETapi-v1-admin-reports-top-coupons">GET api/v1/admin/reports/top-coupons</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="6-quan-tri-vien-admin-GETapi-v1-admin-reports-chatbot-stats">
                                            <a href="#6-quan-tri-vien-admin-GETapi-v1-admin-reports-chatbot-stats">====== CHATBOT AI ======</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="6-quan-tri-vien-admin-GETapi-v1-admin-reports-chatbot-chart">
                                            <a href="#6-quan-tri-vien-admin-GETapi-v1-admin-reports-chatbot-chart">GET api/v1/admin/reports/chatbot-chart</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="6-quan-tri-vien-admin-GETapi-v1-admin-reports-recent-chats">
                                            <a href="#6-quan-tri-vien-admin-GETapi-v1-admin-reports-recent-chats">GET api/v1/admin/reports/recent-chats</a>
                                        </li>
                                                                    </ul>
                                                                                <li class="tocify-item level-2" data-unique="6-quan-tri-vien-admin-quan-ly-banner">
                                <a href="#6-quan-tri-vien-admin-quan-ly-banner">Quản lý Banner</a>
                            </li>
                                                            <ul id="tocify-subheader-6-quan-tri-vien-admin-quan-ly-banner" class="tocify-subheader">
                                                                            <li class="tocify-item level-3" data-unique="6-quan-tri-vien-admin-GETapi-v1-admin-banners">
                                            <a href="#6-quan-tri-vien-admin-GETapi-v1-admin-banners">Danh sách Banner</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="6-quan-tri-vien-admin-POSTapi-v1-admin-banners">
                                            <a href="#6-quan-tri-vien-admin-POSTapi-v1-admin-banners">Thêm mới Banner</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="6-quan-tri-vien-admin-GETapi-v1-admin-banners--id-">
                                            <a href="#6-quan-tri-vien-admin-GETapi-v1-admin-banners--id-">Chi tiết Banner</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="6-quan-tri-vien-admin-PUTapi-v1-admin-banners--id-">
                                            <a href="#6-quan-tri-vien-admin-PUTapi-v1-admin-banners--id-">Cập nhật Banner</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="6-quan-tri-vien-admin-DELETEapi-v1-admin-banners--id-">
                                            <a href="#6-quan-tri-vien-admin-DELETEapi-v1-admin-banners--id-">Xóa Banner</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="6-quan-tri-vien-admin-PATCHapi-v1-admin-banners--banner--status">
                                            <a href="#6-quan-tri-vien-admin-PATCHapi-v1-admin-banners--banner--status">Bật/tắt trạng thái hiển thị</a>
                                        </li>
                                                                    </ul>
                                                                                <li class="tocify-item level-2" data-unique="6-quan-tri-vien-admin-quan-ly-thong-bao">
                                <a href="#6-quan-tri-vien-admin-quan-ly-thong-bao">Quản lý Thông báo</a>
                            </li>
                                                            <ul id="tocify-subheader-6-quan-tri-vien-admin-quan-ly-thong-bao" class="tocify-subheader">
                                                                            <li class="tocify-item level-3" data-unique="6-quan-tri-vien-admin-POSTapi-v1-admin-notifications-broadcast">
                                            <a href="#6-quan-tri-vien-admin-POSTapi-v1-admin-notifications-broadcast">Gửi thông báo tới toàn bộ người dùng (Broadcast)</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="6-quan-tri-vien-admin-GETapi-v1-admin-notifications-history">
                                            <a href="#6-quan-tri-vien-admin-GETapi-v1-admin-notifications-history">Danh sách lịch sử thông báo quảng bá (Gần đây)</a>
                                        </li>
                                                                    </ul>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-1-quan-tri-admin" class="tocify-header">
                <li class="tocify-item level-1" data-unique="1-quan-tri-admin">
                    <a href="#1-quan-tri-admin">1. Quản trị (Admin)</a>
                </li>
                                    <ul id="tocify-subheader-1-quan-tri-admin" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="1-quan-tri-admin-thong-ke">
                                <a href="#1-quan-tri-admin-thong-ke">Thống kê</a>
                            </li>
                                                            <ul id="tocify-subheader-1-quan-tri-admin-thong-ke" class="tocify-subheader">
                                                                            <li class="tocify-item level-3" data-unique="1-quan-tri-admin-GETapi-v1-admin-dashboard">
                                            <a href="#1-quan-tri-admin-GETapi-v1-admin-dashboard">Lấy thống kê tổng quan</a>
                                        </li>
                                                                    </ul>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-1-xac-thuc-tai-khoan" class="tocify-header">
                <li class="tocify-item level-1" data-unique="1-xac-thuc-tai-khoan">
                    <a href="#1-xac-thuc-tai-khoan">1. Xác thực & Tài khoản</a>
                </li>
                                    <ul id="tocify-subheader-1-xac-thuc-tai-khoan" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="1-xac-thuc-tai-khoan-quan-ly-xac-thuc-email">
                                <a href="#1-xac-thuc-tai-khoan-quan-ly-xac-thuc-email">Quản lý Xác thực Email</a>
                            </li>
                                                            <ul id="tocify-subheader-1-xac-thuc-tai-khoan-quan-ly-xac-thuc-email" class="tocify-subheader">
                                                                            <li class="tocify-item level-3" data-unique="1-xac-thuc-tai-khoan-GETapi-v1-auth-email-verify--id---hash-">
                                            <a href="#1-xac-thuc-tai-khoan-GETapi-v1-auth-email-verify--id---hash-">Xử lý click vào link xác thực từ email.</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="1-xac-thuc-tai-khoan-POSTapi-v1-auth-email-resend">
                                            <a href="#1-xac-thuc-tai-khoan-POSTapi-v1-auth-email-resend">Gửi lại email xác thực</a>
                                        </li>
                                                                    </ul>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-12-quan-ly-bang-size" class="tocify-header">
                <li class="tocify-item level-1" data-unique="12-quan-ly-bang-size">
                    <a href="#12-quan-ly-bang-size">12. Quản lý Bảng Size</a>
                </li>
                                    <ul id="tocify-subheader-12-quan-ly-bang-size" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="12-quan-ly-bang-size-cau-hinh-chatbot-tu-van-api-danh-cho-admin-de-quan-ly-cac-quy-tac-chon-size-san-pham">
                                <a href="#12-quan-ly-bang-size-cau-hinh-chatbot-tu-van-api-danh-cho-admin-de-quan-ly-cac-quy-tac-chon-size-san-pham">Cấu hình Chatbot & Tư vấn

API dành cho Admin để quản lý các quy tắc chọn size sản phẩm.</a>
                            </li>
                                                            <ul id="tocify-subheader-12-quan-ly-bang-size-cau-hinh-chatbot-tu-van-api-danh-cho-admin-de-quan-ly-cac-quy-tac-chon-size-san-pham" class="tocify-subheader">
                                                                            <li class="tocify-item level-3" data-unique="12-quan-ly-bang-size-GETapi-v1-admin-size-charts">
                                            <a href="#12-quan-ly-bang-size-GETapi-v1-admin-size-charts">Danh sách Bảng Size</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="12-quan-ly-bang-size-POSTapi-v1-admin-size-charts">
                                            <a href="#12-quan-ly-bang-size-POSTapi-v1-admin-size-charts">Thêm mới Quy tắc Size</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="12-quan-ly-bang-size-PUTapi-v1-admin-size-charts--id-">
                                            <a href="#12-quan-ly-bang-size-PUTapi-v1-admin-size-charts--id-">Cập nhật Quy tắc Size</a>
                                        </li>
                                                                            <li class="tocify-item level-3" data-unique="12-quan-ly-bang-size-DELETEapi-v1-admin-size-charts--id-">
                                            <a href="#12-quan-ly-bang-size-DELETEapi-v1-admin-size-charts--id-">Xóa Quy tắc Size</a>
                                        </li>
                                                                    </ul>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-endpoints" class="tocify-header">
                <li class="tocify-item level-1" data-unique="endpoints">
                    <a href="#endpoints">Endpoints</a>
                </li>
                                    <ul id="tocify-subheader-endpoints" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-auth-password-email">
                                <a href="#endpoints-POSTapi-v1-auth-password-email">Gửi link reset mật khẩu qua email.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-auth-password-reset">
                                <a href="#endpoints-POSTapi-v1-auth-password-reset">Đặt lại mật khẩu mới thông qua token.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-chatbot-message">
                                <a href="#endpoints-POSTapi-v1-chatbot-message">POST api/v1/chatbot/message</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-chatbot-history">
                                <a href="#endpoints-GETapi-v1-chatbot-history">GET api/v1/chatbot/history</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-recommendations">
                                <a href="#endpoints-GETapi-v1-recommendations">Lấy gợi ý sản phẩm từ Python AI service hoặc trả fallback.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-recommendations--productId--related">
                                <a href="#endpoints-GETapi-v1-recommendations--productId--related">Lấy sản phẩm tương tự (cho trang chi tiết sản phẩm).</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-behaviors">
                                <a href="#endpoints-POSTapi-v1-behaviors">Ghi nhận hành vi người dùng cho ML.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-payments-create-url">
                                <a href="#endpoints-POSTapi-v1-payments-create-url">Tạo URL thanh toán cho đơn hàng</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-payments-vnpay-return">
                                <a href="#endpoints-GETapi-v1-payments-vnpay-return">VNPay Callback (Redirect sau khi thanh toán)</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-payments-momo-return">
                                <a href="#endpoints-GETapi-v1-payments-momo-return">MoMo Return (Client Redirect)
Xác thực khi Client Frontend bị redirect về từ app momo.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-payments-momo-ipn">
                                <a href="#endpoints-POSTapi-v1-payments-momo-ipn">MoMo IPN/Callback (Xử lý khi MoMo gọi back)</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-admin-upload">
                                <a href="#endpoints-POSTapi-v1-admin-upload">Upload ảnh</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-admin-roles">
                                <a href="#endpoints-GETapi-v1-admin-roles">Danh sách vai trò kèm quyền hạn</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-admin-roles">
                                <a href="#endpoints-POSTapi-v1-admin-roles">Thêm mới vai trò</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-admin-roles--id-">
                                <a href="#endpoints-GETapi-v1-admin-roles--id-">Chi tiết một vai trò</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTapi-v1-admin-roles--id-">
                                <a href="#endpoints-PUTapi-v1-admin-roles--id-">Cập nhật vai trò</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEapi-v1-admin-roles--id-">
                                <a href="#endpoints-DELETEapi-v1-admin-roles--id-">Xóa vai trò</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-admin-permissions">
                                <a href="#endpoints-GETapi-v1-admin-permissions">Lấy danh sách tất cả quyền hạn (để hiển thị checkbox)</a>
                            </li>
                                                                        </ul>
                            </ul>
            </div>

    <ul class="toc-footer" id="toc-footer">
                    <li style="padding-bottom: 5px;"><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                            <li style="padding-bottom: 5px;"><a href="{{ route("scribe.openapi") }}">View OpenAPI spec</a></li>
                <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
    </ul>

    <ul class="toc-footer" id="last-updated">
        <li>Last updated: April 1, 2026</li>
    </ul>
</div>

<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1 id="introduction">Introduction</h1>
<p>Tài liệu tích hợp API cho dự án SportStore - Hệ thống bán lẻ Thể thao.</p>
<aside>
    <strong>Base URL</strong>: <code>http://localhost:8000</code>
</aside>
<pre><code>Chào mừng bạn đến với tài liệu API của SportStore.

API này phục vụ cho Frontend Next.js (Khách hàng) và Trang quản trị Admin. 
Tất cả các response trả về đều tuân theo chuẩn định dạng JSON thống nhất chung qua `ApiResponse` format.

&lt;aside&gt;Các đoạn code ví dụ (bash, javascript...) nằm ở bên sáng bên phải để bạn có thể tham khảo nhanh.&lt;/aside&gt;</code></pre>

        <h1 id="authenticating-requests">Authenticating requests</h1>
<p>To authenticate requests, include an <strong><code>Authorization</code></strong> header with the value <strong><code>"Bearer {YOUR_AUTH_KEY}"</code></strong>.</p>
<p>All authenticated endpoints are marked with a <code>requires authentication</code> badge in the documentation below.</p>
<p>Sử dụng Bearer Token lấy từ API login để xác thực.</p>

        <h1 id="1-dang-ky-dang-nhap">1. Đăng ký & Đăng nhập</h1>

    

                        <h2 id="1-dang-ky-dang-nhap-xac-thuc-nguoi-dung-cac-api-lien-quan-den-dang-ky-dang-nhap-va-lay-thong-tin-phien-ban-nguoi-dung-hien-tai">Xác thực người dùng

Các API liên quan đến đăng ký, đăng nhập và lấy thông tin phiên bản người dùng hiện tại</h2>
                                                    <h2 id="1-dang-ky-dang-nhap-POSTapi-v1-auth-register">Đăng ký tài khoản</h2>

<p>
</p>

<p>Đăng ký thành viên mới cho SportStore. Mật khẩu sẽ được băm (hash) tự động.</p>

<span id="example-requests-POSTapi-v1-auth-register">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/v1/auth/register" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"ho_va_ten\": \"Nguyễn Văn A\",
    \"email\": \"nguyenva@email.com\",
    \"mat_khau\": \"password123\",
    \"mat_khau_confirmation\": \"password123\",
    \"so_dien_thoai\": \"0987654321\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/auth/register"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "ho_va_ten": "Nguyễn Văn A",
    "email": "nguyenva@email.com",
    "mat_khau": "password123",
    "mat_khau_confirmation": "password123",
    "so_dien_thoai": "0987654321"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-auth-register">
</span>
<span id="execution-results-POSTapi-v1-auth-register" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-auth-register"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-auth-register"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-auth-register" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-auth-register">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-auth-register" data-method="POST"
      data-path="api/v1/auth/register"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-auth-register', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-auth-register"
                    onclick="tryItOut('POSTapi-v1-auth-register');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-auth-register"
                    onclick="cancelTryOut('POSTapi-v1-auth-register');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-auth-register"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/auth/register</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-auth-register"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-auth-register"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>ho_va_ten</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="ho_va_ten"                data-endpoint="POSTapi-v1-auth-register"
               value="Nguyễn Văn A"
               data-component="body">
    <br>
<p>Họ và tên người dùng. Example: <code>Nguyễn Văn A</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-v1-auth-register"
               value="nguyenva@email.com"
               data-component="body">
    <br>
<p>Địa chỉ email hợp lệ. Example: <code>nguyenva@email.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>mat_khau</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="mat_khau"                data-endpoint="POSTapi-v1-auth-register"
               value="password123"
               data-component="body">
    <br>
<p>Mật khẩu (ít nhất 8 ký tự). Example: <code>password123</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>mat_khau_confirmation</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="mat_khau_confirmation"                data-endpoint="POSTapi-v1-auth-register"
               value="password123"
               data-component="body">
    <br>
<p>Nhập lại mật khẩu để xác nhận. Example: <code>password123</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>so_dien_thoai</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="so_dien_thoai"                data-endpoint="POSTapi-v1-auth-register"
               value="0987654321"
               data-component="body">
    <br>
<p>Số điện thoại liên hệ. Example: <code>0987654321</code></p>
        </div>
        </form>

                    <h2 id="1-dang-ky-dang-nhap-POSTapi-v1-auth-login">Đăng nhập</h2>

<p>
</p>

<p>Xác thực người dùng bằng Email và Mật khẩu. Sẽ trả về Access Token sử dụng cho các request sau.</p>

<span id="example-requests-POSTapi-v1-auth-login">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/v1/auth/login" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"email\": \"nguyenva@email.com\",
    \"mat_khau\": \"password123\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/auth/login"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "nguyenva@email.com",
    "mat_khau": "password123"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-auth-login">
</span>
<span id="execution-results-POSTapi-v1-auth-login" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-auth-login"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-auth-login"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-auth-login" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-auth-login">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-auth-login" data-method="POST"
      data-path="api/v1/auth/login"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-auth-login', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-auth-login"
                    onclick="tryItOut('POSTapi-v1-auth-login');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-auth-login"
                    onclick="cancelTryOut('POSTapi-v1-auth-login');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-auth-login"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/auth/login</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-auth-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-auth-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-v1-auth-login"
               value="nguyenva@email.com"
               data-component="body">
    <br>
<p>Email đã đăng ký. Example: <code>nguyenva@email.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>mat_khau</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="mat_khau"                data-endpoint="POSTapi-v1-auth-login"
               value="password123"
               data-component="body">
    <br>
<p>Mật khẩu đăng nhập. Example: <code>password123</code></p>
        </div>
        </form>

                    <h2 id="1-dang-ky-dang-nhap-POSTapi-v1-auth-logout">Đăng xuất</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Xóa bỏ Access Token hiện tại (Revoke) của người dùng. Yêu cầu truyền Header Authorization.</p>

<span id="example-requests-POSTapi-v1-auth-logout">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/v1/auth/logout" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/auth/logout"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-auth-logout">
</span>
<span id="execution-results-POSTapi-v1-auth-logout" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-auth-logout"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-auth-logout"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-auth-logout" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-auth-logout">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-auth-logout" data-method="POST"
      data-path="api/v1/auth/logout"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-auth-logout', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-auth-logout"
                    onclick="tryItOut('POSTapi-v1-auth-logout');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-auth-logout"
                    onclick="cancelTryOut('POSTapi-v1-auth-logout');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-auth-logout"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/auth/logout</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-auth-logout"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-auth-logout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-auth-logout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="1-dang-ky-dang-nhap-GETapi-v1-auth-me">Lấy thông tin cá nhân</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Trả về thông tin chi tiết tài khoản của người dùng đang đăng nhập, bao gồm cả địa chỉ mặc định.</p>

<span id="example-requests-GETapi-v1-auth-me">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/auth/me" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/auth/me"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-auth-me">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-auth-me" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-auth-me"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-auth-me"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-auth-me" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-auth-me">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-auth-me" data-method="GET"
      data-path="api/v1/auth/me"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-auth-me', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-auth-me"
                    onclick="tryItOut('GETapi-v1-auth-me');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-auth-me"
                    onclick="cancelTryOut('GETapi-v1-auth-me');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-auth-me"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/auth/me</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-auth-me"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-auth-me"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-auth-me"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="1-dang-ky-dang-nhap-PUTapi-v1-auth-me">Cập nhật thông tin cá nhân</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Cập nhật Profile. Nếu muốn đổi mật khẩu thì cung cấp thêm <code>mat_khau_cu</code> và <code>mat_khau_moi</code>.</p>

<span id="example-requests-PUTapi-v1-auth-me">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost:8000/api/v1/auth/me" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"ho_va_ten\": \"Nguyễn Văn B\",
    \"so_dien_thoai\": \"0912345678\",
    \"anh_dai_dien\": \"y\",
    \"mat_khau_cu\": \"password123\",
    \"mat_khau_moi\": \"newpassword456\",
    \"mat_khau_moi_confirmation\": \"newpassword456\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/auth/me"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "ho_va_ten": "Nguyễn Văn B",
    "so_dien_thoai": "0912345678",
    "anh_dai_dien": "y",
    "mat_khau_cu": "password123",
    "mat_khau_moi": "newpassword456",
    "mat_khau_moi_confirmation": "newpassword456"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-v1-auth-me">
</span>
<span id="execution-results-PUTapi-v1-auth-me" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-auth-me"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-auth-me"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-auth-me" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-auth-me">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v1-auth-me" data-method="PUT"
      data-path="api/v1/auth/me"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-auth-me', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-auth-me"
                    onclick="tryItOut('PUTapi-v1-auth-me');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-auth-me"
                    onclick="cancelTryOut('PUTapi-v1-auth-me');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-auth-me"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/auth/me</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-v1-auth-me"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v1-auth-me"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-v1-auth-me"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>ho_va_ten</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="ho_va_ten"                data-endpoint="PUTapi-v1-auth-me"
               value="Nguyễn Văn B"
               data-component="body">
    <br>
<p>Họ và tên mới. Example: <code>Nguyễn Văn B</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>so_dien_thoai</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="so_dien_thoai"                data-endpoint="PUTapi-v1-auth-me"
               value="0912345678"
               data-component="body">
    <br>
<p>Số điện thoại mới. Example: <code>0912345678</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>anh_dai_dien</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="anh_dai_dien"                data-endpoint="PUTapi-v1-auth-me"
               value="y"
               data-component="body">
    <br>
<p>Must not be greater than 500 characters. Example: <code>y</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>mat_khau_cu</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="mat_khau_cu"                data-endpoint="PUTapi-v1-auth-me"
               value="password123"
               data-component="body">
    <br>
<p>Mật khẩu hiện tại (bắt buộc nếu muốn đổi mật khẩu). Example: <code>password123</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>mat_khau_moi</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="mat_khau_moi"                data-endpoint="PUTapi-v1-auth-me"
               value="newpassword456"
               data-component="body">
    <br>
<p>Mật khẩu mới thiết lập (chỉ gửi khi muốn đổi). Example: <code>newpassword456</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>mat_khau_moi_confirmation</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="mat_khau_moi_confirmation"                data-endpoint="PUTapi-v1-auth-me"
               value="newpassword456"
               data-component="body">
    <br>
<p>Xác nhận mật khẩu mới. Example: <code>newpassword456</code></p>
        </div>
        </form>

                                <h2 id="1-dang-ky-dang-nhap-google-oauth">Google OAuth</h2>
                                                    <h2 id="1-dang-ky-dang-nhap-GETapi-v1-auth-google-redirect">Lấy URL đăng nhập Google</h2>

<p>
</p>

<p>Trả về URL để client redirect đến màn hình chọn tài khoản Google.</p>

<span id="example-requests-GETapi-v1-auth-google-redirect">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/auth/google/redirect" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/auth/google/redirect"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-auth-google-redirect">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Google OAuth URL&quot;,
    &quot;data&quot;: {
        &quot;url&quot;: &quot;https://accounts.google.com/o/oauth2/auth?client_id=944810457078-ocg3087k2s9pjj5im1g1jpgdtfd57dlq.apps.googleusercontent.com&amp;redirect_uri=http%3A%2F%2Flocalhost%3A3000%2Fauth%2Fcallback&amp;scope=openid+profile+email&amp;response_type=code&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-auth-google-redirect" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-auth-google-redirect"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-auth-google-redirect"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-auth-google-redirect" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-auth-google-redirect">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-auth-google-redirect" data-method="GET"
      data-path="api/v1/auth/google/redirect"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-auth-google-redirect', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-auth-google-redirect"
                    onclick="tryItOut('GETapi-v1-auth-google-redirect');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-auth-google-redirect"
                    onclick="cancelTryOut('GETapi-v1-auth-google-redirect');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-auth-google-redirect"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/auth/google/redirect</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-auth-google-redirect"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-auth-google-redirect"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="1-dang-ky-dang-nhap-POSTapi-v1-auth-google-callback">Xử lý callback từ Google</h2>

<p>
</p>

<p>Nhận authorization code từ client, exchange lấy Google profile,
tìm hoặc tạo user, trả về token.</p>

<span id="example-requests-POSTapi-v1-auth-google-callback">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/v1/auth/google/callback" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"code\": \"4\\/0AX4XfWh...\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/auth/google/callback"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "code": "4\/0AX4XfWh..."
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-auth-google-callback">
</span>
<span id="execution-results-POSTapi-v1-auth-google-callback" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-auth-google-callback"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-auth-google-callback"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-auth-google-callback" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-auth-google-callback">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-auth-google-callback" data-method="POST"
      data-path="api/v1/auth/google/callback"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-auth-google-callback', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-auth-google-callback"
                    onclick="tryItOut('POSTapi-v1-auth-google-callback');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-auth-google-callback"
                    onclick="cancelTryOut('POSTapi-v1-auth-google-callback');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-auth-google-callback"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/auth/google/callback</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-auth-google-callback"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-auth-google-callback"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="code"                data-endpoint="POSTapi-v1-auth-google-callback"
               value="4/0AX4XfWh..."
               data-component="body">
    <br>
<p>Authorization code từ Google. Example: <code>4/0AX4XfWh...</code></p>
        </div>
        </form>

                <h1 id="2-san-pham-danh-muc-khach-hang">2. Sản phẩm & Danh mục (Khách hàng)</h1>

    

                        <h2 id="2-san-pham-danh-muc-khach-hang-danh-muc-nen-tang-cho-phep-khach-hang-xem-danh-sach-cac-danh-muc-the-thao-hien-co">Danh mục nền tảng

Cho phép khách hàng xem danh sách các danh mục thể thao hiện có.</h2>
                                                    <h2 id="2-san-pham-danh-muc-khach-hang-GETapi-v1-categories">Danh sách danh mục</h2>

<p>
</p>

<p>Lấy toàn bộ cây danh mục sản phẩm (bao gồm danh mục con) đang hoạt động.</p>

<span id="example-requests-GETapi-v1-categories">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/categories" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/categories"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-categories">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Danh s&aacute;ch danh mục&quot;,
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;danh_muc_cha_id&quot;: null,
            &quot;ten&quot;: &quot;Thời trang&quot;,
            &quot;duong_dan&quot;: &quot;thoi-trang&quot;,
            &quot;hinh_anh&quot;: null,
            &quot;mo_ta&quot;: null,
            &quot;thu_tu&quot;: 1,
            &quot;trang_thai&quot;: true,
            &quot;created_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
            &quot;danh_muc_con&quot;: [
                {
                    &quot;id&quot;: 2,
                    &quot;danh_muc_cha_id&quot;: 1,
                    &quot;ten&quot;: &quot;Trang phục - Phụ kiện&quot;,
                    &quot;duong_dan&quot;: &quot;thoi-trang-trang-phuc-phu-kien&quot;,
                    &quot;hinh_anh&quot;: null,
                    &quot;mo_ta&quot;: null,
                    &quot;thu_tu&quot;: 1,
                    &quot;trang_thai&quot;: true,
                    &quot;created_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;
                },
                {
                    &quot;id&quot;: 3,
                    &quot;danh_muc_cha_id&quot;: 1,
                    &quot;ten&quot;: &quot;&Aacute;o Polo&quot;,
                    &quot;duong_dan&quot;: &quot;thoi-trang-ao-polo&quot;,
                    &quot;hinh_anh&quot;: null,
                    &quot;mo_ta&quot;: null,
                    &quot;thu_tu&quot;: 2,
                    &quot;trang_thai&quot;: true,
                    &quot;created_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;
                },
                {
                    &quot;id&quot;: 4,
                    &quot;danh_muc_cha_id&quot;: 1,
                    &quot;ten&quot;: &quot;Gi&agrave;y thể thao&quot;,
                    &quot;duong_dan&quot;: &quot;thoi-trang-giay-the-thao&quot;,
                    &quot;hinh_anh&quot;: null,
                    &quot;mo_ta&quot;: null,
                    &quot;thu_tu&quot;: 3,
                    &quot;trang_thai&quot;: true,
                    &quot;created_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;
                }
            ]
        },
        {
            &quot;id&quot;: 5,
            &quot;danh_muc_cha_id&quot;: null,
            &quot;ten&quot;: &quot;Chạy bộ&quot;,
            &quot;duong_dan&quot;: &quot;chay-bo&quot;,
            &quot;hinh_anh&quot;: null,
            &quot;mo_ta&quot;: null,
            &quot;thu_tu&quot;: 2,
            &quot;trang_thai&quot;: true,
            &quot;created_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
            &quot;danh_muc_con&quot;: [
                {
                    &quot;id&quot;: 6,
                    &quot;danh_muc_cha_id&quot;: 5,
                    &quot;ten&quot;: &quot;Trang phục - Phụ kiện&quot;,
                    &quot;duong_dan&quot;: &quot;chay-bo-trang-phuc-phu-kien&quot;,
                    &quot;hinh_anh&quot;: null,
                    &quot;mo_ta&quot;: null,
                    &quot;thu_tu&quot;: 1,
                    &quot;trang_thai&quot;: true,
                    &quot;created_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;
                },
                {
                    &quot;id&quot;: 7,
                    &quot;danh_muc_cha_id&quot;: 5,
                    &quot;ten&quot;: &quot;Gi&agrave;y chạy bộ&quot;,
                    &quot;duong_dan&quot;: &quot;chay-bo-giay-chay-bo&quot;,
                    &quot;hinh_anh&quot;: null,
                    &quot;mo_ta&quot;: null,
                    &quot;thu_tu&quot;: 2,
                    &quot;trang_thai&quot;: true,
                    &quot;created_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;
                }
            ]
        },
        {
            &quot;id&quot;: 8,
            &quot;danh_muc_cha_id&quot;: null,
            &quot;ten&quot;: &quot;B&oacute;ng đ&aacute;&quot;,
            &quot;duong_dan&quot;: &quot;bong-da&quot;,
            &quot;hinh_anh&quot;: null,
            &quot;mo_ta&quot;: null,
            &quot;thu_tu&quot;: 3,
            &quot;trang_thai&quot;: true,
            &quot;created_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
            &quot;danh_muc_con&quot;: [
                {
                    &quot;id&quot;: 9,
                    &quot;danh_muc_cha_id&quot;: 8,
                    &quot;ten&quot;: &quot;Balo - T&uacute;i thể thao&quot;,
                    &quot;duong_dan&quot;: &quot;bong-da-balo-tui-the-thao&quot;,
                    &quot;hinh_anh&quot;: null,
                    &quot;mo_ta&quot;: null,
                    &quot;thu_tu&quot;: 1,
                    &quot;trang_thai&quot;: true,
                    &quot;created_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;
                },
                {
                    &quot;id&quot;: 10,
                    &quot;danh_muc_cha_id&quot;: 8,
                    &quot;ten&quot;: &quot;&Aacute;o b&oacute;ng đ&aacute;&quot;,
                    &quot;duong_dan&quot;: &quot;bong-da-ao-bong-da&quot;,
                    &quot;hinh_anh&quot;: null,
                    &quot;mo_ta&quot;: null,
                    &quot;thu_tu&quot;: 2,
                    &quot;trang_thai&quot;: true,
                    &quot;created_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;
                },
                {
                    &quot;id&quot;: 11,
                    &quot;danh_muc_cha_id&quot;: 8,
                    &quot;ten&quot;: &quot;&Aacute;o Polo&quot;,
                    &quot;duong_dan&quot;: &quot;bong-da-ao-polo&quot;,
                    &quot;hinh_anh&quot;: null,
                    &quot;mo_ta&quot;: null,
                    &quot;thu_tu&quot;: 3,
                    &quot;trang_thai&quot;: true,
                    &quot;created_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;
                },
                {
                    &quot;id&quot;: 12,
                    &quot;danh_muc_cha_id&quot;: 8,
                    &quot;ten&quot;: &quot;Quần &aacute;o b&oacute;ng đ&aacute;&quot;,
                    &quot;duong_dan&quot;: &quot;bong-da-quan-ao-bong-da&quot;,
                    &quot;hinh_anh&quot;: null,
                    &quot;mo_ta&quot;: null,
                    &quot;thu_tu&quot;: 4,
                    &quot;trang_thai&quot;: true,
                    &quot;created_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;
                },
                {
                    &quot;id&quot;: 13,
                    &quot;danh_muc_cha_id&quot;: 8,
                    &quot;ten&quot;: &quot;Phụ kiện b&oacute;ng đ&aacute;&quot;,
                    &quot;duong_dan&quot;: &quot;bong-da-phu-kien-bong-da&quot;,
                    &quot;hinh_anh&quot;: null,
                    &quot;mo_ta&quot;: null,
                    &quot;thu_tu&quot;: 5,
                    &quot;trang_thai&quot;: true,
                    &quot;created_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;
                },
                {
                    &quot;id&quot;: 14,
                    &quot;danh_muc_cha_id&quot;: 8,
                    &quot;ten&quot;: &quot;Gi&agrave;y b&oacute;ng đ&aacute;&quot;,
                    &quot;duong_dan&quot;: &quot;bong-da-giay-bong-da&quot;,
                    &quot;hinh_anh&quot;: null,
                    &quot;mo_ta&quot;: null,
                    &quot;thu_tu&quot;: 6,
                    &quot;trang_thai&quot;: true,
                    &quot;created_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;
                },
                {
                    &quot;id&quot;: 15,
                    &quot;danh_muc_cha_id&quot;: 8,
                    &quot;ten&quot;: &quot;Quả b&oacute;ng đ&aacute;&quot;,
                    &quot;duong_dan&quot;: &quot;bong-da-qua-bong-da&quot;,
                    &quot;hinh_anh&quot;: null,
                    &quot;mo_ta&quot;: null,
                    &quot;thu_tu&quot;: 7,
                    &quot;trang_thai&quot;: true,
                    &quot;created_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;
                }
            ]
        },
        {
            &quot;id&quot;: 16,
            &quot;danh_muc_cha_id&quot;: null,
            &quot;ten&quot;: &quot;Pickleball&quot;,
            &quot;duong_dan&quot;: &quot;pickleball&quot;,
            &quot;hinh_anh&quot;: null,
            &quot;mo_ta&quot;: null,
            &quot;thu_tu&quot;: 4,
            &quot;trang_thai&quot;: true,
            &quot;created_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
            &quot;danh_muc_con&quot;: [
                {
                    &quot;id&quot;: 17,
                    &quot;danh_muc_cha_id&quot;: 16,
                    &quot;ten&quot;: &quot;Gi&agrave;y Pickleball&quot;,
                    &quot;duong_dan&quot;: &quot;pickleball-giay-pickleball&quot;,
                    &quot;hinh_anh&quot;: null,
                    &quot;mo_ta&quot;: null,
                    &quot;thu_tu&quot;: 1,
                    &quot;trang_thai&quot;: true,
                    &quot;created_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;
                },
                {
                    &quot;id&quot;: 18,
                    &quot;danh_muc_cha_id&quot;: 16,
                    &quot;ten&quot;: &quot;Vợt Pickleball&quot;,
                    &quot;duong_dan&quot;: &quot;pickleball-vot-pickleball&quot;,
                    &quot;hinh_anh&quot;: null,
                    &quot;mo_ta&quot;: null,
                    &quot;thu_tu&quot;: 2,
                    &quot;trang_thai&quot;: true,
                    &quot;created_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;
                },
                {
                    &quot;id&quot;: 19,
                    &quot;danh_muc_cha_id&quot;: 16,
                    &quot;ten&quot;: &quot;B&oacute;ng Pickleball&quot;,
                    &quot;duong_dan&quot;: &quot;pickleball-bong-pickleball&quot;,
                    &quot;hinh_anh&quot;: null,
                    &quot;mo_ta&quot;: null,
                    &quot;thu_tu&quot;: 3,
                    &quot;trang_thai&quot;: true,
                    &quot;created_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;
                },
                {
                    &quot;id&quot;: 20,
                    &quot;danh_muc_cha_id&quot;: 16,
                    &quot;ten&quot;: &quot;&Aacute;o thun thể thao&quot;,
                    &quot;duong_dan&quot;: &quot;pickleball-ao-thun-the-thao&quot;,
                    &quot;hinh_anh&quot;: null,
                    &quot;mo_ta&quot;: null,
                    &quot;thu_tu&quot;: 4,
                    &quot;trang_thai&quot;: true,
                    &quot;created_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;
                },
                {
                    &quot;id&quot;: 21,
                    &quot;danh_muc_cha_id&quot;: 16,
                    &quot;ten&quot;: &quot;&Aacute;o Polo&quot;,
                    &quot;duong_dan&quot;: &quot;pickleball-ao-polo&quot;,
                    &quot;hinh_anh&quot;: null,
                    &quot;mo_ta&quot;: null,
                    &quot;thu_tu&quot;: 5,
                    &quot;trang_thai&quot;: true,
                    &quot;created_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;
                },
                {
                    &quot;id&quot;: 22,
                    &quot;danh_muc_cha_id&quot;: 16,
                    &quot;ten&quot;: &quot;Quần Pickleball&quot;,
                    &quot;duong_dan&quot;: &quot;pickleball-quan-pickleball&quot;,
                    &quot;hinh_anh&quot;: null,
                    &quot;mo_ta&quot;: null,
                    &quot;thu_tu&quot;: 6,
                    &quot;trang_thai&quot;: true,
                    &quot;created_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;
                }
            ]
        },
        {
            &quot;id&quot;: 23,
            &quot;danh_muc_cha_id&quot;: null,
            &quot;ten&quot;: &quot;Phụ kiện&quot;,
            &quot;duong_dan&quot;: &quot;phu-kien&quot;,
            &quot;hinh_anh&quot;: null,
            &quot;mo_ta&quot;: null,
            &quot;thu_tu&quot;: 5,
            &quot;trang_thai&quot;: true,
            &quot;created_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
            &quot;danh_muc_con&quot;: [
                {
                    &quot;id&quot;: 24,
                    &quot;danh_muc_cha_id&quot;: 23,
                    &quot;ten&quot;: &quot;Gi&agrave;y thể thao&quot;,
                    &quot;duong_dan&quot;: &quot;phu-kien-giay-the-thao&quot;,
                    &quot;hinh_anh&quot;: null,
                    &quot;mo_ta&quot;: null,
                    &quot;thu_tu&quot;: 1,
                    &quot;trang_thai&quot;: true,
                    &quot;created_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;
                },
                {
                    &quot;id&quot;: 25,
                    &quot;danh_muc_cha_id&quot;: 23,
                    &quot;ten&quot;: &quot;Balo - T&uacute;i thể thao&quot;,
                    &quot;duong_dan&quot;: &quot;phu-kien-balo-tui-the-thao&quot;,
                    &quot;hinh_anh&quot;: null,
                    &quot;mo_ta&quot;: null,
                    &quot;thu_tu&quot;: 2,
                    &quot;trang_thai&quot;: true,
                    &quot;created_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;
                }
            ]
        },
        {
            &quot;id&quot;: 26,
            &quot;danh_muc_cha_id&quot;: null,
            &quot;ten&quot;: &quot;B&oacute;ng b&agrave;n&quot;,
            &quot;duong_dan&quot;: &quot;bong-ban&quot;,
            &quot;hinh_anh&quot;: null,
            &quot;mo_ta&quot;: null,
            &quot;thu_tu&quot;: 6,
            &quot;trang_thai&quot;: true,
            &quot;created_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
            &quot;danh_muc_con&quot;: [
                {
                    &quot;id&quot;: 27,
                    &quot;danh_muc_cha_id&quot;: 26,
                    &quot;ten&quot;: &quot;Sa b&agrave;n chiến thuật&quot;,
                    &quot;duong_dan&quot;: &quot;bong-ban-sa-ban-chien-thuat&quot;,
                    &quot;hinh_anh&quot;: null,
                    &quot;mo_ta&quot;: null,
                    &quot;thu_tu&quot;: 1,
                    &quot;trang_thai&quot;: true,
                    &quot;created_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;
                },
                {
                    &quot;id&quot;: 28,
                    &quot;danh_muc_cha_id&quot;: 26,
                    &quot;ten&quot;: &quot;&Aacute;o b&oacute;ng b&agrave;n&quot;,
                    &quot;duong_dan&quot;: &quot;bong-ban-ao-bong-ban&quot;,
                    &quot;hinh_anh&quot;: null,
                    &quot;mo_ta&quot;: null,
                    &quot;thu_tu&quot;: 2,
                    &quot;trang_thai&quot;: true,
                    &quot;created_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;
                },
                {
                    &quot;id&quot;: 29,
                    &quot;danh_muc_cha_id&quot;: 26,
                    &quot;ten&quot;: &quot;Gi&agrave;y b&oacute;ng b&agrave;n&quot;,
                    &quot;duong_dan&quot;: &quot;bong-ban-giay-bong-ban&quot;,
                    &quot;hinh_anh&quot;: null,
                    &quot;mo_ta&quot;: null,
                    &quot;thu_tu&quot;: 3,
                    &quot;trang_thai&quot;: true,
                    &quot;created_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;
                },
                {
                    &quot;id&quot;: 30,
                    &quot;danh_muc_cha_id&quot;: 26,
                    &quot;ten&quot;: &quot;&Aacute;o thun thể thao&quot;,
                    &quot;duong_dan&quot;: &quot;bong-ban-ao-thun-the-thao&quot;,
                    &quot;hinh_anh&quot;: null,
                    &quot;mo_ta&quot;: null,
                    &quot;thu_tu&quot;: 4,
                    &quot;trang_thai&quot;: true,
                    &quot;created_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;
                }
            ]
        },
        {
            &quot;id&quot;: 31,
            &quot;danh_muc_cha_id&quot;: null,
            &quot;ten&quot;: &quot;Thể thao&quot;,
            &quot;duong_dan&quot;: &quot;the-thao&quot;,
            &quot;hinh_anh&quot;: null,
            &quot;mo_ta&quot;: null,
            &quot;thu_tu&quot;: 7,
            &quot;trang_thai&quot;: true,
            &quot;created_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
            &quot;danh_muc_con&quot;: [
                {
                    &quot;id&quot;: 32,
                    &quot;danh_muc_cha_id&quot;: 31,
                    &quot;ten&quot;: &quot;&Aacute;o thể thao&quot;,
                    &quot;duong_dan&quot;: &quot;the-thao-ao-the-thao&quot;,
                    &quot;hinh_anh&quot;: null,
                    &quot;mo_ta&quot;: null,
                    &quot;thu_tu&quot;: 1,
                    &quot;trang_thai&quot;: true,
                    &quot;created_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;
                }
            ]
        },
        {
            &quot;id&quot;: 33,
            &quot;danh_muc_cha_id&quot;: null,
            &quot;ten&quot;: &quot;Cầu l&ocirc;ng&quot;,
            &quot;duong_dan&quot;: &quot;cau-long&quot;,
            &quot;hinh_anh&quot;: null,
            &quot;mo_ta&quot;: null,
            &quot;thu_tu&quot;: 8,
            &quot;trang_thai&quot;: true,
            &quot;created_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
            &quot;danh_muc_con&quot;: [
                {
                    &quot;id&quot;: 34,
                    &quot;danh_muc_cha_id&quot;: 33,
                    &quot;ten&quot;: &quot;Vợt cầu l&ocirc;ng&quot;,
                    &quot;duong_dan&quot;: &quot;cau-long-vot-cau-long&quot;,
                    &quot;hinh_anh&quot;: null,
                    &quot;mo_ta&quot;: null,
                    &quot;thu_tu&quot;: 1,
                    &quot;trang_thai&quot;: true,
                    &quot;created_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;
                },
                {
                    &quot;id&quot;: 35,
                    &quot;danh_muc_cha_id&quot;: 33,
                    &quot;ten&quot;: &quot;Balo - T&uacute;i thể thao&quot;,
                    &quot;duong_dan&quot;: &quot;cau-long-balo-tui-the-thao&quot;,
                    &quot;hinh_anh&quot;: null,
                    &quot;mo_ta&quot;: null,
                    &quot;thu_tu&quot;: 2,
                    &quot;trang_thai&quot;: true,
                    &quot;created_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;
                },
                {
                    &quot;id&quot;: 36,
                    &quot;danh_muc_cha_id&quot;: 33,
                    &quot;ten&quot;: &quot;Gi&agrave;y cầu l&ocirc;ng&quot;,
                    &quot;duong_dan&quot;: &quot;cau-long-giay-cau-long&quot;,
                    &quot;hinh_anh&quot;: null,
                    &quot;mo_ta&quot;: null,
                    &quot;thu_tu&quot;: 3,
                    &quot;trang_thai&quot;: true,
                    &quot;created_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;
                }
            ]
        },
        {
            &quot;id&quot;: 37,
            &quot;danh_muc_cha_id&quot;: null,
            &quot;ten&quot;: &quot;B&oacute;ng chuyền&quot;,
            &quot;duong_dan&quot;: &quot;bong-chuyen&quot;,
            &quot;hinh_anh&quot;: null,
            &quot;mo_ta&quot;: null,
            &quot;thu_tu&quot;: 9,
            &quot;trang_thai&quot;: true,
            &quot;created_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
            &quot;danh_muc_con&quot;: [
                {
                    &quot;id&quot;: 38,
                    &quot;danh_muc_cha_id&quot;: 37,
                    &quot;ten&quot;: &quot;Quả b&oacute;ng chuyền&quot;,
                    &quot;duong_dan&quot;: &quot;bong-chuyen-qua-bong-chuyen&quot;,
                    &quot;hinh_anh&quot;: null,
                    &quot;mo_ta&quot;: null,
                    &quot;thu_tu&quot;: 1,
                    &quot;trang_thai&quot;: true,
                    &quot;created_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;
                },
                {
                    &quot;id&quot;: 39,
                    &quot;danh_muc_cha_id&quot;: 37,
                    &quot;ten&quot;: &quot;Gi&agrave;y b&oacute;ng chuyền&quot;,
                    &quot;duong_dan&quot;: &quot;bong-chuyen-giay-bong-chuyen&quot;,
                    &quot;hinh_anh&quot;: null,
                    &quot;mo_ta&quot;: null,
                    &quot;thu_tu&quot;: 2,
                    &quot;trang_thai&quot;: true,
                    &quot;created_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
                    &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;
                }
            ]
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-categories" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-categories"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-categories"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-categories" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-categories">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-categories" data-method="GET"
      data-path="api/v1/categories"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-categories', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-categories"
                    onclick="tryItOut('GETapi-v1-categories');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-categories"
                    onclick="cancelTryOut('GETapi-v1-categories');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-categories"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/categories</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-categories"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-categories"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="2-san-pham-danh-muc-khach-hang-GETapi-v1-categories--slug-">Chi tiết danh mục</h2>

<p>
</p>

<p>Trả về thông tin chi tiết của danh mục cùng với danh mục con và các sản phẩm nổi bật.</p>

<span id="example-requests-GETapi-v1-categories--slug-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/categories/giay-chay-bo" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/categories/giay-chay-bo"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-categories--slug-">
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Danh mục kh&ocirc;ng tồn tại&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-categories--slug-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-categories--slug-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-categories--slug-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-categories--slug-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-categories--slug-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-categories--slug-" data-method="GET"
      data-path="api/v1/categories/{slug}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-categories--slug-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-categories--slug-"
                    onclick="tryItOut('GETapi-v1-categories--slug-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-categories--slug-"
                    onclick="cancelTryOut('GETapi-v1-categories--slug-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-categories--slug-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/categories/{slug}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-categories--slug-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-categories--slug-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>slug</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="slug"                data-endpoint="GETapi-v1-categories--slug-"
               value="giay-chay-bo"
               data-component="url">
    <br>
<p>Đường dẫn thân thiện của danh mục. Example: <code>giay-chay-bo</code></p>
            </div>
                    </form>

                                <h2 id="2-san-pham-danh-muc-khach-hang-thuong-hieu-lay-danh-sach-thuong-hieu-doi-tac-cua-he-thong">Thương hiệu

Lấy danh sách thương hiệu đối tác của hệ thống.</h2>
                                                    <h2 id="2-san-pham-danh-muc-khach-hang-GETapi-v1-brands">Danh sách thương hiệu</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-brands">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/brands" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/brands"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-brands">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Danh s&aacute;ch thương hiệu&quot;,
    &quot;data&quot;: [
        {
            &quot;id&quot;: 4,
            &quot;ten&quot;: &quot;Kaiwin&quot;,
            &quot;duong_dan&quot;: &quot;kaiwin&quot;,
            &quot;logo&quot;: &quot;https://vieclamnhamay.vn/uploads/images/2022/11/17/6375f92163b863_88482251.jpg&quot;
        },
        {
            &quot;id&quot;: 3,
            &quot;ten&quot;: &quot;Kamito&quot;,
            &quot;duong_dan&quot;: &quot;kamito&quot;,
            &quot;logo&quot;: &quot;https://file.hstatic.net/200000211685/collection/kamito_giay_bong_da_7ff1b85aacb847399de8b9ee269cbac7.png&quot;
        },
        {
            &quot;id&quot;: 1,
            &quot;ten&quot;: &quot;Nike&quot;,
            &quot;duong_dan&quot;: &quot;nike&quot;,
            &quot;logo&quot;: &quot;https://upload.wikimedia.org/wikipedia/commons/a/a6/Logo_NIKE.svg&quot;
        },
        {
            &quot;id&quot;: 2,
            &quot;ten&quot;: &quot;Wika&quot;,
            &quot;duong_dan&quot;: &quot;wika&quot;,
            &quot;logo&quot;: &quot;https://vicsport.vn/wp-content/uploads/2023/11/wika-logo.png&quot;
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-brands" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-brands"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-brands"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-brands" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-brands">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-brands" data-method="GET"
      data-path="api/v1/brands"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-brands', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-brands"
                    onclick="tryItOut('GETapi-v1-brands');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-brands"
                    onclick="cancelTryOut('GETapi-v1-brands');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-brands"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/brands</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-brands"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-brands"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                                <h2 id="2-san-pham-danh-muc-khach-hang-cua-hang-nhom-api-hien-thi-thong-tin-san-pham-danh-cho-khach-hang-tham-quan-ung-dung">Cửa hàng

Nhóm API hiển thị thông tin sản phẩm dành cho khách hàng tham quan ứng dụng.</h2>
                                                    <h2 id="2-san-pham-danh-muc-khach-hang-GETapi-v1-products">Lấy danh sách sản phẩm</h2>

<p>
</p>

<p>Phục vụ trang danh sách sản phẩm với các filter. Tự động trả về dữ liệu phân trang.</p>

<span id="example-requests-GETapi-v1-products">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/products?tu_khoa=%C3%A1o&amp;danh_muc_id=3&amp;thuong_hieu_id=&amp;sap_xep=moi_nhat&amp;gioi_han=12" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/products"
);

const params = {
    "tu_khoa": "áo",
    "danh_muc_id": "3",
    "thuong_hieu_id": "",
    "sap_xep": "moi_nhat",
    "gioi_han": "12",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-products">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Danh s&aacute;ch sản phẩm&quot;,
    &quot;data&quot;: [
        {
            &quot;id&quot;: 159,
            &quot;danh_muc_id&quot;: 7,
            &quot;thuong_hieu_id&quot;: 3,
            &quot;ten_san_pham&quot;: &quot;Gi&agrave;y Thể Thao Kamito Amazing Khau Phạ&quot;,
            &quot;duong_dan&quot;: &quot;giay-the-thao-kamito-amazing-khau-pha-2alkzBLX&quot;,
            &quot;ma_sku&quot;: &quot;KAM-y6Ce4Z-1019&quot;,
            &quot;mo_ta_ngan&quot;: &quot;Gi&agrave;y Thể Thao Kamito Amazing Khau Phạ&quot;,
            &quot;mo_ta_day_du&quot;: &quot;&lt;p&gt;Gi&agrave;y chạy bộ Amazing phi&ecirc;n bản Khau Phạ với t&ocirc;ng m&agrave;u nổi bật, &ecirc;m &aacute;i v&agrave; trợ lực cực tốt.&lt;/p&gt;&quot;,
            &quot;gia_goc&quot;: &quot;990000.00&quot;,
            &quot;gia_khuyen_mai&quot;: &quot;396000.00&quot;,
            &quot;so_luong_ton_kho&quot;: 995,
            &quot;can_nang_kg&quot;: null,
            &quot;noi_bat&quot;: false,
            &quot;trang_thai&quot;: true,
            &quot;da_ban&quot;: 101,
            &quot;luot_xem&quot;: 94,
            &quot;diem_danh_gia&quot;: &quot;4.20&quot;,
            &quot;so_luot_danh_gia&quot;: 5,
            &quot;created_at&quot;: &quot;2026-03-18T08:25:19.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-04-01T14:26:31.000000Z&quot;,
            &quot;danh_muc&quot;: {
                &quot;id&quot;: 7,
                &quot;danh_muc_cha_id&quot;: 5,
                &quot;ten&quot;: &quot;Gi&agrave;y chạy bộ&quot;,
                &quot;duong_dan&quot;: &quot;chay-bo-giay-chay-bo&quot;,
                &quot;hinh_anh&quot;: null,
                &quot;mo_ta&quot;: null,
                &quot;thu_tu&quot;: 2,
                &quot;trang_thai&quot;: true,
                &quot;created_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;
            },
            &quot;thuong_hieu&quot;: {
                &quot;id&quot;: 3,
                &quot;ten&quot;: &quot;Kamito&quot;,
                &quot;duong_dan&quot;: &quot;kamito&quot;,
                &quot;logo&quot;: &quot;https://file.hstatic.net/200000211685/collection/kamito_giay_bong_da_7ff1b85aacb847399de8b9ee269cbac7.png&quot;,
                &quot;mo_ta&quot;: &quot;Thương hiệu đỉnh cao Nhật Bản, nổi tiếng với c&aacute;c m&ocirc;n thể thao đa dụng v&agrave; Pickleball.&quot;,
                &quot;trang_thai&quot;: true,
                &quot;created_at&quot;: null,
                &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;
            },
            &quot;anh_chinh&quot;: {
                &quot;id&quot;: 710,
                &quot;san_pham_id&quot;: 159,
                &quot;duong_dan_anh&quot;: &quot;https://product.hstatic.net/1000341630/product/dsc08877_6444a5f7e6fa434487e5e92fb9ef48d3.jpg&quot;,
                &quot;chu_thich&quot;: null,
                &quot;thu_tu&quot;: 0,
                &quot;la_anh_chinh&quot;: true,
                &quot;created_at&quot;: &quot;2026-04-01 21:14:40&quot;,
                &quot;url&quot;: &quot;https://product.hstatic.net/1000341630/product/dsc08877_6444a5f7e6fa434487e5e92fb9ef48d3.jpg&quot;
            }
        },
        {
            &quot;id&quot;: 36,
            &quot;danh_muc_id&quot;: 18,
            &quot;thuong_hieu_id&quot;: 2,
            &quot;ten_san_pham&quot;: &quot;Vợt Pickeball Wika Bao Fire t&iacute;m&quot;,
            &quot;duong_dan&quot;: &quot;vot-pickeball-wika-bao-fire-tim-vYaYhymE&quot;,
            &quot;ma_sku&quot;: &quot;WIK-MqW0ok-30303&quot;,
            &quot;mo_ta_ngan&quot;: &quot;Lấy cảm hứng từ Na Tra, mang DNA chiến binh hệ Lửa với tốc độ v&agrave; sức mạnh b&ugrave;ng nổ.\nL&otilde;i Cannon-Core&trade; tạo tiếng nổ lớn, trợ lực mạnh cho reset, flick v&agrave; volley.\nMặt Carbon T700 nh&aacute;m tăng 30%, bền bỉ v&agrave; tối ưu spin, kiểm so&aacute;t b&oacute;ng.\nViền Foam giảm rung, thiết kế SweetMax mở rộng điểm ngọt, hạn chế mis-hit.\nThiết kế họa tiết lửa độc bản, được nhiều VĐV chọn d&ugrave;ng, đồng h&agrave;nh c&ugrave;ng nh&agrave; v&ocirc; địch Vietnam Masters 2025.&quot;,
            &quot;mo_ta_day_du&quot;: &quot;&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Wika Bao Fire l&agrave; mẫu vợt pickleball thế hệ mới lấy cảm hứng từ h&igrave;nh tượng Na Tra &ndash; nguồn năng lượng y&ecirc;u th&iacute;ch của VĐV Dương Thi&ecirc;n Bảo. Với DNA của một chiến binh hệ Lửa, Bao Fire mang đến trải nghiệm đ&aacute;nh b&ugrave;ng nổ, tốc độ vượt trội v&agrave; khả năng kiểm so&aacute;t b&oacute;ng tối đa trong mọi pha xử l&yacute;. Đ&acirc;y l&agrave; lựa chọn l&yacute; tưởng cho người chơi theo phong c&aacute;ch tốc độ, phản xạ nhanh v&agrave; chủ động kiểm so&aacute;t thế trận.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;img class=\&quot;size-full wp-image-30296 aligncenter\&quot; src=\&quot;https://wikasports.com/wp-content/uploads/2025/12/vot-pickleball-wika-bao-fire-tim-1.jpg\&quot; alt=\&quot;vot-pickleball-wika-bao-fire-tim-1\&quot; width=\&quot;1144\&quot; height=\&quot;1430\&quot; /&gt;&lt;/p&gt;&quot;,
            &quot;gia_goc&quot;: &quot;2900000.00&quot;,
            &quot;gia_khuyen_mai&quot;: &quot;2699000.00&quot;,
            &quot;so_luong_ton_kho&quot;: 995,
            &quot;can_nang_kg&quot;: null,
            &quot;noi_bat&quot;: false,
            &quot;trang_thai&quot;: true,
            &quot;da_ban&quot;: 29,
            &quot;luot_xem&quot;: 47,
            &quot;diem_danh_gia&quot;: &quot;4.50&quot;,
            &quot;so_luot_danh_gia&quot;: 2,
            &quot;created_at&quot;: &quot;2026-03-16T08:25:19.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-03-19T08:25:21.000000Z&quot;,
            &quot;danh_muc&quot;: {
                &quot;id&quot;: 18,
                &quot;danh_muc_cha_id&quot;: 16,
                &quot;ten&quot;: &quot;Vợt Pickleball&quot;,
                &quot;duong_dan&quot;: &quot;pickleball-vot-pickleball&quot;,
                &quot;hinh_anh&quot;: null,
                &quot;mo_ta&quot;: null,
                &quot;thu_tu&quot;: 2,
                &quot;trang_thai&quot;: true,
                &quot;created_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;
            },
            &quot;thuong_hieu&quot;: {
                &quot;id&quot;: 2,
                &quot;ten&quot;: &quot;Wika&quot;,
                &quot;duong_dan&quot;: &quot;wika&quot;,
                &quot;logo&quot;: &quot;https://vicsport.vn/wp-content/uploads/2023/11/wika-logo.png&quot;,
                &quot;mo_ta&quot;: &quot;Thương hiệu thể thao Việt Nam, nổi bật với gi&agrave;y b&oacute;ng đ&aacute; v&agrave; trang phục b&oacute;ng đ&aacute;.&quot;,
                &quot;trang_thai&quot;: true,
                &quot;created_at&quot;: null,
                &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;
            },
            &quot;anh_chinh&quot;: {
                &quot;id&quot;: 274,
                &quot;san_pham_id&quot;: 36,
                &quot;duong_dan_anh&quot;: &quot;https://wikasports.com/wp-content/uploads/2025/12/vot-pickleball-wika-bao-fire-tim-2.jpg&quot;,
                &quot;chu_thich&quot;: null,
                &quot;thu_tu&quot;: 0,
                &quot;la_anh_chinh&quot;: true,
                &quot;created_at&quot;: &quot;2026-03-19 08:25:19&quot;,
                &quot;url&quot;: &quot;https://wikasports.com/wp-content/uploads/2025/12/vot-pickleball-wika-bao-fire-tim-2.jpg&quot;
            }
        },
        {
            &quot;id&quot;: 90,
            &quot;danh_muc_id&quot;: 10,
            &quot;thuong_hieu_id&quot;: 2,
            &quot;ten_san_pham&quot;: &quot;&Aacute;o Wika Team Quang Dương trắng t&iacute;m&quot;,
            &quot;duong_dan&quot;: &quot;ao-wika-team-quang-duong-trang-tim-ywK6a1pU&quot;,
            &quot;ma_sku&quot;: &quot;WIK-rrka0d-27892&quot;,
            &quot;mo_ta_ngan&quot;: &quot;Tho&aacute;ng m&aacute;t &ndash; Co gi&atilde;n &ndash; Giữ form: Vải Wi-DRYMAX mới, co gi&atilde;n 4 chiều, bề mặt mềm nhẹ, thoải m&aacute;i.\nC&ocirc;ng nghệ Witech-Dry: Tho&aacute;t mồ h&ocirc;i nhanh, kh&ocirc; tho&aacute;ng, hạn chế bết d&iacute;nh, lu&ocirc;n tự tin khi thi đấu.\nThiết kế trẻ trung &ndash; dễ phối: Cổ tr&ograve;n năng động, viền tay phối m&agrave;u h&agrave;i h&ograve;a, logo Wika nổi bật tr&ecirc;n ngực &aacute;o\nForm d&aacute;ng chuẩn Việt, vừa vặn cho cả nam v&agrave; nữ.&quot;,
            &quot;mo_ta_day_du&quot;: &quot;&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;&Aacute;o Team Wika kh&ocirc;ng chỉ l&agrave; một chiếc &aacute;o thể thao, m&agrave; c&ograve;n l&agrave; biểu tượng của tinh thần gắn kết v&agrave; bản lĩnh thi đấu. Với thiết kế tinh giản nhưng mạnh mẽ, mẫu &aacute;o n&agrave;y gi&uacute;p bạn v&agrave; đồng đội tự tin tạo n&ecirc;n những khoảnh khắc b&ugrave;ng nổ tr&ecirc;n s&acirc;n.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;strong&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Đặc điểm nổi bật của &aacute;o thể thao Team Wika&lt;/span&gt;&lt;/strong&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Chất liệu Wi-DRYMAX cao cấp: Co gi&atilde;n 4 chiều, tho&aacute;ng m&aacute;t, mềm nhẹ, giữ form ổn định trong suốt qu&aacute; tr&igrave;nh vận động.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;C&ocirc;ng nghệ Witech-Dry: Hỗ trợ tho&aacute;t mồ h&ocirc;i nhanh, giữ cơ thể lu&ocirc;n kh&ocirc; tho&aacute;ng, hạn chế bết d&iacute;nh, mang lại sự thoải m&aacute;i tối đa.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Thiết kế trẻ trung, dễ phối: Cổ tr&ograve;n năng động, viền tay phối m&agrave;u h&agrave;i h&ograve;a c&ugrave;ng logo Wika nổi bật, ph&ugrave; hợp cho cả tập luyện lẫn thi đấu.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Form d&aacute;ng chuẩn Việt: Được nghi&ecirc;n cứu để vừa vặn, ph&ugrave; hợp với v&oacute;c d&aacute;ng nam v&agrave; nữ.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;strong&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Th&ocirc;ng tin sản phẩm&lt;/span&gt;&lt;/strong&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Form: Ri&ecirc;ng biệt cho nam v&agrave; nữ&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;M&agrave;u sắc: Trắng T&iacute;m, Navy, Trắng Đỏ, Đỏ&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Size: S, M, L, XL, XXL&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;V&igrave; sao n&ecirc;n chọn &aacute;o Team Wika?&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Kho&aacute;c l&ecirc;n m&igrave;nh &aacute;o thể thao Team Wika, bạn kh&ocirc;ng chỉ cảm nhận sự thoải m&aacute;i m&agrave; c&ograve;n mang theo tinh thần đồng đội, sẵn s&agrave;ng c&ugrave;ng nhau chinh phục mọi giải đấu.&lt;/span&gt;&lt;/p&gt;&quot;,
            &quot;gia_goc&quot;: &quot;310000.00&quot;,
            &quot;gia_khuyen_mai&quot;: &quot;299000.00&quot;,
            &quot;so_luong_ton_kho&quot;: 993,
            &quot;can_nang_kg&quot;: null,
            &quot;noi_bat&quot;: false,
            &quot;trang_thai&quot;: true,
            &quot;da_ban&quot;: 45,
            &quot;luot_xem&quot;: 80,
            &quot;diem_danh_gia&quot;: &quot;5.00&quot;,
            &quot;so_luot_danh_gia&quot;: 5,
            &quot;created_at&quot;: &quot;2026-03-15T08:25:19.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-03-19T08:25:21.000000Z&quot;,
            &quot;danh_muc&quot;: {
                &quot;id&quot;: 10,
                &quot;danh_muc_cha_id&quot;: 8,
                &quot;ten&quot;: &quot;&Aacute;o b&oacute;ng đ&aacute;&quot;,
                &quot;duong_dan&quot;: &quot;bong-da-ao-bong-da&quot;,
                &quot;hinh_anh&quot;: null,
                &quot;mo_ta&quot;: null,
                &quot;thu_tu&quot;: 2,
                &quot;trang_thai&quot;: true,
                &quot;created_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;
            },
            &quot;thuong_hieu&quot;: {
                &quot;id&quot;: 2,
                &quot;ten&quot;: &quot;Wika&quot;,
                &quot;duong_dan&quot;: &quot;wika&quot;,
                &quot;logo&quot;: &quot;https://vicsport.vn/wp-content/uploads/2023/11/wika-logo.png&quot;,
                &quot;mo_ta&quot;: &quot;Thương hiệu thể thao Việt Nam, nổi bật với gi&agrave;y b&oacute;ng đ&aacute; v&agrave; trang phục b&oacute;ng đ&aacute;.&quot;,
                &quot;trang_thai&quot;: true,
                &quot;created_at&quot;: null,
                &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;
            },
            &quot;anh_chinh&quot;: {
                &quot;id&quot;: 527,
                &quot;san_pham_id&quot;: 90,
                &quot;duong_dan_anh&quot;: &quot;https://wikasports.com/wp-content/uploads/2025/09/ao-wika-team-trang-tim_optimized.jpg&quot;,
                &quot;chu_thich&quot;: null,
                &quot;thu_tu&quot;: 0,
                &quot;la_anh_chinh&quot;: true,
                &quot;created_at&quot;: &quot;2026-03-19 08:25:19&quot;,
                &quot;url&quot;: &quot;https://wikasports.com/wp-content/uploads/2025/09/ao-wika-team-trang-tim_optimized.jpg&quot;
            }
        },
        {
            &quot;id&quot;: 18,
            &quot;danh_muc_id&quot;: 10,
            &quot;thuong_hieu_id&quot;: 2,
            &quot;ten_san_pham&quot;: &quot;&Aacute;o b&oacute;ng đ&aacute; Wika Luska kem&quot;,
            &quot;duong_dan&quot;: &quot;ao-bong-da-wika-luska-kem-XCE5Aq1n&quot;,
            &quot;ma_sku&quot;: &quot;WIK-3vPZUK-31377&quot;,
            &quot;mo_ta_ngan&quot;: &quot;Chất liệu Wikarotex co gi&atilde;n 4 chiều, mềm m&aacute;t \nC&ocirc;ng nghệ Witech-dry tho&aacute;t mồ h&ocirc;i si&ecirc;u tốc \nHoạ tiết in bền m&agrave;u \nForm Regular Fit dễ mặc, t&ocirc;n d&aacute;ng vận động vi&ecirc;n \nLogo PU phản quang\nĐặt &aacute;o đội li&ecirc;n hệ &ldquo;CHAT ZALO&rdquo; để được ưu đ&atilde;i!&quot;,
            &quot;mo_ta_day_du&quot;: &quot;&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;&Aacute;o b&oacute;ng đ&aacute; Wika Luska &ndash; Thiết kế mới b&ugrave;ng nổ cho m&ugrave;a giải&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Wika Luska l&agrave; t&acirc;n binh mới nhất gia nhập bộ sưu tập &aacute;o b&oacute;ng đ&aacute; Wika, mang đến l&agrave;n gi&oacute; thiết kế hiện đại v&agrave; gi&agrave;u năng lượng cho m&ugrave;a giải mới. Sản phẩm g&acirc;y ấn tượng mạnh với họa tiết xếp tầng độc đ&aacute;o, tạo hiệu ứng chuyển động linh hoạt, tượng trưng cho sức mạnh tập thể v&agrave; tinh thần thi đấu lan tỏa từ s&acirc;n cỏ đến kh&aacute;n đ&agrave;i.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;&Aacute;o được thiết kế ph&ugrave; hợp cho cả nam v&agrave; nữ, đ&aacute;p ứng tối đa nhu cầu tập luyện v&agrave; thi đấu với cảm gi&aacute;c nhẹ, tho&aacute;ng v&agrave; linh hoạt trong từng chuyển động. Chất liệu Wikarotex cao cấp co gi&atilde;n 4 chiều gi&uacute;p &aacute;o mềm m&aacute;t, dễ chịu khi mặc trong thời gian d&agrave;i. Kết hợp c&ugrave;ng c&ocirc;ng nghệ Witech-dry, sản phẩm hỗ trợ tho&aacute;t mồ h&ocirc;i nhanh, giữ cơ thể lu&ocirc;n kh&ocirc; r&aacute;o v&agrave; thoải m&aacute;i ngay cả khi vận động cường độ cao.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Họa tiết in bền m&agrave;u, form Regular Fit dễ mặc v&agrave; t&ocirc;n d&aacute;ng vận động vi&ecirc;n, ph&ugrave; hợp cho nhiều d&aacute;ng người. Logo PU phản quang l&agrave; điểm nhấn tinh tế, tăng độ nhận diện v&agrave; t&iacute;nh thẩm mỹ. Wika Luska l&agrave; lựa chọn l&yacute; tưởng cho tập luyện, thi đấu v&agrave; c&aacute;c hoạt động thể thao thường ng&agrave;y.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;img class=\&quot;size-full wp-image-3552 aligncenter\&quot; src=\&quot;https://wikasports.com/wp-content/uploads/2021/06/bang-size-ao-wika-sports-1.jpg\&quot; alt=\&quot;bang-size-ao-wika-sports-1\&quot; width=\&quot;1024\&quot; height=\&quot;336\&quot; /&gt;&lt;/p&gt;&quot;,
            &quot;gia_goc&quot;: &quot;249000.00&quot;,
            &quot;gia_khuyen_mai&quot;: &quot;239000.00&quot;,
            &quot;so_luong_ton_kho&quot;: 998,
            &quot;can_nang_kg&quot;: null,
            &quot;noi_bat&quot;: false,
            &quot;trang_thai&quot;: true,
            &quot;da_ban&quot;: 76,
            &quot;luot_xem&quot;: 66,
            &quot;diem_danh_gia&quot;: &quot;3.67&quot;,
            &quot;so_luot_danh_gia&quot;: 3,
            &quot;created_at&quot;: &quot;2026-03-14T08:25:19.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-03-19T08:25:20.000000Z&quot;,
            &quot;danh_muc&quot;: {
                &quot;id&quot;: 10,
                &quot;danh_muc_cha_id&quot;: 8,
                &quot;ten&quot;: &quot;&Aacute;o b&oacute;ng đ&aacute;&quot;,
                &quot;duong_dan&quot;: &quot;bong-da-ao-bong-da&quot;,
                &quot;hinh_anh&quot;: null,
                &quot;mo_ta&quot;: null,
                &quot;thu_tu&quot;: 2,
                &quot;trang_thai&quot;: true,
                &quot;created_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;
            },
            &quot;thuong_hieu&quot;: {
                &quot;id&quot;: 2,
                &quot;ten&quot;: &quot;Wika&quot;,
                &quot;duong_dan&quot;: &quot;wika&quot;,
                &quot;logo&quot;: &quot;https://vicsport.vn/wp-content/uploads/2023/11/wika-logo.png&quot;,
                &quot;mo_ta&quot;: &quot;Thương hiệu thể thao Việt Nam, nổi bật với gi&agrave;y b&oacute;ng đ&aacute; v&agrave; trang phục b&oacute;ng đ&aacute;.&quot;,
                &quot;trang_thai&quot;: true,
                &quot;created_at&quot;: null,
                &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;
            },
            &quot;anh_chinh&quot;: {
                &quot;id&quot;: 110,
                &quot;san_pham_id&quot;: 18,
                &quot;duong_dan_anh&quot;: &quot;https://wikasports.com/wp-content/uploads/2026/02/ao-bong-da-wika-luska-kem-1_optimized.png&quot;,
                &quot;chu_thich&quot;: null,
                &quot;thu_tu&quot;: 0,
                &quot;la_anh_chinh&quot;: true,
                &quot;created_at&quot;: &quot;2026-03-19 08:25:19&quot;,
                &quot;url&quot;: &quot;https://wikasports.com/wp-content/uploads/2026/02/ao-bong-da-wika-luska-kem-1_optimized.png&quot;
            }
        },
        {
            &quot;id&quot;: 113,
            &quot;danh_muc_id&quot;: 10,
            &quot;thuong_hieu_id&quot;: 4,
            &quot;ten_san_pham&quot;: &quot;&Aacute;O B&Oacute;NG Đ&Aacute; KAIWIN MYSTIC - M&Agrave;U TRẮNG&quot;,
            &quot;duong_dan&quot;: &quot;ao-bong-da-kaiwin-mystic-mau-trang-Cm4l7vHe&quot;,
            &quot;ma_sku&quot;: &quot;KAI-WqZl6x-11792&quot;,
            &quot;mo_ta_ngan&quot;: &quot;&Aacute;O B&Oacute;NG Đ&Aacute; KAIWIN MYSTIC - M&Agrave;U TRẮNG&quot;,
            &quot;mo_ta_day_du&quot;: &quot;&lt;div class=\&quot;rte\&quot;&gt;&lt;h3&gt;&Aacute;o B&oacute;ng Đ&aacute; Kaiwin MYSTIC &ndash; M&agrave;u Trắng&lt;/h3&gt;&lt;p&gt;Mẫu &aacute;o thi đấu cao cấp 2025 với thiết kế tối giản nhưng đầy tinh tế.&lt;/p&gt;&lt;/div&gt;&quot;,
            &quot;gia_goc&quot;: &quot;299000.00&quot;,
            &quot;gia_khuyen_mai&quot;: null,
            &quot;so_luong_ton_kho&quot;: 999,
            &quot;can_nang_kg&quot;: null,
            &quot;noi_bat&quot;: false,
            &quot;trang_thai&quot;: true,
            &quot;da_ban&quot;: 26,
            &quot;luot_xem&quot;: 52,
            &quot;diem_danh_gia&quot;: &quot;4.00&quot;,
            &quot;so_luot_danh_gia&quot;: 1,
            &quot;created_at&quot;: &quot;2026-03-14T08:25:19.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-03-19T08:25:22.000000Z&quot;,
            &quot;danh_muc&quot;: {
                &quot;id&quot;: 10,
                &quot;danh_muc_cha_id&quot;: 8,
                &quot;ten&quot;: &quot;&Aacute;o b&oacute;ng đ&aacute;&quot;,
                &quot;duong_dan&quot;: &quot;bong-da-ao-bong-da&quot;,
                &quot;hinh_anh&quot;: null,
                &quot;mo_ta&quot;: null,
                &quot;thu_tu&quot;: 2,
                &quot;trang_thai&quot;: true,
                &quot;created_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;
            },
            &quot;thuong_hieu&quot;: {
                &quot;id&quot;: 4,
                &quot;ten&quot;: &quot;Kaiwin&quot;,
                &quot;duong_dan&quot;: &quot;kaiwin&quot;,
                &quot;logo&quot;: &quot;https://vieclamnhamay.vn/uploads/images/2022/11/17/6375f92163b863_88482251.jpg&quot;,
                &quot;mo_ta&quot;: &quot;Nh&agrave; sản xuất trang phục, &aacute;o b&oacute;ng đ&aacute;, dụng cụ thể thao thiết kế hiện đại.&quot;,
                &quot;trang_thai&quot;: true,
                &quot;created_at&quot;: null,
                &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;
            },
            &quot;anh_chinh&quot;: {
                &quot;id&quot;: 614,
                &quot;san_pham_id&quot;: 113,
                &quot;duong_dan_anh&quot;: &quot;https://bizweb.dktcdn.net/100/017/070/products/a-o-bong-da-mystic-mau-trang.jpg?v=1758992701000&quot;,
                &quot;chu_thich&quot;: null,
                &quot;thu_tu&quot;: 0,
                &quot;la_anh_chinh&quot;: true,
                &quot;created_at&quot;: &quot;2026-03-19 08:25:19&quot;,
                &quot;url&quot;: &quot;https://bizweb.dktcdn.net/100/017/070/products/a-o-bong-da-mystic-mau-trang.jpg?v=1758992701000&quot;
            }
        },
        {
            &quot;id&quot;: 54,
            &quot;danh_muc_id&quot;: 10,
            &quot;thuong_hieu_id&quot;: 2,
            &quot;ten_san_pham&quot;: &quot;&Aacute;o b&oacute;ng đ&aacute; Wika Wind xanh ngọc&quot;,
            &quot;duong_dan&quot;: &quot;ao-bong-da-wika-wind-xanh-Hkv0zq9P&quot;,
            &quot;ma_sku&quot;: &quot;WIK-71rSyz-29580&quot;,
            &quot;mo_ta_ngan&quot;: &quot;&Aacute;o b&oacute;ng đ&aacute; Wika Wind mang cảm hứng &ldquo;cơn lốc&rdquo;, thiết kế tốc độ v&agrave; mạnh mẽ.\nChất liệu Wikarotex co gi&atilde;n 4 chiều, mềm m&aacute;t, giữ form bền.\nC&ocirc;ng nghệ Witech-dry tho&aacute;t mồ h&ocirc;i nhanh, tối ưu cho thi đấu.\nForm Regular Fit dễ mặc, họa tiết bền m&agrave;u, logo PU phản quang.\nSize: S&ndash;XXL, ph&ugrave; hợp cả nam &amp; nữ.\nĐặt &aacute;o đội li&ecirc;n hệ &ldquo;CHAT ZALO&rdquo; để được ưu đ&atilde;i!&quot;,
            &quot;mo_ta_day_du&quot;: &quot;&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Wika Wind &ndash; t&acirc;n binh đầy b&ugrave;ng nổ vừa ch&iacute;nh thức ra mắt, mang theo tinh thần tốc độ v&agrave; phong c&aacute;ch thiết kế hiện đại. Lấy cảm hứng từ chuyển động mạnh mẽ của cơn lốc xo&aacute;y, họa tiết bao phủ th&acirc;n &aacute;o gi&uacute;p tạo cảm gi&aacute;c nhanh &ndash; gọn &ndash; mạnh trong từng đường b&oacute;ng, trở th&agrave;nh lựa chọn l&yacute; tưởng cho những trận đấu đ&ograve;i hỏi sự linh hoạt v&agrave; bứt ph&aacute;.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;&lt;strong&gt;Thiết kế ấn tượng &ndash; Tối ưu cho vận động&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;&Aacute;o sở hữu form Regular Fit dễ mặc, &ocirc;m gọn cơ thể vừa đủ để t&ocirc;n d&aacute;ng m&agrave; vẫn đảm bảo thoải m&aacute;i khi di chuyển.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Cổ tr&ograve;n đi k&egrave;m phần viền cổ v&agrave; tay &aacute;o phối m&agrave;u đồng điệu, tạo n&ecirc;n tổng thể liền mạch, thể thao v&agrave; chuy&ecirc;n nghiệp hơn.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;&lt;strong&gt;Chất liệu cao cấp &ndash; Sẵn s&agrave;ng cho mọi trận đấu&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Wika Wind được ho&agrave;n thiện từ chất liệu Wikarotex co gi&atilde;n 4 chiều, mềm &ndash; m&aacute;t &ndash; &ocirc;m form l&acirc;u d&agrave;i, gi&uacute;p bạn tự tin thi đấu từ đầu đến cuối trận.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Kết hợp c&ugrave;ng c&ocirc;ng nghệ Witech-dry, &aacute;o tho&aacute;t mồ h&ocirc;i nhanh, giữ cơ thể lu&ocirc;n kh&ocirc; tho&aacute;ng ngay cả khi vận động cường độ cao.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;&lt;strong&gt;Những ưu điểm nổi bật:&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Chất liệu Wikarotex 4-way stretch đ&agrave;n hồi tốt, tho&aacute;ng nhẹ&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;C&ocirc;ng nghệ Witech-dry gi&uacute;p thấm h&uacute;t &ndash; tho&aacute;t mồ h&ocirc;i cực nhanh&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Hoạ tiết in sắc n&eacute;t, bền m&agrave;u theo thời gian&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Logo PU phản quang, nổi bật trong mọi điều kiện &aacute;nh s&aacute;ng&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Form Regular Fit ph&ugrave; hợp cả nam &amp; nữ&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;T&aacute;i hiện tinh thần &ldquo;Wind&rdquo; &ndash; tốc độ, linh hoạt, b&ugrave;ng nổ&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Sẵn s&agrave;ng bứt ph&aacute; mọi giới hạn.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;H&atilde;y kho&aacute;c l&ecirc;n m&igrave;nh Wika Wind v&agrave; biến mỗi đường chạy tr&ecirc;n s&acirc;n th&agrave;nh một &ldquo;cơn lốc&rdquo; mang dấu ấn của ri&ecirc;ng bạn!&lt;/span&gt;&lt;/p&gt;&quot;,
            &quot;gia_goc&quot;: &quot;249000.00&quot;,
            &quot;gia_khuyen_mai&quot;: &quot;239000.00&quot;,
            &quot;so_luong_ton_kho&quot;: 996,
            &quot;can_nang_kg&quot;: null,
            &quot;noi_bat&quot;: false,
            &quot;trang_thai&quot;: true,
            &quot;da_ban&quot;: 94,
            &quot;luot_xem&quot;: 68,
            &quot;diem_danh_gia&quot;: &quot;3.67&quot;,
            &quot;so_luot_danh_gia&quot;: 3,
            &quot;created_at&quot;: &quot;2026-03-14T08:25:19.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-03-19T08:25:21.000000Z&quot;,
            &quot;danh_muc&quot;: {
                &quot;id&quot;: 10,
                &quot;danh_muc_cha_id&quot;: 8,
                &quot;ten&quot;: &quot;&Aacute;o b&oacute;ng đ&aacute;&quot;,
                &quot;duong_dan&quot;: &quot;bong-da-ao-bong-da&quot;,
                &quot;hinh_anh&quot;: null,
                &quot;mo_ta&quot;: null,
                &quot;thu_tu&quot;: 2,
                &quot;trang_thai&quot;: true,
                &quot;created_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;
            },
            &quot;thuong_hieu&quot;: {
                &quot;id&quot;: 2,
                &quot;ten&quot;: &quot;Wika&quot;,
                &quot;duong_dan&quot;: &quot;wika&quot;,
                &quot;logo&quot;: &quot;https://vicsport.vn/wp-content/uploads/2023/11/wika-logo.png&quot;,
                &quot;mo_ta&quot;: &quot;Thương hiệu thể thao Việt Nam, nổi bật với gi&agrave;y b&oacute;ng đ&aacute; v&agrave; trang phục b&oacute;ng đ&aacute;.&quot;,
                &quot;trang_thai&quot;: true,
                &quot;created_at&quot;: null,
                &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;
            },
            &quot;anh_chinh&quot;: {
                &quot;id&quot;: 370,
                &quot;san_pham_id&quot;: 54,
                &quot;duong_dan_anh&quot;: &quot;https://wikasports.com/wp-content/uploads/2025/11/ao-bong-da-wika-wind-xanh-ngoc-1.jpg&quot;,
                &quot;chu_thich&quot;: null,
                &quot;thu_tu&quot;: 0,
                &quot;la_anh_chinh&quot;: true,
                &quot;created_at&quot;: &quot;2026-03-19 08:25:19&quot;,
                &quot;url&quot;: &quot;https://wikasports.com/wp-content/uploads/2025/11/ao-bong-da-wika-wind-xanh-ngoc-1.jpg&quot;
            }
        },
        {
            &quot;id&quot;: 155,
            &quot;danh_muc_id&quot;: 3,
            &quot;thuong_hieu_id&quot;: 3,
            &quot;ten_san_pham&quot;: &quot;&Aacute;o Polo Kamito LS.02&quot;,
            &quot;duong_dan&quot;: &quot;ao-polo-kamito-ls-02-rIUqpPVS&quot;,
            &quot;ma_sku&quot;: &quot;KAM-GCEST8-1015&quot;,
            &quot;mo_ta_ngan&quot;: &quot;&Aacute;o Polo Kamito LS.02&quot;,
            &quot;mo_ta_day_du&quot;: &quot;&lt;p&gt;&Aacute;o Polo nam t&iacute;nh, năng động d&agrave;nh cho c&aacute;c hoạt động thể thao nhẹ nh&agrave;ng.&lt;/p&gt;&quot;,
            &quot;gia_goc&quot;: &quot;399000.00&quot;,
            &quot;gia_khuyen_mai&quot;: null,
            &quot;so_luong_ton_kho&quot;: 992,
            &quot;can_nang_kg&quot;: null,
            &quot;noi_bat&quot;: false,
            &quot;trang_thai&quot;: true,
            &quot;da_ban&quot;: 54,
            &quot;luot_xem&quot;: 57,
            &quot;diem_danh_gia&quot;: &quot;3.00&quot;,
            &quot;so_luot_danh_gia&quot;: 1,
            &quot;created_at&quot;: &quot;2026-03-12T08:25:19.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-03-19T08:25:23.000000Z&quot;,
            &quot;danh_muc&quot;: {
                &quot;id&quot;: 3,
                &quot;danh_muc_cha_id&quot;: 1,
                &quot;ten&quot;: &quot;&Aacute;o Polo&quot;,
                &quot;duong_dan&quot;: &quot;thoi-trang-ao-polo&quot;,
                &quot;hinh_anh&quot;: null,
                &quot;mo_ta&quot;: null,
                &quot;thu_tu&quot;: 2,
                &quot;trang_thai&quot;: true,
                &quot;created_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;
            },
            &quot;thuong_hieu&quot;: {
                &quot;id&quot;: 3,
                &quot;ten&quot;: &quot;Kamito&quot;,
                &quot;duong_dan&quot;: &quot;kamito&quot;,
                &quot;logo&quot;: &quot;https://file.hstatic.net/200000211685/collection/kamito_giay_bong_da_7ff1b85aacb847399de8b9ee269cbac7.png&quot;,
                &quot;mo_ta&quot;: &quot;Thương hiệu đỉnh cao Nhật Bản, nổi tiếng với c&aacute;c m&ocirc;n thể thao đa dụng v&agrave; Pickleball.&quot;,
                &quot;trang_thai&quot;: true,
                &quot;created_at&quot;: null,
                &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;
            },
            &quot;anh_chinh&quot;: {
                &quot;id&quot;: 698,
                &quot;san_pham_id&quot;: 155,
                &quot;duong_dan_anh&quot;: &quot;https://cdn.hstatic.net/products/1000341630/ao_polo_kamito_ls_02_1.jpg&quot;,
                &quot;chu_thich&quot;: null,
                &quot;thu_tu&quot;: 0,
                &quot;la_anh_chinh&quot;: true,
                &quot;created_at&quot;: &quot;2026-03-19 08:25:19&quot;,
                &quot;url&quot;: &quot;https://cdn.hstatic.net/products/1000341630/ao_polo_kamito_ls_02_1.jpg&quot;
            }
        },
        {
            &quot;id&quot;: 37,
            &quot;danh_muc_id&quot;: 18,
            &quot;thuong_hieu_id&quot;: 2,
            &quot;ten_san_pham&quot;: &quot;Vợt Pickeball Wika Bao Fire xanh ngọc&quot;,
            &quot;duong_dan&quot;: &quot;vot-pickeball-wika-bao-fire-xanh-ngoc-90Wap2CN&quot;,
            &quot;ma_sku&quot;: &quot;WIK-5i74BU-30302&quot;,
            &quot;mo_ta_ngan&quot;: &quot;Lấy cảm hứng từ Na Tra, mang DNA chiến binh hệ Lửa với tốc độ v&agrave; sức mạnh b&ugrave;ng nổ.\nL&otilde;i Cannon-Core&trade; tạo tiếng nổ lớn, trợ lực mạnh cho reset, flick v&agrave; volley.\nMặt Carbon T700 nh&aacute;m tăng 30%, bền bỉ v&agrave; tối ưu spin, kiểm so&aacute;t b&oacute;ng.\nViền Foam giảm rung, thiết kế SweetMax mở rộng điểm ngọt, hạn chế mis-hit.\nThiết kế họa tiết lửa độc bản, được nhiều VĐV chọn d&ugrave;ng, đồng h&agrave;nh c&ugrave;ng nh&agrave; v&ocirc; địch Vietnam Masters 2025.&quot;,
            &quot;mo_ta_day_du&quot;: &quot;&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Wika Bao Fire l&agrave; mẫu vợt pickleball thế hệ mới lấy cảm hứng từ h&igrave;nh tượng Na Tra &ndash; nguồn năng lượng y&ecirc;u th&iacute;ch của VĐV Dương Thi&ecirc;n Bảo. Với DNA của một chiến binh hệ Lửa, Bao Fire mang đến trải nghiệm đ&aacute;nh b&ugrave;ng nổ, tốc độ vượt trội v&agrave; khả năng kiểm so&aacute;t b&oacute;ng tối đa trong mọi pha xử l&yacute;. Đ&acirc;y l&agrave; lựa chọn l&yacute; tưởng cho người chơi theo phong c&aacute;ch tốc độ, phản xạ nhanh v&agrave; chủ động kiểm so&aacute;t thế trận.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;img class=\&quot;size-full wp-image-30299 aligncenter\&quot; src=\&quot;https://wikasports.com/wp-content/uploads/2025/12/vot-pickleball-wika-bao-fire-xanh-ngoc-3.jpg\&quot; alt=\&quot;vot-pickleball-wika-bao-fire-xanh-ngoc-3\&quot; width=\&quot;1144\&quot; height=\&quot;1430\&quot; /&gt;&lt;/p&gt;&quot;,
            &quot;gia_goc&quot;: &quot;2900000.00&quot;,
            &quot;gia_khuyen_mai&quot;: &quot;2699000.00&quot;,
            &quot;so_luong_ton_kho&quot;: 993,
            &quot;can_nang_kg&quot;: null,
            &quot;noi_bat&quot;: false,
            &quot;trang_thai&quot;: true,
            &quot;da_ban&quot;: 106,
            &quot;luot_xem&quot;: 51,
            &quot;diem_danh_gia&quot;: &quot;5.00&quot;,
            &quot;so_luot_danh_gia&quot;: 2,
            &quot;created_at&quot;: &quot;2026-03-12T08:25:19.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-03-19T08:25:21.000000Z&quot;,
            &quot;danh_muc&quot;: {
                &quot;id&quot;: 18,
                &quot;danh_muc_cha_id&quot;: 16,
                &quot;ten&quot;: &quot;Vợt Pickleball&quot;,
                &quot;duong_dan&quot;: &quot;pickleball-vot-pickleball&quot;,
                &quot;hinh_anh&quot;: null,
                &quot;mo_ta&quot;: null,
                &quot;thu_tu&quot;: 2,
                &quot;trang_thai&quot;: true,
                &quot;created_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;
            },
            &quot;thuong_hieu&quot;: {
                &quot;id&quot;: 2,
                &quot;ten&quot;: &quot;Wika&quot;,
                &quot;duong_dan&quot;: &quot;wika&quot;,
                &quot;logo&quot;: &quot;https://vicsport.vn/wp-content/uploads/2023/11/wika-logo.png&quot;,
                &quot;mo_ta&quot;: &quot;Thương hiệu thể thao Việt Nam, nổi bật với gi&agrave;y b&oacute;ng đ&aacute; v&agrave; trang phục b&oacute;ng đ&aacute;.&quot;,
                &quot;trang_thai&quot;: true,
                &quot;created_at&quot;: null,
                &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;
            },
            &quot;anh_chinh&quot;: {
                &quot;id&quot;: 276,
                &quot;san_pham_id&quot;: 37,
                &quot;duong_dan_anh&quot;: &quot;https://wikasports.com/wp-content/uploads/2025/12/vot-pickleball-wika-bao-fire-xanh-ngoc-1.jpg&quot;,
                &quot;chu_thich&quot;: null,
                &quot;thu_tu&quot;: 0,
                &quot;la_anh_chinh&quot;: true,
                &quot;created_at&quot;: &quot;2026-03-19 08:25:19&quot;,
                &quot;url&quot;: &quot;https://wikasports.com/wp-content/uploads/2025/12/vot-pickleball-wika-bao-fire-xanh-ngoc-1.jpg&quot;
            }
        },
        {
            &quot;id&quot;: 91,
            &quot;danh_muc_id&quot;: 10,
            &quot;thuong_hieu_id&quot;: 2,
            &quot;ten_san_pham&quot;: &quot;&Aacute;o Wika Team Quang Dương trắng đỏ&quot;,
            &quot;duong_dan&quot;: &quot;ao-wika-team-quang-duong-trang-do-Yts52GaP&quot;,
            &quot;ma_sku&quot;: &quot;WIK-YUcS9s-27886&quot;,
            &quot;mo_ta_ngan&quot;: &quot;Tho&aacute;ng m&aacute;t &ndash; Co gi&atilde;n &ndash; Giữ form: Vải Wi-DRYMAX mới, co gi&atilde;n 4 chiều, bề mặt mềm nhẹ, thoải m&aacute;i.\nC&ocirc;ng nghệ Witech-Dry: Tho&aacute;t mồ h&ocirc;i nhanh, kh&ocirc; tho&aacute;ng, hạn chế bết d&iacute;nh, lu&ocirc;n tự tin khi thi đấu.\nThiết kế trẻ trung &ndash; dễ phối: Cổ tr&ograve;n năng động, viền tay phối m&agrave;u h&agrave;i h&ograve;a, logo Wika nổi bật tr&ecirc;n ngực &aacute;o\nForm d&aacute;ng chuẩn Việt, vừa vặn cho cả nam v&agrave; nữ.&quot;,
            &quot;mo_ta_day_du&quot;: &quot;&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;&Aacute;o Team Wika kh&ocirc;ng chỉ l&agrave; một chiếc &aacute;o thể thao, m&agrave; c&ograve;n l&agrave; biểu tượng của tinh thần gắn kết v&agrave; bản lĩnh thi đấu. Với thiết kế tinh giản nhưng mạnh mẽ, mẫu &aacute;o n&agrave;y gi&uacute;p bạn v&agrave; đồng đội tự tin tạo n&ecirc;n những khoảnh khắc b&ugrave;ng nổ tr&ecirc;n s&acirc;n.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;strong&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Đặc điểm nổi bật của &aacute;o thể thao Team Wika&lt;/span&gt;&lt;/strong&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Chất liệu Wi-DRYMAX cao cấp: Co gi&atilde;n 4 chiều, tho&aacute;ng m&aacute;t, mềm nhẹ, giữ form ổn định trong suốt qu&aacute; tr&igrave;nh vận động.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;C&ocirc;ng nghệ Witech-Dry: Hỗ trợ tho&aacute;t mồ h&ocirc;i nhanh, giữ cơ thể lu&ocirc;n kh&ocirc; tho&aacute;ng, hạn chế bết d&iacute;nh, mang lại sự thoải m&aacute;i tối đa.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Thiết kế trẻ trung, dễ phối: Cổ tr&ograve;n năng động, viền tay phối m&agrave;u h&agrave;i h&ograve;a c&ugrave;ng logo Wika nổi bật, ph&ugrave; hợp cho cả tập luyện lẫn thi đấu.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Form d&aacute;ng chuẩn Việt: Được nghi&ecirc;n cứu để vừa vặn, ph&ugrave; hợp với v&oacute;c d&aacute;ng nam v&agrave; nữ.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;strong&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Th&ocirc;ng tin sản phẩm&lt;/span&gt;&lt;/strong&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Form: Ri&ecirc;ng biệt cho nam v&agrave; nữ&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;M&agrave;u sắc: Trắng T&iacute;m, Navy, Trắng Đỏ, Đỏ&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Size: S, M, L, XL, XXL&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;V&igrave; sao n&ecirc;n chọn &aacute;o Team Wika?&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Kho&aacute;c l&ecirc;n m&igrave;nh &aacute;o thể thao Team Wika, bạn kh&ocirc;ng chỉ cảm nhận sự thoải m&aacute;i m&agrave; c&ograve;n mang theo tinh thần đồng đội, sẵn s&agrave;ng c&ugrave;ng nhau chinh phục mọi giải đấu.&lt;/span&gt;&lt;/p&gt;&quot;,
            &quot;gia_goc&quot;: &quot;310000.00&quot;,
            &quot;gia_khuyen_mai&quot;: &quot;299000.00&quot;,
            &quot;so_luong_ton_kho&quot;: 993,
            &quot;can_nang_kg&quot;: null,
            &quot;noi_bat&quot;: true,
            &quot;trang_thai&quot;: true,
            &quot;da_ban&quot;: 37,
            &quot;luot_xem&quot;: 73,
            &quot;diem_danh_gia&quot;: &quot;3.60&quot;,
            &quot;so_luot_danh_gia&quot;: 5,
            &quot;created_at&quot;: &quot;2026-03-12T08:25:19.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-04-01T14:11:11.000000Z&quot;,
            &quot;danh_muc&quot;: {
                &quot;id&quot;: 10,
                &quot;danh_muc_cha_id&quot;: 8,
                &quot;ten&quot;: &quot;&Aacute;o b&oacute;ng đ&aacute;&quot;,
                &quot;duong_dan&quot;: &quot;bong-da-ao-bong-da&quot;,
                &quot;hinh_anh&quot;: null,
                &quot;mo_ta&quot;: null,
                &quot;thu_tu&quot;: 2,
                &quot;trang_thai&quot;: true,
                &quot;created_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;
            },
            &quot;thuong_hieu&quot;: {
                &quot;id&quot;: 2,
                &quot;ten&quot;: &quot;Wika&quot;,
                &quot;duong_dan&quot;: &quot;wika&quot;,
                &quot;logo&quot;: &quot;https://vicsport.vn/wp-content/uploads/2023/11/wika-logo.png&quot;,
                &quot;mo_ta&quot;: &quot;Thương hiệu thể thao Việt Nam, nổi bật với gi&agrave;y b&oacute;ng đ&aacute; v&agrave; trang phục b&oacute;ng đ&aacute;.&quot;,
                &quot;trang_thai&quot;: true,
                &quot;created_at&quot;: null,
                &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;
            },
            &quot;anh_chinh&quot;: {
                &quot;id&quot;: 528,
                &quot;san_pham_id&quot;: 91,
                &quot;duong_dan_anh&quot;: &quot;https://wikasports.com/wp-content/uploads/2025/09/ao-wika-team-trang-do_optimized.jpg&quot;,
                &quot;chu_thich&quot;: null,
                &quot;thu_tu&quot;: 0,
                &quot;la_anh_chinh&quot;: true,
                &quot;created_at&quot;: &quot;2026-03-19 08:25:19&quot;,
                &quot;url&quot;: &quot;https://wikasports.com/wp-content/uploads/2025/09/ao-wika-team-trang-do_optimized.jpg&quot;
            }
        },
        {
            &quot;id&quot;: 59,
            &quot;danh_muc_id&quot;: 11,
            &quot;thuong_hieu_id&quot;: 2,
            &quot;ten_san_pham&quot;: &quot;&Aacute;o polo Wika Kairo Quang Dương trắng&quot;,
            &quot;duong_dan&quot;: &quot;ao-polo-wika-kairo-quang-duong-trang-lJQ7cO3B&quot;,
            &quot;ma_sku&quot;: &quot;WIK-G8z6IF-29402&quot;,
            &quot;mo_ta_ngan&quot;: &quot;Chất vải WI-DRYMAX (mới) co gi&atilde;n 4 chiều, tăng lượng lỗ tho&aacute;t kh&iacute;\nSợi vải mềm nhẹ, tho&aacute;ng kh&iacute;, giữ cảm gi&aacute;c dễ chịu trong suốt buổi tập.\nC&ocirc;ng nghệ Witech-Dry thấm h&uacute;t mồ h&ocirc;i si&ecirc;u tốc\nForm &aacute;o chuẩn Việt, t&ocirc;n d&aacute;ng thể thao cho cả nam &amp; nữ.\nPh&ugrave; hợp nhiều m&ocirc;n: Pickleball, cầu l&ocirc;ng, gym, chạy bộ&hellip;&quot;,
            &quot;mo_ta_day_du&quot;: &quot;&lt;p style=\&quot;text-align: justify\&quot;&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Bộ sưu tập Wika Kairo x Quang Dương mang đến một bước tiến mới trong thời trang thể thao hiện đại &ndash; nơi sự tinh giản, hiệu năng v&agrave; phong th&aacute;i chuy&ecirc;n nghiệp giao h&ograve;a ho&agrave;n hảo. Kh&ocirc;ng chỉ dừng lại ở một chiếc &aacute;o thể thao th&ocirc;ng thường, &aacute;o Polo Kairo l&agrave; biểu tượng của tinh thần bứt ph&aacute;, thể hiện c&aacute; t&iacute;nh mạnh mẽ v&agrave; phong th&aacute;i tự tin của người mặc tr&ecirc;n mọi mặt s&acirc;n.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;strong&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Thiết kế tinh giản &ndash; hiện đại v&agrave; kh&aacute;c biệt&lt;/span&gt;&lt;/strong&gt;&lt;/p&gt;\n&lt;p style=\&quot;text-align: justify\&quot;&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;&Aacute;o Polo Wika Kairo g&acirc;y ấn tượng ngay từ c&aacute;i nh&igrave;n đầu ti&ecirc;n với thiết kế tối giản nhưng độc đ&aacute;o. Thay v&igrave; sử dụng họa tiết phức tạp, Wika tập trung v&agrave;o những đường line tinh tế chạy dọc th&acirc;n &aacute;o &ndash; chi tiết nhỏ nhưng mang đến hiệu ứng thị gi&aacute;c mạnh mẽ, gi&uacute;p t&ocirc;n l&ecirc;n d&aacute;ng người thể thao v&agrave; tạo cảm gi&aacute;c chuyển động li&ecirc;n tục.&lt;/span&gt;&lt;/p&gt;\n&lt;p style=\&quot;text-align: justify\&quot;&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Sự kết hợp hai mảng m&agrave;u chủ đạo được xử l&yacute; tinh tế tạo n&ecirc;n diện mạo hiện đại, năng động v&agrave; đầy cuốn h&uacute;t. D&ugrave; l&agrave; tr&ecirc;n s&acirc;n tập, trong trận đấu hay khi tham gia c&aacute;c hoạt động ngo&agrave;i trời, Wika Kairo đều gi&uacute;p người mặc nổi bật với phong c&aacute;ch thời thượng nhưng kh&ocirc;ng ph&ocirc; trương.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;strong&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Chất liệu WI-DRYMAX &ndash; đột ph&aacute; trong c&ocirc;ng nghệ vải thể thao&lt;/span&gt;&lt;/strong&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Điểm kh&aacute;c biệt lớn nhất của &aacute;o Polo Kairo nằm ở chất liệu WI-DRYMAX thế hệ mới, được Wika nghi&ecirc;n cứu v&agrave; ph&aacute;t triển ri&ecirc;ng cho c&aacute;c d&ograve;ng sản phẩm thể thao cao cấp.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Co gi&atilde;n 4 chiều gi&uacute;p người mặc dễ d&agrave;ng di chuyển, xoay chuyển linh hoạt trong từng động t&aacute;c.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Tăng lượng lỗ tho&aacute;t kh&iacute; tr&ecirc;n bề mặt vải gi&uacute;p lưu th&ocirc;ng kh&ocirc;ng kh&iacute; hiệu quả, giữ cơ thể lu&ocirc;n kh&ocirc; tho&aacute;ng d&ugrave; vận động trong thời gian d&agrave;i.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Sợi vải mềm nhẹ, mang đến cảm gi&aacute;c dễ chịu, kh&ocirc;ng g&acirc;y k&iacute;ch ứng da v&agrave; ph&ugrave; hợp với mọi điều kiện thời tiết.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Với chất liệu n&agrave;y, &aacute;o thể thao Wika Kairo kh&ocirc;ng chỉ mang lại sự thoải m&aacute;i tối đa m&agrave; c&ograve;n gi&uacute;p n&acirc;ng cao hiệu suất luyện tập, giảm cảm gi&aacute;c b&iacute; b&aacute;ch &ndash; yếu tố m&agrave; những người chơi thể thao chuy&ecirc;n nghiệp lu&ocirc;n t&igrave;m kiếm.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;strong&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;C&ocirc;ng nghệ Witech-Dry &ndash; thấm h&uacute;t si&ecirc;u tốc, lu&ocirc;n kh&ocirc; r&aacute;o&lt;/span&gt;&lt;/strong&gt;&lt;/p&gt;\n&lt;p style=\&quot;text-align: justify\&quot;&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Được trang bị c&ocirc;ng nghệ Witech-Dry độc quyền, Polo Kairo c&oacute; khả năng thấm h&uacute;t v&agrave; bay hơi mồ h&ocirc;i si&ecirc;u nhanh, gi&uacute;p l&agrave;n da lu&ocirc;n kh&ocirc; tho&aacute;ng. Trong những buổi tập cường độ cao, bạn c&oacute; thể ho&agrave;n to&agrave;n y&ecirc;n t&acirc;m về cảm gi&aacute;c thoải m&aacute;i m&agrave; chiếc &aacute;o mang lại.&lt;/span&gt;&lt;/p&gt;\n&lt;p style=\&quot;text-align: justify\&quot;&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Nhờ cơ chế hoạt động th&ocirc;ng minh, c&aacute;c sợi vải sẽ tự động đẩy hơi ẩm ra ngo&agrave;i bề mặt để bay hơi, đồng thời ngăn kh&ocirc;ng cho mồ h&ocirc;i b&aacute;m ngược trở lại cơ thể. Ch&iacute;nh v&igrave; vậy, &aacute;o Polo Kairo lu&ocirc;n giữ được form d&aacute;ng gọn g&agrave;ng, kh&ocirc;ng nhăn nh&uacute;m hay bết d&iacute;nh trong qu&aacute; tr&igrave;nh vận động.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;strong&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Form &aacute;o chuẩn Việt &ndash; t&ocirc;n d&aacute;ng thể thao cho cả nam v&agrave; nữ&lt;/span&gt;&lt;/strong&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Wika hiểu r&otilde; v&oacute;c d&aacute;ng v&agrave; th&oacute;i quen vận động của người Việt, do đ&oacute; form &aacute;o Kairo được thiết kế theo chuẩn thể h&igrave;nh Việt Nam, đảm bảo vừa vặn v&agrave; t&ocirc;n d&aacute;ng tự nhi&ecirc;n.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Phần vai v&agrave; ngực được cắt may tinh tế gi&uacute;p t&ocirc;n l&ecirc;n vẻ mạnh mẽ, khỏe khoắn.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Eo &aacute;o được xử l&yacute; gọn g&agrave;ng gi&uacute;p người mặc tr&ocirc;ng cao v&agrave; c&acirc;n đối hơn.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Với khả năng ph&ugrave; hợp cho cả nam v&agrave; nữ, Polo Kairo trở th&agrave;nh lựa chọn l&yacute; tưởng cho c&aacute;c đội nh&oacute;m, c&acirc;u lạc bộ thể thao hoặc c&aacute;c buổi tập chung.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;strong&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Linh hoạt trong mọi hoạt động thể thao&lt;/span&gt;&lt;/strong&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Kh&ocirc;ng chỉ d&agrave;nh ri&ecirc;ng cho một m&ocirc;n thể thao, &aacute;o Wika Kairo l&agrave; sự lựa chọn ho&agrave;n hảo cho nhiều hoạt động kh&aacute;c nhau như:&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Pickleball &ndash; m&ocirc;n thể thao đang thịnh h&agrave;nh với y&ecirc;u cầu cao về sự linh hoạt v&agrave; tho&aacute;ng m&aacute;t.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Cầu l&ocirc;ng &ndash; hỗ trợ chuyển động nhanh, nhẹ v&agrave; ổn định.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Gym &amp; Fitness &ndash; co gi&atilde;n 4 chiều, thoải m&aacute;i trong mọi b&agrave;i tập.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Chạy bộ, thể dục ngo&agrave;i trời &ndash; chất liệu kh&ocirc; nhanh, dễ chịu trong mọi điều kiện thời tiết.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Từ những s&acirc;n chơi phong tr&agrave;o đến c&aacute;c giải đấu chuy&ecirc;n nghiệp, Wika Kairo x Quang Dương lu&ocirc;n mang lại cảm gi&aacute;c tự tin, chuy&ecirc;n nghiệp v&agrave; đầy năng lượng t&iacute;ch cực cho người mặc.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;strong&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Sự hợp t&aacute;c giữa Wika v&agrave; Quang Dương &ndash; khi thời trang gặp thể thao&lt;/span&gt;&lt;/strong&gt;&lt;/p&gt;\n&lt;p style=\&quot;text-align: justify\&quot;&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Sự kết hợp giữa thương hiệu Wika &ndash; nổi tiếng với c&aacute;c sản phẩm thể thao chất lượng cao &ndash; v&agrave; Quang Dương &ndash; gương mặt đại diện cho phong c&aacute;ch thể thao hiện đại &ndash; đ&atilde; tạo n&ecirc;n bản phối Kairo vừa mang t&iacute;nh thẩm mỹ, vừa đ&aacute;p ứng y&ecirc;u cầu khắt khe về hiệu năng.&lt;/span&gt;&lt;/p&gt;\n&lt;p style=\&quot;text-align: justify\&quot;&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Mỗi chi tiết tr&ecirc;n &aacute;o đều được c&acirc;n nhắc kỹ lưỡng để đạt được sự c&acirc;n bằng giữa thiết kế v&agrave; c&ocirc;ng năng, giữa thời trang v&agrave; thể thao. Đ&acirc;y kh&ocirc;ng chỉ l&agrave; chiếc &aacute;o mặc để tập luyện, m&agrave; c&ograve;n l&agrave; tuy&ecirc;n ng&ocirc;n phong c&aacute;ch của những người y&ecirc;u vận động v&agrave; hướng đến sự ho&agrave;n thiện.&lt;/span&gt;&lt;/p&gt;\n&lt;p style=\&quot;text-align: justify\&quot;&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;&Aacute;o Polo Wika Kairo x Quang Dương kh&ocirc;ng chỉ l&agrave; một sản phẩm thể thao, m&agrave; l&agrave; sự lựa chọn của những người hiện đại &ndash; những người muốn khẳng định phong th&aacute;i chuy&ecirc;n nghiệp, tinh giản v&agrave; kh&aacute;c biệt. Với chất liệu ti&ecirc;n tiến, thiết kế tinh tế v&agrave; c&ocirc;ng nghệ hỗ trợ hiệu suất tối đa, Wika Kairo xứng đ&aacute;ng l&agrave; người bạn đồng h&agrave;nh trong mọi h&agrave;nh tr&igrave;nh luyện tập v&agrave; thi đấu.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Tự tin &ndash; Năng động &ndash; Chuy&ecirc;n nghiệp, đ&oacute; l&agrave; tinh thần m&agrave; Wika Kairo mang đến cho bạn.&lt;/span&gt;&lt;/p&gt;&quot;,
            &quot;gia_goc&quot;: &quot;399000.00&quot;,
            &quot;gia_khuyen_mai&quot;: &quot;359000.00&quot;,
            &quot;so_luong_ton_kho&quot;: 994,
            &quot;can_nang_kg&quot;: null,
            &quot;noi_bat&quot;: false,
            &quot;trang_thai&quot;: true,
            &quot;da_ban&quot;: 80,
            &quot;luot_xem&quot;: 28,
            &quot;diem_danh_gia&quot;: &quot;4.50&quot;,
            &quot;so_luot_danh_gia&quot;: 4,
            &quot;created_at&quot;: &quot;2026-03-11T08:25:19.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-03-19T08:25:21.000000Z&quot;,
            &quot;danh_muc&quot;: {
                &quot;id&quot;: 11,
                &quot;danh_muc_cha_id&quot;: 8,
                &quot;ten&quot;: &quot;&Aacute;o Polo&quot;,
                &quot;duong_dan&quot;: &quot;bong-da-ao-polo&quot;,
                &quot;hinh_anh&quot;: null,
                &quot;mo_ta&quot;: null,
                &quot;thu_tu&quot;: 3,
                &quot;trang_thai&quot;: true,
                &quot;created_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;
            },
            &quot;thuong_hieu&quot;: {
                &quot;id&quot;: 2,
                &quot;ten&quot;: &quot;Wika&quot;,
                &quot;duong_dan&quot;: &quot;wika&quot;,
                &quot;logo&quot;: &quot;https://vicsport.vn/wp-content/uploads/2023/11/wika-logo.png&quot;,
                &quot;mo_ta&quot;: &quot;Thương hiệu thể thao Việt Nam, nổi bật với gi&agrave;y b&oacute;ng đ&aacute; v&agrave; trang phục b&oacute;ng đ&aacute;.&quot;,
                &quot;trang_thai&quot;: true,
                &quot;created_at&quot;: null,
                &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;
            },
            &quot;anh_chinh&quot;: {
                &quot;id&quot;: 382,
                &quot;san_pham_id&quot;: 59,
                &quot;duong_dan_anh&quot;: &quot;https://wikasports.com/wp-content/uploads/2025/11/ao-polo-wika-kairo-quang-duong-trang-1_optimized.jpg&quot;,
                &quot;chu_thich&quot;: null,
                &quot;thu_tu&quot;: 0,
                &quot;la_anh_chinh&quot;: true,
                &quot;created_at&quot;: &quot;2026-03-19 08:25:19&quot;,
                &quot;url&quot;: &quot;https://wikasports.com/wp-content/uploads/2025/11/ao-polo-wika-kairo-quang-duong-trang-1_optimized.jpg&quot;
            }
        },
        {
            &quot;id&quot;: 63,
            &quot;danh_muc_id&quot;: 10,
            &quot;thuong_hieu_id&quot;: 2,
            &quot;ten_san_pham&quot;: &quot;&Aacute;o thể thao Wika Xvolt xanh ngọc&quot;,
            &quot;duong_dan&quot;: &quot;ao-wika-xvolt-xanh-ngoc-Jef0FhdO&quot;,
            &quot;ma_sku&quot;: &quot;WIK-eBExze-29239&quot;,
            &quot;mo_ta_ngan&quot;: &quot;&Aacute;o thể thao WIKA XVOLT mang cảm hứng &ldquo;Volt&rdquo; &ndash; tốc độ, sức mạnh v&agrave; tinh thần bứt ph&aacute;.\nChất liệu WI-DRYMAX co gi&atilde;n 4 chiều, tho&aacute;ng kh&iacute; v&agrave; thấm h&uacute;t mồ h&ocirc;i si&ecirc;u tốc.\nHọa tiết tia s&eacute;t chạy dọc th&acirc;n &aacute;o thể hiện năng lượng v&agrave; c&aacute; t&iacute;nh người chơi.\nForm chuẩn Việt, t&ocirc;n d&aacute;ng thể thao cho cả nam v&agrave; nữ.\nPh&ugrave; hợp nhiều m&ocirc;n: pickleball, cầu l&ocirc;ng, gym, chạy bộ v&agrave; c&aacute;c hoạt động ngo&agrave;i trời.&quot;,
            &quot;mo_ta_day_du&quot;: &quot;&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Khi Linh Muối v&agrave; Tr&iacute; Chuột &ndash; hai phong c&aacute;ch, hai c&aacute; t&iacute;nh kh&aacute;c biệt &ndash; c&ugrave;ng kho&aacute;c l&ecirc;n m&igrave;nh chiếc &aacute;o WIKA XVOLT, s&acirc;n đấu như bừng l&ecirc;n nguồn điện mới. Kh&ocirc;ng chỉ l&agrave; trang phục thể thao, XVolt l&agrave; biểu tượng của tốc độ, sức mạnh v&agrave; tinh thần bứt ph&aacute; &ndash; nơi mỗi chuyển động đều mang trong m&igrave;nh năng lượng &ldquo;Volt&rdquo; m&atilde;nh liệt.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Họa tiết tia s&eacute;t chạy dọc th&acirc;n &aacute;o ch&iacute;nh l&agrave; tuy&ecirc;n ng&ocirc;n của những người chơi kh&ocirc;ng ngừng tiến l&ecirc;n. Mỗi đường n&eacute;t được thiết kế để khắc họa DNA &ldquo;Volt&rdquo;: nhiệt huyết, mạnh mẽ v&agrave; đầy đam m&ecirc;.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;strong&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;C&ocirc;ng nghệ &amp; chất liệu &ndash; Hiệu suất vượt trội&lt;/span&gt;&lt;/strong&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Vải WI-DRYMAX (phi&ecirc;n bản mới): co gi&atilde;n 4 chiều, gia tăng số lượng lỗ tho&aacute;t kh&iacute;, gi&uacute;p bạn di chuyển linh hoạt trong mọi trận đấu.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Sợi vải mềm nhẹ, tho&aacute;ng kh&iacute;, mang lại cảm gi&aacute;c dễ chịu d&ugrave; tập luyện cường độ cao.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;C&ocirc;ng nghệ Witech-Dry: thấm h&uacute;t mồ h&ocirc;i si&ecirc;u tốc, giữ cơ thể lu&ocirc;n kh&ocirc; r&aacute;o v&agrave; tr&agrave;n đầy năng lượng.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Form &aacute;o chuẩn Việt: t&ocirc;n d&aacute;ng thể thao, ph&ugrave; hợp cho cả nam v&agrave; nữ.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Đa năng &ndash; Chuẩn phong c&aacute;ch vận động hiện đại&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Từ pickleball, cầu l&ocirc;ng, gym, chạy bộ đến c&aacute;c hoạt động ngo&agrave;i trời, WIKA XVOLT l&agrave; lựa chọn ho&agrave;n hảo cho những ai muốn kết hợp hiệu năng v&agrave; thời trang.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;WIKA XVOLT &ndash; kh&ocirc;ng chỉ l&agrave; &aacute;o thể thao, m&agrave; l&agrave; nguồn năng lượng dẫn nhịp cho mọi s&acirc;n đấu. &lt;/span&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Bạn sẵn s&agrave;ng k&iacute;ch hoạt &ldquo;Volt Mode&rdquo; của ri&ecirc;ng m&igrave;nh chưa?&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;img class=\&quot;size-full wp-image-18802 aligncenter\&quot; src=\&quot;https://wikasports.com/wp-content/uploads/2024/12/bang-size-ao-the-thao.jpg\&quot; alt=\&quot;bang-size-ao-the-thao\&quot; width=\&quot;646\&quot; height=\&quot;383\&quot; /&gt;&lt;/p&gt;&quot;,
            &quot;gia_goc&quot;: &quot;399000.00&quot;,
            &quot;gia_khuyen_mai&quot;: &quot;359000.00&quot;,
            &quot;so_luong_ton_kho&quot;: 996,
            &quot;can_nang_kg&quot;: null,
            &quot;noi_bat&quot;: false,
            &quot;trang_thai&quot;: true,
            &quot;da_ban&quot;: 16,
            &quot;luot_xem&quot;: 26,
            &quot;diem_danh_gia&quot;: &quot;4.75&quot;,
            &quot;so_luot_danh_gia&quot;: 4,
            &quot;created_at&quot;: &quot;2026-03-11T08:25:19.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-03-19T08:25:21.000000Z&quot;,
            &quot;danh_muc&quot;: {
                &quot;id&quot;: 10,
                &quot;danh_muc_cha_id&quot;: 8,
                &quot;ten&quot;: &quot;&Aacute;o b&oacute;ng đ&aacute;&quot;,
                &quot;duong_dan&quot;: &quot;bong-da-ao-bong-da&quot;,
                &quot;hinh_anh&quot;: null,
                &quot;mo_ta&quot;: null,
                &quot;thu_tu&quot;: 2,
                &quot;trang_thai&quot;: true,
                &quot;created_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;
            },
            &quot;thuong_hieu&quot;: {
                &quot;id&quot;: 2,
                &quot;ten&quot;: &quot;Wika&quot;,
                &quot;duong_dan&quot;: &quot;wika&quot;,
                &quot;logo&quot;: &quot;https://vicsport.vn/wp-content/uploads/2023/11/wika-logo.png&quot;,
                &quot;mo_ta&quot;: &quot;Thương hiệu thể thao Việt Nam, nổi bật với gi&agrave;y b&oacute;ng đ&aacute; v&agrave; trang phục b&oacute;ng đ&aacute;.&quot;,
                &quot;trang_thai&quot;: true,
                &quot;created_at&quot;: null,
                &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;
            },
            &quot;anh_chinh&quot;: {
                &quot;id&quot;: 393,
                &quot;san_pham_id&quot;: 63,
                &quot;duong_dan_anh&quot;: &quot;https://wikasports.com/wp-content/uploads/2025/11/ao-wika-xvolt-xanh-ngoc-1.png&quot;,
                &quot;chu_thich&quot;: null,
                &quot;thu_tu&quot;: 0,
                &quot;la_anh_chinh&quot;: true,
                &quot;created_at&quot;: &quot;2026-03-19 08:25:19&quot;,
                &quot;url&quot;: &quot;https://wikasports.com/wp-content/uploads/2025/11/ao-wika-xvolt-xanh-ngoc-1.png&quot;
            }
        },
        {
            &quot;id&quot;: 34,
            &quot;danh_muc_id&quot;: 11,
            &quot;thuong_hieu_id&quot;: 2,
            &quot;ten_san_pham&quot;: &quot;&Aacute;o polo Wika Leather m&agrave;u trắng x&aacute;m&quot;,
            &quot;duong_dan&quot;: &quot;ao-polo-wika-leather-trang-xam-d36Q1Zbs&quot;,
            &quot;ma_sku&quot;: &quot;WIK-fpMeno-30428&quot;,
            &quot;mo_ta_ngan&quot;: &quot;Chất vải Polyester co gi&atilde;n, đ&agrave;n hồi tốt, giữ form\nSợi vải tho&aacute;ng kh&iacute;, mềm nhẹ tạ cảm gi&aacute;c dễ chịu khi tập\nSử dụng c&ocirc;ng nghệ Witech-dry thấm h&uacute;t mồ h&ocirc;i v&agrave; ngăn m&ugrave;i\nCổ &aacute;o được thiết kế cứng c&aacute;p, đứng form\nHoạ tiết mũi t&ecirc;n ph&aacute; c&aacute;ch 1 b&ecirc;n vai nổi bật c&ugrave;ng h&ocirc;ng &aacute;o\nForm &aacute;o chuẩn Việt cho cả nam &amp; nữ&quot;,
            &quot;mo_ta_day_du&quot;: &quot;&lt;p style=\&quot;text-align: justify\&quot;&gt;&lt;span style=\&quot;color: #000000;font-size: 100%\&quot;&gt;Trở lại với những item polo thể thao, Wika ra mắt &aacute;o Wika Leather mang đến phong c&aacute;ch chuy&ecirc;n nghiệp c&ugrave;ng khả năng thấm h&uacute;t tối đa trong tập luyện.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;strong&gt;&lt;span style=\&quot;color: #000000;font-size: 100%\&quot;&gt;Cảm hứng thiết kế&lt;/span&gt;&lt;/strong&gt;&lt;/p&gt;\n&lt;p style=\&quot;text-align: justify\&quot;&gt;&lt;span style=\&quot;color: #000000;font-size: 100%\&quot;&gt;Wika Lealther kh&ocirc;ng chỉ l&agrave; một chiếc &aacute;o polo thể thao, m&agrave; c&ograve;n l&agrave; tuy&ecirc;n ng&ocirc;n về sự bứt ph&aacute; mạnh mẽ v&agrave; tinh thần chinh phục. Lấy cảm hứng từ h&igrave;nh ảnh những chiến binh lu&ocirc;n hướng về ph&iacute;a trước, &aacute;o sở hữu họa tiết mũi t&ecirc;n sắc n&eacute;t chạy dọc một b&ecirc;n vai v&agrave; h&ocirc;ng &aacute;o, tạo n&ecirc;n một diện mạo đầy ph&aacute; c&aacute;ch v&agrave; nổi bật.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;strong&gt;&lt;span style=\&quot;color: #000000;font-size: 100%\&quot;&gt;Thiết kế v&agrave; c&ocirc;ng nghệ&lt;/span&gt;&lt;/strong&gt;&lt;/p&gt;\n&lt;p style=\&quot;text-align: justify\&quot;&gt;&lt;span style=\&quot;color: #000000;font-size: 100%\&quot;&gt;&Aacute;o polo Wika Leather kh&ocirc;ng chỉ nổi bật c&ugrave;ng họa tiết bất đối xứng với mũi t&ecirc;n đa hướng, m&agrave; c&ograve;n được thiết kế để mang lại sự thoải m&aacute;i v&agrave; phong c&aacute;ch cho mọi người chơi thể thao. Đ&acirc;y l&agrave; chiếc &aacute;o ho&agrave;n hảo cho cả vận động vi&ecirc;n chuy&ecirc;n nghiệp lẫn người y&ecirc;u thể thao, với những điểm nhấn vượt trội:&lt;/span&gt;&lt;/p&gt;\n&lt;p style=\&quot;text-align: justify\&quot;&gt;&lt;strong&gt;&lt;span style=\&quot;color: #000000;font-size: 100%\&quot;&gt;Thoải m&aacute;i vượt trội &ndash; Vận động dễ chịu&lt;/span&gt;&lt;/strong&gt;&lt;/p&gt;\n&lt;p style=\&quot;text-align: justify\&quot;&gt;&lt;span style=\&quot;color: #000000;font-size: 100%\&quot;&gt;&ndash; Chất liệu Polyester co gi&atilde;n 4 chiều gi&uacute;p &aacute;o linh hoạt theo từng cử động, mang lại cảm gi&aacute;c dễ chịu d&ugrave; bạn đang vận động mạnh hay luyện tập cường độ cao.&lt;/span&gt;&lt;/p&gt;\n&lt;p style=\&quot;text-align: justify\&quot;&gt;&lt;span style=\&quot;color: #000000;font-size: 100%\&quot;&gt;&ndash; C&ocirc;ng nghệ Wi-tech Dry gi&uacute;p thấm h&uacute;t mồ h&ocirc;i si&ecirc;u tốc, giữ cơ thể kh&ocirc; r&aacute;o v&agrave; tho&aacute;ng m&aacute;t suốt thời gian d&agrave;i.&lt;/span&gt;&lt;/p&gt;\n&lt;p style=\&quot;text-align: justify\&quot;&gt;&lt;strong&gt;&lt;span style=\&quot;color: #000000;font-size: 100%\&quot;&gt;Thiết kế chuẩn Việt &ndash; T&ocirc;n d&aacute;ng cả nam &amp; nữ&lt;/span&gt;&lt;/strong&gt;&lt;/p&gt;\n&lt;p style=\&quot;text-align: justify\&quot;&gt;&lt;span style=\&quot;color: #000000;font-size: 100%\&quot;&gt;&ndash; Form &aacute;o được ph&aacute;t triển dựa tr&ecirc;n số đo trung b&igrave;nh của người Việt, mang lại sự vừa vặn.&lt;/span&gt;&lt;/p&gt;\n&lt;p style=\&quot;text-align: justify\&quot;&gt;&lt;span style=\&quot;color: #000000;font-size: 100%\&quot;&gt;&ndash; D&aacute;ng &aacute;o Regular Fit kh&ocirc;ng b&oacute; s&aacute;t, tạo cảm gi&aacute;c thoải m&aacute;i nhưng vẫn giữ được vẻ ngo&agrave;i gọn g&agrave;ng v&agrave; năng động.&lt;/span&gt;&lt;/p&gt;\n&lt;p style=\&quot;text-align: justify\&quot;&gt;&lt;strong&gt;&lt;span style=\&quot;color: #000000;font-size: 100%\&quot;&gt;Phong c&aacute;ch chuy&ecirc;n nghiệp &ndash; Tự tin thi đấu&lt;/span&gt;&lt;/strong&gt;&lt;/p&gt;\n&lt;p style=\&quot;text-align: justify\&quot;&gt;&lt;span style=\&quot;color: #000000;font-size: 100%\&quot;&gt;&ndash; Cổ &aacute;o cứng c&aacute;p, đứng form v&agrave; chuy&ecirc;n nghiệp.&lt;/span&gt;&lt;/p&gt;\n&lt;p style=\&quot;text-align: justify\&quot;&gt;&lt;span style=\&quot;color: #000000;font-size: 100%\&quot;&gt;&ndash; Phối m&agrave;u h&agrave;i h&ograve;a ở cổ v&agrave; viền tay &aacute;o, tạo điểm nhấn tinh tế, ph&ugrave; hợp với mọi tone da.&lt;/span&gt;&lt;/p&gt;\n&lt;p style=\&quot;text-align: justify\&quot;&gt;&lt;span style=\&quot;color: #000000;font-size: 100%\&quot;&gt;&ndash; Dễ d&agrave;ng kết hợp với nhiều kiểu quần shorts hay quần d&agrave;i, linh hoạt phong c&aacute;ch.&lt;/span&gt;&lt;/p&gt;\n&lt;p style=\&quot;text-align: justify\&quot;&gt;&lt;strong&gt;&lt;span style=\&quot;color: #000000;font-size: 100%\&quot;&gt;Size v&agrave; m&agrave;u sắc&lt;/span&gt;&lt;/strong&gt;&lt;/p&gt;\n&lt;p style=\&quot;text-align: justify\&quot;&gt;&lt;span style=\&quot;color: #000000;font-size: 100%\&quot;&gt;&ndash; Size: S &ndash; M &ndash; L &ndash; XL &ndash; XXL&lt;/span&gt;&lt;/p&gt;\n&lt;p style=\&quot;text-align: justify\&quot;&gt;&lt;span style=\&quot;color: #000000;font-size: 100%\&quot;&gt;&ndash; 3 phối m&agrave;u nổi bật: Trắng &ndash; Xanh Dương &ndash; Đỏ&lt;/span&gt;&lt;/p&gt;&quot;,
            &quot;gia_goc&quot;: &quot;250000.00&quot;,
            &quot;gia_khuyen_mai&quot;: &quot;219000.00&quot;,
            &quot;so_luong_ton_kho&quot;: 989,
            &quot;can_nang_kg&quot;: null,
            &quot;noi_bat&quot;: false,
            &quot;trang_thai&quot;: true,
            &quot;da_ban&quot;: 87,
            &quot;luot_xem&quot;: 77,
            &quot;diem_danh_gia&quot;: &quot;5.00&quot;,
            &quot;so_luot_danh_gia&quot;: 1,
            &quot;created_at&quot;: &quot;2026-03-09T08:25:19.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-03-19T08:25:21.000000Z&quot;,
            &quot;danh_muc&quot;: {
                &quot;id&quot;: 11,
                &quot;danh_muc_cha_id&quot;: 8,
                &quot;ten&quot;: &quot;&Aacute;o Polo&quot;,
                &quot;duong_dan&quot;: &quot;bong-da-ao-polo&quot;,
                &quot;hinh_anh&quot;: null,
                &quot;mo_ta&quot;: null,
                &quot;thu_tu&quot;: 3,
                &quot;trang_thai&quot;: true,
                &quot;created_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;
            },
            &quot;thuong_hieu&quot;: {
                &quot;id&quot;: 2,
                &quot;ten&quot;: &quot;Wika&quot;,
                &quot;duong_dan&quot;: &quot;wika&quot;,
                &quot;logo&quot;: &quot;https://vicsport.vn/wp-content/uploads/2023/11/wika-logo.png&quot;,
                &quot;mo_ta&quot;: &quot;Thương hiệu thể thao Việt Nam, nổi bật với gi&agrave;y b&oacute;ng đ&aacute; v&agrave; trang phục b&oacute;ng đ&aacute;.&quot;,
                &quot;trang_thai&quot;: true,
                &quot;created_at&quot;: null,
                &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;
            },
            &quot;anh_chinh&quot;: {
                &quot;id&quot;: 270,
                &quot;san_pham_id&quot;: 34,
                &quot;duong_dan_anh&quot;: &quot;https://wikasports.com/wp-content/uploads/2025/12/ao-polo-wika-leather-trang-xam_optimized.jpg&quot;,
                &quot;chu_thich&quot;: null,
                &quot;thu_tu&quot;: 0,
                &quot;la_anh_chinh&quot;: true,
                &quot;created_at&quot;: &quot;2026-03-19 08:25:19&quot;,
                &quot;url&quot;: &quot;https://wikasports.com/wp-content/uploads/2025/12/ao-polo-wika-leather-trang-xam_optimized.jpg&quot;
            }
        }
    ],
    &quot;meta&quot;: {
        &quot;current_page&quot;: 1,
        &quot;last_page&quot;: 6,
        &quot;per_page&quot;: 12,
        &quot;total&quot;: 67,
        &quot;from&quot;: 1,
        &quot;to&quot;: 12
    },
    &quot;links&quot;: {
        &quot;first&quot;: &quot;http://localhost:8000/api/v1/products?page=1&quot;,
        &quot;last&quot;: &quot;http://localhost:8000/api/v1/products?page=6&quot;,
        &quot;prev&quot;: null,
        &quot;next&quot;: &quot;http://localhost:8000/api/v1/products?page=2&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-products" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-products"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-products"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-products" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-products">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-products" data-method="GET"
      data-path="api/v1/products"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-products', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-products"
                    onclick="tryItOut('GETapi-v1-products');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-products"
                    onclick="cancelTryOut('GETapi-v1-products');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-products"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/products</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-products"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-products"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>tu_khoa</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="tu_khoa"                data-endpoint="GETapi-v1-products"
               value="áo"
               data-component="query">
    <br>
<p>Tìm kiếm theo tên sản phẩm. Example: <code>áo</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>danh_muc_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="danh_muc_id"                data-endpoint="GETapi-v1-products"
               value="3"
               data-component="query">
    <br>
<p>Lọc theo ID danh mục. Example: <code>3</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>thuong_hieu_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="thuong_hieu_id"                data-endpoint="GETapi-v1-products"
               value=""
               data-component="query">
    <br>
<p>Lọc theo ID thương hiệu.</p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>sap_xep</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="sap_xep"                data-endpoint="GETapi-v1-products"
               value="moi_nhat"
               data-component="query">
    <br>
<p>Tiêu chí sắp xếp: <code>moi_nhat</code>, <code>ban_chay</code>, <code>gia_tang</code>, <code>gia_giam</code>. Example: <code>moi_nhat</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>gioi_han</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="gioi_han"                data-endpoint="GETapi-v1-products"
               value="12"
               data-component="query">
    <br>
<p>Số lượng sản phẩm trên mỗi trang (Mặc định: 12). Example: <code>12</code></p>
            </div>
                </form>

                    <h2 id="2-san-pham-danh-muc-khach-hang-GETapi-v1-products--slug-">Xem chi tiết sản phẩm</h2>

<p>
</p>

<p>Trả về thông tin chi tiết một sản phẩm, bao gồm biến thể và hình ảnh.
Cập nhật thêm luồng Tracking hành vi xem chi tiết phục vụ cho Suggestion ML.</p>

<span id="example-requests-GETapi-v1-products--slug-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/products/ao-thun-the-thao-nam" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/products/ao-thun-the-thao-nam"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-products--slug-">
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Sản phẩm kh&ocirc;ng tồn tại hoặc đ&atilde; ngừng b&aacute;n&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-products--slug-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-products--slug-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-products--slug-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-products--slug-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-products--slug-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-products--slug-" data-method="GET"
      data-path="api/v1/products/{slug}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-products--slug-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-products--slug-"
                    onclick="tryItOut('GETapi-v1-products--slug-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-products--slug-"
                    onclick="cancelTryOut('GETapi-v1-products--slug-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-products--slug-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/products/{slug}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-products--slug-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-products--slug-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>slug</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="slug"                data-endpoint="GETapi-v1-products--slug-"
               value="ao-thun-the-thao-nam"
               data-component="url">
    <br>
<p>Slug duy nhất của sản phẩm. Example: <code>ao-thun-the-thao-nam</code></p>
            </div>
                    </form>

                                <h2 id="2-san-pham-danh-muc-khach-hang-banner-trang-chu-quan-ly-hien-thi-banner-dong-tren-giao-dien-cua-hang">Banner Trang chủ

Quản lý hiển thị Banner động trên giao diện Cửa hàng.</h2>
                                                    <h2 id="2-san-pham-danh-muc-khach-hang-GETapi-v1-banners">Danh sách Banner</h2>

<p>
</p>

<p>Lấy các Banner đang hoạt động để hiển thị Slideshow trên Trang chủ.</p>

<span id="example-requests-GETapi-v1-banners">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/banners" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/banners"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-banners">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Danh s&aacute;ch Banner&quot;,
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;tieu_de&quot;: &quot;Banner Gi&agrave;y b&oacute;ng đ&aacute; Wika 1&quot;,
            &quot;hinh_anh&quot;: &quot;https://wikasports.com/wp-content/uploads/2021/06/banner-giay-da-bong-1-2048x823.jpg&quot;,
            &quot;duong_dan&quot;: &quot;/danh-muc/giay-bong-da&quot;,
            &quot;thu_tu&quot;: 1,
            &quot;trang_thai&quot;: 1,
            &quot;created_at&quot;: &quot;2026-03-19T08:25:19.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-03-19T08:25:19.000000Z&quot;,
            &quot;url&quot;: &quot;https://wikasports.com/wp-content/uploads/2021/06/banner-giay-da-bong-1-2048x823.jpg&quot;
        },
        {
            &quot;id&quot;: 2,
            &quot;tieu_de&quot;: &quot;Banner Gi&agrave;y b&oacute;ng đ&aacute; Wika 2&quot;,
            &quot;hinh_anh&quot;: &quot;https://wikasports.com/wp-content/uploads/2021/06/banner-giay-da-bong-2-scaled.jpg&quot;,
            &quot;duong_dan&quot;: &quot;/danh-muc/giay-bong-da&quot;,
            &quot;thu_tu&quot;: 2,
            &quot;trang_thai&quot;: 1,
            &quot;created_at&quot;: &quot;2026-03-19T08:25:19.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-03-19T08:25:19.000000Z&quot;,
            &quot;url&quot;: &quot;https://wikasports.com/wp-content/uploads/2021/06/banner-giay-da-bong-2-scaled.jpg&quot;
        },
        {
            &quot;id&quot;: 3,
            &quot;tieu_de&quot;: &quot;Nguyễn Ho&agrave;ng Đức x Wika&quot;,
            &quot;hinh_anh&quot;: &quot;https://wikasports.com/wp-content/uploads/2023/02/nguyen-hoang-duc-banner.jpg&quot;,
            &quot;duong_dan&quot;: &quot;/danh-muc/ao-bong-da&quot;,
            &quot;thu_tu&quot;: 3,
            &quot;trang_thai&quot;: 1,
            &quot;created_at&quot;: &quot;2026-03-19T08:25:19.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-03-19T08:25:19.000000Z&quot;,
            &quot;url&quot;: &quot;https://wikasports.com/wp-content/uploads/2023/02/nguyen-hoang-duc-banner.jpg&quot;
        },
        {
            &quot;id&quot;: 4,
            &quot;tieu_de&quot;: &quot;Wika Hunter&quot;,
            &quot;hinh_anh&quot;: &quot;https://wikasports.com/wp-content/uploads/2022/02/banner-wika-hunter-1536x568.jpg&quot;,
            &quot;duong_dan&quot;: &quot;/danh-muc/giay-bong-da&quot;,
            &quot;thu_tu&quot;: 4,
            &quot;trang_thai&quot;: 1,
            &quot;created_at&quot;: &quot;2026-03-19T08:25:19.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-03-19T08:25:19.000000Z&quot;,
            &quot;url&quot;: &quot;https://wikasports.com/wp-content/uploads/2022/02/banner-wika-hunter-1536x568.jpg&quot;
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-banners" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-banners"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-banners"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-banners" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-banners">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-banners" data-method="GET"
      data-path="api/v1/banners"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-banners', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-banners"
                    onclick="tryItOut('GETapi-v1-banners');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-banners"
                    onclick="cancelTryOut('GETapi-v1-banners');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-banners"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/banners</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-banners"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-banners"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                                <h2 id="2-san-pham-danh-muc-khach-hang-danh-gia-san-pham">Đánh giá Sản phẩm</h2>
                                                    <h2 id="2-san-pham-danh-muc-khach-hang-POSTapi-v1-reviews">Gửi đánh giá</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Khách hàng gửi đánh giá cho sản phẩm đã mua. Đánh giá sẽ cần Admin duyệt trước khi hiển thị.</p>

<span id="example-requests-POSTapi-v1-reviews">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/v1/reviews" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"san_pham_id\": 1,
    \"don_hang_id\": 5,
    \"so_sao\": 5,
    \"tieu_de\": \"Sản phẩm rất tốt\",
    \"noi_dung\": \"Giày đi êm chân, đúng size.\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/reviews"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "san_pham_id": 1,
    "don_hang_id": 5,
    "so_sao": 5,
    "tieu_de": "Sản phẩm rất tốt",
    "noi_dung": "Giày đi êm chân, đúng size."
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-reviews">
</span>
<span id="execution-results-POSTapi-v1-reviews" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-reviews"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-reviews"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-reviews" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-reviews">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-reviews" data-method="POST"
      data-path="api/v1/reviews"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-reviews', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-reviews"
                    onclick="tryItOut('POSTapi-v1-reviews');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-reviews"
                    onclick="cancelTryOut('POSTapi-v1-reviews');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-reviews"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/reviews</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-reviews"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-reviews"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-reviews"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>san_pham_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="san_pham_id"                data-endpoint="POSTapi-v1-reviews"
               value="1"
               data-component="body">
    <br>
<p>ID sản phẩm được đánh giá. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>don_hang_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="don_hang_id"                data-endpoint="POSTapi-v1-reviews"
               value="5"
               data-component="body">
    <br>
<p>ID đơn hàng. Giúp xác thực người dùng đã thực sự mua hàng. Example: <code>5</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>so_sao</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="so_sao"                data-endpoint="POSTapi-v1-reviews"
               value="5"
               data-component="body">
    <br>
<p>Số điểm đánh giá (1-5 sao). Example: <code>5</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tieu_de</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="tieu_de"                data-endpoint="POSTapi-v1-reviews"
               value="Sản phẩm rất tốt"
               data-component="body">
    <br>
<p>Tiêu đề đánh giá. Example: <code>Sản phẩm rất tốt</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>noi_dung</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="noi_dung"                data-endpoint="POSTapi-v1-reviews"
               value="Giày đi êm chân, đúng size."
               data-component="body">
    <br>
<p>Nội dung đánh giá chi tiết. Example: <code>Giày đi êm chân, đúng size.</code></p>
        </div>
        </form>

                    <h2 id="2-san-pham-danh-muc-khach-hang-GETapi-v1-reviews--id-">Chi tiết đánh giá</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-reviews--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/reviews/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/reviews/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-reviews--id-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-reviews--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-reviews--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-reviews--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-reviews--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-reviews--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-reviews--id-" data-method="GET"
      data-path="api/v1/reviews/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-reviews--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-reviews--id-"
                    onclick="tryItOut('GETapi-v1-reviews--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-reviews--id-"
                    onclick="cancelTryOut('GETapi-v1-reviews--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-reviews--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/reviews/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-reviews--id-"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-reviews--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-reviews--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-v1-reviews--id-"
               value="1"
               data-component="url">
    <br>
<p>ID của đánh giá. Example: <code>1</code></p>
            </div>
                    </form>

                <h1 id="3-gio-hang-thanh-toan">3. Giỏ hàng & Thanh toán</h1>

    

                        <h2 id="3-gio-hang-thanh-toan-quan-ly-gio-hang-cho-phep-khach-hang-them-sua-xoa-san-pham-trong-gio-hang-ho-tro-ca-khach-vang-lai-luu-qua-header-x-session-id-va-nguoi-dung-da-dang-nhap-luu-qua-user-id">Quản lý Giỏ hàng

Cho phép khách hàng thêm, sửa, xóa sản phẩm trong giỏ hàng.
Hỗ trợ cả khách vãng lai (lưu qua Header `X-Session-ID`) và người dùng đã đăng nhập (lưu qua User ID).</h2>
                                                    <h2 id="3-gio-hang-thanh-toan-GETapi-v1-cart">Lấy thông tin giỏ hàng</h2>

<p>
</p>

<p>Lấy danh sách sản phẩm, tổng số lượng và số tiền tạm tính hiện có trong giỏ.</p>

<span id="example-requests-GETapi-v1-cart">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/cart" \
    --header "X-Session-ID: ID phiên làm việc (nếu người dùng chưa đăng nhập)" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/cart"
);

const headers = {
    "X-Session-ID": "ID phiên làm việc (nếu người dùng chưa đăng nhập)",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-cart">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-cart" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-cart"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-cart"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-cart" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-cart">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-cart" data-method="GET"
      data-path="api/v1/cart"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-cart', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-cart"
                    onclick="tryItOut('GETapi-v1-cart');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-cart"
                    onclick="cancelTryOut('GETapi-v1-cart');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-cart"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/cart</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>X-Session-ID</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="X-Session-ID"                data-endpoint="GETapi-v1-cart"
               value="ID phiên làm việc (nếu người dùng chưa đăng nhập)"
               data-component="header">
    <br>
<p>Example: <code>ID phiên làm việc (nếu người dùng chưa đăng nhập)</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-cart"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-cart"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="3-gio-hang-thanh-toan-POSTapi-v1-cart-items">Thêm sản phẩm vào giỏ</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-cart-items">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/v1/cart/items" \
    --header "X-Session-ID: ID phiên làm việc (nếu người dùng chưa đăng nhập)" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"san_pham_id\": 1,
    \"bien_the_id\": null,
    \"so_luong\": 1
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/cart/items"
);

const headers = {
    "X-Session-ID": "ID phiên làm việc (nếu người dùng chưa đăng nhập)",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "san_pham_id": 1,
    "bien_the_id": null,
    "so_luong": 1
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-cart-items">
</span>
<span id="execution-results-POSTapi-v1-cart-items" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-cart-items"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-cart-items"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-cart-items" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-cart-items">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-cart-items" data-method="POST"
      data-path="api/v1/cart/items"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-cart-items', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-cart-items"
                    onclick="tryItOut('POSTapi-v1-cart-items');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-cart-items"
                    onclick="cancelTryOut('POSTapi-v1-cart-items');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-cart-items"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/cart/items</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>X-Session-ID</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="X-Session-ID"                data-endpoint="POSTapi-v1-cart-items"
               value="ID phiên làm việc (nếu người dùng chưa đăng nhập)"
               data-component="header">
    <br>
<p>Example: <code>ID phiên làm việc (nếu người dùng chưa đăng nhập)</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-cart-items"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-cart-items"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>san_pham_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="san_pham_id"                data-endpoint="POSTapi-v1-cart-items"
               value="1"
               data-component="body">
    <br>
<p>ID của sản phẩm muốn thêm. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>bien_the_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="bien_the_id"                data-endpoint="POSTapi-v1-cart-items"
               value=""
               data-component="body">
    <br>
<p>ID của biến thể (kích thước, màu sắc). Null nếu sản phẩm không có biến thể.</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>so_luong</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="so_luong"                data-endpoint="POSTapi-v1-cart-items"
               value="1"
               data-component="body">
    <br>
<p>Số lượng muốn thêm (1-99). Example: <code>1</code></p>
        </div>
        </form>

                    <h2 id="3-gio-hang-thanh-toan-PUTapi-v1-cart-items--id-">Cập nhật số lượng sản phẩm</h2>

<p>
</p>



<span id="example-requests-PUTapi-v1-cart-items--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost:8000/api/v1/cart/items/16" \
    --header "X-Session-ID: ID phiên làm việc (nếu người dùng chưa đăng nhập)" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"so_luong\": 2
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/cart/items/16"
);

const headers = {
    "X-Session-ID": "ID phiên làm việc (nếu người dùng chưa đăng nhập)",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "so_luong": 2
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-v1-cart-items--id-">
</span>
<span id="execution-results-PUTapi-v1-cart-items--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-cart-items--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-cart-items--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-cart-items--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-cart-items--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v1-cart-items--id-" data-method="PUT"
      data-path="api/v1/cart/items/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-cart-items--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-cart-items--id-"
                    onclick="tryItOut('PUTapi-v1-cart-items--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-cart-items--id-"
                    onclick="cancelTryOut('PUTapi-v1-cart-items--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-cart-items--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/cart/items/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>X-Session-ID</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="X-Session-ID"                data-endpoint="PUTapi-v1-cart-items--id-"
               value="ID phiên làm việc (nếu người dùng chưa đăng nhập)"
               data-component="header">
    <br>
<p>Example: <code>ID phiên làm việc (nếu người dùng chưa đăng nhập)</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v1-cart-items--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-v1-cart-items--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-v1-cart-items--id-"
               value="16"
               data-component="url">
    <br>
<p>ID của item trong giỏ hàng (không phải san_pham_id) Example: <code>16</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>so_luong</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="so_luong"                data-endpoint="PUTapi-v1-cart-items--id-"
               value="2"
               data-component="body">
    <br>
<p>Số lượng mới muốn cập nhật (1-99). Example: <code>2</code></p>
        </div>
        </form>

                    <h2 id="3-gio-hang-thanh-toan-DELETEapi-v1-cart-items--id-">Xóa sản phẩm khỏi giỏ</h2>

<p>
</p>



<span id="example-requests-DELETEapi-v1-cart-items--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost:8000/api/v1/cart/items/16" \
    --header "X-Session-ID: ID phiên làm việc (nếu người dùng chưa đăng nhập)" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/cart/items/16"
);

const headers = {
    "X-Session-ID": "ID phiên làm việc (nếu người dùng chưa đăng nhập)",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-cart-items--id-">
</span>
<span id="execution-results-DELETEapi-v1-cart-items--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-cart-items--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-cart-items--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-cart-items--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-cart-items--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-cart-items--id-" data-method="DELETE"
      data-path="api/v1/cart/items/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-cart-items--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-cart-items--id-"
                    onclick="tryItOut('DELETEapi-v1-cart-items--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-cart-items--id-"
                    onclick="cancelTryOut('DELETEapi-v1-cart-items--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-cart-items--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/cart/items/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>X-Session-ID</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="X-Session-ID"                data-endpoint="DELETEapi-v1-cart-items--id-"
               value="ID phiên làm việc (nếu người dùng chưa đăng nhập)"
               data-component="header">
    <br>
<p>Example: <code>ID phiên làm việc (nếu người dùng chưa đăng nhập)</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-v1-cart-items--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-v1-cart-items--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-v1-cart-items--id-"
               value="16"
               data-component="url">
    <br>
<p>ID của item trong giỏ hàng (không phải san_pham_id) Example: <code>16</code></p>
            </div>
                    </form>

                    <h2 id="3-gio-hang-thanh-toan-DELETEapi-v1-cart">Xóa toàn bộ giỏ hàng</h2>

<p>
</p>

<p>Dùng khi người dùng muốn dọn dẹp giỏ hoặc sau khi đặt hàng thành công.</p>

<span id="example-requests-DELETEapi-v1-cart">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost:8000/api/v1/cart" \
    --header "X-Session-ID: ID phiên làm việc (nếu người dùng chưa đăng nhập)" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/cart"
);

const headers = {
    "X-Session-ID": "ID phiên làm việc (nếu người dùng chưa đăng nhập)",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-cart">
</span>
<span id="execution-results-DELETEapi-v1-cart" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-cart"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-cart"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-cart" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-cart">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-cart" data-method="DELETE"
      data-path="api/v1/cart"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-cart', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-cart"
                    onclick="tryItOut('DELETEapi-v1-cart');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-cart"
                    onclick="cancelTryOut('DELETEapi-v1-cart');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-cart"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/cart</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>X-Session-ID</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="X-Session-ID"                data-endpoint="DELETEapi-v1-cart"
               value="ID phiên làm việc (nếu người dùng chưa đăng nhập)"
               data-component="header">
    <br>
<p>Example: <code>ID phiên làm việc (nếu người dùng chưa đăng nhập)</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-v1-cart"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-v1-cart"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="3-gio-hang-thanh-toan-POSTapi-v1-cart-merge">Hợp nhất giỏ hàng Guest vào tài khoản sau khi đăng nhập.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Khi user đăng nhập, client gửi danh sách sản phẩm đã thêm khi còn là guest.
Backend sẽ merge vào giỏ hàng hiện có của user (tăng số lượng nếu trùng).</p>

<span id="example-requests-POSTapi-v1-cart-merge">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/v1/cart/merge" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"items\": [
        \"architecto\"
    ]
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/cart/merge"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "items": [
        "architecto"
    ]
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-cart-merge">
</span>
<span id="execution-results-POSTapi-v1-cart-merge" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-cart-merge"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-cart-merge"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-cart-merge" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-cart-merge">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-cart-merge" data-method="POST"
      data-path="api/v1/cart/merge"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-cart-merge', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-cart-merge"
                    onclick="tryItOut('POSTapi-v1-cart-merge');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-cart-merge"
                    onclick="cancelTryOut('POSTapi-v1-cart-merge');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-cart-merge"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/cart/merge</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-cart-merge"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-cart-merge"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-cart-merge"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
        <details>
            <summary style="padding-bottom: 10px;">
                <b style="line-height: 2;"><code>items</code></b>&nbsp;&nbsp;
<small>string[]</small>&nbsp;
 &nbsp;
 &nbsp;
<br>
<p>Danh sách sản phẩm từ giỏ hàng guest.</p>
            </summary>
                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>san_pham_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="items.0.san_pham_id"                data-endpoint="POSTapi-v1-cart-merge"
               value="1"
               data-component="body">
    <br>
<p>ID sản phẩm. Example: <code>1</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>bien_the_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="items.0.bien_the_id"                data-endpoint="POSTapi-v1-cart-merge"
               value=""
               data-component="body">
    <br>
<p>ID biến thể.</p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>so_luong</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="items.0.so_luong"                data-endpoint="POSTapi-v1-cart-merge"
               value="2"
               data-component="body">
    <br>
<p>Số lượng. Example: <code>2</code></p>
                    </div>
                                    </details>
        </div>
        </form>

                                <h2 id="3-gio-hang-thanh-toan-ma-giam-gia">Mã giảm giá</h2>
                                                    <h2 id="3-gio-hang-thanh-toan-POSTapi-v1-coupons-validate">Kiểm tra mã giảm giá</h2>

<p>
</p>

<p>Xác thực mã giảm giá do người dùng nhập trước khi áp dụng vào đơn hàng.
Trả về số tiền được giảm nếu mã hợp lệ.</p>

<span id="example-requests-POSTapi-v1-coupons-validate">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/v1/coupons/validate" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"ma_code\": \"SALE2025\",
    \"tam_tinh\": \"500000\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/coupons/validate"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "ma_code": "SALE2025",
    "tam_tinh": "500000"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-coupons-validate">
</span>
<span id="execution-results-POSTapi-v1-coupons-validate" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-coupons-validate"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-coupons-validate"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-coupons-validate" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-coupons-validate">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-coupons-validate" data-method="POST"
      data-path="api/v1/coupons/validate"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-coupons-validate', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-coupons-validate"
                    onclick="tryItOut('POSTapi-v1-coupons-validate');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-coupons-validate"
                    onclick="cancelTryOut('POSTapi-v1-coupons-validate');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-coupons-validate"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/coupons/validate</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-coupons-validate"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-coupons-validate"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>ma_code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="ma_code"                data-endpoint="POSTapi-v1-coupons-validate"
               value="SALE2025"
               data-component="body">
    <br>
<p>Mã giảm giá người dùng nhập. Example: <code>SALE2025</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tam_tinh</code></b>&nbsp;&nbsp;
<small>numeric</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="tam_tinh"                data-endpoint="POSTapi-v1-coupons-validate"
               value="500000"
               data-component="body">
    <br>
<p>Tổng tiền tạm tính của giỏ hàng. Example: <code>500000</code></p>
        </div>
        </form>

                                <h2 id="3-gio-hang-thanh-toan-thanh-toan-lich-su-don-hang-cho-phep-khach-hang-xem-lich-su-mua-hang-chi-tiet-don-va-thuc-hien-dat-hang-checkout">Thanh toán &amp; Lịch sử đơn hàng

Cho phép khách hàng xem lịch sử mua hàng, chi tiết đơn và thực hiện đặt hàng (Checkout).</h2>
                                                    <h2 id="3-gio-hang-thanh-toan-GETapi-v1-orders">Danh sách Đơn hàng</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Lấy danh sách lịch sử đơn hàng của người dùng đang đăng nhập. Có phân trang.</p>

<span id="example-requests-GETapi-v1-orders">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/orders" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/orders"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-orders">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-orders" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-orders"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-orders"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-orders" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-orders">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-orders" data-method="GET"
      data-path="api/v1/orders"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-orders', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-orders"
                    onclick="tryItOut('GETapi-v1-orders');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-orders"
                    onclick="cancelTryOut('GETapi-v1-orders');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-orders"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/orders</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-orders"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-orders"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-orders"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="3-gio-hang-thanh-toan-POSTapi-v1-orders">Đặt hàng (Checkout)</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Tạo đơn hàng mới từ các mặt hàng đang có trong Giỏ. Sau khi thanh toán thành công, giỏ hàng sẽ bị xóa.</p>

<span id="example-requests-POSTapi-v1-orders">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/v1/orders" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"dia_chi_id\": 2,
    \"phuong_thuc_tt\": \"cod\",
    \"ma_coupon\": \"SALE2025\",
    \"ghi_chu\": \"Giao vào giờ hành chính\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/orders"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "dia_chi_id": 2,
    "phuong_thuc_tt": "cod",
    "ma_coupon": "SALE2025",
    "ghi_chu": "Giao vào giờ hành chính"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-orders">
</span>
<span id="execution-results-POSTapi-v1-orders" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-orders"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-orders"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-orders" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-orders">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-orders" data-method="POST"
      data-path="api/v1/orders"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-orders', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-orders"
                    onclick="tryItOut('POSTapi-v1-orders');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-orders"
                    onclick="cancelTryOut('POSTapi-v1-orders');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-orders"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/orders</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-orders"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-orders"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-orders"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>dia_chi_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="dia_chi_id"                data-endpoint="POSTapi-v1-orders"
               value="2"
               data-component="body">
    <br>
<p>ID địa chỉ giao hàng của người dùng. Example: <code>2</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>phuong_thuc_tt</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="phuong_thuc_tt"                data-endpoint="POSTapi-v1-orders"
               value="cod"
               data-component="body">
    <br>
<p>Phương thức thanh toán (cod, chuyen_khoan, vnpay, momo). Example: <code>cod</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>ma_coupon</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="ma_coupon"                data-endpoint="POSTapi-v1-orders"
               value="SALE2025"
               data-component="body">
    <br>
<p>Mã giảm giá (nếu có áp dụng). Example: <code>SALE2025</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>ghi_chu</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="ghi_chu"                data-endpoint="POSTapi-v1-orders"
               value="Giao vào giờ hành chính"
               data-component="body">
    <br>
<p>Ghi chú thêm cho đơn hàng. Example: <code>Giao vào giờ hành chính</code></p>
        </div>
        </form>

                    <h2 id="3-gio-hang-thanh-toan-GETapi-v1-orders--code-">Chi tiết đơn hàng</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Xem chi tiết một đơn hàng thông qua Mã đơn hàng.</p>

<span id="example-requests-GETapi-v1-orders--code-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/orders/DH202503050001" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/orders/DH202503050001"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-orders--code-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-orders--code-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-orders--code-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-orders--code-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-orders--code-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-orders--code-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-orders--code-" data-method="GET"
      data-path="api/v1/orders/{code}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-orders--code-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-orders--code-"
                    onclick="tryItOut('GETapi-v1-orders--code-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-orders--code-"
                    onclick="cancelTryOut('GETapi-v1-orders--code-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-orders--code-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/orders/{code}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-orders--code-"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-orders--code-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-orders--code-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="code"                data-endpoint="GETapi-v1-orders--code-"
               value="DH202503050001"
               data-component="url">
    <br>
<p>Mã đơn hàng (VD: DH202503...). Example: <code>DH202503050001</code></p>
            </div>
                    </form>

                <h1 id="4-thong-tin-ca-nhan-dia-chi">4. Thông tin cá nhân & Địa chỉ</h1>

    

                        <h2 id="4-thong-tin-ca-nhan-dia-chi-so-dia-chi-quan-ly-so-dia-chi-giao-hang-cua-nguoi-dung">Sổ địa chỉ

Quản lý sổ địa chỉ giao hàng của người dùng.</h2>
                                                    <h2 id="4-thong-tin-ca-nhan-dia-chi-GETapi-v1-addresses">Danh sách địa chỉ</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-addresses">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/addresses" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/addresses"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-addresses">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-addresses" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-addresses"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-addresses"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-addresses" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-addresses">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-addresses" data-method="GET"
      data-path="api/v1/addresses"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-addresses', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-addresses"
                    onclick="tryItOut('GETapi-v1-addresses');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-addresses"
                    onclick="cancelTryOut('GETapi-v1-addresses');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-addresses"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/addresses</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-addresses"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-addresses"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-addresses"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="4-thong-tin-ca-nhan-dia-chi-POSTapi-v1-addresses">Thêm địa chỉ mới</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-addresses">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/v1/addresses" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"ho_va_ten\": \"Nguyễn Văn B\",
    \"so_dien_thoai\": \"0988777666\",
    \"tinh_thanh\": \"Hà Nội\",
    \"quan_huyen\": \"Cầu Giấy\",
    \"phuong_xa\": \"Dịch Vọng\",
    \"dia_chi_cu_the\": \"123 Xuân Thủy\",
    \"la_mac_dinh\": true
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/addresses"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "ho_va_ten": "Nguyễn Văn B",
    "so_dien_thoai": "0988777666",
    "tinh_thanh": "Hà Nội",
    "quan_huyen": "Cầu Giấy",
    "phuong_xa": "Dịch Vọng",
    "dia_chi_cu_the": "123 Xuân Thủy",
    "la_mac_dinh": true
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-addresses">
</span>
<span id="execution-results-POSTapi-v1-addresses" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-addresses"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-addresses"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-addresses" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-addresses">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-addresses" data-method="POST"
      data-path="api/v1/addresses"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-addresses', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-addresses"
                    onclick="tryItOut('POSTapi-v1-addresses');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-addresses"
                    onclick="cancelTryOut('POSTapi-v1-addresses');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-addresses"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/addresses</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-addresses"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-addresses"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-addresses"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>ho_va_ten</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="ho_va_ten"                data-endpoint="POSTapi-v1-addresses"
               value="Nguyễn Văn B"
               data-component="body">
    <br>
<p>Họ và tên người nhận. Example: <code>Nguyễn Văn B</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>so_dien_thoai</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="so_dien_thoai"                data-endpoint="POSTapi-v1-addresses"
               value="0988777666"
               data-component="body">
    <br>
<p>Số điện thoại nhận hàng. Example: <code>0988777666</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tinh_thanh</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="tinh_thanh"                data-endpoint="POSTapi-v1-addresses"
               value="Hà Nội"
               data-component="body">
    <br>
<p>Tỉnh/Thành phố. Example: <code>Hà Nội</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>quan_huyen</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="quan_huyen"                data-endpoint="POSTapi-v1-addresses"
               value="Cầu Giấy"
               data-component="body">
    <br>
<p>Quận/Huyện. Example: <code>Cầu Giấy</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>phuong_xa</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="phuong_xa"                data-endpoint="POSTapi-v1-addresses"
               value="Dịch Vọng"
               data-component="body">
    <br>
<p>Phường/Xã. Example: <code>Dịch Vọng</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>dia_chi_cu_the</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="dia_chi_cu_the"                data-endpoint="POSTapi-v1-addresses"
               value="123 Xuân Thủy"
               data-component="body">
    <br>
<p>Số nhà, đường. Example: <code>123 Xuân Thủy</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>la_mac_dinh</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="POSTapi-v1-addresses" style="display: none">
            <input type="radio" name="la_mac_dinh"
                   value="true"
                   data-endpoint="POSTapi-v1-addresses"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-v1-addresses" style="display: none">
            <input type="radio" name="la_mac_dinh"
                   value="false"
                   data-endpoint="POSTapi-v1-addresses"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Đặt làm địa chỉ mặc định (true/false). Example: <code>true</code></p>
        </div>
        </form>

                    <h2 id="4-thong-tin-ca-nhan-dia-chi-GETapi-v1-addresses--id-">Lấy chi tiết một địa chỉ</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-addresses--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/addresses/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/addresses/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-addresses--id-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-addresses--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-addresses--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-addresses--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-addresses--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-addresses--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-addresses--id-" data-method="GET"
      data-path="api/v1/addresses/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-addresses--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-addresses--id-"
                    onclick="tryItOut('GETapi-v1-addresses--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-addresses--id-"
                    onclick="cancelTryOut('GETapi-v1-addresses--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-addresses--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/addresses/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-addresses--id-"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-addresses--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-addresses--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-v1-addresses--id-"
               value="1"
               data-component="url">
    <br>
<p>ID của địa chỉ. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="4-thong-tin-ca-nhan-dia-chi-PUTapi-v1-addresses--id-">Cập nhật địa chỉ</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTapi-v1-addresses--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost:8000/api/v1/addresses/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"ho_va_ten\": \"Nguyễn Văn B\",
    \"so_dien_thoai\": \"0988777666\",
    \"tinh_thanh\": \"Hồ Chí Minh\",
    \"quan_huyen\": \"Quận 1\",
    \"phuong_xa\": \"Bến Nghé\",
    \"dia_chi_cu_the\": \"Tòa nhà Bitexco\",
    \"la_mac_dinh\": true
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/addresses/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "ho_va_ten": "Nguyễn Văn B",
    "so_dien_thoai": "0988777666",
    "tinh_thanh": "Hồ Chí Minh",
    "quan_huyen": "Quận 1",
    "phuong_xa": "Bến Nghé",
    "dia_chi_cu_the": "Tòa nhà Bitexco",
    "la_mac_dinh": true
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-v1-addresses--id-">
</span>
<span id="execution-results-PUTapi-v1-addresses--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-addresses--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-addresses--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-addresses--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-addresses--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v1-addresses--id-" data-method="PUT"
      data-path="api/v1/addresses/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-addresses--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-addresses--id-"
                    onclick="tryItOut('PUTapi-v1-addresses--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-addresses--id-"
                    onclick="cancelTryOut('PUTapi-v1-addresses--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-addresses--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/addresses/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/v1/addresses/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-v1-addresses--id-"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v1-addresses--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-v1-addresses--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-v1-addresses--id-"
               value="1"
               data-component="url">
    <br>
<p>ID của địa chỉ cần sửa. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>ho_va_ten</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="ho_va_ten"                data-endpoint="PUTapi-v1-addresses--id-"
               value="Nguyễn Văn B"
               data-component="body">
    <br>
<p>Họ và tên người nhận. Example: <code>Nguyễn Văn B</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>so_dien_thoai</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="so_dien_thoai"                data-endpoint="PUTapi-v1-addresses--id-"
               value="0988777666"
               data-component="body">
    <br>
<p>Số điện thoại nhận hàng. Example: <code>0988777666</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tinh_thanh</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="tinh_thanh"                data-endpoint="PUTapi-v1-addresses--id-"
               value="Hồ Chí Minh"
               data-component="body">
    <br>
<p>Tỉnh/Thành phố. Example: <code>Hồ Chí Minh</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>quan_huyen</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="quan_huyen"                data-endpoint="PUTapi-v1-addresses--id-"
               value="Quận 1"
               data-component="body">
    <br>
<p>Quận/Huyện. Example: <code>Quận 1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>phuong_xa</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="phuong_xa"                data-endpoint="PUTapi-v1-addresses--id-"
               value="Bến Nghé"
               data-component="body">
    <br>
<p>Phường/Xã. Example: <code>Bến Nghé</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>dia_chi_cu_the</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="dia_chi_cu_the"                data-endpoint="PUTapi-v1-addresses--id-"
               value="Tòa nhà Bitexco"
               data-component="body">
    <br>
<p>Số nhà, đường. Example: <code>Tòa nhà Bitexco</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>la_mac_dinh</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="PUTapi-v1-addresses--id-" style="display: none">
            <input type="radio" name="la_mac_dinh"
                   value="true"
                   data-endpoint="PUTapi-v1-addresses--id-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-v1-addresses--id-" style="display: none">
            <input type="radio" name="la_mac_dinh"
                   value="false"
                   data-endpoint="PUTapi-v1-addresses--id-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Đặt làm địa chỉ mặc định (true/false). Example: <code>true</code></p>
        </div>
        </form>

                    <h2 id="4-thong-tin-ca-nhan-dia-chi-DELETEapi-v1-addresses--id-">Xóa địa chỉ</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-v1-addresses--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost:8000/api/v1/addresses/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/addresses/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-addresses--id-">
</span>
<span id="execution-results-DELETEapi-v1-addresses--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-addresses--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-addresses--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-addresses--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-addresses--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-addresses--id-" data-method="DELETE"
      data-path="api/v1/addresses/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-addresses--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-addresses--id-"
                    onclick="tryItOut('DELETEapi-v1-addresses--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-addresses--id-"
                    onclick="cancelTryOut('DELETEapi-v1-addresses--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-addresses--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/addresses/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-v1-addresses--id-"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-v1-addresses--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-v1-addresses--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-v1-addresses--id-"
               value="1"
               data-component="url">
    <br>
<p>ID của địa chỉ cần xóa. Example: <code>1</code></p>
            </div>
                    </form>

                                <h2 id="4-thong-tin-ca-nhan-dia-chi-yeu-thich">Yêu thích</h2>
                                                    <h2 id="4-thong-tin-ca-nhan-dia-chi-GETapi-v1-wishlist">Danh sách sản phẩm yêu thích</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-wishlist">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/wishlist" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/wishlist"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-wishlist">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-wishlist" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-wishlist"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-wishlist"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-wishlist" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-wishlist">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-wishlist" data-method="GET"
      data-path="api/v1/wishlist"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-wishlist', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-wishlist"
                    onclick="tryItOut('GETapi-v1-wishlist');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-wishlist"
                    onclick="cancelTryOut('GETapi-v1-wishlist');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-wishlist"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/wishlist</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-wishlist"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-wishlist"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-wishlist"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="4-thong-tin-ca-nhan-dia-chi-POSTapi-v1-wishlist--productId-">Thêm/Xóa yêu thích</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Tự động thêm sản phẩm vào danh sách yêu thích nếu chưa có, hoặc xóa khỏi danh sách nếu đã tồn tại.</p>

<span id="example-requests-POSTapi-v1-wishlist--productId-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/v1/wishlist/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/wishlist/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-wishlist--productId-">
</span>
<span id="execution-results-POSTapi-v1-wishlist--productId-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-wishlist--productId-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-wishlist--productId-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-wishlist--productId-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-wishlist--productId-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-wishlist--productId-" data-method="POST"
      data-path="api/v1/wishlist/{productId}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-wishlist--productId-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-wishlist--productId-"
                    onclick="tryItOut('POSTapi-v1-wishlist--productId-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-wishlist--productId-"
                    onclick="cancelTryOut('POSTapi-v1-wishlist--productId-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-wishlist--productId-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/wishlist/{productId}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-wishlist--productId-"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-wishlist--productId-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-wishlist--productId-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>productId</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="productId"                data-endpoint="POSTapi-v1-wishlist--productId-"
               value="1"
               data-component="url">
    <br>
<p>ID sản phẩm. Example: <code>1</code></p>
            </div>
                    </form>

                                <h2 id="4-thong-tin-ca-nhan-dia-chi-quan-ly-thong-bao-kiem-tra-cac-thong-bao-don-hang-khuyen-mai-he-thong-danh-rieng-cho-nguoi-dung">Quản lý Thông báo

Kiểm tra các thông báo (đơn hàng, khuyến mãi, hệ thống...) dành riêng cho người dùng.</h2>
                                                    <h2 id="4-thong-tin-ca-nhan-dia-chi-GETapi-v1-notifications">Lấy danh sách thông báo</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-notifications">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/notifications" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/notifications"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-notifications">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-notifications" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-notifications"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-notifications"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-notifications" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-notifications">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-notifications" data-method="GET"
      data-path="api/v1/notifications"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-notifications', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-notifications"
                    onclick="tryItOut('GETapi-v1-notifications');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-notifications"
                    onclick="cancelTryOut('GETapi-v1-notifications');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-notifications"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/notifications</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-notifications"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-notifications"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-notifications"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="4-thong-tin-ca-nhan-dia-chi-PUTapi-v1-notifications--id--read">Đánh dấu 1 thông báo là đã đọc</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTapi-v1-notifications--id--read">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost:8000/api/v1/notifications/1/read" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/notifications/1/read"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "PUT",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-v1-notifications--id--read">
</span>
<span id="execution-results-PUTapi-v1-notifications--id--read" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-notifications--id--read"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-notifications--id--read"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-notifications--id--read" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-notifications--id--read">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v1-notifications--id--read" data-method="PUT"
      data-path="api/v1/notifications/{id}/read"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-notifications--id--read', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-notifications--id--read"
                    onclick="tryItOut('PUTapi-v1-notifications--id--read');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-notifications--id--read"
                    onclick="cancelTryOut('PUTapi-v1-notifications--id--read');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-notifications--id--read"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/notifications/{id}/read</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-v1-notifications--id--read"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v1-notifications--id--read"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-v1-notifications--id--read"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-v1-notifications--id--read"
               value="1"
               data-component="url">
    <br>
<p>ID thông báo. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="4-thong-tin-ca-nhan-dia-chi-PUTapi-v1-notifications-read-all">Đánh dấu toàn bộ là đã đọc</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTapi-v1-notifications-read-all">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost:8000/api/v1/notifications/read-all" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/notifications/read-all"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "PUT",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-v1-notifications-read-all">
</span>
<span id="execution-results-PUTapi-v1-notifications-read-all" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-notifications-read-all"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-notifications-read-all"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-notifications-read-all" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-notifications-read-all">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v1-notifications-read-all" data-method="PUT"
      data-path="api/v1/notifications/read-all"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-notifications-read-all', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-notifications-read-all"
                    onclick="tryItOut('PUTapi-v1-notifications-read-all');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-notifications-read-all"
                    onclick="cancelTryOut('PUTapi-v1-notifications-read-all');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-notifications-read-all"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/notifications/read-all</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-v1-notifications-read-all"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v1-notifications-read-all"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-v1-notifications-read-all"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                <h1 id="6-quan-tri-vien-admin">6. Quản trị viên (Admin)</h1>

    

                        <h2 id="6-quan-tri-vien-admin-quan-ly-san-pham">Quản lý Sản phẩm</h2>
                                                    <h2 id="6-quan-tri-vien-admin-GETapi-v1-admin-products">Danh sách sản phẩm (Admin)</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Lấy toàn bộ danh sách sản phẩm phục vụ trang quản trị.</p>

<span id="example-requests-GETapi-v1-admin-products">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/admin/products" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/products"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-products">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-admin-products" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-products"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-products"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-products" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-products">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-products" data-method="GET"
      data-path="api/v1/admin/products"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-products', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-products"
                    onclick="tryItOut('GETapi-v1-admin-products');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-products"
                    onclick="cancelTryOut('GETapi-v1-admin-products');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-products"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/products</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-admin-products"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-admin-products"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-admin-products"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="6-quan-tri-vien-admin-POSTapi-v1-admin-products">Tạo sản phẩm mới</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-admin-products">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/v1/admin/products" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"ten_san_pham\": \"Áo khoác thể thao\",
    \"danh_muc_id\": 1,
    \"thuong_hieu_id\": 2,
    \"gia_goc\": \"500000\",
    \"gia_khuyen_mai\": \"450000\",
    \"mo_ta_ngan\": \"Áo khoác dù chống nước\",
    \"mo_ta_day_du\": \"&lt;p&gt;Chi tiết...&lt;\\/p&gt;\",
    \"trang_thai\": true,
    \"noi_bat\": false,
    \"ma_sku\": \"p\",
    \"bien_the\": [
        {
            \"kich_co\": \"architecto\",
            \"mau_sac\": \"architecto\",
            \"gia_rieng\": 39,
            \"ton_kho\": 84
        }
    ],
    \"hinh_anh\": [
        {
            \"duong_dan_anh\": \"architecto\",
            \"la_anh_chinh\": false,
            \"thu_tu\": 16
        }
    ]
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/products"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "ten_san_pham": "Áo khoác thể thao",
    "danh_muc_id": 1,
    "thuong_hieu_id": 2,
    "gia_goc": "500000",
    "gia_khuyen_mai": "450000",
    "mo_ta_ngan": "Áo khoác dù chống nước",
    "mo_ta_day_du": "&lt;p&gt;Chi tiết...&lt;\/p&gt;",
    "trang_thai": true,
    "noi_bat": false,
    "ma_sku": "p",
    "bien_the": [
        {
            "kich_co": "architecto",
            "mau_sac": "architecto",
            "gia_rieng": 39,
            "ton_kho": 84
        }
    ],
    "hinh_anh": [
        {
            "duong_dan_anh": "architecto",
            "la_anh_chinh": false,
            "thu_tu": 16
        }
    ]
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-admin-products">
</span>
<span id="execution-results-POSTapi-v1-admin-products" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-admin-products"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-admin-products"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-admin-products" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-admin-products">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-admin-products" data-method="POST"
      data-path="api/v1/admin/products"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-admin-products', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-admin-products"
                    onclick="tryItOut('POSTapi-v1-admin-products');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-admin-products"
                    onclick="cancelTryOut('POSTapi-v1-admin-products');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-admin-products"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/admin/products</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-admin-products"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-admin-products"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-admin-products"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>ten_san_pham</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="ten_san_pham"                data-endpoint="POSTapi-v1-admin-products"
               value="Áo khoác thể thao"
               data-component="body">
    <br>
<p>Tên sản phẩm. Example: <code>Áo khoác thể thao</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>danh_muc_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="danh_muc_id"                data-endpoint="POSTapi-v1-admin-products"
               value="1"
               data-component="body">
    <br>
<p>ID danh mục. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>thuong_hieu_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="thuong_hieu_id"                data-endpoint="POSTapi-v1-admin-products"
               value="2"
               data-component="body">
    <br>
<p>ID thương hiệu (nếu có). Example: <code>2</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>gia_goc</code></b>&nbsp;&nbsp;
<small>numeric</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="gia_goc"                data-endpoint="POSTapi-v1-admin-products"
               value="500000"
               data-component="body">
    <br>
<p>Giá nhập / Giá niêm yết. Example: <code>500000</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>gia_khuyen_mai</code></b>&nbsp;&nbsp;
<small>numeric</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="gia_khuyen_mai"                data-endpoint="POSTapi-v1-admin-products"
               value="450000"
               data-component="body">
    <br>
<p>Giá bán thực tế sau giảm. Example: <code>450000</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>mo_ta_ngan</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="mo_ta_ngan"                data-endpoint="POSTapi-v1-admin-products"
               value="Áo khoác dù chống nước"
               data-component="body">
    <br>
<p>Mô tả ngắn. Example: <code>Áo khoác dù chống nước</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>mo_ta_day_du</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="mo_ta_day_du"                data-endpoint="POSTapi-v1-admin-products"
               value="<p>Chi tiết...</p>"
               data-component="body">
    <br>
<p>Mô tả chi tiết (HTML). Example: <code>&lt;p&gt;Chi tiết...&lt;/p&gt;</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>trang_thai</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="POSTapi-v1-admin-products" style="display: none">
            <input type="radio" name="trang_thai"
                   value="true"
                   data-endpoint="POSTapi-v1-admin-products"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-v1-admin-products" style="display: none">
            <input type="radio" name="trang_thai"
                   value="false"
                   data-endpoint="POSTapi-v1-admin-products"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Có đang mở bán hay không. Example: <code>true</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>noi_bat</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="POSTapi-v1-admin-products" style="display: none">
            <input type="radio" name="noi_bat"
                   value="true"
                   data-endpoint="POSTapi-v1-admin-products"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-v1-admin-products" style="display: none">
            <input type="radio" name="noi_bat"
                   value="false"
                   data-endpoint="POSTapi-v1-admin-products"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Có đưa lên danh sách nổi bật không. Example: <code>false</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>ma_sku</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="ma_sku"                data-endpoint="POSTapi-v1-admin-products"
               value="p"
               data-component="body">
    <br>
<p>Must not be greater than 100 characters. Example: <code>p</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
        <details>
            <summary style="padding-bottom: 10px;">
                <b style="line-height: 2;"><code>bien_the</code></b>&nbsp;&nbsp;
<small>object[]</small>&nbsp;
 &nbsp;
 &nbsp;
<br>
<p>Biến thể. Must have at least 1 items.</p>
            </summary>
                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>kich_co</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="bien_the.0.kich_co"                data-endpoint="POSTapi-v1-admin-products"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>mau_sac</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="bien_the.0.mau_sac"                data-endpoint="POSTapi-v1-admin-products"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>gia_rieng</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="bien_the.0.gia_rieng"                data-endpoint="POSTapi-v1-admin-products"
               value="39"
               data-component="body">
    <br>
<p>Must be at least 0. Example: <code>39</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>ton_kho</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="bien_the.0.ton_kho"                data-endpoint="POSTapi-v1-admin-products"
               value="84"
               data-component="body">
    <br>
<p>Must be at least 0. Example: <code>84</code></p>
                    </div>
                                    </details>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
        <details>
            <summary style="padding-bottom: 10px;">
                <b style="line-height: 2;"><code>hinh_anh</code></b>&nbsp;&nbsp;
<small>object[]</small>&nbsp;
 &nbsp;
 &nbsp;
<br>
<p>Hình ảnh. Must have at least 1 items.</p>
            </summary>
                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>duong_dan_anh</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="hinh_anh.0.duong_dan_anh"                data-endpoint="POSTapi-v1-admin-products"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>la_anh_chinh</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="POSTapi-v1-admin-products" style="display: none">
            <input type="radio" name="hinh_anh.0.la_anh_chinh"
                   value="true"
                   data-endpoint="POSTapi-v1-admin-products"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-v1-admin-products" style="display: none">
            <input type="radio" name="hinh_anh.0.la_anh_chinh"
                   value="false"
                   data-endpoint="POSTapi-v1-admin-products"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>false</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>thu_tu</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="hinh_anh.0.thu_tu"                data-endpoint="POSTapi-v1-admin-products"
               value="16"
               data-component="body">
    <br>
<p>Example: <code>16</code></p>
                    </div>
                                    </details>
        </div>
        </form>

                    <h2 id="6-quan-tri-vien-admin-GETapi-v1-admin-products--id-">GET api/v1/admin/products/{id}</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-admin-products--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/admin/products/architecto" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/products/architecto"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-products--id-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-admin-products--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-products--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-products--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-products--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-products--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-products--id-" data-method="GET"
      data-path="api/v1/admin/products/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-products--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-products--id-"
                    onclick="tryItOut('GETapi-v1-admin-products--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-products--id-"
                    onclick="cancelTryOut('GETapi-v1-admin-products--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-products--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/products/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-admin-products--id-"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-admin-products--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-admin-products--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="GETapi-v1-admin-products--id-"
               value="architecto"
               data-component="url">
    <br>
<p>The ID of the product. Example: <code>architecto</code></p>
            </div>
                    </form>

                    <h2 id="6-quan-tri-vien-admin-PUTapi-v1-admin-products--id-">PUT api/v1/admin/products/{id}</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTapi-v1-admin-products--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost:8000/api/v1/admin/products/architecto" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"ten_san_pham\": \"b\",
    \"danh_muc_id\": 16,
    \"thuong_hieu_id\": 16,
    \"gia_goc\": 22,
    \"gia_khuyen_mai\": 84,
    \"mo_ta_ngan\": \"z\",
    \"mo_ta_day_du\": \"miyvdljnikhwaykcmyuwpwlvqwrsitcpscqldzsnrwtujwvlxjklqppwqbewtnnoqitpxntltcvi\",
    \"trang_thai\": false,
    \"noi_bat\": false,
    \"bien_the\": [
        {
            \"kich_co\": \"architecto\",
            \"mau_sac\": \"architecto\",
            \"gia_rieng\": 39,
            \"ton_kho\": 84
        }
    ],
    \"hinh_anh\": [
        {
            \"duong_dan_anh\": \"architecto\",
            \"la_anh_chinh\": true,
            \"thu_tu\": 16
        }
    ]
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/products/architecto"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "ten_san_pham": "b",
    "danh_muc_id": 16,
    "thuong_hieu_id": 16,
    "gia_goc": 22,
    "gia_khuyen_mai": 84,
    "mo_ta_ngan": "z",
    "mo_ta_day_du": "miyvdljnikhwaykcmyuwpwlvqwrsitcpscqldzsnrwtujwvlxjklqppwqbewtnnoqitpxntltcvi",
    "trang_thai": false,
    "noi_bat": false,
    "bien_the": [
        {
            "kich_co": "architecto",
            "mau_sac": "architecto",
            "gia_rieng": 39,
            "ton_kho": 84
        }
    ],
    "hinh_anh": [
        {
            "duong_dan_anh": "architecto",
            "la_anh_chinh": true,
            "thu_tu": 16
        }
    ]
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-v1-admin-products--id-">
</span>
<span id="execution-results-PUTapi-v1-admin-products--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-admin-products--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-admin-products--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-admin-products--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-admin-products--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v1-admin-products--id-" data-method="PUT"
      data-path="api/v1/admin/products/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-admin-products--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-admin-products--id-"
                    onclick="tryItOut('PUTapi-v1-admin-products--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-admin-products--id-"
                    onclick="cancelTryOut('PUTapi-v1-admin-products--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-admin-products--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/admin/products/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/v1/admin/products/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-v1-admin-products--id-"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v1-admin-products--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-v1-admin-products--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="PUTapi-v1-admin-products--id-"
               value="architecto"
               data-component="url">
    <br>
<p>The ID of the product. Example: <code>architecto</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>ten_san_pham</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="ten_san_pham"                data-endpoint="PUTapi-v1-admin-products--id-"
               value="b"
               data-component="body">
    <br>
<p>Must be at least 5 characters. Must not be greater than 200 characters. Example: <code>b</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>danh_muc_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="danh_muc_id"                data-endpoint="PUTapi-v1-admin-products--id-"
               value="16"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the danh_muc table. Example: <code>16</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>thuong_hieu_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="thuong_hieu_id"                data-endpoint="PUTapi-v1-admin-products--id-"
               value="16"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the thuong_hieu table. Example: <code>16</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>gia_goc</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="gia_goc"                data-endpoint="PUTapi-v1-admin-products--id-"
               value="22"
               data-component="body">
    <br>
<p>Must be at least 1. Example: <code>22</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>gia_khuyen_mai</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="gia_khuyen_mai"                data-endpoint="PUTapi-v1-admin-products--id-"
               value="84"
               data-component="body">
    <br>
<p>Must be at least 0. Example: <code>84</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>mo_ta_ngan</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="mo_ta_ngan"                data-endpoint="PUTapi-v1-admin-products--id-"
               value="z"
               data-component="body">
    <br>
<p>Must be at least 10 characters. Must not be greater than 500 characters. Example: <code>z</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>mo_ta_day_du</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="mo_ta_day_du"                data-endpoint="PUTapi-v1-admin-products--id-"
               value="miyvdljnikhwaykcmyuwpwlvqwrsitcpscqldzsnrwtujwvlxjklqppwqbewtnnoqitpxntltcvi"
               data-component="body">
    <br>
<p>Must be at least 20 characters. Example: <code>miyvdljnikhwaykcmyuwpwlvqwrsitcpscqldzsnrwtujwvlxjklqppwqbewtnnoqitpxntltcvi</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>trang_thai</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="PUTapi-v1-admin-products--id-" style="display: none">
            <input type="radio" name="trang_thai"
                   value="true"
                   data-endpoint="PUTapi-v1-admin-products--id-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-v1-admin-products--id-" style="display: none">
            <input type="radio" name="trang_thai"
                   value="false"
                   data-endpoint="PUTapi-v1-admin-products--id-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>false</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>noi_bat</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="PUTapi-v1-admin-products--id-" style="display: none">
            <input type="radio" name="noi_bat"
                   value="true"
                   data-endpoint="PUTapi-v1-admin-products--id-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-v1-admin-products--id-" style="display: none">
            <input type="radio" name="noi_bat"
                   value="false"
                   data-endpoint="PUTapi-v1-admin-products--id-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>false</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>ma_sku</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="ma_sku"                data-endpoint="PUTapi-v1-admin-products--id-"
               value=""
               data-component="body">
    <br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
        <details>
            <summary style="padding-bottom: 10px;">
                <b style="line-height: 2;"><code>bien_the</code></b>&nbsp;&nbsp;
<small>object[]</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
<br>
<p>Biến thể. Must have at least 1 items.</p>
            </summary>
                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>kich_co</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="bien_the.0.kich_co"                data-endpoint="PUTapi-v1-admin-products--id-"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>mau_sac</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="bien_the.0.mau_sac"                data-endpoint="PUTapi-v1-admin-products--id-"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>gia_rieng</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="bien_the.0.gia_rieng"                data-endpoint="PUTapi-v1-admin-products--id-"
               value="39"
               data-component="body">
    <br>
<p>Must be at least 0. Example: <code>39</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>ton_kho</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="bien_the.0.ton_kho"                data-endpoint="PUTapi-v1-admin-products--id-"
               value="84"
               data-component="body">
    <br>
<p>Must be at least 0. Example: <code>84</code></p>
                    </div>
                                    </details>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
        <details>
            <summary style="padding-bottom: 10px;">
                <b style="line-height: 2;"><code>hinh_anh</code></b>&nbsp;&nbsp;
<small>object[]</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
<br>
<p>Hình ảnh. Must have at least 1 items.</p>
            </summary>
                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>duong_dan_anh</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="hinh_anh.0.duong_dan_anh"                data-endpoint="PUTapi-v1-admin-products--id-"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>la_anh_chinh</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="PUTapi-v1-admin-products--id-" style="display: none">
            <input type="radio" name="hinh_anh.0.la_anh_chinh"
                   value="true"
                   data-endpoint="PUTapi-v1-admin-products--id-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-v1-admin-products--id-" style="display: none">
            <input type="radio" name="hinh_anh.0.la_anh_chinh"
                   value="false"
                   data-endpoint="PUTapi-v1-admin-products--id-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>true</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>thu_tu</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="hinh_anh.0.thu_tu"                data-endpoint="PUTapi-v1-admin-products--id-"
               value="16"
               data-component="body">
    <br>
<p>Example: <code>16</code></p>
                    </div>
                                    </details>
        </div>
        </form>

                    <h2 id="6-quan-tri-vien-admin-DELETEapi-v1-admin-products--id-">DELETE api/v1/admin/products/{id}</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-v1-admin-products--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost:8000/api/v1/admin/products/architecto" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/products/architecto"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-admin-products--id-">
</span>
<span id="execution-results-DELETEapi-v1-admin-products--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-admin-products--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-admin-products--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-admin-products--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-admin-products--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-admin-products--id-" data-method="DELETE"
      data-path="api/v1/admin/products/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-admin-products--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-admin-products--id-"
                    onclick="tryItOut('DELETEapi-v1-admin-products--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-admin-products--id-"
                    onclick="cancelTryOut('DELETEapi-v1-admin-products--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-admin-products--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/admin/products/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-v1-admin-products--id-"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-v1-admin-products--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-v1-admin-products--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="DELETEapi-v1-admin-products--id-"
               value="architecto"
               data-component="url">
    <br>
<p>The ID of the product. Example: <code>architecto</code></p>
            </div>
                    </form>

                                <h2 id="6-quan-tri-vien-admin-quan-ly-danh-muc">Quản lý Danh mục</h2>
                                                    <h2 id="6-quan-tri-vien-admin-GETapi-v1-admin-categories">Danh sách danh mục (Admin)</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-admin-categories">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/admin/categories" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/categories"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-categories">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-admin-categories" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-categories"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-categories"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-categories" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-categories">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-categories" data-method="GET"
      data-path="api/v1/admin/categories"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-categories', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-categories"
                    onclick="tryItOut('GETapi-v1-admin-categories');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-categories"
                    onclick="cancelTryOut('GETapi-v1-admin-categories');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-categories"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/categories</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-admin-categories"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-admin-categories"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-admin-categories"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="6-quan-tri-vien-admin-POSTapi-v1-admin-categories">Tạo danh mục mới</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-admin-categories">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/v1/admin/categories" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"ten\": \"Giày bóng đá\",
    \"danh_muc_cha_id\": null,
    \"trang_thai\": false,
    \"thu_tu\": 39
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/categories"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "ten": "Giày bóng đá",
    "danh_muc_cha_id": null,
    "trang_thai": false,
    "thu_tu": 39
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-admin-categories">
</span>
<span id="execution-results-POSTapi-v1-admin-categories" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-admin-categories"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-admin-categories"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-admin-categories" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-admin-categories">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-admin-categories" data-method="POST"
      data-path="api/v1/admin/categories"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-admin-categories', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-admin-categories"
                    onclick="tryItOut('POSTapi-v1-admin-categories');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-admin-categories"
                    onclick="cancelTryOut('POSTapi-v1-admin-categories');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-admin-categories"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/admin/categories</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-admin-categories"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-admin-categories"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-admin-categories"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>ten</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="ten"                data-endpoint="POSTapi-v1-admin-categories"
               value="Giày bóng đá"
               data-component="body">
    <br>
<p>Tên danh mục. Example: <code>Giày bóng đá</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>danh_muc_cha_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="danh_muc_cha_id"                data-endpoint="POSTapi-v1-admin-categories"
               value=""
               data-component="body">
    <br>
<p>ID danh mục cha (Nếu là danh mục con).</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>trang_thai</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="POSTapi-v1-admin-categories" style="display: none">
            <input type="radio" name="trang_thai"
                   value="true"
                   data-endpoint="POSTapi-v1-admin-categories"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-v1-admin-categories" style="display: none">
            <input type="radio" name="trang_thai"
                   value="false"
                   data-endpoint="POSTapi-v1-admin-categories"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>false</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>thu_tu</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="thu_tu"                data-endpoint="POSTapi-v1-admin-categories"
               value="39"
               data-component="body">
    <br>
<p>Must be at least 0. Example: <code>39</code></p>
        </div>
        </form>

                    <h2 id="6-quan-tri-vien-admin-GETapi-v1-admin-categories--id-">GET api/v1/admin/categories/{id}</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-admin-categories--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/admin/categories/architecto" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/categories/architecto"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-categories--id-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-admin-categories--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-categories--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-categories--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-categories--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-categories--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-categories--id-" data-method="GET"
      data-path="api/v1/admin/categories/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-categories--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-categories--id-"
                    onclick="tryItOut('GETapi-v1-admin-categories--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-categories--id-"
                    onclick="cancelTryOut('GETapi-v1-admin-categories--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-categories--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/categories/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-admin-categories--id-"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-admin-categories--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-admin-categories--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="GETapi-v1-admin-categories--id-"
               value="architecto"
               data-component="url">
    <br>
<p>The ID of the category. Example: <code>architecto</code></p>
            </div>
                    </form>

                    <h2 id="6-quan-tri-vien-admin-PUTapi-v1-admin-categories--id-">PUT api/v1/admin/categories/{id}</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTapi-v1-admin-categories--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost:8000/api/v1/admin/categories/architecto" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"ten\": \"b\",
    \"trang_thai\": true,
    \"danh_muc_cha_id\": 16,
    \"thu_tu\": 39
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/categories/architecto"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "ten": "b",
    "trang_thai": true,
    "danh_muc_cha_id": 16,
    "thu_tu": 39
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-v1-admin-categories--id-">
</span>
<span id="execution-results-PUTapi-v1-admin-categories--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-admin-categories--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-admin-categories--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-admin-categories--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-admin-categories--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v1-admin-categories--id-" data-method="PUT"
      data-path="api/v1/admin/categories/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-admin-categories--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-admin-categories--id-"
                    onclick="tryItOut('PUTapi-v1-admin-categories--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-admin-categories--id-"
                    onclick="cancelTryOut('PUTapi-v1-admin-categories--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-admin-categories--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/admin/categories/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/v1/admin/categories/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-v1-admin-categories--id-"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v1-admin-categories--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-v1-admin-categories--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="PUTapi-v1-admin-categories--id-"
               value="architecto"
               data-component="url">
    <br>
<p>The ID of the category. Example: <code>architecto</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>ten</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="ten"                data-endpoint="PUTapi-v1-admin-categories--id-"
               value="b"
               data-component="body">
    <br>
<p>Must not be greater than 100 characters. Example: <code>b</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>trang_thai</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="PUTapi-v1-admin-categories--id-" style="display: none">
            <input type="radio" name="trang_thai"
                   value="true"
                   data-endpoint="PUTapi-v1-admin-categories--id-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-v1-admin-categories--id-" style="display: none">
            <input type="radio" name="trang_thai"
                   value="false"
                   data-endpoint="PUTapi-v1-admin-categories--id-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>true</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>danh_muc_cha_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="danh_muc_cha_id"                data-endpoint="PUTapi-v1-admin-categories--id-"
               value="16"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the danh_muc table. Example: <code>16</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>thu_tu</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="thu_tu"                data-endpoint="PUTapi-v1-admin-categories--id-"
               value="39"
               data-component="body">
    <br>
<p>Must be at least 0. Example: <code>39</code></p>
        </div>
        </form>

                    <h2 id="6-quan-tri-vien-admin-DELETEapi-v1-admin-categories--id-">DELETE api/v1/admin/categories/{id}</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-v1-admin-categories--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost:8000/api/v1/admin/categories/architecto" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/categories/architecto"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-admin-categories--id-">
</span>
<span id="execution-results-DELETEapi-v1-admin-categories--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-admin-categories--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-admin-categories--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-admin-categories--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-admin-categories--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-admin-categories--id-" data-method="DELETE"
      data-path="api/v1/admin/categories/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-admin-categories--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-admin-categories--id-"
                    onclick="tryItOut('DELETEapi-v1-admin-categories--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-admin-categories--id-"
                    onclick="cancelTryOut('DELETEapi-v1-admin-categories--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-admin-categories--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/admin/categories/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-v1-admin-categories--id-"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-v1-admin-categories--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-v1-admin-categories--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="DELETEapi-v1-admin-categories--id-"
               value="architecto"
               data-component="url">
    <br>
<p>The ID of the category. Example: <code>architecto</code></p>
            </div>
                    </form>

                                <h2 id="6-quan-tri-vien-admin-quan-ly-thuong-hieu">Quản lý Thương hiệu</h2>
                                                    <h2 id="6-quan-tri-vien-admin-GETapi-v1-admin-brands">Danh sách thương hiệu (Admin)</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-admin-brands">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/admin/brands" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/brands"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-brands">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-admin-brands" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-brands"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-brands"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-brands" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-brands">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-brands" data-method="GET"
      data-path="api/v1/admin/brands"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-brands', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-brands"
                    onclick="tryItOut('GETapi-v1-admin-brands');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-brands"
                    onclick="cancelTryOut('GETapi-v1-admin-brands');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-brands"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/brands</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-admin-brands"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-admin-brands"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-admin-brands"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="6-quan-tri-vien-admin-POSTapi-v1-admin-brands">Tạo thương hiệu mới</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-admin-brands">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/v1/admin/brands" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"ten\": \"Nike\",
    \"mo_ta\": \"Thương hiệu toàn cầu.\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/brands"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "ten": "Nike",
    "mo_ta": "Thương hiệu toàn cầu."
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-admin-brands">
</span>
<span id="execution-results-POSTapi-v1-admin-brands" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-admin-brands"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-admin-brands"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-admin-brands" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-admin-brands">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-admin-brands" data-method="POST"
      data-path="api/v1/admin/brands"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-admin-brands', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-admin-brands"
                    onclick="tryItOut('POSTapi-v1-admin-brands');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-admin-brands"
                    onclick="cancelTryOut('POSTapi-v1-admin-brands');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-admin-brands"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/admin/brands</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-admin-brands"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-admin-brands"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-admin-brands"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>ten</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="ten"                data-endpoint="POSTapi-v1-admin-brands"
               value="Nike"
               data-component="body">
    <br>
<p>Tên thương hiệu. Example: <code>Nike</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>mo_ta</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="mo_ta"                data-endpoint="POSTapi-v1-admin-brands"
               value="Thương hiệu toàn cầu."
               data-component="body">
    <br>
<p>Mô tả chi tiết. Example: <code>Thương hiệu toàn cầu.</code></p>
        </div>
        </form>

                    <h2 id="6-quan-tri-vien-admin-GETapi-v1-admin-brands--id-">GET api/v1/admin/brands/{id}</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-admin-brands--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/admin/brands/architecto" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/brands/architecto"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-brands--id-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-admin-brands--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-brands--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-brands--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-brands--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-brands--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-brands--id-" data-method="GET"
      data-path="api/v1/admin/brands/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-brands--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-brands--id-"
                    onclick="tryItOut('GETapi-v1-admin-brands--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-brands--id-"
                    onclick="cancelTryOut('GETapi-v1-admin-brands--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-brands--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/brands/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-admin-brands--id-"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-admin-brands--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-admin-brands--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="GETapi-v1-admin-brands--id-"
               value="architecto"
               data-component="url">
    <br>
<p>The ID of the brand. Example: <code>architecto</code></p>
            </div>
                    </form>

                    <h2 id="6-quan-tri-vien-admin-PUTapi-v1-admin-brands--id-">PUT api/v1/admin/brands/{id}</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTapi-v1-admin-brands--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost:8000/api/v1/admin/brands/architecto" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"ten\": \"b\",
    \"mo_ta\": \"architecto\",
    \"trang_thai\": false
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/brands/architecto"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "ten": "b",
    "mo_ta": "architecto",
    "trang_thai": false
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-v1-admin-brands--id-">
</span>
<span id="execution-results-PUTapi-v1-admin-brands--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-admin-brands--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-admin-brands--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-admin-brands--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-admin-brands--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v1-admin-brands--id-" data-method="PUT"
      data-path="api/v1/admin/brands/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-admin-brands--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-admin-brands--id-"
                    onclick="tryItOut('PUTapi-v1-admin-brands--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-admin-brands--id-"
                    onclick="cancelTryOut('PUTapi-v1-admin-brands--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-admin-brands--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/admin/brands/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/v1/admin/brands/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-v1-admin-brands--id-"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v1-admin-brands--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-v1-admin-brands--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="PUTapi-v1-admin-brands--id-"
               value="architecto"
               data-component="url">
    <br>
<p>The ID of the brand. Example: <code>architecto</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>ten</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="ten"                data-endpoint="PUTapi-v1-admin-brands--id-"
               value="b"
               data-component="body">
    <br>
<p>Must not be greater than 100 characters. Example: <code>b</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>mo_ta</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="mo_ta"                data-endpoint="PUTapi-v1-admin-brands--id-"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>trang_thai</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="PUTapi-v1-admin-brands--id-" style="display: none">
            <input type="radio" name="trang_thai"
                   value="true"
                   data-endpoint="PUTapi-v1-admin-brands--id-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-v1-admin-brands--id-" style="display: none">
            <input type="radio" name="trang_thai"
                   value="false"
                   data-endpoint="PUTapi-v1-admin-brands--id-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>false</code></p>
        </div>
        </form>

                    <h2 id="6-quan-tri-vien-admin-DELETEapi-v1-admin-brands--id-">DELETE api/v1/admin/brands/{id}</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-v1-admin-brands--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost:8000/api/v1/admin/brands/architecto" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/brands/architecto"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-admin-brands--id-">
</span>
<span id="execution-results-DELETEapi-v1-admin-brands--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-admin-brands--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-admin-brands--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-admin-brands--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-admin-brands--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-admin-brands--id-" data-method="DELETE"
      data-path="api/v1/admin/brands/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-admin-brands--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-admin-brands--id-"
                    onclick="tryItOut('DELETEapi-v1-admin-brands--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-admin-brands--id-"
                    onclick="cancelTryOut('DELETEapi-v1-admin-brands--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-admin-brands--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/admin/brands/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-v1-admin-brands--id-"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-v1-admin-brands--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-v1-admin-brands--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="DELETEapi-v1-admin-brands--id-"
               value="architecto"
               data-component="url">
    <br>
<p>The ID of the brand. Example: <code>architecto</code></p>
            </div>
                    </form>

                                <h2 id="6-quan-tri-vien-admin-quan-ly-don-hang">Quản lý Đơn hàng</h2>
                                                    <h2 id="6-quan-tri-vien-admin-GETapi-v1-admin-orders">Danh sách đơn hàng (Admin)</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-admin-orders">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/admin/orders?trang_thai=cho_xac_nhan&amp;phuong_thuc_tt=cod&amp;tu_khoa=DH123&amp;tu_ngay=2025-01-01&amp;den_ngay=2025-12-31" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/orders"
);

const params = {
    "trang_thai": "cho_xac_nhan",
    "phuong_thuc_tt": "cod",
    "tu_khoa": "DH123",
    "tu_ngay": "2025-01-01",
    "den_ngay": "2025-12-31",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-orders">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-admin-orders" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-orders"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-orders"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-orders" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-orders">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-orders" data-method="GET"
      data-path="api/v1/admin/orders"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-orders', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-orders"
                    onclick="tryItOut('GETapi-v1-admin-orders');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-orders"
                    onclick="cancelTryOut('GETapi-v1-admin-orders');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-orders"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/orders</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-admin-orders"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-admin-orders"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-admin-orders"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>trang_thai</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="trang_thai"                data-endpoint="GETapi-v1-admin-orders"
               value="cho_xac_nhan"
               data-component="query">
    <br>
<p>Lọc theo trạng thái (cho_xac_nhan, da_giao...). Example: <code>cho_xac_nhan</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>phuong_thuc_tt</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="phuong_thuc_tt"                data-endpoint="GETapi-v1-admin-orders"
               value="cod"
               data-component="query">
    <br>
<p>Lọc theo phương thức thanh toán (cod, vnpay, momo). Example: <code>cod</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>tu_khoa</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="tu_khoa"                data-endpoint="GETapi-v1-admin-orders"
               value="DH123"
               data-component="query">
    <br>
<p>Tìm theo mã đơn hoặc tên khách hàng. Example: <code>DH123</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>tu_ngay</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="tu_ngay"                data-endpoint="GETapi-v1-admin-orders"
               value="2025-01-01"
               data-component="query">
    <br>
<p>Từ ngày (Y-m-d). Example: <code>2025-01-01</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>den_ngay</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="den_ngay"                data-endpoint="GETapi-v1-admin-orders"
               value="2025-12-31"
               data-component="query">
    <br>
<p>Đến ngày (Y-m-d). Example: <code>2025-12-31</code></p>
            </div>
                </form>

                    <h2 id="6-quan-tri-vien-admin-GETapi-v1-admin-orders--id-">Chi tiết đơn hàng (Admin)</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-admin-orders--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/admin/orders/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/orders/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-orders--id-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-admin-orders--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-orders--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-orders--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-orders--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-orders--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-orders--id-" data-method="GET"
      data-path="api/v1/admin/orders/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-orders--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-orders--id-"
                    onclick="tryItOut('GETapi-v1-admin-orders--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-orders--id-"
                    onclick="cancelTryOut('GETapi-v1-admin-orders--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-orders--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/orders/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-admin-orders--id-"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-admin-orders--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-admin-orders--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-v1-admin-orders--id-"
               value="1"
               data-component="url">
    <br>
<p>ID đơn hàng. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="6-quan-tri-vien-admin-PUTapi-v1-admin-orders--id--status">Cập nhật trạng thái đơn</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTapi-v1-admin-orders--id--status">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost:8000/api/v1/admin/orders/1/status" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"trang_thai\": \"da_xac_nhan\",
    \"ghi_chu\": \"Khách hàng đồng ý giao chiều nay.\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/orders/1/status"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "trang_thai": "da_xac_nhan",
    "ghi_chu": "Khách hàng đồng ý giao chiều nay."
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-v1-admin-orders--id--status">
</span>
<span id="execution-results-PUTapi-v1-admin-orders--id--status" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-admin-orders--id--status"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-admin-orders--id--status"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-admin-orders--id--status" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-admin-orders--id--status">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v1-admin-orders--id--status" data-method="PUT"
      data-path="api/v1/admin/orders/{id}/status"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-admin-orders--id--status', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-admin-orders--id--status"
                    onclick="tryItOut('PUTapi-v1-admin-orders--id--status');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-admin-orders--id--status"
                    onclick="cancelTryOut('PUTapi-v1-admin-orders--id--status');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-admin-orders--id--status"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/admin/orders/{id}/status</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-v1-admin-orders--id--status"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v1-admin-orders--id--status"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-v1-admin-orders--id--status"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-v1-admin-orders--id--status"
               value="1"
               data-component="url">
    <br>
<p>ID đơn hàng. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>trang_thai</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="trang_thai"                data-endpoint="PUTapi-v1-admin-orders--id--status"
               value="da_xac_nhan"
               data-component="body">
    <br>
<p>Trạng thái mới (cho_xac_nhan, da_xac_nhan, dang_xu_ly, dang_giao, da_giao, da_huy, hoan_tra). Example: <code>da_xac_nhan</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>ghi_chu</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="ghi_chu"                data-endpoint="PUTapi-v1-admin-orders--id--status"
               value="Khách hàng đồng ý giao chiều nay."
               data-component="body">
    <br>
<p>Ghi chú cập nhật (VD: Đã gọi xác nhận). Example: <code>Khách hàng đồng ý giao chiều nay.</code></p>
        </div>
        </form>

                                <h2 id="6-quan-tri-vien-admin-quan-ly-ma-giam-gia">Quản lý Mã giảm giá</h2>
                                                    <h2 id="6-quan-tri-vien-admin-GETapi-v1-admin-coupons">Danh sách mã giảm giá (Admin)</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-admin-coupons">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/admin/coupons" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/coupons"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-coupons">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-admin-coupons" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-coupons"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-coupons"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-coupons" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-coupons">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-coupons" data-method="GET"
      data-path="api/v1/admin/coupons"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-coupons', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-coupons"
                    onclick="tryItOut('GETapi-v1-admin-coupons');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-coupons"
                    onclick="cancelTryOut('GETapi-v1-admin-coupons');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-coupons"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/coupons</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-admin-coupons"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-admin-coupons"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-admin-coupons"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="6-quan-tri-vien-admin-POSTapi-v1-admin-coupons">Cấp mã giảm giá mới</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-admin-coupons">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/v1/admin/coupons" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"ma_code\": \"SUMMER25\",
    \"loai_giam\": \"phan_tram\",
    \"gia_tri\": \"10\",
    \"gia_tri_don_hang_min\": \"300000\",
    \"gioi_han_su_dung\": 100,
    \"bat_dau_luc\": \"2025-06-01\",
    \"het_han_luc\": \"2025-06-30\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/coupons"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "ma_code": "SUMMER25",
    "loai_giam": "phan_tram",
    "gia_tri": "10",
    "gia_tri_don_hang_min": "300000",
    "gioi_han_su_dung": 100,
    "bat_dau_luc": "2025-06-01",
    "het_han_luc": "2025-06-30"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-admin-coupons">
</span>
<span id="execution-results-POSTapi-v1-admin-coupons" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-admin-coupons"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-admin-coupons"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-admin-coupons" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-admin-coupons">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-admin-coupons" data-method="POST"
      data-path="api/v1/admin/coupons"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-admin-coupons', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-admin-coupons"
                    onclick="tryItOut('POSTapi-v1-admin-coupons');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-admin-coupons"
                    onclick="cancelTryOut('POSTapi-v1-admin-coupons');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-admin-coupons"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/admin/coupons</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-admin-coupons"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-admin-coupons"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-admin-coupons"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>ma_code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="ma_code"                data-endpoint="POSTapi-v1-admin-coupons"
               value="SUMMER25"
               data-component="body">
    <br>
<p>Mã code duy nhất. Example: <code>SUMMER25</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>loai_giam</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="loai_giam"                data-endpoint="POSTapi-v1-admin-coupons"
               value="phan_tram"
               data-component="body">
    <br>
<p>Loại giảm (phan_tram, so_tien_co_dinh). Example: <code>phan_tram</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>gia_tri</code></b>&nbsp;&nbsp;
<small>numeric</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="gia_tri"                data-endpoint="POSTapi-v1-admin-coupons"
               value="10"
               data-component="body">
    <br>
<p>Mức giảm (%, VNĐ). Example: <code>10</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>gia_tri_don_hang_min</code></b>&nbsp;&nbsp;
<small>numeric</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="gia_tri_don_hang_min"                data-endpoint="POSTapi-v1-admin-coupons"
               value="300000"
               data-component="body">
    <br>
<p>Đơn thiểu áp dụng. Example: <code>300000</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>gioi_han_su_dung</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="gioi_han_su_dung"                data-endpoint="POSTapi-v1-admin-coupons"
               value="100"
               data-component="body">
    <br>
<p>Tổng lượt dùng tối đa. Example: <code>100</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>bat_dau_luc</code></b>&nbsp;&nbsp;
<small>date</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="bat_dau_luc"                data-endpoint="POSTapi-v1-admin-coupons"
               value="2025-06-01"
               data-component="body">
    <br>
<p>Thời gian khởi động. Example: <code>2025-06-01</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>het_han_luc</code></b>&nbsp;&nbsp;
<small>date</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="het_han_luc"                data-endpoint="POSTapi-v1-admin-coupons"
               value="2025-06-30"
               data-component="body">
    <br>
<p>Thời gian kết thúc. Example: <code>2025-06-30</code></p>
        </div>
        </form>

                    <h2 id="6-quan-tri-vien-admin-GETapi-v1-admin-coupons--id-">GET api/v1/admin/coupons/{id}</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-admin-coupons--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/admin/coupons/architecto" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/coupons/architecto"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-coupons--id-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-admin-coupons--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-coupons--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-coupons--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-coupons--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-coupons--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-coupons--id-" data-method="GET"
      data-path="api/v1/admin/coupons/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-coupons--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-coupons--id-"
                    onclick="tryItOut('GETapi-v1-admin-coupons--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-coupons--id-"
                    onclick="cancelTryOut('GETapi-v1-admin-coupons--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-coupons--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/coupons/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-admin-coupons--id-"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-admin-coupons--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-admin-coupons--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="GETapi-v1-admin-coupons--id-"
               value="architecto"
               data-component="url">
    <br>
<p>The ID of the coupon. Example: <code>architecto</code></p>
            </div>
                    </form>

                    <h2 id="6-quan-tri-vien-admin-PUTapi-v1-admin-coupons--id-">PUT api/v1/admin/coupons/{id}</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTapi-v1-admin-coupons--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost:8000/api/v1/admin/coupons/architecto" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"loai_giam\": \"phan_tram\",
    \"gia_tri\": 27,
    \"gia_tri_don_hang_min\": 39,
    \"gioi_han_su_dung\": 67,
    \"bat_dau_luc\": \"2026-04-01T14:29:02\",
    \"het_han_luc\": \"2052-04-24\",
    \"trang_thai\": false
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/coupons/architecto"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "loai_giam": "phan_tram",
    "gia_tri": 27,
    "gia_tri_don_hang_min": 39,
    "gioi_han_su_dung": 67,
    "bat_dau_luc": "2026-04-01T14:29:02",
    "het_han_luc": "2052-04-24",
    "trang_thai": false
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-v1-admin-coupons--id-">
</span>
<span id="execution-results-PUTapi-v1-admin-coupons--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-admin-coupons--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-admin-coupons--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-admin-coupons--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-admin-coupons--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v1-admin-coupons--id-" data-method="PUT"
      data-path="api/v1/admin/coupons/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-admin-coupons--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-admin-coupons--id-"
                    onclick="tryItOut('PUTapi-v1-admin-coupons--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-admin-coupons--id-"
                    onclick="cancelTryOut('PUTapi-v1-admin-coupons--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-admin-coupons--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/admin/coupons/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/v1/admin/coupons/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-v1-admin-coupons--id-"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v1-admin-coupons--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-v1-admin-coupons--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="PUTapi-v1-admin-coupons--id-"
               value="architecto"
               data-component="url">
    <br>
<p>The ID of the coupon. Example: <code>architecto</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>ma_code</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="ma_code"                data-endpoint="PUTapi-v1-admin-coupons--id-"
               value=""
               data-component="body">
    <br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>loai_giam</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="loai_giam"                data-endpoint="PUTapi-v1-admin-coupons--id-"
               value="phan_tram"
               data-component="body">
    <br>
<p>Example: <code>phan_tram</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>phan_tram</code></li> <li><code>so_tien_co_dinh</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>gia_tri</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="gia_tri"                data-endpoint="PUTapi-v1-admin-coupons--id-"
               value="27"
               data-component="body">
    <br>
<p>Must be at least 0. Example: <code>27</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>gia_tri_don_hang_min</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="gia_tri_don_hang_min"                data-endpoint="PUTapi-v1-admin-coupons--id-"
               value="39"
               data-component="body">
    <br>
<p>Must be at least 0. Example: <code>39</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>gioi_han_su_dung</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="gioi_han_su_dung"                data-endpoint="PUTapi-v1-admin-coupons--id-"
               value="67"
               data-component="body">
    <br>
<p>Must be at least 1. Example: <code>67</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>bat_dau_luc</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="bat_dau_luc"                data-endpoint="PUTapi-v1-admin-coupons--id-"
               value="2026-04-01T14:29:02"
               data-component="body">
    <br>
<p>Must be a valid date. Example: <code>2026-04-01T14:29:02</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>het_han_luc</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="het_han_luc"                data-endpoint="PUTapi-v1-admin-coupons--id-"
               value="2052-04-24"
               data-component="body">
    <br>
<p>Must be a valid date. Must be a date after or equal to <code>bat_dau_luc</code>. Example: <code>2052-04-24</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>trang_thai</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="PUTapi-v1-admin-coupons--id-" style="display: none">
            <input type="radio" name="trang_thai"
                   value="true"
                   data-endpoint="PUTapi-v1-admin-coupons--id-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-v1-admin-coupons--id-" style="display: none">
            <input type="radio" name="trang_thai"
                   value="false"
                   data-endpoint="PUTapi-v1-admin-coupons--id-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>false</code></p>
        </div>
        </form>

                    <h2 id="6-quan-tri-vien-admin-DELETEapi-v1-admin-coupons--id-">DELETE api/v1/admin/coupons/{id}</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-v1-admin-coupons--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost:8000/api/v1/admin/coupons/architecto" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/coupons/architecto"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-admin-coupons--id-">
</span>
<span id="execution-results-DELETEapi-v1-admin-coupons--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-admin-coupons--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-admin-coupons--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-admin-coupons--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-admin-coupons--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-admin-coupons--id-" data-method="DELETE"
      data-path="api/v1/admin/coupons/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-admin-coupons--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-admin-coupons--id-"
                    onclick="tryItOut('DELETEapi-v1-admin-coupons--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-admin-coupons--id-"
                    onclick="cancelTryOut('DELETEapi-v1-admin-coupons--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-admin-coupons--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/admin/coupons/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-v1-admin-coupons--id-"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-v1-admin-coupons--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-v1-admin-coupons--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="DELETEapi-v1-admin-coupons--id-"
               value="architecto"
               data-component="url">
    <br>
<p>The ID of the coupon. Example: <code>architecto</code></p>
            </div>
                    </form>

                                <h2 id="6-quan-tri-vien-admin-quan-ly-danh-gia">Quản lý Đánh giá</h2>
                                                    <h2 id="6-quan-tri-vien-admin-GETapi-v1-admin-reviews">Danh sách đánh giá (Admin)</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-admin-reviews">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/admin/reviews?da_duyet=" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/reviews"
);

const params = {
    "da_duyet": "0",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-reviews">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-admin-reviews" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-reviews"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-reviews"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-reviews" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-reviews">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-reviews" data-method="GET"
      data-path="api/v1/admin/reviews"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-reviews', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-reviews"
                    onclick="tryItOut('GETapi-v1-admin-reviews');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-reviews"
                    onclick="cancelTryOut('GETapi-v1-admin-reviews');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-reviews"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/reviews</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-admin-reviews"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-admin-reviews"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-admin-reviews"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>da_duyet</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="GETapi-v1-admin-reviews" style="display: none">
            <input type="radio" name="da_duyet"
                   value="1"
                   data-endpoint="GETapi-v1-admin-reviews"
                   data-component="query"             >
            <code>true</code>
        </label>
        <label data-endpoint="GETapi-v1-admin-reviews" style="display: none">
            <input type="radio" name="da_duyet"
                   value="0"
                   data-endpoint="GETapi-v1-admin-reviews"
                   data-component="query"             >
            <code>false</code>
        </label>
    <br>
<p>Lọc theo trạng thái duyệt (true/false). Example: <code>false</code></p>
            </div>
                </form>

                    <h2 id="6-quan-tri-vien-admin-PUTapi-v1-admin-reviews--id--approve">Duyệt đánh giá</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Admin xác nhận duyệt để đánh giá hiển thị công khai trên ứng dụng. Hệ thống tự tính lại sao trung bình của sản phẩm.</p>

<span id="example-requests-PUTapi-v1-admin-reviews--id--approve">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost:8000/api/v1/admin/reviews/1/approve" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/reviews/1/approve"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "PUT",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-v1-admin-reviews--id--approve">
</span>
<span id="execution-results-PUTapi-v1-admin-reviews--id--approve" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-admin-reviews--id--approve"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-admin-reviews--id--approve"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-admin-reviews--id--approve" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-admin-reviews--id--approve">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v1-admin-reviews--id--approve" data-method="PUT"
      data-path="api/v1/admin/reviews/{id}/approve"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-admin-reviews--id--approve', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-admin-reviews--id--approve"
                    onclick="tryItOut('PUTapi-v1-admin-reviews--id--approve');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-admin-reviews--id--approve"
                    onclick="cancelTryOut('PUTapi-v1-admin-reviews--id--approve');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-admin-reviews--id--approve"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/admin/reviews/{id}/approve</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-v1-admin-reviews--id--approve"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v1-admin-reviews--id--approve"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-v1-admin-reviews--id--approve"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-v1-admin-reviews--id--approve"
               value="1"
               data-component="url">
    <br>
<p>ID đánh giá. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="6-quan-tri-vien-admin-DELETEapi-v1-admin-reviews--id-">Xóa đánh giá</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-v1-admin-reviews--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost:8000/api/v1/admin/reviews/architecto" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/reviews/architecto"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-admin-reviews--id-">
</span>
<span id="execution-results-DELETEapi-v1-admin-reviews--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-admin-reviews--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-admin-reviews--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-admin-reviews--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-admin-reviews--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-admin-reviews--id-" data-method="DELETE"
      data-path="api/v1/admin/reviews/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-admin-reviews--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-admin-reviews--id-"
                    onclick="tryItOut('DELETEapi-v1-admin-reviews--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-admin-reviews--id-"
                    onclick="cancelTryOut('DELETEapi-v1-admin-reviews--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-admin-reviews--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/admin/reviews/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-v1-admin-reviews--id-"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-v1-admin-reviews--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-v1-admin-reviews--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="DELETEapi-v1-admin-reviews--id-"
               value="architecto"
               data-component="url">
    <br>
<p>The ID of the review. Example: <code>architecto</code></p>
            </div>
                    </form>

                                <h2 id="6-quan-tri-vien-admin-quan-ly-nguoi-dung">Quản lý Người dùng</h2>
                                                    <h2 id="6-quan-tri-vien-admin-GETapi-v1-admin-users">Danh sách người dùng (Admin)</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-admin-users">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/admin/users?page=1&amp;search=%22Nguyen+Van+A%22&amp;vai_tro=architecto" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/users"
);

const params = {
    "page": "1",
    "search": ""Nguyen Van A"",
    "vai_tro": "architecto",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-users">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-admin-users" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-users"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-users"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-users" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-users">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-users" data-method="GET"
      data-path="api/v1/admin/users"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-users', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-users"
                    onclick="tryItOut('GETapi-v1-admin-users');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-users"
                    onclick="cancelTryOut('GETapi-v1-admin-users');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-users"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/users</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-admin-users"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-admin-users"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-admin-users"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="page"                data-endpoint="GETapi-v1-admin-users"
               value="1"
               data-component="query">
    <br>
<p>Số trang. Example: <code>1</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>search</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="search"                data-endpoint="GETapi-v1-admin-users"
               value=""Nguyen Van A""
               data-component="query">
    <br>
<p>Tìm kiếm theo tên, email, sđt. Example: <code>"Nguyen Van A"</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>vai_tro</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="vai_tro"                data-endpoint="GETapi-v1-admin-users"
               value="architecto"
               data-component="query">
    <br>
<p>Lọc theo vai trò (khach_hang, quan_tri). Example: <code>architecto</code></p>
            </div>
                </form>

                    <h2 id="6-quan-tri-vien-admin-POSTapi-v1-admin-users">Thêm mới người dùng (Admin)</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-admin-users">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/v1/admin/users" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"ho_va_ten\": \"b\",
    \"email\": \"zbailey@example.net\",
    \"mat_khau\": \"iyvdljnikhwaykcmyuwpwlvqwrsitcpscqldzsnrwtujwv\",
    \"so_dien_thoai\": \"lxjklqppwqbewtnn\",
    \"vai_tro\": \"quan_tri\",
    \"trang_thai\": false
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/users"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "ho_va_ten": "b",
    "email": "zbailey@example.net",
    "mat_khau": "iyvdljnikhwaykcmyuwpwlvqwrsitcpscqldzsnrwtujwv",
    "so_dien_thoai": "lxjklqppwqbewtnn",
    "vai_tro": "quan_tri",
    "trang_thai": false
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-admin-users">
</span>
<span id="execution-results-POSTapi-v1-admin-users" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-admin-users"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-admin-users"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-admin-users" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-admin-users">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-admin-users" data-method="POST"
      data-path="api/v1/admin/users"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-admin-users', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-admin-users"
                    onclick="tryItOut('POSTapi-v1-admin-users');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-admin-users"
                    onclick="cancelTryOut('POSTapi-v1-admin-users');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-admin-users"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/admin/users</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-admin-users"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-admin-users"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-admin-users"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>ho_va_ten</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="ho_va_ten"                data-endpoint="POSTapi-v1-admin-users"
               value="b"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>b</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-v1-admin-users"
               value="zbailey@example.net"
               data-component="body">
    <br>
<p>Must be a valid email address. Example: <code>zbailey@example.net</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>mat_khau</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="mat_khau"                data-endpoint="POSTapi-v1-admin-users"
               value="iyvdljnikhwaykcmyuwpwlvqwrsitcpscqldzsnrwtujwv"
               data-component="body">
    <br>
<p>Must be at least 6 characters. Example: <code>iyvdljnikhwaykcmyuwpwlvqwrsitcpscqldzsnrwtujwv</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>so_dien_thoai</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="so_dien_thoai"                data-endpoint="POSTapi-v1-admin-users"
               value="lxjklqppwqbewtnn"
               data-component="body">
    <br>
<p>Must not be greater than 20 characters. Example: <code>lxjklqppwqbewtnn</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>vai_tro</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="vai_tro"                data-endpoint="POSTapi-v1-admin-users"
               value="quan_tri"
               data-component="body">
    <br>
<p>Example: <code>quan_tri</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>khach_hang</code></li> <li><code>quan_tri</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>trang_thai</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="POSTapi-v1-admin-users" style="display: none">
            <input type="radio" name="trang_thai"
                   value="true"
                   data-endpoint="POSTapi-v1-admin-users"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-v1-admin-users" style="display: none">
            <input type="radio" name="trang_thai"
                   value="false"
                   data-endpoint="POSTapi-v1-admin-users"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>false</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>vai_tro_ids</code></b>&nbsp;&nbsp;
<small>string[]</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="vai_tro_ids[0]"                data-endpoint="POSTapi-v1-admin-users"
               data-component="body">
        <input type="text" style="display: none"
               name="vai_tro_ids[1]"                data-endpoint="POSTapi-v1-admin-users"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the vai_tro table.</p>
        </div>
        </form>

                    <h2 id="6-quan-tri-vien-admin-GETapi-v1-admin-users--id-">Chi tiết người dùng (Admin)</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-admin-users--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/admin/users/architecto" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/users/architecto"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-users--id-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-admin-users--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-users--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-users--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-users--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-users--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-users--id-" data-method="GET"
      data-path="api/v1/admin/users/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-users--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-users--id-"
                    onclick="tryItOut('GETapi-v1-admin-users--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-users--id-"
                    onclick="cancelTryOut('GETapi-v1-admin-users--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-users--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/users/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-admin-users--id-"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-admin-users--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-admin-users--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="GETapi-v1-admin-users--id-"
               value="architecto"
               data-component="url">
    <br>
<p>The ID of the user. Example: <code>architecto</code></p>
            </div>
                    </form>

                    <h2 id="6-quan-tri-vien-admin-PUTapi-v1-admin-users--id-">Cập nhật thông tin/trạng thái người dùng (Admin)</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTapi-v1-admin-users--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost:8000/api/v1/admin/users/architecto" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"vai_tro\": \"architecto\",
    \"trang_thai\": false
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/users/architecto"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "vai_tro": "architecto",
    "trang_thai": false
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-v1-admin-users--id-">
</span>
<span id="execution-results-PUTapi-v1-admin-users--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-admin-users--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-admin-users--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-admin-users--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-admin-users--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v1-admin-users--id-" data-method="PUT"
      data-path="api/v1/admin/users/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-admin-users--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-admin-users--id-"
                    onclick="tryItOut('PUTapi-v1-admin-users--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-admin-users--id-"
                    onclick="cancelTryOut('PUTapi-v1-admin-users--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-admin-users--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/admin/users/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/v1/admin/users/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-v1-admin-users--id-"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v1-admin-users--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-v1-admin-users--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="PUTapi-v1-admin-users--id-"
               value="architecto"
               data-component="url">
    <br>
<p>The ID of the user. Example: <code>architecto</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>vai_tro</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="vai_tro"                data-endpoint="PUTapi-v1-admin-users--id-"
               value="architecto"
               data-component="body">
    <br>
<p>Vai trò (khach_hang, quan_tri). Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>trang_thai</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="PUTapi-v1-admin-users--id-" style="display: none">
            <input type="radio" name="trang_thai"
                   value="true"
                   data-endpoint="PUTapi-v1-admin-users--id-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-v1-admin-users--id-" style="display: none">
            <input type="radio" name="trang_thai"
                   value="false"
                   data-endpoint="PUTapi-v1-admin-users--id-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Trạng thái hoạt động. Example: <code>false</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>vai_tro_ids</code></b>&nbsp;&nbsp;
<small>string[]</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="vai_tro_ids[0]"                data-endpoint="PUTapi-v1-admin-users--id-"
               data-component="body">
        <input type="text" style="display: none"
               name="vai_tro_ids[1]"                data-endpoint="PUTapi-v1-admin-users--id-"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the vai_tro table.</p>
        </div>
        </form>

                    <h2 id="6-quan-tri-vien-admin-DELETEapi-v1-admin-users--id-">Xóa người dùng (Admin)</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-v1-admin-users--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost:8000/api/v1/admin/users/architecto" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/users/architecto"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-admin-users--id-">
</span>
<span id="execution-results-DELETEapi-v1-admin-users--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-admin-users--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-admin-users--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-admin-users--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-admin-users--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-admin-users--id-" data-method="DELETE"
      data-path="api/v1/admin/users/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-admin-users--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-admin-users--id-"
                    onclick="tryItOut('DELETEapi-v1-admin-users--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-admin-users--id-"
                    onclick="cancelTryOut('DELETEapi-v1-admin-users--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-admin-users--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/admin/users/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-v1-admin-users--id-"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-v1-admin-users--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-v1-admin-users--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="DELETEapi-v1-admin-users--id-"
               value="architecto"
               data-component="url">
    <br>
<p>The ID of the user. Example: <code>architecto</code></p>
            </div>
                    </form>

                                <h2 id="6-quan-tri-vien-admin-bao-cao-thong-ke">Báo cáo &amp; Thống kê</h2>
                                                    <h2 id="6-quan-tri-vien-admin-GETapi-v1-admin-reports-overview">Tổng quan thống kê (Overview)</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-admin-reports-overview">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/admin/reports/overview?period=architecto" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/reports/overview"
);

const params = {
    "period": "architecto",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-reports-overview">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-admin-reports-overview" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-reports-overview"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-reports-overview"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-reports-overview" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-reports-overview">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-reports-overview" data-method="GET"
      data-path="api/v1/admin/reports/overview"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-reports-overview', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-reports-overview"
                    onclick="tryItOut('GETapi-v1-admin-reports-overview');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-reports-overview"
                    onclick="cancelTryOut('GETapi-v1-admin-reports-overview');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-reports-overview"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/reports/overview</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-admin-reports-overview"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-admin-reports-overview"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-admin-reports-overview"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>period</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="period"                data-endpoint="GETapi-v1-admin-reports-overview"
               value="architecto"
               data-component="query">
    <br>
<p>Khoảng thời gian (today, week, month, year). Default: month Example: <code>architecto</code></p>
            </div>
                </form>

                    <h2 id="6-quan-tri-vien-admin-GETapi-v1-admin-reports-revenue-chart">Dữ liệu biểu đồ doanh thu (Revenue Chart)</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-admin-reports-revenue-chart">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/admin/reports/revenue-chart?period=architecto" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/reports/revenue-chart"
);

const params = {
    "period": "architecto",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-reports-revenue-chart">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-admin-reports-revenue-chart" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-reports-revenue-chart"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-reports-revenue-chart"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-reports-revenue-chart" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-reports-revenue-chart">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-reports-revenue-chart" data-method="GET"
      data-path="api/v1/admin/reports/revenue-chart"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-reports-revenue-chart', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-reports-revenue-chart"
                    onclick="tryItOut('GETapi-v1-admin-reports-revenue-chart');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-reports-revenue-chart"
                    onclick="cancelTryOut('GETapi-v1-admin-reports-revenue-chart');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-reports-revenue-chart"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/reports/revenue-chart</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-admin-reports-revenue-chart"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-admin-reports-revenue-chart"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-admin-reports-revenue-chart"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>period</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="period"                data-endpoint="GETapi-v1-admin-reports-revenue-chart"
               value="architecto"
               data-component="query">
    <br>
<p>Khoảng thời gian (week, month, year). Default: month Example: <code>architecto</code></p>
            </div>
                </form>

                    <h2 id="6-quan-tri-vien-admin-GETapi-v1-admin-reports-top-products">Top sản phẩm bán chạy (Top Products)</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-admin-reports-top-products">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/admin/reports/top-products" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/reports/top-products"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-reports-top-products">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-admin-reports-top-products" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-reports-top-products"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-reports-top-products"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-reports-top-products" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-reports-top-products">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-reports-top-products" data-method="GET"
      data-path="api/v1/admin/reports/top-products"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-reports-top-products', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-reports-top-products"
                    onclick="tryItOut('GETapi-v1-admin-reports-top-products');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-reports-top-products"
                    onclick="cancelTryOut('GETapi-v1-admin-reports-top-products');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-reports-top-products"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/reports/top-products</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-admin-reports-top-products"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-admin-reports-top-products"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-admin-reports-top-products"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="6-quan-tri-vien-admin-GETapi-v1-admin-reports-product-stats">Thống kê sản phẩm tĩnh (Total, low_stock, views.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>..)</p>

<span id="example-requests-GETapi-v1-admin-reports-product-stats">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/admin/reports/product-stats" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/reports/product-stats"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-reports-product-stats">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-admin-reports-product-stats" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-reports-product-stats"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-reports-product-stats"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-reports-product-stats" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-reports-product-stats">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-reports-product-stats" data-method="GET"
      data-path="api/v1/admin/reports/product-stats"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-reports-product-stats', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-reports-product-stats"
                    onclick="tryItOut('GETapi-v1-admin-reports-product-stats');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-reports-product-stats"
                    onclick="cancelTryOut('GETapi-v1-admin-reports-product-stats');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-reports-product-stats"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/reports/product-stats</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-admin-reports-product-stats"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-admin-reports-product-stats"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-admin-reports-product-stats"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="6-quan-tri-vien-admin-GETapi-v1-admin-reports-customer-stats">====== KHACH HANG (CUSTOMERS) ======</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-admin-reports-customer-stats">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/admin/reports/customer-stats" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/reports/customer-stats"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-reports-customer-stats">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-admin-reports-customer-stats" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-reports-customer-stats"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-reports-customer-stats"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-reports-customer-stats" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-reports-customer-stats">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-reports-customer-stats" data-method="GET"
      data-path="api/v1/admin/reports/customer-stats"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-reports-customer-stats', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-reports-customer-stats"
                    onclick="tryItOut('GETapi-v1-admin-reports-customer-stats');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-reports-customer-stats"
                    onclick="cancelTryOut('GETapi-v1-admin-reports-customer-stats');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-reports-customer-stats"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/reports/customer-stats</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-admin-reports-customer-stats"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-admin-reports-customer-stats"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-admin-reports-customer-stats"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="6-quan-tri-vien-admin-GETapi-v1-admin-reports-customer-chart">GET api/v1/admin/reports/customer-chart</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-admin-reports-customer-chart">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/admin/reports/customer-chart" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/reports/customer-chart"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-reports-customer-chart">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-admin-reports-customer-chart" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-reports-customer-chart"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-reports-customer-chart"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-reports-customer-chart" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-reports-customer-chart">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-reports-customer-chart" data-method="GET"
      data-path="api/v1/admin/reports/customer-chart"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-reports-customer-chart', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-reports-customer-chart"
                    onclick="tryItOut('GETapi-v1-admin-reports-customer-chart');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-reports-customer-chart"
                    onclick="cancelTryOut('GETapi-v1-admin-reports-customer-chart');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-reports-customer-chart"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/reports/customer-chart</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-admin-reports-customer-chart"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-admin-reports-customer-chart"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-admin-reports-customer-chart"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="6-quan-tri-vien-admin-GETapi-v1-admin-reports-top-customers">GET api/v1/admin/reports/top-customers</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-admin-reports-top-customers">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/admin/reports/top-customers" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/reports/top-customers"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-reports-top-customers">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-admin-reports-top-customers" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-reports-top-customers"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-reports-top-customers"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-reports-top-customers" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-reports-top-customers">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-reports-top-customers" data-method="GET"
      data-path="api/v1/admin/reports/top-customers"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-reports-top-customers', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-reports-top-customers"
                    onclick="tryItOut('GETapi-v1-admin-reports-top-customers');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-reports-top-customers"
                    onclick="cancelTryOut('GETapi-v1-admin-reports-top-customers');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-reports-top-customers"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/reports/top-customers</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-admin-reports-top-customers"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-admin-reports-top-customers"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-admin-reports-top-customers"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="6-quan-tri-vien-admin-GETapi-v1-admin-reports-marketing-stats">====== MARKETING ======</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-admin-reports-marketing-stats">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/admin/reports/marketing-stats" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/reports/marketing-stats"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-reports-marketing-stats">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-admin-reports-marketing-stats" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-reports-marketing-stats"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-reports-marketing-stats"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-reports-marketing-stats" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-reports-marketing-stats">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-reports-marketing-stats" data-method="GET"
      data-path="api/v1/admin/reports/marketing-stats"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-reports-marketing-stats', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-reports-marketing-stats"
                    onclick="tryItOut('GETapi-v1-admin-reports-marketing-stats');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-reports-marketing-stats"
                    onclick="cancelTryOut('GETapi-v1-admin-reports-marketing-stats');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-reports-marketing-stats"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/reports/marketing-stats</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-admin-reports-marketing-stats"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-admin-reports-marketing-stats"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-admin-reports-marketing-stats"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="6-quan-tri-vien-admin-GETapi-v1-admin-reports-coupon-chart">GET api/v1/admin/reports/coupon-chart</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-admin-reports-coupon-chart">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/admin/reports/coupon-chart" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/reports/coupon-chart"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-reports-coupon-chart">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-admin-reports-coupon-chart" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-reports-coupon-chart"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-reports-coupon-chart"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-reports-coupon-chart" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-reports-coupon-chart">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-reports-coupon-chart" data-method="GET"
      data-path="api/v1/admin/reports/coupon-chart"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-reports-coupon-chart', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-reports-coupon-chart"
                    onclick="tryItOut('GETapi-v1-admin-reports-coupon-chart');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-reports-coupon-chart"
                    onclick="cancelTryOut('GETapi-v1-admin-reports-coupon-chart');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-reports-coupon-chart"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/reports/coupon-chart</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-admin-reports-coupon-chart"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-admin-reports-coupon-chart"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-admin-reports-coupon-chart"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="6-quan-tri-vien-admin-GETapi-v1-admin-reports-top-coupons">GET api/v1/admin/reports/top-coupons</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-admin-reports-top-coupons">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/admin/reports/top-coupons" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/reports/top-coupons"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-reports-top-coupons">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-admin-reports-top-coupons" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-reports-top-coupons"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-reports-top-coupons"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-reports-top-coupons" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-reports-top-coupons">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-reports-top-coupons" data-method="GET"
      data-path="api/v1/admin/reports/top-coupons"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-reports-top-coupons', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-reports-top-coupons"
                    onclick="tryItOut('GETapi-v1-admin-reports-top-coupons');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-reports-top-coupons"
                    onclick="cancelTryOut('GETapi-v1-admin-reports-top-coupons');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-reports-top-coupons"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/reports/top-coupons</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-admin-reports-top-coupons"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-admin-reports-top-coupons"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-admin-reports-top-coupons"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="6-quan-tri-vien-admin-GETapi-v1-admin-reports-chatbot-stats">====== CHATBOT AI ======</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-admin-reports-chatbot-stats">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/admin/reports/chatbot-stats" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/reports/chatbot-stats"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-reports-chatbot-stats">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-admin-reports-chatbot-stats" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-reports-chatbot-stats"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-reports-chatbot-stats"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-reports-chatbot-stats" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-reports-chatbot-stats">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-reports-chatbot-stats" data-method="GET"
      data-path="api/v1/admin/reports/chatbot-stats"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-reports-chatbot-stats', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-reports-chatbot-stats"
                    onclick="tryItOut('GETapi-v1-admin-reports-chatbot-stats');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-reports-chatbot-stats"
                    onclick="cancelTryOut('GETapi-v1-admin-reports-chatbot-stats');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-reports-chatbot-stats"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/reports/chatbot-stats</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-admin-reports-chatbot-stats"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-admin-reports-chatbot-stats"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-admin-reports-chatbot-stats"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="6-quan-tri-vien-admin-GETapi-v1-admin-reports-chatbot-chart">GET api/v1/admin/reports/chatbot-chart</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-admin-reports-chatbot-chart">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/admin/reports/chatbot-chart" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/reports/chatbot-chart"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-reports-chatbot-chart">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-admin-reports-chatbot-chart" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-reports-chatbot-chart"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-reports-chatbot-chart"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-reports-chatbot-chart" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-reports-chatbot-chart">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-reports-chatbot-chart" data-method="GET"
      data-path="api/v1/admin/reports/chatbot-chart"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-reports-chatbot-chart', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-reports-chatbot-chart"
                    onclick="tryItOut('GETapi-v1-admin-reports-chatbot-chart');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-reports-chatbot-chart"
                    onclick="cancelTryOut('GETapi-v1-admin-reports-chatbot-chart');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-reports-chatbot-chart"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/reports/chatbot-chart</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-admin-reports-chatbot-chart"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-admin-reports-chatbot-chart"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-admin-reports-chatbot-chart"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="6-quan-tri-vien-admin-GETapi-v1-admin-reports-recent-chats">GET api/v1/admin/reports/recent-chats</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-admin-reports-recent-chats">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/admin/reports/recent-chats" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/reports/recent-chats"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-reports-recent-chats">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-admin-reports-recent-chats" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-reports-recent-chats"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-reports-recent-chats"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-reports-recent-chats" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-reports-recent-chats">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-reports-recent-chats" data-method="GET"
      data-path="api/v1/admin/reports/recent-chats"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-reports-recent-chats', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-reports-recent-chats"
                    onclick="tryItOut('GETapi-v1-admin-reports-recent-chats');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-reports-recent-chats"
                    onclick="cancelTryOut('GETapi-v1-admin-reports-recent-chats');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-reports-recent-chats"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/reports/recent-chats</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-admin-reports-recent-chats"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-admin-reports-recent-chats"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-admin-reports-recent-chats"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                                <h2 id="6-quan-tri-vien-admin-quan-ly-banner">Quản lý Banner</h2>
                                                    <h2 id="6-quan-tri-vien-admin-GETapi-v1-admin-banners">Danh sách Banner</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-admin-banners">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/admin/banners?search=architecto&amp;trang_thai=16&amp;per_page=16" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/banners"
);

const params = {
    "search": "architecto",
    "trang_thai": "16",
    "per_page": "16",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-banners">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-admin-banners" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-banners"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-banners"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-banners" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-banners">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-banners" data-method="GET"
      data-path="api/v1/admin/banners"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-banners', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-banners"
                    onclick="tryItOut('GETapi-v1-admin-banners');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-banners"
                    onclick="cancelTryOut('GETapi-v1-admin-banners');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-banners"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/banners</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-admin-banners"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-admin-banners"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-admin-banners"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>search</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="search"                data-endpoint="GETapi-v1-admin-banners"
               value="architecto"
               data-component="query">
    <br>
<p>Tìm kiếm theo tiêu đề. Example: <code>architecto</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>trang_thai</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="trang_thai"                data-endpoint="GETapi-v1-admin-banners"
               value="16"
               data-component="query">
    <br>
<p>Lọc theo trạng thái (1: Hiện, 0: Ẩn). Example: <code>16</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-v1-admin-banners"
               value="16"
               data-component="query">
    <br>
<p>Số lượng item trên 1 trang. Default: 10 Example: <code>16</code></p>
            </div>
                </form>

                    <h2 id="6-quan-tri-vien-admin-POSTapi-v1-admin-banners">Thêm mới Banner</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-admin-banners">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/v1/admin/banners" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"tieu_de\": \"architecto\",
    \"hinh_anh\": \"architecto\",
    \"duong_dan\": \"architecto\",
    \"thu_tu\": 16,
    \"trang_thai\": 16
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/banners"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "tieu_de": "architecto",
    "hinh_anh": "architecto",
    "duong_dan": "architecto",
    "thu_tu": 16,
    "trang_thai": 16
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-admin-banners">
</span>
<span id="execution-results-POSTapi-v1-admin-banners" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-admin-banners"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-admin-banners"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-admin-banners" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-admin-banners">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-admin-banners" data-method="POST"
      data-path="api/v1/admin/banners"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-admin-banners', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-admin-banners"
                    onclick="tryItOut('POSTapi-v1-admin-banners');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-admin-banners"
                    onclick="cancelTryOut('POSTapi-v1-admin-banners');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-admin-banners"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/admin/banners</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-admin-banners"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-admin-banners"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-admin-banners"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tieu_de</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="tieu_de"                data-endpoint="POSTapi-v1-admin-banners"
               value="architecto"
               data-component="body">
    <br>
<p>Tiêu đề banner. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>hinh_anh</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="hinh_anh"                data-endpoint="POSTapi-v1-admin-banners"
               value="architecto"
               data-component="body">
    <br>
<p>Đường dẫn ảnh banner (Upload qua API /admin/upload). Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>duong_dan</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="duong_dan"                data-endpoint="POSTapi-v1-admin-banners"
               value="architecto"
               data-component="body">
    <br>
<p>Đường dẫn khi click vào banner. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>thu_tu</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="thu_tu"                data-endpoint="POSTapi-v1-admin-banners"
               value="16"
               data-component="body">
    <br>
<p>Thứ tự hiển thị. Example: <code>16</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>trang_thai</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="trang_thai"                data-endpoint="POSTapi-v1-admin-banners"
               value="16"
               data-component="body">
    <br>
<p>Trạng thái (1: Hiện, 0: Ẩn). Default: 1. Example: <code>16</code></p>
        </div>
        </form>

                    <h2 id="6-quan-tri-vien-admin-GETapi-v1-admin-banners--id-">Chi tiết Banner</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-v1-admin-banners--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/admin/banners/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/banners/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-banners--id-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-admin-banners--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-banners--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-banners--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-banners--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-banners--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-banners--id-" data-method="GET"
      data-path="api/v1/admin/banners/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-banners--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-banners--id-"
                    onclick="tryItOut('GETapi-v1-admin-banners--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-banners--id-"
                    onclick="cancelTryOut('GETapi-v1-admin-banners--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-banners--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/banners/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-admin-banners--id-"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-admin-banners--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-admin-banners--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-v1-admin-banners--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the banner. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="6-quan-tri-vien-admin-PUTapi-v1-admin-banners--id-">Cập nhật Banner</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTapi-v1-admin-banners--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost:8000/api/v1/admin/banners/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"tieu_de\": \"b\",
    \"hinh_anh\": \"architecto\",
    \"duong_dan\": \"n\",
    \"thu_tu\": 16,
    \"trang_thai\": true
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/banners/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "tieu_de": "b",
    "hinh_anh": "architecto",
    "duong_dan": "n",
    "thu_tu": 16,
    "trang_thai": true
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-v1-admin-banners--id-">
</span>
<span id="execution-results-PUTapi-v1-admin-banners--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-admin-banners--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-admin-banners--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-admin-banners--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-admin-banners--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v1-admin-banners--id-" data-method="PUT"
      data-path="api/v1/admin/banners/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-admin-banners--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-admin-banners--id-"
                    onclick="tryItOut('PUTapi-v1-admin-banners--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-admin-banners--id-"
                    onclick="cancelTryOut('PUTapi-v1-admin-banners--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-admin-banners--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/admin/banners/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/v1/admin/banners/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-v1-admin-banners--id-"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v1-admin-banners--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-v1-admin-banners--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-v1-admin-banners--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the banner. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tieu_de</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="tieu_de"                data-endpoint="PUTapi-v1-admin-banners--id-"
               value="b"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>b</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>hinh_anh</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="hinh_anh"                data-endpoint="PUTapi-v1-admin-banners--id-"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>duong_dan</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="duong_dan"                data-endpoint="PUTapi-v1-admin-banners--id-"
               value="n"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>n</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>thu_tu</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="thu_tu"                data-endpoint="PUTapi-v1-admin-banners--id-"
               value="16"
               data-component="body">
    <br>
<p>Example: <code>16</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>trang_thai</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="PUTapi-v1-admin-banners--id-" style="display: none">
            <input type="radio" name="trang_thai"
                   value="true"
                   data-endpoint="PUTapi-v1-admin-banners--id-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-v1-admin-banners--id-" style="display: none">
            <input type="radio" name="trang_thai"
                   value="false"
                   data-endpoint="PUTapi-v1-admin-banners--id-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>true</code></p>
        </div>
        </form>

                    <h2 id="6-quan-tri-vien-admin-DELETEapi-v1-admin-banners--id-">Xóa Banner</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-v1-admin-banners--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost:8000/api/v1/admin/banners/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/banners/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-admin-banners--id-">
</span>
<span id="execution-results-DELETEapi-v1-admin-banners--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-admin-banners--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-admin-banners--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-admin-banners--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-admin-banners--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-admin-banners--id-" data-method="DELETE"
      data-path="api/v1/admin/banners/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-admin-banners--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-admin-banners--id-"
                    onclick="tryItOut('DELETEapi-v1-admin-banners--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-admin-banners--id-"
                    onclick="cancelTryOut('DELETEapi-v1-admin-banners--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-admin-banners--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/admin/banners/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-v1-admin-banners--id-"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-v1-admin-banners--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-v1-admin-banners--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-v1-admin-banners--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the banner. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="6-quan-tri-vien-admin-PATCHapi-v1-admin-banners--banner--status">Bật/tắt trạng thái hiển thị</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PATCHapi-v1-admin-banners--banner--status">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PATCH \
    "http://localhost:8000/api/v1/admin/banners/1/status" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/banners/1/status"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "PATCH",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PATCHapi-v1-admin-banners--banner--status">
</span>
<span id="execution-results-PATCHapi-v1-admin-banners--banner--status" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PATCHapi-v1-admin-banners--banner--status"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PATCHapi-v1-admin-banners--banner--status"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PATCHapi-v1-admin-banners--banner--status" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PATCHapi-v1-admin-banners--banner--status">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PATCHapi-v1-admin-banners--banner--status" data-method="PATCH"
      data-path="api/v1/admin/banners/{banner}/status"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PATCHapi-v1-admin-banners--banner--status', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PATCHapi-v1-admin-banners--banner--status"
                    onclick="tryItOut('PATCHapi-v1-admin-banners--banner--status');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PATCHapi-v1-admin-banners--banner--status"
                    onclick="cancelTryOut('PATCHapi-v1-admin-banners--banner--status');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PATCHapi-v1-admin-banners--banner--status"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/v1/admin/banners/{banner}/status</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PATCHapi-v1-admin-banners--banner--status"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PATCHapi-v1-admin-banners--banner--status"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PATCHapi-v1-admin-banners--banner--status"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>banner</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="banner"                data-endpoint="PATCHapi-v1-admin-banners--banner--status"
               value="1"
               data-component="url">
    <br>
<p>The banner. Example: <code>1</code></p>
            </div>
                    </form>

                                <h2 id="6-quan-tri-vien-admin-quan-ly-thong-bao">Quản lý Thông báo</h2>
                                                    <h2 id="6-quan-tri-vien-admin-POSTapi-v1-admin-notifications-broadcast">Gửi thông báo tới toàn bộ người dùng (Broadcast)</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-v1-admin-notifications-broadcast">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/v1/admin/notifications/broadcast" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"tieu_de\": \"architecto\",
    \"noi_dung\": \"architecto\",
    \"loai\": \"khuyen_mai\",
    \"du_lieu_them\": [],
    \"gui_email\": true
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/notifications/broadcast"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "tieu_de": "architecto",
    "noi_dung": "architecto",
    "loai": "khuyen_mai",
    "du_lieu_them": [],
    "gui_email": true
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-admin-notifications-broadcast">
</span>
<span id="execution-results-POSTapi-v1-admin-notifications-broadcast" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-admin-notifications-broadcast"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-admin-notifications-broadcast"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-admin-notifications-broadcast" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-admin-notifications-broadcast">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-admin-notifications-broadcast" data-method="POST"
      data-path="api/v1/admin/notifications/broadcast"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-admin-notifications-broadcast', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-admin-notifications-broadcast"
                    onclick="tryItOut('POSTapi-v1-admin-notifications-broadcast');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-admin-notifications-broadcast"
                    onclick="cancelTryOut('POSTapi-v1-admin-notifications-broadcast');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-admin-notifications-broadcast"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/admin/notifications/broadcast</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-admin-notifications-broadcast"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-admin-notifications-broadcast"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-admin-notifications-broadcast"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tieu_de</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="tieu_de"                data-endpoint="POSTapi-v1-admin-notifications-broadcast"
               value="architecto"
               data-component="body">
    <br>
<p>Tiêu đề thông báo. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>noi_dung</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="noi_dung"                data-endpoint="POSTapi-v1-admin-notifications-broadcast"
               value="architecto"
               data-component="body">
    <br>
<p>Nội dung thông báo. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>loai</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="loai"                data-endpoint="POSTapi-v1-admin-notifications-broadcast"
               value="khuyen_mai"
               data-component="body">
    <br>
<p>Loại thông báo (khuyen_mai, he_thong). Example: <code>khuyen_mai</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>du_lieu_them</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="du_lieu_them"                data-endpoint="POSTapi-v1-admin-notifications-broadcast"
               value=""
               data-component="body">
    <br>
<p>Dữ liệu tùy chỉnh (JSON).</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>gui_email</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="POSTapi-v1-admin-notifications-broadcast" style="display: none">
            <input type="radio" name="gui_email"
                   value="true"
                   data-endpoint="POSTapi-v1-admin-notifications-broadcast"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-v1-admin-notifications-broadcast" style="display: none">
            <input type="radio" name="gui_email"
                   value="false"
                   data-endpoint="POSTapi-v1-admin-notifications-broadcast"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>true</code></p>
        </div>
        </form>

                    <h2 id="6-quan-tri-vien-admin-GETapi-v1-admin-notifications-history">Danh sách lịch sử thông báo quảng bá (Gần đây)</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Note: Class này hiện chỉ lưu thông báo cho từng user.
Để quản lý lịch sử broadcast chuẩn, có thể cần bảng riêng,
nhưng tạm thời lấy các thông báo mới nhất không phân biệt user id để admin xem lại.</p>

<span id="example-requests-GETapi-v1-admin-notifications-history">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/admin/notifications/history" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/notifications/history"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-notifications-history">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-admin-notifications-history" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-notifications-history"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-notifications-history"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-notifications-history" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-notifications-history">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-notifications-history" data-method="GET"
      data-path="api/v1/admin/notifications/history"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-notifications-history', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-notifications-history"
                    onclick="tryItOut('GETapi-v1-admin-notifications-history');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-notifications-history"
                    onclick="cancelTryOut('GETapi-v1-admin-notifications-history');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-notifications-history"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/notifications/history</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-admin-notifications-history"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-admin-notifications-history"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-admin-notifications-history"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                <h1 id="1-quan-tri-admin">1. Quản trị (Admin)</h1>

    

                        <h2 id="1-quan-tri-admin-thong-ke">Thống kê</h2>
                                                    <h2 id="1-quan-tri-admin-GETapi-v1-admin-dashboard">Lấy thống kê tổng quan</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Trả về các chỉ số cơ bản cho Dashboard admin.</p>

<span id="example-requests-GETapi-v1-admin-dashboard">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/admin/dashboard" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/dashboard"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-dashboard">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-admin-dashboard" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-dashboard"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-dashboard"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-dashboard" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-dashboard">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-dashboard" data-method="GET"
      data-path="api/v1/admin/dashboard"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-dashboard', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-dashboard"
                    onclick="tryItOut('GETapi-v1-admin-dashboard');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-dashboard"
                    onclick="cancelTryOut('GETapi-v1-admin-dashboard');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-dashboard"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/dashboard</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-v1-admin-dashboard"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-admin-dashboard"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-admin-dashboard"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                <h1 id="1-xac-thuc-tai-khoan">1. Xác thực & Tài khoản</h1>

    

                        <h2 id="1-xac-thuc-tai-khoan-quan-ly-xac-thuc-email">Quản lý Xác thực Email</h2>
                                                    <h2 id="1-xac-thuc-tai-khoan-GETapi-v1-auth-email-verify--id---hash-">Xử lý click vào link xác thực từ email.</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-auth-email-verify--id---hash-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/auth/email/verify/16/architecto" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/auth/email/verify/16/architecto"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-auth-email-verify--id---hash-">
            <blockquote>
            <p>Example response (302):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
location: http://localhost:3000/verify-email?status=expired
content-type: text/html; charset=utf-8
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">&lt;!DOCTYPE html&gt;
&lt;html&gt;
    &lt;head&gt;
        &lt;meta charset=&quot;UTF-8&quot; /&gt;
        &lt;meta http-equiv=&quot;refresh&quot; content=&quot;0;url=&#039;http://localhost:3000/verify-email?status=expired&#039;&quot; /&gt;

        &lt;title&gt;Redirecting to http://localhost:3000/verify-email?status=expired&lt;/title&gt;
    &lt;/head&gt;
    &lt;body&gt;
        Redirecting to &lt;a href=&quot;http://localhost:3000/verify-email?status=expired&quot;&gt;http://localhost:3000/verify-email?status=expired&lt;/a&gt;.
    &lt;/body&gt;
&lt;/html&gt;</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-auth-email-verify--id---hash-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-auth-email-verify--id---hash-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-auth-email-verify--id---hash-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-auth-email-verify--id---hash-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-auth-email-verify--id---hash-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-auth-email-verify--id---hash-" data-method="GET"
      data-path="api/v1/auth/email/verify/{id}/{hash}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-auth-email-verify--id---hash-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-auth-email-verify--id---hash-"
                    onclick="tryItOut('GETapi-v1-auth-email-verify--id---hash-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-auth-email-verify--id---hash-"
                    onclick="cancelTryOut('GETapi-v1-auth-email-verify--id---hash-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-auth-email-verify--id---hash-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/auth/email/verify/{id}/{hash}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-auth-email-verify--id---hash-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-auth-email-verify--id---hash-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-v1-auth-email-verify--id---hash-"
               value="16"
               data-component="url">
    <br>
<p>ID người dùng. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>hash</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="hash"                data-endpoint="GETapi-v1-auth-email-verify--id---hash-"
               value="architecto"
               data-component="url">
    <br>
<p>Mã hash xác thực. Example: <code>architecto</code></p>
            </div>
                    </form>

                    <h2 id="1-xac-thuc-tai-khoan-POSTapi-v1-auth-email-resend">Gửi lại email xác thực</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Dành cho người dùng đã đăng nhập nhưng chưa xác thực email.</p>

<span id="example-requests-POSTapi-v1-auth-email-resend">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/v1/auth/email/resend" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/auth/email/resend"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-auth-email-resend">
</span>
<span id="execution-results-POSTapi-v1-auth-email-resend" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-auth-email-resend"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-auth-email-resend"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-auth-email-resend" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-auth-email-resend">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-auth-email-resend" data-method="POST"
      data-path="api/v1/auth/email/resend"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-auth-email-resend', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-auth-email-resend"
                    onclick="tryItOut('POSTapi-v1-auth-email-resend');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-auth-email-resend"
                    onclick="cancelTryOut('POSTapi-v1-auth-email-resend');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-auth-email-resend"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/auth/email/resend</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-v1-auth-email-resend"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-auth-email-resend"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-auth-email-resend"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                <h1 id="12-quan-ly-bang-size">12. Quản lý Bảng Size</h1>

    

                        <h2 id="12-quan-ly-bang-size-cau-hinh-chatbot-tu-van-api-danh-cho-admin-de-quan-ly-cac-quy-tac-chon-size-san-pham">Cấu hình Chatbot &amp; Tư vấn

API dành cho Admin để quản lý các quy tắc chọn size sản phẩm.</h2>
                                                    <h2 id="12-quan-ly-bang-size-GETapi-v1-admin-size-charts">Danh sách Bảng Size</h2>

<p>
</p>

<p>Lấy danh sách toàn bộ các quy tắc size trong hệ thống.</p>

<span id="example-requests-GETapi-v1-admin-size-charts">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/admin/size-charts?loai=ao&amp;thuong_hieu_id=1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/size-charts"
);

const params = {
    "loai": "ao",
    "thuong_hieu_id": "1",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-size-charts">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-admin-size-charts" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-size-charts"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-size-charts"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-size-charts" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-size-charts">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-size-charts" data-method="GET"
      data-path="api/v1/admin/size-charts"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-size-charts', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-size-charts"
                    onclick="tryItOut('GETapi-v1-admin-size-charts');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-size-charts"
                    onclick="cancelTryOut('GETapi-v1-admin-size-charts');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-size-charts"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/size-charts</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-admin-size-charts"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-admin-size-charts"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>loai</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="loai"                data-endpoint="GETapi-v1-admin-size-charts"
               value="ao"
               data-component="query">
    <br>
<p>Lọc theo loại (ao, quan, giay). Example: <code>ao</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>thuong_hieu_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="thuong_hieu_id"                data-endpoint="GETapi-v1-admin-size-charts"
               value="1"
               data-component="query">
    <br>
<p>Lọc theo thương hiệu. Example: <code>1</code></p>
            </div>
                </form>

                    <h2 id="12-quan-ly-bang-size-POSTapi-v1-admin-size-charts">Thêm mới Quy tắc Size</h2>

<p>
</p>

<p>Tạo một quy tắc quy đổi size mới.</p>

<span id="example-requests-POSTapi-v1-admin-size-charts">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/v1/admin/size-charts" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"thuong_hieu_id\": 1,
    \"loai\": \"ao\",
    \"ten_size\": \"XL\",
    \"chieu_cao_min\": 175,
    \"chieu_cao_max\": 185,
    \"can_nang_min\": 70,
    \"can_nang_max\": 80,
    \"chieu_dai_chan_min\": 255,
    \"chieu_dai_chan_max\": 265,
    \"mo_ta\": \"architecto\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/size-charts"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "thuong_hieu_id": 1,
    "loai": "ao",
    "ten_size": "XL",
    "chieu_cao_min": 175,
    "chieu_cao_max": 185,
    "can_nang_min": 70,
    "can_nang_max": 80,
    "chieu_dai_chan_min": 255,
    "chieu_dai_chan_max": 265,
    "mo_ta": "architecto"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-admin-size-charts">
</span>
<span id="execution-results-POSTapi-v1-admin-size-charts" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-admin-size-charts"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-admin-size-charts"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-admin-size-charts" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-admin-size-charts">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-admin-size-charts" data-method="POST"
      data-path="api/v1/admin/size-charts"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-admin-size-charts', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-admin-size-charts"
                    onclick="tryItOut('POSTapi-v1-admin-size-charts');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-admin-size-charts"
                    onclick="cancelTryOut('POSTapi-v1-admin-size-charts');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-admin-size-charts"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/admin/size-charts</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-admin-size-charts"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-admin-size-charts"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>thuong_hieu_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="thuong_hieu_id"                data-endpoint="POSTapi-v1-admin-size-charts"
               value="1"
               data-component="body">
    <br>
<p>ID thương hiệu (null nếu dùng chung). Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>loai</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="loai"                data-endpoint="POSTapi-v1-admin-size-charts"
               value="ao"
               data-component="body">
    <br>
<p>Loại đồ thể thao (ao, quan, giay). Example: <code>ao</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>ten_size</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="ten_size"                data-endpoint="POSTapi-v1-admin-size-charts"
               value="XL"
               data-component="body">
    <br>
<p>Tên size hiển thị. Example: <code>XL</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>chieu_cao_min</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="chieu_cao_min"                data-endpoint="POSTapi-v1-admin-size-charts"
               value="175"
               data-component="body">
    <br>
<p>Chiều cao tối thiểu (cm). Example: <code>175</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>chieu_cao_max</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="chieu_cao_max"                data-endpoint="POSTapi-v1-admin-size-charts"
               value="185"
               data-component="body">
    <br>
<p>Chiều cao tối đa (cm). Example: <code>185</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>can_nang_min</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="can_nang_min"                data-endpoint="POSTapi-v1-admin-size-charts"
               value="70"
               data-component="body">
    <br>
<p>Cân nặng tối thiểu (kg). Example: <code>70</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>can_nang_max</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="can_nang_max"                data-endpoint="POSTapi-v1-admin-size-charts"
               value="80"
               data-component="body">
    <br>
<p>Cân nặng tối đa (kg). Example: <code>80</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>chieu_dai_chan_min</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="chieu_dai_chan_min"                data-endpoint="POSTapi-v1-admin-size-charts"
               value="255"
               data-component="body">
    <br>
<p>Độ dài chân tối thiểu (mm) cho Giày. Example: <code>255</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>chieu_dai_chan_max</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="chieu_dai_chan_max"                data-endpoint="POSTapi-v1-admin-size-charts"
               value="265"
               data-component="body">
    <br>
<p>Độ dài chân tối đa (mm) cho Giày. Example: <code>265</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>mo_ta</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="mo_ta"                data-endpoint="POSTapi-v1-admin-size-charts"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
        </form>

                    <h2 id="12-quan-ly-bang-size-PUTapi-v1-admin-size-charts--id-">Cập nhật Quy tắc Size</h2>

<p>
</p>

<p>Thay đổi thông số của một quy tắc size hiện có.</p>

<span id="example-requests-PUTapi-v1-admin-size-charts--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost:8000/api/v1/admin/size-charts/architecto" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"ten_size\": \"b\",
    \"chieu_cao_min\": 39,
    \"chieu_cao_max\": 4326.41688,
    \"can_nang_min\": 77,
    \"can_nang_max\": 4326.41688,
    \"chieu_dai_chan_min\": 77,
    \"chieu_dai_chan_max\": 4326.41688,
    \"mo_ta\": \"architecto\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/size-charts/architecto"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "ten_size": "b",
    "chieu_cao_min": 39,
    "chieu_cao_max": 4326.41688,
    "can_nang_min": 77,
    "can_nang_max": 4326.41688,
    "chieu_dai_chan_min": 77,
    "chieu_dai_chan_max": 4326.41688,
    "mo_ta": "architecto"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-v1-admin-size-charts--id-">
</span>
<span id="execution-results-PUTapi-v1-admin-size-charts--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-admin-size-charts--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-admin-size-charts--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-admin-size-charts--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-admin-size-charts--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v1-admin-size-charts--id-" data-method="PUT"
      data-path="api/v1/admin/size-charts/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-admin-size-charts--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-admin-size-charts--id-"
                    onclick="tryItOut('PUTapi-v1-admin-size-charts--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-admin-size-charts--id-"
                    onclick="cancelTryOut('PUTapi-v1-admin-size-charts--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-admin-size-charts--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/admin/size-charts/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/v1/admin/size-charts/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v1-admin-size-charts--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-v1-admin-size-charts--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="PUTapi-v1-admin-size-charts--id-"
               value="architecto"
               data-component="url">
    <br>
<p>The ID of the size chart. Example: <code>architecto</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>thuong_hieu_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="thuong_hieu_id"                data-endpoint="PUTapi-v1-admin-size-charts--id-"
               value=""
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the thuong_hieu table.</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>loai</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="loai"                data-endpoint="PUTapi-v1-admin-size-charts--id-"
               value=""
               data-component="body">
    <br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>ten_size</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="ten_size"                data-endpoint="PUTapi-v1-admin-size-charts--id-"
               value="b"
               data-component="body">
    <br>
<p>Must not be greater than 50 characters. Example: <code>b</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>chieu_cao_min</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="chieu_cao_min"                data-endpoint="PUTapi-v1-admin-size-charts--id-"
               value="39"
               data-component="body">
    <br>
<p>Must be at least 0. Example: <code>39</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>chieu_cao_max</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="chieu_cao_max"                data-endpoint="PUTapi-v1-admin-size-charts--id-"
               value="4326.41688"
               data-component="body">
    <br>
<p>Example: <code>4326.41688</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>can_nang_min</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="can_nang_min"                data-endpoint="PUTapi-v1-admin-size-charts--id-"
               value="77"
               data-component="body">
    <br>
<p>Must be at least 0. Example: <code>77</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>can_nang_max</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="can_nang_max"                data-endpoint="PUTapi-v1-admin-size-charts--id-"
               value="4326.41688"
               data-component="body">
    <br>
<p>Example: <code>4326.41688</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>chieu_dai_chan_min</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="chieu_dai_chan_min"                data-endpoint="PUTapi-v1-admin-size-charts--id-"
               value="77"
               data-component="body">
    <br>
<p>Must be at least 0. Example: <code>77</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>chieu_dai_chan_max</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="chieu_dai_chan_max"                data-endpoint="PUTapi-v1-admin-size-charts--id-"
               value="4326.41688"
               data-component="body">
    <br>
<p>Example: <code>4326.41688</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>mo_ta</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="mo_ta"                data-endpoint="PUTapi-v1-admin-size-charts--id-"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
        </form>

                    <h2 id="12-quan-ly-bang-size-DELETEapi-v1-admin-size-charts--id-">Xóa Quy tắc Size</h2>

<p>
</p>

<p>Gỡ bỏ một quy tắc size khỏi hệ thống.</p>

<span id="example-requests-DELETEapi-v1-admin-size-charts--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost:8000/api/v1/admin/size-charts/architecto" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/size-charts/architecto"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-admin-size-charts--id-">
</span>
<span id="execution-results-DELETEapi-v1-admin-size-charts--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-admin-size-charts--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-admin-size-charts--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-admin-size-charts--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-admin-size-charts--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-admin-size-charts--id-" data-method="DELETE"
      data-path="api/v1/admin/size-charts/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-admin-size-charts--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-admin-size-charts--id-"
                    onclick="tryItOut('DELETEapi-v1-admin-size-charts--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-admin-size-charts--id-"
                    onclick="cancelTryOut('DELETEapi-v1-admin-size-charts--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-admin-size-charts--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/admin/size-charts/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-v1-admin-size-charts--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-v1-admin-size-charts--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="DELETEapi-v1-admin-size-charts--id-"
               value="architecto"
               data-component="url">
    <br>
<p>The ID of the size chart. Example: <code>architecto</code></p>
            </div>
                    </form>

                <h1 id="endpoints">Endpoints</h1>

    

                                <h2 id="endpoints-POSTapi-v1-auth-password-email">Gửi link reset mật khẩu qua email.</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-auth-password-email">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/v1/auth/password/email" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"email\": \"gbailey@example.net\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/auth/password/email"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "gbailey@example.net"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-auth-password-email">
</span>
<span id="execution-results-POSTapi-v1-auth-password-email" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-auth-password-email"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-auth-password-email"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-auth-password-email" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-auth-password-email">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-auth-password-email" data-method="POST"
      data-path="api/v1/auth/password/email"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-auth-password-email', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-auth-password-email"
                    onclick="tryItOut('POSTapi-v1-auth-password-email');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-auth-password-email"
                    onclick="cancelTryOut('POSTapi-v1-auth-password-email');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-auth-password-email"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/auth/password/email</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-auth-password-email"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-auth-password-email"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-v1-auth-password-email"
               value="gbailey@example.net"
               data-component="body">
    <br>
<p>Must be a valid email address. The <code>email</code> of an existing record in the nguoi_dung table. Example: <code>gbailey@example.net</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTapi-v1-auth-password-reset">Đặt lại mật khẩu mới thông qua token.</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-auth-password-reset">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/v1/auth/password/reset" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"token\": \"architecto\",
    \"email\": \"zbailey@example.net\",
    \"password\": \"-0pBNvYgxw\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/auth/password/reset"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "token": "architecto",
    "email": "zbailey@example.net",
    "password": "-0pBNvYgxw"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-auth-password-reset">
</span>
<span id="execution-results-POSTapi-v1-auth-password-reset" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-auth-password-reset"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-auth-password-reset"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-auth-password-reset" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-auth-password-reset">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-auth-password-reset" data-method="POST"
      data-path="api/v1/auth/password/reset"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-auth-password-reset', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-auth-password-reset"
                    onclick="tryItOut('POSTapi-v1-auth-password-reset');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-auth-password-reset"
                    onclick="cancelTryOut('POSTapi-v1-auth-password-reset');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-auth-password-reset"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/auth/password/reset</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-auth-password-reset"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-auth-password-reset"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>token</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="token"                data-endpoint="POSTapi-v1-auth-password-reset"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-v1-auth-password-reset"
               value="zbailey@example.net"
               data-component="body">
    <br>
<p>Must be a valid email address. The <code>email</code> of an existing record in the nguoi_dung table. Example: <code>zbailey@example.net</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-v1-auth-password-reset"
               value="-0pBNvYgxw"
               data-component="body">
    <br>
<p>Must be at least 8 characters. Example: <code>-0pBNvYgxw</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTapi-v1-chatbot-message">POST api/v1/chatbot/message</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-chatbot-message">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/v1/chatbot/message" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"noi_dung\": \"b\",
    \"ma_phien\": \"n\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/chatbot/message"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "noi_dung": "b",
    "ma_phien": "n"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-chatbot-message">
</span>
<span id="execution-results-POSTapi-v1-chatbot-message" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-chatbot-message"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-chatbot-message"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-chatbot-message" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-chatbot-message">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-chatbot-message" data-method="POST"
      data-path="api/v1/chatbot/message"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-chatbot-message', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-chatbot-message"
                    onclick="tryItOut('POSTapi-v1-chatbot-message');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-chatbot-message"
                    onclick="cancelTryOut('POSTapi-v1-chatbot-message');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-chatbot-message"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/chatbot/message</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-chatbot-message"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-chatbot-message"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>noi_dung</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="noi_dung"                data-endpoint="POSTapi-v1-chatbot-message"
               value="b"
               data-component="body">
    <br>
<p>Must not be greater than 2000 characters. Example: <code>b</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>ma_phien</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="ma_phien"                data-endpoint="POSTapi-v1-chatbot-message"
               value="n"
               data-component="body">
    <br>
<p>Must not be greater than 100 characters. Example: <code>n</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-v1-chatbot-history">GET api/v1/chatbot/history</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-chatbot-history">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/chatbot/history" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/chatbot/history"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-chatbot-history">
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Thiếu m&atilde; phi&ecirc;n&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-chatbot-history" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-chatbot-history"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-chatbot-history"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-chatbot-history" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-chatbot-history">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-chatbot-history" data-method="GET"
      data-path="api/v1/chatbot/history"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-chatbot-history', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-chatbot-history"
                    onclick="tryItOut('GETapi-v1-chatbot-history');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-chatbot-history"
                    onclick="cancelTryOut('GETapi-v1-chatbot-history');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-chatbot-history"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/chatbot/history</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-chatbot-history"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-chatbot-history"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-v1-recommendations">Lấy gợi ý sản phẩm từ Python AI service hoặc trả fallback.</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-recommendations">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/recommendations" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/recommendations"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-recommendations">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;message&quot;: &quot;Gợi &yacute; sản phẩm&quot;,
    &quot;data&quot;: [
        {
            &quot;id&quot;: 30,
            &quot;danh_muc_id&quot;: 18,
            &quot;thuong_hieu_id&quot;: 2,
            &quot;ten_san_pham&quot;: &quot;Vợt Pickleball Wika Quang Dương Air v&agrave;ng&quot;,
            &quot;duong_dan&quot;: &quot;vot-pickleball-wika-quang-duong-air-vang-BuPmuPYU&quot;,
            &quot;ma_sku&quot;: &quot;WIK-HujOVD-30996&quot;,
            &quot;mo_ta_ngan&quot;: &quot;Trọng lượng vợt: 230 &plusmn; 10G\nChu vi c&aacute;n vợt: 108 MM\nChiều d&agrave;i c&aacute;n vợt: 140 MM\nChiều d&agrave;i vợt: 417 MM\nChiều ngang vợt: 188 MM\nĐộ d&agrave;y vợt: 14 &amp; 16MM\nMặt Carbon nh&aacute;m GEN 5 X100\nL&Otilde;I AIRFOAM ĐỘC QUYỀN&quot;,
            &quot;mo_ta_day_du&quot;: &quot;&lt;p style=\&quot;text-align: justify\&quot;&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;WIKA QD Air l&agrave; c&uacute; bắt tay ch&iacute;nh thức giữa Wika v&agrave; Quang Dương, đ&aacute;nh dấu bước tiến mới với c&acirc;y vợt l&otilde;i Full-Foam đầu ti&ecirc;n của h&atilde;ng. Sản phẩm được nghi&ecirc;n cứu v&agrave; tối ưu to&agrave;n diện nhằm mang đến tốc độ b&ugrave;ng nổ, cảm gi&aacute;c đ&aacute;nh chắc tay v&agrave; độ bền vượt trội cho lối chơi thi đấu hiện đại.&lt;/span&gt;&lt;/p&gt;\n&lt;p style=\&quot;text-align: justify\&quot;&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Vợt sở hữu mặt nh&aacute;m Carbon Gen 5 X100 cao cấp, gi&uacute;p người chơi dễ d&agrave;ng tạo xo&aacute;y, kiểm so&aacute;t b&oacute;ng tốt trong khi vẫn duy tr&igrave; độ bền nh&aacute;m l&acirc;u d&agrave;i. Lớp nền trong phủ thủy tinh cao cấp hỗ trợ tăng độ ổn định v&agrave; phản hồi b&oacute;ng r&otilde; r&agrave;ng hơn trong từng pha chạm.&lt;/span&gt;&lt;/p&gt;\n&lt;p style=\&quot;text-align: justify\&quot;&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;L&otilde;i AIRFOAM&trade; độc quyền mang lại độ bền cao, loại bỏ ho&agrave;n to&agrave;n t&igrave;nh trạng xẹp l&otilde;i sau thời gian d&agrave;i sử dụng, đảm bảo hiệu suất ổn định trong mọi điều kiện thi đấu. B&ecirc;n cạnh đ&oacute;, cấu tr&uacute;c l&otilde;i dạng &ldquo;kim tự th&aacute;p&rdquo; được bố tr&iacute; d&agrave;y đặc tại trung t&acirc;m mặt vợt v&agrave; thưa dần ra viền, gi&uacute;p mở rộng sweet spot v&agrave; tăng r&otilde; rệt tốc độ vung vợt.&lt;/span&gt;&lt;/p&gt;\n&lt;p style=\&quot;text-align: justify\&quot;&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Foam được k&eacute;o d&agrave;i s&acirc;u xuống phần c&aacute;n vợt, g&oacute;p phần gia tăng điểm ngọt, giảm rung hiệu quả v&agrave; mang lại cảm gi&aacute;c đ&aacute;nh đầm tay, chắc chắn hơn. Nhờ đ&oacute;, b&oacute;ng sau khi tiếp x&uacute;c c&oacute; gia tốc lớn, đi nhanh, cắm v&agrave; đầy uy lực, đặc biệt ph&ugrave; hợp với lối chơi tấn c&ocirc;ng tốc độ cao.&lt;/span&gt;&lt;/p&gt;\n&lt;p style=\&quot;text-align: justify\&quot;&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;WIKA QD Air l&agrave; lựa chọn d&agrave;nh cho những người chơi theo đuổi phong c&aacute;ch thi đấu mạnh mẽ, nơi tốc độ v&agrave; sự ch&iacute;nh x&aacute;c được đẩy l&ecirc;n tối đa, đ&uacute;ng tinh thần &ldquo;x&eacute; gi&oacute;&rdquo; của Quang Dương tr&ecirc;n s&acirc;n đấu.&lt;/span&gt;&lt;/p&gt;&quot;,
            &quot;gia_goc&quot;: &quot;4500000.00&quot;,
            &quot;gia_khuyen_mai&quot;: &quot;4200000.00&quot;,
            &quot;so_luong_ton_kho&quot;: 997,
            &quot;can_nang_kg&quot;: null,
            &quot;noi_bat&quot;: false,
            &quot;trang_thai&quot;: true,
            &quot;da_ban&quot;: 60,
            &quot;luot_xem&quot;: 104,
            &quot;diem_danh_gia&quot;: &quot;5.00&quot;,
            &quot;so_luot_danh_gia&quot;: 3,
            &quot;created_at&quot;: &quot;2026-01-02T08:25:19.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-03-19T08:37:32.000000Z&quot;,
            &quot;anh_chinh&quot;: {
                &quot;id&quot;: 235,
                &quot;san_pham_id&quot;: 30,
                &quot;duong_dan_anh&quot;: &quot;https://wikasports.com/wp-content/uploads/2026/02/vot-pickleball-wika-quang-duong-air-vang-9_optimized-scaled.jpg&quot;,
                &quot;chu_thich&quot;: null,
                &quot;thu_tu&quot;: 0,
                &quot;la_anh_chinh&quot;: true,
                &quot;created_at&quot;: &quot;2026-03-19 08:25:19&quot;,
                &quot;url&quot;: &quot;https://wikasports.com/wp-content/uploads/2026/02/vot-pickleball-wika-quang-duong-air-vang-9_optimized-scaled.jpg&quot;
            },
            &quot;danh_muc&quot;: {
                &quot;id&quot;: 18,
                &quot;danh_muc_cha_id&quot;: 16,
                &quot;ten&quot;: &quot;Vợt Pickleball&quot;,
                &quot;duong_dan&quot;: &quot;pickleball-vot-pickleball&quot;,
                &quot;hinh_anh&quot;: null,
                &quot;mo_ta&quot;: null,
                &quot;thu_tu&quot;: 2,
                &quot;trang_thai&quot;: true,
                &quot;created_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;
            }
        },
        {
            &quot;id&quot;: 58,
            &quot;danh_muc_id&quot;: 11,
            &quot;thuong_hieu_id&quot;: 2,
            &quot;ten_san_pham&quot;: &quot;&Aacute;o polo Wika Kairo Quang Dương xanh&quot;,
            &quot;duong_dan&quot;: &quot;ao-polo-wika-kairo-quang-duong-xanh-D6plsd1g&quot;,
            &quot;ma_sku&quot;: &quot;WIK-lQ5K5N-29412&quot;,
            &quot;mo_ta_ngan&quot;: &quot;Chất vải WI-DRYMAX (mới) co gi&atilde;n 4 chiều, tăng lượng lỗ tho&aacute;t kh&iacute;\nSợi vải mềm nhẹ, tho&aacute;ng kh&iacute;, giữ cảm gi&aacute;c dễ chịu trong suốt buổi tập.\nC&ocirc;ng nghệ Witech-Dry thấm h&uacute;t mồ h&ocirc;i si&ecirc;u tốc\nForm &aacute;o chuẩn Việt, t&ocirc;n d&aacute;ng thể thao cho cả nam &amp; nữ.\nPh&ugrave; hợp nhiều m&ocirc;n: Pickleball, cầu l&ocirc;ng, gym, chạy bộ&hellip;&quot;,
            &quot;mo_ta_day_du&quot;: &quot;&lt;p style=\&quot;text-align: justify\&quot;&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Bộ sưu tập Wika Kairo x Quang Dương mang đến một bước tiến mới trong thời trang thể thao hiện đại &ndash; nơi sự tinh giản, hiệu năng v&agrave; phong th&aacute;i chuy&ecirc;n nghiệp giao h&ograve;a ho&agrave;n hảo. Kh&ocirc;ng chỉ dừng lại ở một chiếc &aacute;o thể thao th&ocirc;ng thường, &aacute;o Polo Kairo l&agrave; biểu tượng của tinh thần bứt ph&aacute;, thể hiện c&aacute; t&iacute;nh mạnh mẽ v&agrave; phong th&aacute;i tự tin của người mặc tr&ecirc;n mọi mặt s&acirc;n.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;strong&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Thiết kế tinh giản &ndash; hiện đại v&agrave; kh&aacute;c biệt&lt;/span&gt;&lt;/strong&gt;&lt;/p&gt;\n&lt;p style=\&quot;text-align: justify\&quot;&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;&Aacute;o Polo Wika Kairo g&acirc;y ấn tượng ngay từ c&aacute;i nh&igrave;n đầu ti&ecirc;n với thiết kế tối giản nhưng độc đ&aacute;o. Thay v&igrave; sử dụng họa tiết phức tạp, Wika tập trung v&agrave;o những đường line tinh tế chạy dọc th&acirc;n &aacute;o &ndash; chi tiết nhỏ nhưng mang đến hiệu ứng thị gi&aacute;c mạnh mẽ, gi&uacute;p t&ocirc;n l&ecirc;n d&aacute;ng người thể thao v&agrave; tạo cảm gi&aacute;c chuyển động li&ecirc;n tục.&lt;/span&gt;&lt;/p&gt;\n&lt;p style=\&quot;text-align: justify\&quot;&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Sự kết hợp hai mảng m&agrave;u chủ đạo được xử l&yacute; tinh tế tạo n&ecirc;n diện mạo hiện đại, năng động v&agrave; đầy cuốn h&uacute;t. D&ugrave; l&agrave; tr&ecirc;n s&acirc;n tập, trong trận đấu hay khi tham gia c&aacute;c hoạt động ngo&agrave;i trời, Wika Kairo đều gi&uacute;p người mặc nổi bật với phong c&aacute;ch thời thượng nhưng kh&ocirc;ng ph&ocirc; trương.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;strong&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Chất liệu WI-DRYMAX &ndash; đột ph&aacute; trong c&ocirc;ng nghệ vải thể thao&lt;/span&gt;&lt;/strong&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Điểm kh&aacute;c biệt lớn nhất của &aacute;o Polo Kairo nằm ở chất liệu WI-DRYMAX thế hệ mới, được Wika nghi&ecirc;n cứu v&agrave; ph&aacute;t triển ri&ecirc;ng cho c&aacute;c d&ograve;ng sản phẩm thể thao cao cấp.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Co gi&atilde;n 4 chiều gi&uacute;p người mặc dễ d&agrave;ng di chuyển, xoay chuyển linh hoạt trong từng động t&aacute;c.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Tăng lượng lỗ tho&aacute;t kh&iacute; tr&ecirc;n bề mặt vải gi&uacute;p lưu th&ocirc;ng kh&ocirc;ng kh&iacute; hiệu quả, giữ cơ thể lu&ocirc;n kh&ocirc; tho&aacute;ng d&ugrave; vận động trong thời gian d&agrave;i.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Sợi vải mềm nhẹ, mang đến cảm gi&aacute;c dễ chịu, kh&ocirc;ng g&acirc;y k&iacute;ch ứng da v&agrave; ph&ugrave; hợp với mọi điều kiện thời tiết.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Với chất liệu n&agrave;y, &aacute;o thể thao Wika Kairo kh&ocirc;ng chỉ mang lại sự thoải m&aacute;i tối đa m&agrave; c&ograve;n gi&uacute;p n&acirc;ng cao hiệu suất luyện tập, giảm cảm gi&aacute;c b&iacute; b&aacute;ch &ndash; yếu tố m&agrave; những người chơi thể thao chuy&ecirc;n nghiệp lu&ocirc;n t&igrave;m kiếm.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;strong&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;C&ocirc;ng nghệ Witech-Dry &ndash; thấm h&uacute;t si&ecirc;u tốc, lu&ocirc;n kh&ocirc; r&aacute;o&lt;/span&gt;&lt;/strong&gt;&lt;/p&gt;\n&lt;p style=\&quot;text-align: justify\&quot;&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Được trang bị c&ocirc;ng nghệ Witech-Dry độc quyền, Polo Kairo c&oacute; khả năng thấm h&uacute;t v&agrave; bay hơi mồ h&ocirc;i si&ecirc;u nhanh, gi&uacute;p l&agrave;n da lu&ocirc;n kh&ocirc; tho&aacute;ng. Trong những buổi tập cường độ cao, bạn c&oacute; thể ho&agrave;n to&agrave;n y&ecirc;n t&acirc;m về cảm gi&aacute;c thoải m&aacute;i m&agrave; chiếc &aacute;o mang lại.&lt;/span&gt;&lt;/p&gt;\n&lt;p style=\&quot;text-align: justify\&quot;&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Nhờ cơ chế hoạt động th&ocirc;ng minh, c&aacute;c sợi vải sẽ tự động đẩy hơi ẩm ra ngo&agrave;i bề mặt để bay hơi, đồng thời ngăn kh&ocirc;ng cho mồ h&ocirc;i b&aacute;m ngược trở lại cơ thể. Ch&iacute;nh v&igrave; vậy, &aacute;o Polo Kairo lu&ocirc;n giữ được form d&aacute;ng gọn g&agrave;ng, kh&ocirc;ng nhăn nh&uacute;m hay bết d&iacute;nh trong qu&aacute; tr&igrave;nh vận động.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;strong&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Form &aacute;o chuẩn Việt &ndash; t&ocirc;n d&aacute;ng thể thao cho cả nam v&agrave; nữ&lt;/span&gt;&lt;/strong&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Wika hiểu r&otilde; v&oacute;c d&aacute;ng v&agrave; th&oacute;i quen vận động của người Việt, do đ&oacute; form &aacute;o Kairo được thiết kế theo chuẩn thể h&igrave;nh Việt Nam, đảm bảo vừa vặn v&agrave; t&ocirc;n d&aacute;ng tự nhi&ecirc;n.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Phần vai v&agrave; ngực được cắt may tinh tế gi&uacute;p t&ocirc;n l&ecirc;n vẻ mạnh mẽ, khỏe khoắn.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Eo &aacute;o được xử l&yacute; gọn g&agrave;ng gi&uacute;p người mặc tr&ocirc;ng cao v&agrave; c&acirc;n đối hơn.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Với khả năng ph&ugrave; hợp cho cả nam v&agrave; nữ, Polo Kairo trở th&agrave;nh lựa chọn l&yacute; tưởng cho c&aacute;c đội nh&oacute;m, c&acirc;u lạc bộ thể thao hoặc c&aacute;c buổi tập chung.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;strong&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Linh hoạt trong mọi hoạt động thể thao&lt;/span&gt;&lt;/strong&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Kh&ocirc;ng chỉ d&agrave;nh ri&ecirc;ng cho một m&ocirc;n thể thao, &aacute;o Wika Kairo l&agrave; sự lựa chọn ho&agrave;n hảo cho nhiều hoạt động kh&aacute;c nhau như:&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Pickleball &ndash; m&ocirc;n thể thao đang thịnh h&agrave;nh với y&ecirc;u cầu cao về sự linh hoạt v&agrave; tho&aacute;ng m&aacute;t.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Cầu l&ocirc;ng &ndash; hỗ trợ chuyển động nhanh, nhẹ v&agrave; ổn định.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Gym &amp; Fitness &ndash; co gi&atilde;n 4 chiều, thoải m&aacute;i trong mọi b&agrave;i tập.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Chạy bộ, thể dục ngo&agrave;i trời &ndash; chất liệu kh&ocirc; nhanh, dễ chịu trong mọi điều kiện thời tiết.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Từ những s&acirc;n chơi phong tr&agrave;o đến c&aacute;c giải đấu chuy&ecirc;n nghiệp, Wika Kairo x Quang Dương lu&ocirc;n mang lại cảm gi&aacute;c tự tin, chuy&ecirc;n nghiệp v&agrave; đầy năng lượng t&iacute;ch cực cho người mặc.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;strong&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Sự hợp t&aacute;c giữa Wika v&agrave; Quang Dương &ndash; khi thời trang gặp thể thao&lt;/span&gt;&lt;/strong&gt;&lt;/p&gt;\n&lt;p style=\&quot;text-align: justify\&quot;&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Sự kết hợp giữa thương hiệu Wika &ndash; nổi tiếng với c&aacute;c sản phẩm thể thao chất lượng cao &ndash; v&agrave; Quang Dương &ndash; gương mặt đại diện cho phong c&aacute;ch thể thao hiện đại &ndash; đ&atilde; tạo n&ecirc;n bản phối Kairo vừa mang t&iacute;nh thẩm mỹ, vừa đ&aacute;p ứng y&ecirc;u cầu khắt khe về hiệu năng.&lt;/span&gt;&lt;/p&gt;\n&lt;p style=\&quot;text-align: justify\&quot;&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Mỗi chi tiết tr&ecirc;n &aacute;o đều được c&acirc;n nhắc kỹ lưỡng để đạt được sự c&acirc;n bằng giữa thiết kế v&agrave; c&ocirc;ng năng, giữa thời trang v&agrave; thể thao. Đ&acirc;y kh&ocirc;ng chỉ l&agrave; chiếc &aacute;o mặc để tập luyện, m&agrave; c&ograve;n l&agrave; tuy&ecirc;n ng&ocirc;n phong c&aacute;ch của những người y&ecirc;u vận động v&agrave; hướng đến sự ho&agrave;n thiện.&lt;/span&gt;&lt;/p&gt;\n&lt;p style=\&quot;text-align: justify\&quot;&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;&Aacute;o Polo Wika Kairo x Quang Dương kh&ocirc;ng chỉ l&agrave; một sản phẩm thể thao, m&agrave; l&agrave; sự lựa chọn của những người hiện đại &ndash; những người muốn khẳng định phong th&aacute;i chuy&ecirc;n nghiệp, tinh giản v&agrave; kh&aacute;c biệt. Với chất liệu ti&ecirc;n tiến, thiết kế tinh tế v&agrave; c&ocirc;ng nghệ hỗ trợ hiệu suất tối đa, Wika Kairo xứng đ&aacute;ng l&agrave; người bạn đồng h&agrave;nh trong mọi h&agrave;nh tr&igrave;nh luyện tập v&agrave; thi đấu.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Tự tin &ndash; Năng động &ndash; Chuy&ecirc;n nghiệp, đ&oacute; l&agrave; tinh thần m&agrave; Wika Kairo mang đến cho bạn.&lt;/span&gt;&lt;/p&gt;&quot;,
            &quot;gia_goc&quot;: &quot;399000.00&quot;,
            &quot;gia_khuyen_mai&quot;: &quot;359000.00&quot;,
            &quot;so_luong_ton_kho&quot;: 997,
            &quot;can_nang_kg&quot;: null,
            &quot;noi_bat&quot;: false,
            &quot;trang_thai&quot;: true,
            &quot;da_ban&quot;: 4,
            &quot;luot_xem&quot;: 98,
            &quot;diem_danh_gia&quot;: &quot;4.20&quot;,
            &quot;so_luot_danh_gia&quot;: 5,
            &quot;created_at&quot;: &quot;2026-02-04T08:25:19.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-03-19T08:25:21.000000Z&quot;,
            &quot;anh_chinh&quot;: {
                &quot;id&quot;: 380,
                &quot;san_pham_id&quot;: 58,
                &quot;duong_dan_anh&quot;: &quot;https://wikasports.com/wp-content/uploads/2025/11/ao-polo-wika-kairo-quang-duong-xanh-1_optimized.jpg&quot;,
                &quot;chu_thich&quot;: null,
                &quot;thu_tu&quot;: 0,
                &quot;la_anh_chinh&quot;: true,
                &quot;created_at&quot;: &quot;2026-03-19 08:25:19&quot;,
                &quot;url&quot;: &quot;https://wikasports.com/wp-content/uploads/2025/11/ao-polo-wika-kairo-quang-duong-xanh-1_optimized.jpg&quot;
            },
            &quot;danh_muc&quot;: {
                &quot;id&quot;: 11,
                &quot;danh_muc_cha_id&quot;: 8,
                &quot;ten&quot;: &quot;&Aacute;o Polo&quot;,
                &quot;duong_dan&quot;: &quot;bong-da-ao-polo&quot;,
                &quot;hinh_anh&quot;: null,
                &quot;mo_ta&quot;: null,
                &quot;thu_tu&quot;: 3,
                &quot;trang_thai&quot;: true,
                &quot;created_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;
            }
        },
        {
            &quot;id&quot;: 65,
            &quot;danh_muc_id&quot;: 10,
            &quot;thuong_hieu_id&quot;: 2,
            &quot;ten_san_pham&quot;: &quot;&Aacute;o thể thao Wika Xvolt trắng t&iacute;m&quot;,
            &quot;duong_dan&quot;: &quot;ao-wika-xvolt-trang-tim-C6e1piMm&quot;,
            &quot;ma_sku&quot;: &quot;WIK-A42f6s-29191&quot;,
            &quot;mo_ta_ngan&quot;: &quot;&Aacute;o thể thao WIKA XVOLT mang cảm hứng &ldquo;Volt&rdquo; &ndash; tốc độ, sức mạnh v&agrave; tinh thần bứt ph&aacute;.\nChất liệu WI-DRYMAX co gi&atilde;n 4 chiều, tho&aacute;ng kh&iacute; v&agrave; thấm h&uacute;t mồ h&ocirc;i si&ecirc;u tốc.\nHọa tiết tia s&eacute;t chạy dọc th&acirc;n &aacute;o thể hiện năng lượng v&agrave; c&aacute; t&iacute;nh người chơi.\nForm chuẩn Việt, t&ocirc;n d&aacute;ng thể thao cho cả nam v&agrave; nữ.\nPh&ugrave; hợp nhiều m&ocirc;n: pickleball, cầu l&ocirc;ng, gym, chạy bộ v&agrave; c&aacute;c hoạt động ngo&agrave;i trời.&quot;,
            &quot;mo_ta_day_du&quot;: &quot;&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Khi Linh Muối v&agrave; Tr&iacute; Chuột &ndash; hai phong c&aacute;ch, hai c&aacute; t&iacute;nh kh&aacute;c biệt &ndash; c&ugrave;ng kho&aacute;c l&ecirc;n m&igrave;nh chiếc &aacute;o WIKA XVOLT, s&acirc;n đấu như bừng l&ecirc;n nguồn điện mới. Kh&ocirc;ng chỉ l&agrave; trang phục thể thao, XVolt l&agrave; biểu tượng của tốc độ, sức mạnh v&agrave; tinh thần bứt ph&aacute; &ndash; nơi mỗi chuyển động đều mang trong m&igrave;nh năng lượng &ldquo;Volt&rdquo; m&atilde;nh liệt.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Họa tiết tia s&eacute;t chạy dọc th&acirc;n &aacute;o ch&iacute;nh l&agrave; tuy&ecirc;n ng&ocirc;n của những người chơi kh&ocirc;ng ngừng tiến l&ecirc;n. Mỗi đường n&eacute;t được thiết kế để khắc họa DNA &ldquo;Volt&rdquo;: nhiệt huyết, mạnh mẽ v&agrave; đầy đam m&ecirc;.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;strong&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;C&ocirc;ng nghệ &amp; chất liệu &ndash; Hiệu suất vượt trội&lt;/span&gt;&lt;/strong&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Vải WI-DRYMAX (phi&ecirc;n bản mới): co gi&atilde;n 4 chiều, gia tăng số lượng lỗ tho&aacute;t kh&iacute;, gi&uacute;p bạn di chuyển linh hoạt trong mọi trận đấu.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Sợi vải mềm nhẹ, tho&aacute;ng kh&iacute;, mang lại cảm gi&aacute;c dễ chịu d&ugrave; tập luyện cường độ cao.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;C&ocirc;ng nghệ Witech-Dry: thấm h&uacute;t mồ h&ocirc;i si&ecirc;u tốc, giữ cơ thể lu&ocirc;n kh&ocirc; r&aacute;o v&agrave; tr&agrave;n đầy năng lượng.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Form &aacute;o chuẩn Việt: t&ocirc;n d&aacute;ng thể thao, ph&ugrave; hợp cho cả nam v&agrave; nữ.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Đa năng &ndash; Chuẩn phong c&aacute;ch vận động hiện đại&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Từ pickleball, cầu l&ocirc;ng, gym, chạy bộ đến c&aacute;c hoạt động ngo&agrave;i trời, WIKA XVOLT l&agrave; lựa chọn ho&agrave;n hảo cho những ai muốn kết hợp hiệu năng v&agrave; thời trang.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;WIKA XVOLT &ndash; kh&ocirc;ng chỉ l&agrave; &aacute;o thể thao, m&agrave; l&agrave; nguồn năng lượng dẫn nhịp cho mọi s&acirc;n đấu. &lt;/span&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Bạn sẵn s&agrave;ng k&iacute;ch hoạt &ldquo;Volt Mode&rdquo; của ri&ecirc;ng m&igrave;nh chưa?&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;img class=\&quot;size-full wp-image-18802 aligncenter\&quot; src=\&quot;https://wikasports.com/wp-content/uploads/2024/12/bang-size-ao-the-thao.jpg\&quot; alt=\&quot;bang-size-ao-the-thao\&quot; width=\&quot;646\&quot; height=\&quot;383\&quot; /&gt;&lt;/p&gt;&quot;,
            &quot;gia_goc&quot;: &quot;399000.00&quot;,
            &quot;gia_khuyen_mai&quot;: &quot;359000.00&quot;,
            &quot;so_luong_ton_kho&quot;: 995,
            &quot;can_nang_kg&quot;: null,
            &quot;noi_bat&quot;: false,
            &quot;trang_thai&quot;: true,
            &quot;da_ban&quot;: 23,
            &quot;luot_xem&quot;: 98,
            &quot;diem_danh_gia&quot;: &quot;5.00&quot;,
            &quot;so_luot_danh_gia&quot;: 3,
            &quot;created_at&quot;: &quot;2026-01-27T08:25:19.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-03-19T08:25:21.000000Z&quot;,
            &quot;anh_chinh&quot;: {
                &quot;id&quot;: 407,
                &quot;san_pham_id&quot;: 65,
                &quot;duong_dan_anh&quot;: &quot;https://wikasports.com/wp-content/uploads/2025/11/ao-wika-xvolt-trang-tim-1.png&quot;,
                &quot;chu_thich&quot;: null,
                &quot;thu_tu&quot;: 0,
                &quot;la_anh_chinh&quot;: true,
                &quot;created_at&quot;: &quot;2026-03-19 08:25:19&quot;,
                &quot;url&quot;: &quot;https://wikasports.com/wp-content/uploads/2025/11/ao-wika-xvolt-trang-tim-1.png&quot;
            },
            &quot;danh_muc&quot;: {
                &quot;id&quot;: 10,
                &quot;danh_muc_cha_id&quot;: 8,
                &quot;ten&quot;: &quot;&Aacute;o b&oacute;ng đ&aacute;&quot;,
                &quot;duong_dan&quot;: &quot;bong-da-ao-bong-da&quot;,
                &quot;hinh_anh&quot;: null,
                &quot;mo_ta&quot;: null,
                &quot;thu_tu&quot;: 2,
                &quot;trang_thai&quot;: true,
                &quot;created_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;
            }
        },
        {
            &quot;id&quot;: 84,
            &quot;danh_muc_id&quot;: 10,
            &quot;thuong_hieu_id&quot;: 2,
            &quot;ten_san_pham&quot;: &quot;&Aacute;o thể thao Wika Quang Dương Glimor v&agrave;ng&quot;,
            &quot;duong_dan&quot;: &quot;ao-wika-glimor-vang-3P0BuDxA&quot;,
            &quot;ma_sku&quot;: &quot;WIK-JePtCI-28128&quot;,
            &quot;mo_ta_ngan&quot;: &quot;Chất vải WI-DRYMAX (mới) co gi&atilde;n 4 chiều, tăng lượng lỗ tho&aacute;t kh&iacute;\nSợi vải mềm nhẹ, tho&aacute;ng kh&iacute;, giữ cảm gi&aacute;c dễ chịu trong suốt buổi tập.\nC&ocirc;ng nghệ Witech-Dry thấm h&uacute;t mồ h&ocirc;i si&ecirc;u tốc\nForm &aacute;o chuẩn Việt, t&ocirc;n d&aacute;ng thể thao cho cả nam &amp; nữ.\nPh&ugrave; hợp nhiều m&ocirc;n: Pickleball, cầu l&ocirc;ng, gym, chạy bộ&hellip;&quot;,
            &quot;mo_ta_day_du&quot;: &quot;&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;&Aacute;o Thể Thao WIKA Glimor &ndash; Nổi Bật Từng Khoảnh Khắc Thi Đấu&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;&Aacute;o thể thao WIKA Glimor được thiết kế d&agrave;nh cho những người y&ecirc;u vận động, mang lại sự thoải m&aacute;i v&agrave; phong c&aacute;ch trong cả tập luyện lẫn thi đấu. Sản phẩm nổi bật với tay &aacute;o raglan phối m&agrave;u gradient, tạo hiệu ứng chuyển sắc mềm mại gi&uacute;p từng chuyển động tr&ecirc;n s&acirc;n th&ecirc;m cuốn h&uacute;t.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Điểm mạnh của WIKA Glimor nằm ở sự kết hợp giữa c&ocirc;ng nghệ ti&ecirc;n tiến v&agrave; chất liệu cao cấp:&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Chất vải WI-DRYMAX thế hệ mới, co gi&atilde;n 4 chiều, tăng cường độ tho&aacute;ng kh&iacute;.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Sợi vải mềm nhẹ, tho&aacute;ng m&aacute;t, giữ cảm gi&aacute;c dễ chịu trong suốt qu&aacute; tr&igrave;nh vận động.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;C&ocirc;ng nghệ Witech-Dry thấm h&uacute;t mồ h&ocirc;i si&ecirc;u tốc, gi&uacute;p cơ thể lu&ocirc;n kh&ocirc; r&aacute;o.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Form &aacute;o chuẩn d&agrave;nh cho v&oacute;c d&aacute;ng người Việt, t&ocirc;n d&aacute;ng thể thao cho cả nam v&agrave; nữ.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Ph&ugrave; hợp với nhiều m&ocirc;n thể thao như pickleball, cầu l&ocirc;ng, gym, chạy bộ v&agrave; c&aacute;c hoạt động ngo&agrave;i trời kh&aacute;c.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=\&quot;font-size: 100%;color: #000000\&quot;&gt;Với thiết kế hiện đại c&ugrave;ng t&iacute;nh năng vượt trội, &aacute;o thể thao WIKA Glimor kh&ocirc;ng chỉ đ&aacute;p ứng nhu cầu vận động m&agrave; c&ograve;n khẳng định phong c&aacute;ch thời trang năng động của người chơi.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;img class=\&quot;size-full wp-image-3552 aligncenter\&quot; src=\&quot;https://wikasports.com/wp-content/uploads/2021/06/bang-size-ao-wika-sports-1.jpg\&quot; alt=\&quot;bang-size-ao-wika-sports-1\&quot; width=\&quot;1024\&quot; height=\&quot;336\&quot; /&gt;&lt;/p&gt;&quot;,
            &quot;gia_goc&quot;: &quot;399000.00&quot;,
            &quot;gia_khuyen_mai&quot;: &quot;359000.00&quot;,
            &quot;so_luong_ton_kho&quot;: 996,
            &quot;can_nang_kg&quot;: null,
            &quot;noi_bat&quot;: false,
            &quot;trang_thai&quot;: true,
            &quot;da_ban&quot;: 90,
            &quot;luot_xem&quot;: 99,
            &quot;diem_danh_gia&quot;: &quot;4.67&quot;,
            &quot;so_luot_danh_gia&quot;: 3,
            &quot;created_at&quot;: &quot;2026-01-16T08:25:19.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-03-19T08:25:21.000000Z&quot;,
            &quot;anh_chinh&quot;: {
                &quot;id&quot;: 509,
                &quot;san_pham_id&quot;: 84,
                &quot;duong_dan_anh&quot;: &quot;https://wikasports.com/wp-content/uploads/2025/09/ao-wika-quang-duong-glimor-vang_optimized.jpg&quot;,
                &quot;chu_thich&quot;: null,
                &quot;thu_tu&quot;: 0,
                &quot;la_anh_chinh&quot;: true,
                &quot;created_at&quot;: &quot;2026-03-19 08:25:19&quot;,
                &quot;url&quot;: &quot;https://wikasports.com/wp-content/uploads/2025/09/ao-wika-quang-duong-glimor-vang_optimized.jpg&quot;
            },
            &quot;danh_muc&quot;: {
                &quot;id&quot;: 10,
                &quot;danh_muc_cha_id&quot;: 8,
                &quot;ten&quot;: &quot;&Aacute;o b&oacute;ng đ&aacute;&quot;,
                &quot;duong_dan&quot;: &quot;bong-da-ao-bong-da&quot;,
                &quot;hinh_anh&quot;: null,
                &quot;mo_ta&quot;: null,
                &quot;thu_tu&quot;: 2,
                &quot;trang_thai&quot;: true,
                &quot;created_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;
            }
        },
        {
            &quot;id&quot;: 122,
            &quot;danh_muc_id&quot;: 14,
            &quot;thuong_hieu_id&quot;: 4,
            &quot;ten_san_pham&quot;: &quot;Gi&agrave;y B&oacute;ng Đ&aacute; Kaiwin Tiến Linh TL22 Pro - M&agrave;u Xanh Ngọc&quot;,
            &quot;duong_dan&quot;: &quot;giay-bong-da-kaiwin-tien-linh-tl22-pro-mau-xanh-ngoc-Y4ZPvdIM&quot;,
            &quot;ma_sku&quot;: &quot;KAI-yOJeZs-2002&quot;,
            &quot;mo_ta_ngan&quot;: &quot;Phi&ecirc;n bản gi&agrave;y b&oacute;ng đ&aacute; cao cấp đồng h&agrave;nh c&ugrave;ng tuyển thủ Tiến Linh.&quot;,
            &quot;mo_ta_day_du&quot;: &quot;&lt;p&gt;D&ograve;ng gi&agrave;y TL22 Pro được thiết kế ri&ecirc;ng với c&aacute;c c&ocirc;ng nghệ hỗ trợ bứt tốc v&agrave; bảo vệ cổ ch&acirc;n, ph&ugrave; hợp cho lối chơi tấn c&ocirc;ng mạnh mẽ.&lt;/p&gt;&quot;,
            &quot;gia_goc&quot;: &quot;669000.00&quot;,
            &quot;gia_khuyen_mai&quot;: null,
            &quot;so_luong_ton_kho&quot;: 996,
            &quot;can_nang_kg&quot;: null,
            &quot;noi_bat&quot;: false,
            &quot;trang_thai&quot;: true,
            &quot;da_ban&quot;: 72,
            &quot;luot_xem&quot;: 100,
            &quot;diem_danh_gia&quot;: &quot;4.20&quot;,
            &quot;so_luot_danh_gia&quot;: 5,
            &quot;created_at&quot;: &quot;2026-01-06T08:25:19.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-03-19T08:25:22.000000Z&quot;,
            &quot;anh_chinh&quot;: {
                &quot;id&quot;: 632,
                &quot;san_pham_id&quot;: 122,
                &quot;duong_dan_anh&quot;: &quot;https://bizweb.dktcdn.net/thumb/large/100/017/070/products/tl22-pro-xanh.jpg&quot;,
                &quot;chu_thich&quot;: null,
                &quot;thu_tu&quot;: 0,
                &quot;la_anh_chinh&quot;: true,
                &quot;created_at&quot;: &quot;2026-03-19 08:25:19&quot;,
                &quot;url&quot;: &quot;https://bizweb.dktcdn.net/thumb/large/100/017/070/products/tl22-pro-xanh.jpg&quot;
            },
            &quot;danh_muc&quot;: {
                &quot;id&quot;: 14,
                &quot;danh_muc_cha_id&quot;: 8,
                &quot;ten&quot;: &quot;Gi&agrave;y b&oacute;ng đ&aacute;&quot;,
                &quot;duong_dan&quot;: &quot;bong-da-giay-bong-da&quot;,
                &quot;hinh_anh&quot;: null,
                &quot;mo_ta&quot;: null,
                &quot;thu_tu&quot;: 6,
                &quot;trang_thai&quot;: true,
                &quot;created_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;
            }
        },
        {
            &quot;id&quot;: 127,
            &quot;danh_muc_id&quot;: 25,
            &quot;thuong_hieu_id&quot;: 4,
            &quot;ten_san_pham&quot;: &quot;Balo Thể Thao Kaiwin Technology - M&agrave;u Đỏ&quot;,
            &quot;duong_dan&quot;: &quot;balo-the-thao-kaiwin-technology-mau-do-KUCzWKiF&quot;,
            &quot;ma_sku&quot;: &quot;KAI-X1yDjk-2007&quot;,
            &quot;mo_ta_ngan&quot;: &quot;Balo thể thao đa năng với ngăn chứa gi&agrave;y ri&ecirc;ng biệt.&quot;,
            &quot;mo_ta_day_du&quot;: &quot;&lt;p&gt;Balo Kaiwin Technology được thiết kế với nhiều ngăn th&ocirc;ng minh, chất liệu chống thấm nước nhẹ, mang lại sự tiện &iacute;ch tối đa cho người d&ugrave;ng.&lt;/p&gt;&quot;,
            &quot;gia_goc&quot;: &quot;358000.00&quot;,
            &quot;gia_khuyen_mai&quot;: null,
            &quot;so_luong_ton_kho&quot;: 998,
            &quot;can_nang_kg&quot;: null,
            &quot;noi_bat&quot;: false,
            &quot;trang_thai&quot;: true,
            &quot;da_ban&quot;: 2,
            &quot;luot_xem&quot;: 99,
            &quot;diem_danh_gia&quot;: &quot;4.00&quot;,
            &quot;so_luot_danh_gia&quot;: 3,
            &quot;created_at&quot;: &quot;2026-01-24T08:25:19.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-03-19T08:25:22.000000Z&quot;,
            &quot;anh_chinh&quot;: {
                &quot;id&quot;: 642,
                &quot;san_pham_id&quot;: 127,
                &quot;duong_dan_anh&quot;: &quot;https://bizweb.dktcdn.net/100/017/070/products/balo-technology-do2.jpg?v=1755613598240&quot;,
                &quot;chu_thich&quot;: null,
                &quot;thu_tu&quot;: 0,
                &quot;la_anh_chinh&quot;: true,
                &quot;created_at&quot;: &quot;2026-03-19 08:25:19&quot;,
                &quot;url&quot;: &quot;https://bizweb.dktcdn.net/100/017/070/products/balo-technology-do2.jpg?v=1755613598240&quot;
            },
            &quot;danh_muc&quot;: {
                &quot;id&quot;: 25,
                &quot;danh_muc_cha_id&quot;: 23,
                &quot;ten&quot;: &quot;Balo - T&uacute;i thể thao&quot;,
                &quot;duong_dan&quot;: &quot;phu-kien-balo-tui-the-thao&quot;,
                &quot;hinh_anh&quot;: null,
                &quot;mo_ta&quot;: null,
                &quot;thu_tu&quot;: 2,
                &quot;trang_thai&quot;: true,
                &quot;created_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;
            }
        },
        {
            &quot;id&quot;: 142,
            &quot;danh_muc_id&quot;: 12,
            &quot;thuong_hieu_id&quot;: 3,
            &quot;ten_san_pham&quot;: &quot;Bộ B&oacute;ng Đ&aacute; Kamito Striker 01&quot;,
            &quot;duong_dan&quot;: &quot;bo-bong-da-kamito-striker-01-V2yYQ984&quot;,
            &quot;ma_sku&quot;: &quot;KAM-wi4cH5-1002&quot;,
            &quot;mo_ta_ngan&quot;: &quot;Bộ B&oacute;ng Đ&aacute; Kamito Striker 01&quot;,
            &quot;mo_ta_day_du&quot;: &quot;&lt;p&gt;Bộ đồ b&oacute;ng đ&aacute; Striker 01 được tạo ra cho những cầu thủ lu&ocirc;n muốn chủ động thế trận&mdash;từ những pha tăng tốc b&aacute;m bi&ecirc;n, c&aacute;c t&igrave;nh huống pressing li&ecirc;n tục...&lt;/p&gt;&quot;,
            &quot;gia_goc&quot;: &quot;259000.00&quot;,
            &quot;gia_khuyen_mai&quot;: null,
            &quot;so_luong_ton_kho&quot;: 996,
            &quot;can_nang_kg&quot;: null,
            &quot;noi_bat&quot;: false,
            &quot;trang_thai&quot;: true,
            &quot;da_ban&quot;: 11,
            &quot;luot_xem&quot;: 99,
            &quot;diem_danh_gia&quot;: &quot;5.00&quot;,
            &quot;so_luot_danh_gia&quot;: 1,
            &quot;created_at&quot;: &quot;2026-02-14T08:25:19.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-03-19T08:25:22.000000Z&quot;,
            &quot;anh_chinh&quot;: {
                &quot;id&quot;: 672,
                &quot;san_pham_id&quot;: 142,
                &quot;duong_dan_anh&quot;: &quot;https://cdn.hstatic.net/products/1000341630/variant_navy_1_c389f0a326d045c79b1b54bf2a164b74.jpg&quot;,
                &quot;chu_thich&quot;: null,
                &quot;thu_tu&quot;: 0,
                &quot;la_anh_chinh&quot;: true,
                &quot;created_at&quot;: &quot;2026-03-19 08:25:19&quot;,
                &quot;url&quot;: &quot;https://cdn.hstatic.net/products/1000341630/variant_navy_1_c389f0a326d045c79b1b54bf2a164b74.jpg&quot;
            },
            &quot;danh_muc&quot;: {
                &quot;id&quot;: 12,
                &quot;danh_muc_cha_id&quot;: 8,
                &quot;ten&quot;: &quot;Quần &aacute;o b&oacute;ng đ&aacute;&quot;,
                &quot;duong_dan&quot;: &quot;bong-da-quan-ao-bong-da&quot;,
                &quot;hinh_anh&quot;: null,
                &quot;mo_ta&quot;: null,
                &quot;thu_tu&quot;: 4,
                &quot;trang_thai&quot;: true,
                &quot;created_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;
            }
        },
        {
            &quot;id&quot;: 159,
            &quot;danh_muc_id&quot;: 7,
            &quot;thuong_hieu_id&quot;: 3,
            &quot;ten_san_pham&quot;: &quot;Gi&agrave;y Thể Thao Kamito Amazing Khau Phạ&quot;,
            &quot;duong_dan&quot;: &quot;giay-the-thao-kamito-amazing-khau-pha-2alkzBLX&quot;,
            &quot;ma_sku&quot;: &quot;KAM-y6Ce4Z-1019&quot;,
            &quot;mo_ta_ngan&quot;: &quot;Gi&agrave;y Thể Thao Kamito Amazing Khau Phạ&quot;,
            &quot;mo_ta_day_du&quot;: &quot;&lt;p&gt;Gi&agrave;y chạy bộ Amazing phi&ecirc;n bản Khau Phạ với t&ocirc;ng m&agrave;u nổi bật, &ecirc;m &aacute;i v&agrave; trợ lực cực tốt.&lt;/p&gt;&quot;,
            &quot;gia_goc&quot;: &quot;990000.00&quot;,
            &quot;gia_khuyen_mai&quot;: &quot;396000.00&quot;,
            &quot;so_luong_ton_kho&quot;: 995,
            &quot;can_nang_kg&quot;: null,
            &quot;noi_bat&quot;: false,
            &quot;trang_thai&quot;: true,
            &quot;da_ban&quot;: 101,
            &quot;luot_xem&quot;: 94,
            &quot;diem_danh_gia&quot;: &quot;4.20&quot;,
            &quot;so_luot_danh_gia&quot;: 5,
            &quot;created_at&quot;: &quot;2026-03-18T08:25:19.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-04-01T14:26:31.000000Z&quot;,
            &quot;anh_chinh&quot;: {
                &quot;id&quot;: 710,
                &quot;san_pham_id&quot;: 159,
                &quot;duong_dan_anh&quot;: &quot;https://product.hstatic.net/1000341630/product/dsc08877_6444a5f7e6fa434487e5e92fb9ef48d3.jpg&quot;,
                &quot;chu_thich&quot;: null,
                &quot;thu_tu&quot;: 0,
                &quot;la_anh_chinh&quot;: true,
                &quot;created_at&quot;: &quot;2026-04-01 21:14:40&quot;,
                &quot;url&quot;: &quot;https://product.hstatic.net/1000341630/product/dsc08877_6444a5f7e6fa434487e5e92fb9ef48d3.jpg&quot;
            },
            &quot;danh_muc&quot;: {
                &quot;id&quot;: 7,
                &quot;danh_muc_cha_id&quot;: 5,
                &quot;ten&quot;: &quot;Gi&agrave;y chạy bộ&quot;,
                &quot;duong_dan&quot;: &quot;chay-bo-giay-chay-bo&quot;,
                &quot;hinh_anh&quot;: null,
                &quot;mo_ta&quot;: null,
                &quot;thu_tu&quot;: 2,
                &quot;trang_thai&quot;: true,
                &quot;created_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2026-03-19T08:25:13.000000Z&quot;
            }
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-recommendations" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-recommendations"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-recommendations"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-recommendations" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-recommendations">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-recommendations" data-method="GET"
      data-path="api/v1/recommendations"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-recommendations', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-recommendations"
                    onclick="tryItOut('GETapi-v1-recommendations');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-recommendations"
                    onclick="cancelTryOut('GETapi-v1-recommendations');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-recommendations"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/recommendations</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-recommendations"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-recommendations"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-v1-recommendations--productId--related">Lấy sản phẩm tương tự (cho trang chi tiết sản phẩm).</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-recommendations--productId--related">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/recommendations/architecto/related" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/recommendations/architecto/related"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-recommendations--productId--related">
            <blockquote>
            <p>Example response (500):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Server Error&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-recommendations--productId--related" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-recommendations--productId--related"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-recommendations--productId--related"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-recommendations--productId--related" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-recommendations--productId--related">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-recommendations--productId--related" data-method="GET"
      data-path="api/v1/recommendations/{productId}/related"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-recommendations--productId--related', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-recommendations--productId--related"
                    onclick="tryItOut('GETapi-v1-recommendations--productId--related');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-recommendations--productId--related"
                    onclick="cancelTryOut('GETapi-v1-recommendations--productId--related');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-recommendations--productId--related"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/recommendations/{productId}/related</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-recommendations--productId--related"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-recommendations--productId--related"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>productId</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="productId"                data-endpoint="GETapi-v1-recommendations--productId--related"
               value="architecto"
               data-component="url">
    <br>
<p>Example: <code>architecto</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-POSTapi-v1-behaviors">Ghi nhận hành vi người dùng cho ML.</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-behaviors">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/v1/behaviors" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"san_pham_id\": 16,
    \"hanh_vi\": \"them_gio_hang\",
    \"thoi_gian_xem_s\": 39
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/behaviors"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "san_pham_id": 16,
    "hanh_vi": "them_gio_hang",
    "thoi_gian_xem_s": 39
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-behaviors">
</span>
<span id="execution-results-POSTapi-v1-behaviors" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-behaviors"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-behaviors"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-behaviors" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-behaviors">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-behaviors" data-method="POST"
      data-path="api/v1/behaviors"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-behaviors', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-behaviors"
                    onclick="tryItOut('POSTapi-v1-behaviors');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-behaviors"
                    onclick="cancelTryOut('POSTapi-v1-behaviors');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-behaviors"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/behaviors</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-behaviors"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-behaviors"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>san_pham_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="san_pham_id"                data-endpoint="POSTapi-v1-behaviors"
               value="16"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the san_pham table. Example: <code>16</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>hanh_vi</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="hanh_vi"                data-endpoint="POSTapi-v1-behaviors"
               value="them_gio_hang"
               data-component="body">
    <br>
<p>Example: <code>them_gio_hang</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>xem</code></li> <li><code>click</code></li> <li><code>them_gio_hang</code></li> <li><code>mua_hang</code></li> <li><code>yeu_thich</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>thoi_gian_xem_s</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="thoi_gian_xem_s"                data-endpoint="POSTapi-v1-behaviors"
               value="39"
               data-component="body">
    <br>
<p>Must be at least 0. Example: <code>39</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTapi-v1-payments-create-url">Tạo URL thanh toán cho đơn hàng</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-payments-create-url">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/v1/payments/create-url" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"ma_don_hang\": \"architecto\",
    \"phuong_thuc\": \"vnpay\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/payments/create-url"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "ma_don_hang": "architecto",
    "phuong_thuc": "vnpay"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-payments-create-url">
</span>
<span id="execution-results-POSTapi-v1-payments-create-url" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-payments-create-url"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-payments-create-url"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-payments-create-url" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-payments-create-url">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-payments-create-url" data-method="POST"
      data-path="api/v1/payments/create-url"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-payments-create-url', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-payments-create-url"
                    onclick="tryItOut('POSTapi-v1-payments-create-url');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-payments-create-url"
                    onclick="cancelTryOut('POSTapi-v1-payments-create-url');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-payments-create-url"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/payments/create-url</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-payments-create-url"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-payments-create-url"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>ma_don_hang</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="ma_don_hang"                data-endpoint="POSTapi-v1-payments-create-url"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>ma_don_hang</code> of an existing record in the don_hang table. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>phuong_thuc</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="phuong_thuc"                data-endpoint="POSTapi-v1-payments-create-url"
               value="vnpay"
               data-component="body">
    <br>
<p>Example: <code>vnpay</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>momo</code></li> <li><code>vnpay</code></li></ul>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-v1-payments-vnpay-return">VNPay Callback (Redirect sau khi thanh toán)</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-payments-vnpay-return">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/payments/vnpay-return" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/payments/vnpay-return"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-payments-vnpay-return">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-payments-vnpay-return" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-payments-vnpay-return"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-payments-vnpay-return"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-payments-vnpay-return" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-payments-vnpay-return">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-payments-vnpay-return" data-method="GET"
      data-path="api/v1/payments/vnpay-return"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-payments-vnpay-return', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-payments-vnpay-return"
                    onclick="tryItOut('GETapi-v1-payments-vnpay-return');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-payments-vnpay-return"
                    onclick="cancelTryOut('GETapi-v1-payments-vnpay-return');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-payments-vnpay-return"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/payments/vnpay-return</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-payments-vnpay-return"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-payments-vnpay-return"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-v1-payments-momo-return">MoMo Return (Client Redirect)
Xác thực khi Client Frontend bị redirect về từ app momo.</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-payments-momo-return">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/payments/momo-return" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/payments/momo-return"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-payments-momo-return">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-payments-momo-return" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-payments-momo-return"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-payments-momo-return"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-payments-momo-return" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-payments-momo-return">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-payments-momo-return" data-method="GET"
      data-path="api/v1/payments/momo-return"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-payments-momo-return', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-payments-momo-return"
                    onclick="tryItOut('GETapi-v1-payments-momo-return');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-payments-momo-return"
                    onclick="cancelTryOut('GETapi-v1-payments-momo-return');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-payments-momo-return"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/payments/momo-return</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-payments-momo-return"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-payments-momo-return"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-v1-payments-momo-ipn">MoMo IPN/Callback (Xử lý khi MoMo gọi back)</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-payments-momo-ipn">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/v1/payments/momo-ipn" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/payments/momo-ipn"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-payments-momo-ipn">
</span>
<span id="execution-results-POSTapi-v1-payments-momo-ipn" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-payments-momo-ipn"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-payments-momo-ipn"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-payments-momo-ipn" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-payments-momo-ipn">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-payments-momo-ipn" data-method="POST"
      data-path="api/v1/payments/momo-ipn"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-payments-momo-ipn', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-payments-momo-ipn"
                    onclick="tryItOut('POSTapi-v1-payments-momo-ipn');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-payments-momo-ipn"
                    onclick="cancelTryOut('POSTapi-v1-payments-momo-ipn');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-payments-momo-ipn"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/payments/momo-ipn</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-payments-momo-ipn"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-payments-momo-ipn"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-v1-admin-upload">Upload ảnh</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-admin-upload">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/v1/admin/upload" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --form "folder=architecto"\
    --form "image=@/private/var/folders/zf/yzr9qxgn5jv47gkkm8q_yxdw0000gn/T/phpdcc0mj340vjk9WlA6dD" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/upload"
);

const headers = {
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('folder', 'architecto');
body.append('image', document.querySelector('input[name="image"]').files[0]);

fetch(url, {
    method: "POST",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-admin-upload">
</span>
<span id="execution-results-POSTapi-v1-admin-upload" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-admin-upload"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-admin-upload"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-admin-upload" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-admin-upload">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-admin-upload" data-method="POST"
      data-path="api/v1/admin/upload"
      data-authed="0"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-admin-upload', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-admin-upload"
                    onclick="tryItOut('POSTapi-v1-admin-upload');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-admin-upload"
                    onclick="cancelTryOut('POSTapi-v1-admin-upload');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-admin-upload"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/admin/upload</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-admin-upload"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-admin-upload"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>image</code></b>&nbsp;&nbsp;
<small>file</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="image"                data-endpoint="POSTapi-v1-admin-upload"
               value=""
               data-component="body">
    <br>
<p>Ảnh cần upload. Example: <code>/private/var/folders/zf/yzr9qxgn5jv47gkkm8q_yxdw0000gn/T/phpdcc0mj340vjk9WlA6dD</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>folder</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="folder"                data-endpoint="POSTapi-v1-admin-upload"
               value="architecto"
               data-component="body">
    <br>
<p>Thư mục con (VD: products, avatars). Default: 'uploads' Example: <code>architecto</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-v1-admin-roles">Danh sách vai trò kèm quyền hạn</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-admin-roles">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/admin/roles" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/roles"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-roles">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-admin-roles" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-roles"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-roles"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-roles" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-roles">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-roles" data-method="GET"
      data-path="api/v1/admin/roles"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-roles', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-roles"
                    onclick="tryItOut('GETapi-v1-admin-roles');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-roles"
                    onclick="cancelTryOut('GETapi-v1-admin-roles');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-roles"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/roles</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-admin-roles"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-admin-roles"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-v1-admin-roles">Thêm mới vai trò</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-admin-roles">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8000/api/v1/admin/roles" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"ten\": \"b\",
    \"ma_slug\": \"n\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/roles"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "ten": "b",
    "ma_slug": "n"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-admin-roles">
</span>
<span id="execution-results-POSTapi-v1-admin-roles" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-admin-roles"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-admin-roles"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-admin-roles" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-admin-roles">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-admin-roles" data-method="POST"
      data-path="api/v1/admin/roles"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-admin-roles', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-admin-roles"
                    onclick="tryItOut('POSTapi-v1-admin-roles');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-admin-roles"
                    onclick="cancelTryOut('POSTapi-v1-admin-roles');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-admin-roles"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/admin/roles</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-admin-roles"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-admin-roles"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>ten</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="ten"                data-endpoint="POSTapi-v1-admin-roles"
               value="b"
               data-component="body">
    <br>
<p>Must not be greater than 100 characters. Example: <code>b</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>ma_slug</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="ma_slug"                data-endpoint="POSTapi-v1-admin-roles"
               value="n"
               data-component="body">
    <br>
<p>Must not be greater than 100 characters. Example: <code>n</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>quyen_ids</code></b>&nbsp;&nbsp;
<small>string[]</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="quyen_ids[0]"                data-endpoint="POSTapi-v1-admin-roles"
               data-component="body">
        <input type="text" style="display: none"
               name="quyen_ids[1]"                data-endpoint="POSTapi-v1-admin-roles"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the quyen table.</p>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-v1-admin-roles--id-">Chi tiết một vai trò</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-admin-roles--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/admin/roles/architecto" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/roles/architecto"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-roles--id-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-admin-roles--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-roles--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-roles--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-roles--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-roles--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-roles--id-" data-method="GET"
      data-path="api/v1/admin/roles/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-roles--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-roles--id-"
                    onclick="tryItOut('GETapi-v1-admin-roles--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-roles--id-"
                    onclick="cancelTryOut('GETapi-v1-admin-roles--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-roles--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/roles/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-admin-roles--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-admin-roles--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="GETapi-v1-admin-roles--id-"
               value="architecto"
               data-component="url">
    <br>
<p>The ID of the role. Example: <code>architecto</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-PUTapi-v1-admin-roles--id-">Cập nhật vai trò</h2>

<p>
</p>



<span id="example-requests-PUTapi-v1-admin-roles--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost:8000/api/v1/admin/roles/architecto" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/roles/architecto"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "PUT",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-v1-admin-roles--id-">
</span>
<span id="execution-results-PUTapi-v1-admin-roles--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-admin-roles--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-admin-roles--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-admin-roles--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-admin-roles--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v1-admin-roles--id-" data-method="PUT"
      data-path="api/v1/admin/roles/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-admin-roles--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-admin-roles--id-"
                    onclick="tryItOut('PUTapi-v1-admin-roles--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-admin-roles--id-"
                    onclick="cancelTryOut('PUTapi-v1-admin-roles--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-admin-roles--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/admin/roles/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v1-admin-roles--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-v1-admin-roles--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="PUTapi-v1-admin-roles--id-"
               value="architecto"
               data-component="url">
    <br>
<p>The ID of the role. Example: <code>architecto</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>ten</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="ten"                data-endpoint="PUTapi-v1-admin-roles--id-"
               value=""
               data-component="body">
    <br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>ma_slug</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="ma_slug"                data-endpoint="PUTapi-v1-admin-roles--id-"
               value=""
               data-component="body">
    <br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>quyen_ids</code></b>&nbsp;&nbsp;
<small>string[]</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="quyen_ids[0]"                data-endpoint="PUTapi-v1-admin-roles--id-"
               data-component="body">
        <input type="text" style="display: none"
               name="quyen_ids[1]"                data-endpoint="PUTapi-v1-admin-roles--id-"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the quyen table.</p>
        </div>
        </form>

                    <h2 id="endpoints-DELETEapi-v1-admin-roles--id-">Xóa vai trò</h2>

<p>
</p>



<span id="example-requests-DELETEapi-v1-admin-roles--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost:8000/api/v1/admin/roles/architecto" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/roles/architecto"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-admin-roles--id-">
</span>
<span id="execution-results-DELETEapi-v1-admin-roles--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-admin-roles--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-admin-roles--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-admin-roles--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-admin-roles--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-admin-roles--id-" data-method="DELETE"
      data-path="api/v1/admin/roles/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-admin-roles--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-admin-roles--id-"
                    onclick="tryItOut('DELETEapi-v1-admin-roles--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-admin-roles--id-"
                    onclick="cancelTryOut('DELETEapi-v1-admin-roles--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-admin-roles--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/admin/roles/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-v1-admin-roles--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-v1-admin-roles--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="DELETEapi-v1-admin-roles--id-"
               value="architecto"
               data-component="url">
    <br>
<p>The ID of the role. Example: <code>architecto</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-v1-admin-permissions">Lấy danh sách tất cả quyền hạn (để hiển thị checkbox)</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-admin-permissions">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8000/api/v1/admin/permissions" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8000/api/v1/admin/permissions"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-admin-permissions">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-admin-permissions" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-admin-permissions"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-admin-permissions"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-admin-permissions" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-admin-permissions">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-admin-permissions" data-method="GET"
      data-path="api/v1/admin/permissions"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-admin-permissions', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-admin-permissions"
                    onclick="tryItOut('GETapi-v1-admin-permissions');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-admin-permissions"
                    onclick="cancelTryOut('GETapi-v1-admin-permissions');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-admin-permissions"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/admin/permissions</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-admin-permissions"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-admin-permissions"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

            

        
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                                        <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                                        <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                            </div>
            </div>
</div>
</body>
</html>
