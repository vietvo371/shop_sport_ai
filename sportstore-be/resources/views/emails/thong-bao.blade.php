<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $tieuDe }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; background-color: #f8fafc; color: #1e293b; -webkit-font-smoothing: antialiased; }
        .wrapper { max-width: 600px; margin: 40px auto; background: #ffffff; border-radius: 24px; overflow: hidden; box-shadow: 0 20px 50px rgba(0,0,0,0.05); }
        
        /* Header & Brand */
        .header { background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); padding: 48px 40px; position: relative; text-align: center; }
        .header::after { content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 100px; background: linear-gradient(to top, rgba(255,255,255,0.05), transparent); pointer-events: none; }
        .header-logo { color: #ffffff; font-size: 24px; font-weight: 800; letter-spacing: -1px; text-decoration: none; display: inline-block; }
        .header-logo span { color: #f97316; }
        
        /* Badge System */
        .badge-wrapper { margin-top: 20px; }
        .badge { display: inline-flex; align-items: center; padding: 6px 14px; border-radius: 100px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; }
        .badge-don_hang { background: rgba(59, 130, 246, 0.1); color: #3b82f6; border: 1px solid rgba(59, 130, 246, 0.2); }
        .badge-khuyen_mai { background: rgba(245, 158, 11, 0.1); color: #f59e0b; border: 1px solid rgba(245, 158, 11, 0.2); }
        .badge-he_thong  { background: rgba(16, 185, 129, 0.1); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.2); }
        
        /* Main Body */
        .body { padding: 48px 40px; background-image: radial-gradient(circle at 100% 0%, rgba(249, 115, 22, 0.03) 0%, transparent 15%); }
        .title { font-size: 28px; font-weight: 800; color: #0f172a; margin-bottom: 20px; line-height: 1.25; letter-spacing: -0.02em; }
        .content { font-size: 16px; line-height: 1.6; color: #475569; margin-bottom: 32px; }
        
        /* Information Cards */
        .info-card { background: #fdfdfd; border: 1px solid #f1f5f9; border-radius: 20px; padding: 24px; margin-bottom: 32px; }
        .info-label { font-size: 13px; color: #94a3b8; font-weight: 600; text-transform: uppercase; letter-spacing: 0.02em; }
        .info-value { font-size: 15px; color: #0f172a; font-weight: 700; }
        
        /* Action Button */
        .cta-wrapper { text-align: center; margin-bottom: 40px; }
        .cta-button { display: inline-block; background-color: #f97316; color: #ffffff !important; padding: 16px 36px; border-radius: 14px; text-decoration: none; font-weight: 700; font-size: 15px; box-shadow: 0 10px 20px rgba(249, 115, 22, 0.2); transition: all 0.3s ease; }
        
        /* Footer */
        .footer { padding: 32px 40px; background: #f8fafc; border-top: 1px solid #f1f5f9; text-align: center; }
        .footer-text { font-size: 13px; color: #64748b; line-height: 1.8; }
        .footer-text strong { color: #0f172a; }
        .footer-links { margin-top: 16px; font-size: 12px; }
        .footer-links a { color: #f97316; text-decoration: none; font-weight: 600; margin: 0 8px; }
        
        /* Global utility */
        .highlight { color: #f97316; font-weight: 700; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <a href="{{ config('app.frontend_url') }}" class="header-logo">SPORT<span>STORE</span></a>
            <div class="badge-wrapper">
                <span class="badge badge-{{ $loai }}">
                    @if($loai === 'don_hang') 🛍️ Thông tin đơn hàng
                    @elseif($loai === 'khuyen_mai') 🎁 Ưu đãi đặc biệt
                    @else 🔔 Thông báo hệ thống
                    @endif
                </span>
            </div>
        </div>

        <div class="body">
            <h1 class="title">{{ $tieuDe }}</h1>
            <div class="content">
                {!! nl2br(e($noiDung)) !!}
            </div>

            @if(!empty($duLieuThem))
            <div class="info-card">
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    @foreach($duLieuThem as $label => $value)
                    <tr>
                        <td align="left" style="padding: 12px 0; border-bottom: 1px solid #f1f5f9; vertical-align: middle;">
                            <span class="info-label">{{ $label }}</span>
                        </td>
                        <td align="right" style="padding: 12px 0; border-bottom: 1px solid #f1f5f9; vertical-align: middle;">
                            <span class="info-value">{{ $value }}</span>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            @endif

            @if($hanhDongUrl)
            <div class="cta-wrapper">
                <a href="{{ $hanhDongUrl }}" class="cta-button">
                    {{ $hanhDongText ?? 'Khám phá ngay' }}
                </a>
            </div>
            @endif
        </div>

        <div class="footer">
            <p class="footer-text">
                Chào mừng bạn đến với cộng đồng <strong class="highlight">SportStore</strong>.<br>
                Đây là email tự động từ hệ thống chăm sóc khách hàng.
            </p>
            <div class="footer-links">
                <a href="{{ config('app.frontend_url') }}">Trang chủ</a>
                <span style="color: #cbd5e1">•</span>
                <a href="{{ config('app.frontend_url') }}/profile">Tài khoản</a>
                <span style="color: #cbd5e1">•</span>
                <a href="mailto:vietvo371@gmail.com">Hỗ trợ</a>
            </div>
            <p style="margin-top: 16px; font-size: 11px; color: #94a3b8;">
                &copy; {{ date('Y') }} SportStore Inc. All rights reserved.
            </p>
        </div>
    </div>
</body>
</html>
