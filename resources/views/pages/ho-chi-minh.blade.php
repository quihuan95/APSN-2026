@extends('layouts.app')

@section('title', 'Giới thiệu Thành phố Hồ Chí Minh — Điểm đến APSN Forum 2026')

@section('content')
    <div class="page-intro">
        <span class="page-badge">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="3 6 9 3 15 6 21 3 21 18 15 21 9 18 3 21"></polygon><line x1="9" y1="3" x2="9" y2="18"></line><line x1="15" y1="6" x2="15" y2="21"></line></svg>
            Khám phá điểm đến · Host City Guide
        </span>
        <h1 class="page-title">Thành phố Hồ Chí Minh</h1>
        <p class="page-lede">Thành phố Hồ Chí Minh là nơi đăng cai APSN Forum 2026 và APSN Council Meeting 2026, từ ngày 14 đến 18 tháng 12 năm 2026, tại Rex Hotel Saigon. Đô thị năng động bậc nhất Đông Nam Á sẵn sàng chào đón quý đại biểu quốc tế.</p>
    </div>

    <!-- Highlights Grid -->
    <div class="highlights-grid">
        <div class="highlight-card">
            <div class="highlight-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M12 2v20M5 12h14"></path><circle cx="12" cy="5" r="3"></circle><path d="M5 12a7 7 0 0 0 14 0"></path></svg>
            </div>
            <div class="highlight-title">Cửa ngõ Hàng hải &amp; Cảng biển</div>
            <div class="highlight-desc">Hạ lưu sông Sài Gòn kết nối hệ thống cảng Cát Lái và cụm cảng nước sâu Cái Mép, xử lý phần lớn lưu lượng container xuất nhập khẩu của Việt Nam.</div>
        </div>

        <div class="highlight-card">
            <div class="highlight-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
            </div>
            <div class="highlight-title">Trung tâm Kinh tế &amp; Tài chính</div>
            <div class="highlight-desc">Đô thị lớn nhất Việt Nam, đóng góp tỷ trọng GDP hàng đầu và là đầu mối giao thương quốc tế quan trọng trong mạng lưới kinh tế APEC.</div>
        </div>

        <div class="highlight-card">
            <div class="highlight-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M3 21h18"></path><path d="M5 21V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16"></path><path d="M9 9h1"></path><path d="M9 13h1"></path><path d="M9 17h1"></path><path d="M14 9h1"></path><path d="M14 13h1"></path><path d="M14 17h1"></path></svg>
            </div>
            <div class="highlight-title">Trái tim Quận 1 &amp; Di sản</div>
            <div class="highlight-desc">Khách sạn Rex tọa lạc trên đại lộ đi bộ Nguyễn Huệ, liền kề Nhà hát Thành phố, Bưu điện Trung tâm, Nhà thờ Đức Bà và bến Bạch Đằng sông Sài Gòn.</div>
        </div>

        <div class="highlight-card">
            <div class="highlight-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line></svg>
            </div>
            <div class="highlight-title">Thời tiết Tháng 12 lý tưởng</div>
            <div class="highlight-desc">Mùa khô với nhiệt độ dễ chịu (23°C – 31°C), gió mát về đêm, rất thuận tiện cho các hoạt động khảo sát cảng ngoài trời và tiệc networking sân thượng.</div>
        </div>
    </div>

    <div class="editorial-layout">
        <!-- Main Article Content -->
        <article class="editorial-content">
            <p>Thành phố Hồ Chí Minh là đô thị lớn nhất Việt Nam và trung tâm kinh tế, thương mại, tài chính hàng đầu của cả nước. Thành phố nằm ở hạ lưu hệ thống sông Đồng Nai – sông Sài Gòn, nối liền với các luồng hàng hải quốc tế trọng yếu của khu vực châu Á – Thái Bình Dương. Tên gọi lịch sử Sài Gòn vẫn được người dân và du khách quốc tế thân mật sử dụng song song với tên gọi chính thức.</p>

            <p>Thành phố vinh dự mang tên Chủ tịch Hồ Chí Minh (1890–1969), vị lãnh tụ kính yêu của nhân dân Việt Nam. Năm 1976, sau khi đất nước thống nhất, đô thị Sài Gòn – Gia Định chính thức được đổi tên thành Thành phố Hồ Chí Minh, mở ra kỷ nguyên hội nhập và bứt phá mạnh mẽ về kinh tế biển.</p>

            <h2>Trung tâm lịch sử Quận 1 — Không gian văn hóa &amp; gặp gỡ</h2>
            <p>Khu vực trung tâm Quận 1 là nơi hội tụ các công trình kiến trúc biểu tượng ghi dấu ấn lịch sử: phố đi bộ Nguyễn Huệ, Nhà hát Thành phố, Nhà thờ Đức Bà, Bưu điện Trung tâm, chợ Bến Thành và khách sạn biểu tượng Rex Hotel Saigon. Từ địa điểm hội nghị, đại biểu chỉ mất vài phút đi bộ để thưởng ngoạn cảnh quan bến Bạch Đằng dọc sông Sài Gòn lung linh về đêm hoặc ghé thăm các nhà hàng ẩm thực tinh hoa.</p>

            <h2>Ý nghĩa với đại biểu APSN</h2>
            <p>Mạng lưới Dịch vụ Cảng APEC (APSN) là diễn đàn hợp tác hàng hải chuyên sâu nhằm thúc đẩy sự kết nối, an toàn và phát triển bền vững chuỗi cung ứng cảng biển. Thành phố Hồ Chí Minh là minh chứng tiêu biểu cho sự chuyển mình xanh và số hóa của hạ tầng logistics: cụm cảng Cát Lái và hệ thống cảng sông Sài Gòn là tâm điểm hội tụ của các nhà quản lý hàng hải, hãng tàu viễn dương và các tập đoàn dịch vụ cảng biển quốc tế.</p>

            <p>Tháng 12 tại TP.HCM là thời điểm thời tiết đẹp nhất trong năm với tiết trời khô ráo, nắng ấm ban ngày và mát dịu về đêm. Đại biểu quốc tế nên chuẩn bị trang phục lịch thiệp, kèm áo khoác nhẹ khi tham dự các phiên họp máy lạnh và các buổi dạ tiệc ngoại giao ngoài trời trên sân thượng.</p>
        </article>

        <!-- Sidebar Information Card -->
        <aside class="sidebar-sticky">
            <div class="info-card">
                <div class="info-card-header">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--blue-600)" stroke-width="2.2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                    <span class="info-card-title">Thông tin sự kiện</span>
                </div>
                <ul class="info-list">
                    <li class="info-list-item">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 21h18"></path><path d="M5 21V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16"></path></svg>
                        <div>
                            <strong>Địa điểm tổ chức:</strong>
                            Rex Hotel Saigon (5 sao)<br>
                            141 Nguyễn Huệ, Quận 1, TP.HCM
                        </div>
                    </li>
                    <li class="info-list-item">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                        <div>
                            <strong>Thời gian hội nghị:</strong>
                            14–18 December 2026
                        </div>
                    </li>
                    <li class="info-list-item">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                        <div>
                            <strong>Đơn vị chủ trì đăng cai:</strong>
                            Cục Hàng hải và Đường thủy Việt Nam (VIMAWA), Bộ Xây dựng
                        </div>
                    </li>
                    <li class="info-list-item">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17.8 19.2 16 11l3.5-3.5C21 6 21.5 4 21 3c-1-.5-3 0-4.5 1.5L13 8 4.8 6.2c-.5-.1-.9.1-1.1.5l-.3.5c-.2.5-.1 1 .3 1.3L9 12l-2 3H4l-1 1 3 2 2 3 1-1v-3l3-2 3.5 5.3c.3.4.8.5 1.3.3l.5-.2c.4-.3.6-.7.5-1.2z"></path></svg>
                        <div>
                            <strong>Sân bay quốc tế Tân Sơn Nhất (SGN):</strong>
                            Khoảng 7.5 km (~25–35 phút di chuyển taxi tới khách sạn Rex)
                        </div>
                    </li>
                    <li class="info-list-item">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                        <div>
                            <strong>Múi giờ &amp; Tiền tệ:</strong>
                            GMT+7 (Indochina Time)<br>
                            Việt Nam Đồng (VND)
                        </div>
                    </li>
                </ul>
            </div>
        </aside>
    </div>
@endsection
