@extends('layouts.app')

@section('title', 'Đã nhận đăng ký — APSN Forum 2026')

@section('content')
    <div class="thanks-wrapper">
        <div class="thanks-card">
            <div class="thanks-icon">
                <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
            </div>
            <h1 class="thanks-title">Đăng ký tham dự đã được ghi nhận!</h1>

            <div class="thanks-message">
                @if (session('registration_name'))
                    <p style="font-size:18px; color:var(--navy-900); font-weight:700; margin-bottom:8px;">Kính gửi quý đại biểu {{ session('registration_name') }},</p>
                    <p>Ban tổ chức và Ban thư ký APSN 2026 trân trọng cảm ơn quý đại biểu đã hoàn tất thủ tục đăng ký tham dự <strong>APSN Forum 2026 và APSN Council Meeting 2026</strong> tại Thành phố Hồ Chí Minh, Việt Nam.</p>
                @else
                    <p>Trân trọng cảm ơn quý đại biểu đã đăng ký tham dự <strong>APSN Forum 2026 và APSN Council Meeting 2026</strong> tại Thành phố Hồ Chí Minh, Việt Nam.</p>
                @endif
            </div>

            <div class="thanks-next-steps">
                <h4>Các bước tiếp theo dành cho Đại biểu / Next Steps</h4>
                <ul>
                    <li>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                        <span><strong>Xác nhận qua email:</strong> Thông tin chi tiết kèm thư mời điện tử sẽ được Ban thư ký gửi đến hòm thư liên hệ của quý vị.</span>
                    </li>
                    <li>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                        <span><strong>Cập nhật lịch trình chuyến bay:</strong> Nếu quý vị chưa điền thông tin chuyến bay hoặc khách sạn, vui lòng gửi bổ sung cho Ban tổ chức khi đã xác nhận để được điều phối đưa đón tại sân bay Tân Sơn Nhất.</span>
                    </li>
                    <li>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                        <span><strong>Hỗ trợ Visa &amp; Đón tiếp:</strong> Nếu cần công hàm hỗ trợ thủ tục thị thực hoặc thông tin thẻ APEC Business Travel Card (ABTC), vui lòng liên hệ Ban thư ký qua email.</span>
                    </li>
                </ul>
            </div>

            <div style="display:flex; justify-content:center; gap:14px; flex-wrap:wrap;">
                <a href="{{ route('register') }}" class="btn-submit" style="text-decoration:none;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                    <span>Quay lại trang đăng ký</span>
                </a>
                <a href="{{ route('rex') }}" class="hotel-booking-btn" style="text-decoration:none; background: var(--slate-100); color: var(--navy-900) !important; border: 1px solid var(--border-card); box-shadow:none;">
                    <span>Xem phòng Rex Hotel Saigon</span>
                </a>
            </div>
        </div>
    </div>
@endsection
