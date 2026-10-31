@extends('layouts.app')

@section('title', 'Phòng ở Rex Hotel Saigon — Địa điểm chính APSN Forum 2026')

@section('content')
    <div class="page-intro">
        <span class="page-badge">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M3 21h18"></path><path d="M5 21V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16"></path><path d="M9 9h1"></path><path d="M9 13h1"></path><path d="M9 17h1"></path><path d="M14 9h1"></path><path d="M14 13h1"></path><path d="M14 17h1"></path></svg>
            Khách sạn đăng cai chính · Official Summit Venue
        </span>
        <h1 class="page-title">Phòng ở Rex Hotel Saigon</h1>
        <p class="page-lede">Rex Hotel Saigon (141 Nguyễn Huệ, Quận 1) là khách sạn 5 sao danh tiếng với bề dày lịch sử gần một thế kỷ, được chọn làm địa điểm trung tâm diễn ra toàn bộ các phiên họp của APSN Forum 2026 và APSN Council Meeting 2026. Khách sạn sở hữu 286 phòng và suite sang trọng, phân bố hài hòa giữa East Wing cổ kính và Executive Wing hiện đại.</p>
    </div>

    <!-- Venue Highlights Strip -->
    <div class="highlights-grid" style="grid-template-columns: repeat(3, 1fr); margin-bottom: 32px;">
        <div class="highlight-card">
            <div class="highlight-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path></svg>
            </div>
            <div class="highlight-title">Khách sạn 5 sao Di sản</div>
            <div class="highlight-desc">Biểu tượng kiến trúc Sài Gòn từ năm 1927, nằm ngay vị trí vàng số 1 đại lộ đi bộ Nguyễn Huệ, Quận 1.</div>
        </div>

        <div class="highlight-card">
            <div class="highlight-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
            </div>
            <div class="highlight-title">286 Phòng &amp; Suites</div>
            <div class="highlight-desc">Đa dạng hạng phòng từ Deluxe tiêu chuẩn đến Presidential Suite 200m² đạt chuẩn nguyên thủ quốc tế.</div>
        </div>

        <div class="highlight-card">
            <div class="highlight-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="12" cy="12" r="10"></circle><path d="M8 14s1.5 2 4 2 4-2 4-2"></path><line x1="9" y1="9" x2="9.01" y2="9"></line><line x1="15" y1="9" x2="15.01" y2="9"></line></svg>
            </div>
            <div class="highlight-title">Rooftop Garden Bar</div>
            <div class="highlight-desc">Sân thượng huyền thoại nhìn toàn cảnh phố đi bộ Nguyễn Huệ và UBND Thành phố, điểm hẹn networking đẳng cấp.</div>
        </div>
    </div>

    <!-- Rooms Catalog Grid -->
    <div class="rooms-grid">
        <!-- 1: Deluxe -->
        <div class="room-card">
            <div>
                <div class="room-header">
                    <h3 class="room-title">Deluxe Room</h3>
                    <div class="room-badges">
                        <span class="room-badge">East Wing</span>
                        <span class="room-badge">Khoảng 28 m²</span>
                        <span class="room-badge">King / Twin</span>
                    </div>
                </div>
                <p class="room-desc">Phòng tiêu chuẩn ấm cúng, trang bị giường King hoặc 2 giường đơn Twin, điều hòa trung tâm, TV truyền hình vệ tinh, minibar, két sắt an toàn, wifi tốc độ cao, máy sấy tóc, bồn tắm nằm hoặc vòi sen đứng. Toàn bộ là phòng không hút thuốc.</p>
            </div>
        </div>

        <!-- 2: Premium -->
        <div class="room-card">
            <div>
                <div class="room-header">
                    <h3 class="room-title">Premium Room</h3>
                    <div class="room-badges">
                        <span class="room-badge">Khoảng 38 m²</span>
                        <span class="room-badge">Pillow Menu</span>
                        <span class="room-badge">King / Twin</span>
                    </div>
                </div>
                <p class="room-desc">Không gian rộng rãi với nệm cao cấp, tùy chọn gối ngủ theo pillow menu riêng biệt, bảng điều khiển thông minh đầu giường. Bố trí linh hoạt giường King hoặc Twin, có thể kê thêm giường phụ theo yêu cầu của đại biểu.</p>
            </div>
        </div>

        <!-- 3: Rex Suite -->
        <div class="room-card">
            <div>
                <div class="room-header">
                    <h3 class="room-title">Rex Suite</h3>
                    <div class="room-badges">
                        <span class="room-badge">Phòng khách riêng</span>
                        <span class="room-badge">Ban công Juliet</span>
                        <span class="room-badge">King / Twin</span>
                    </div>
                </div>
                <p class="room-desc">Hạng Suite đặc trưng với phòng khách biệt lập phục vụ nghỉ ngơi và tiếp khách, bàn làm việc chuẩn doanh nhân. Một số phòng có ban công kiểu Pháp (Juliet) nhìn xuống đại lộ Nguyễn Huệ sầm uất.</p>
            </div>
        </div>

        <!-- 4: Governor Suite -->
        <div class="room-card">
            <div>
                <div class="room-header">
                    <h3 class="room-title">Governor Suite</h3>
                    <div class="room-badges">
                        <span class="room-badge">Khoảng 57 m²</span>
                        <span class="room-badge">Giường King</span>
                        <span class="room-badge">Phòng khách rộng</span>
                    </div>
                </div>
                <p class="room-desc">Thiết kế trang trọng gồm phòng khách tách biệt với sofa cao cấp, bàn họp mini làm việc riêng và trang thiết bị tiện nghi vượt trội so với tiêu chuẩn thông thường.</p>
            </div>
        </div>

        <!-- 5: Executive Premium -->
        <div class="room-card">
            <div>
                <div class="room-header">
                    <h3 class="room-title">Executive Premium</h3>
                    <div class="room-badges">
                        <span class="room-badge room-badge-gold">Executive Wing</span>
                        <span class="room-badge">Khoảng 38 m²</span>
                        <span class="room-badge">Tiện nghi cao cấp</span>
                    </div>
                </div>
                <p class="room-desc">Tọa lạc tại cánh Executive Wing hiện đại, phòng sở hữu nội thất tinh tế, đồ dùng phòng tắm cao cấp và không gian yên tĩnh tuyệt đối cho các chuyên gia công tác.</p>
            </div>
        </div>

        <!-- 6: Executive Governor Suite -->
        <div class="room-card">
            <div>
                <div class="room-header">
                    <h3 class="room-title">Executive Governor Suite</h3>
                    <div class="room-badges">
                        <span class="room-badge room-badge-gold">Executive Wing</span>
                        <span class="room-badge">Suite ngoại giao</span>
                    </div>
                </div>
                <p class="room-desc">Suite trang trọng hàng đầu trong khu Executive với phòng khách và phòng ngủ diện tích rộng, phù hợp cho các trưởng đoàn và đại biểu cấp cao cần không gian trao đổi công việc kín đáo.</p>
            </div>
        </div>

        <!-- 7: Executive Suite -->
        <div class="room-card">
            <div>
                <div class="room-header">
                    <h3 class="room-title">Executive Suite</h3>
                    <div class="room-badges">
                        <span class="room-badge">Hướng Nhà hát Thành phố</span>
                        <span class="room-badge">Giường King</span>
                    </div>
                </div>
                <p class="room-desc">Phong cách hiện đại, tầm nhìn trực diện tuyệt đẹp ra Nhà hát Thành phố Hồ Chí Minh (Saigon Opera House), hệ thống nghe nhìn thông minh cùng các dịch vụ hỗ trợ thương vụ chuyên biệt.</p>
            </div>
        </div>

        <!-- 8: Imperial Suite -->
        <div class="room-card">
            <div>
                <div class="room-header">
                    <h3 class="room-title">Imperial Suite</h3>
                    <div class="room-badges">
                        <span class="room-badge">Tầng 3–4 East Wing</span>
                        <span class="room-badge">Khoảng 98 m²</span>
                        <span class="room-badge">Sauna riêng trong phòng</span>
                    </div>
                </div>
                <p class="room-desc">Tuyệt tác không gian mang đậm bản sắc văn hóa Việt Nam truyền thống, hướng nhìn bao quát phố đi bộ Nguyễn Huệ. Gồm phòng khách lớn, phòng ăn sang trọng, bàn làm việc và phòng xông hơi khô (sauna) ngay trong phòng.</p>
            </div>
        </div>

        <!-- 9: Presidential Suite -->
        <div class="room-card col-full" style="background: linear-gradient(135deg, #FFFFFF 0%, #F0F7FD 100%); border-color: #B2D5F5;">
            <div>
                <div class="room-header">
                    <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:8px;">
                        <h3 class="room-title" style="font-size:22px; color:var(--navy-900);">Presidential Suite (Phòng Tổng thống)</h3>
                        <span class="room-badge room-badge-gold" style="font-size:12px; padding:4px 12px;">Hạng phòng thượng đỉnh cao nhất</span>
                    </div>
                    <div class="room-badges" style="margin-top:6px;">
                        <span class="room-badge">Tầng cao Executive Wing</span>
                        <span class="room-badge">Khoảng 200 m²</span>
                        <span class="room-badge">2 Phòng ngủ King độc lập</span>
                        <span class="room-badge">Phòng khách &amp; Phòng ăn VIP</span>
                    </div>
                </div>
                <p class="room-desc" style="font-size:15px;">Hạng suite quy mô lớn và sang trọng nhất của khách sạn Rex. Thiết kế đương đại đỉnh cao với 2 phòng ngủ giường King master, đại sảnh tiếp khách, phòng ăn riêng, quầy pantry, phòng làm việc chuyên biệt và ban công ngắm nhìn toàn cảnh trung tâm Sài Gòn. Từng là nơi đón tiếp nhiều nguyên thủ quốc gia và các quan chức cấp cao APEC.</p>
            </div>
        </div>
    </div>

    <!-- General Amenities -->
    <div class="editorial-content" style="margin-top: 24px;">
        <h2>Tiện ích &amp; Dịch vụ chung tại Rex Hotel</h2>
        <p>Hầu hết tất cả các hạng phòng tại Rex Hotel Saigon đều được phục vụ minibar miễn phí lượt đầu tiên trong kỳ lưu trú, trà và cà phê hảo hạng, áo choàng, dép bông, wifi tốc độ cao và két sắt bảo mật. Khách sạn nổi tiếng với Vườn Thượng Uyển Rooftop Garden Restaurant nhìn xuống đại lộ Nguyễn Huệ — không gian hoàn hảo cho các cuộc gặp gỡ ngoại giao và tiệc tối thân mật sau các phiên họp căng thẳng của APSN Forum.</p>

        <div class="section-intro-hint" style="margin-top: 20px;">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
            <div>
                <strong>Lưu ý dành cho Đại biểu:</strong>
                Thông tin phòng được tổng hợp theo công bố chính thức của Rex Hotel Saigon. Số lượng phòng trống và mức giá ưu đãi hội nghị phụ thuộc vào thời điểm đặt. Quý đại biểu vui lòng liên hệ sớm với Ban tổ chức hoặc trực tiếp lễ tân khách sạn (ghi chú tham dự sự kiện APSN Forum 2026) để nhận giá phòng theo khối APEC.
            </div>
        </div>
    </div>
@endsection
