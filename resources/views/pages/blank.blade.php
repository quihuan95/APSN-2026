@extends('layouts.app')

@section('title', 'Khách sạn vệ tinh — APSN Forum 2026')

@section('content')
    <div class="page-intro">
        <span class="page-badge">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="4" y="2" width="16" height="20" rx="2" ry="2"></rect><line x1="9" y1="22" x2="9" y2="22.01"></line><line x1="15" y1="22" x2="15" y2="22.01"></line><line x1="9" y1="6" x2="9" y2="6.01"></line><line x1="15" y1="6" x2="15" y2="6.01"></line><line x1="9" y1="10" x2="9" y2="10.01"></line><line x1="15" y1="10" x2="15" y2="10.01"></line></svg>
            Lưu trú vệ tinh · Satellite Accommodation
        </span>
        <h1 class="page-title">Khách sạn vệ tinh lân cận</h1>
        <p class="page-lede">Rex Hotel Saigon là địa điểm diễn ra toàn bộ hội nghị chính. Trong trường hợp phòng tại Rex Hotel đã kín chỗ, quý đại biểu có thể đặt phòng tại hai khách sạn vệ tinh tiêu chuẩn 4 sao tọa lạc ngay trên cùng đại lộ đi bộ Nguyễn Huệ, chỉ cách Rex Hotel từ 1 đến 3 phút đi bộ.</p>
    </div>

    <!-- Proximity Banner -->
    <div class="section-intro-hint" style="margin-bottom: 32px; background: #ECFEFF; border-color: #A5F3FC;">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--cyan-600)" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 14 14"></polyline></svg>
        <div>
            <strong style="color: var(--cyan-600); font-size:15px;">Vị trí liền kề đắc địa:</strong>
            Cả hai khách sạn Saigon Prince Hotel và Oscar Saigon Hotel đều nằm cùng trục phố đi bộ Nguyễn Huệ với Rex Hotel. Quý đại biểu có thể dễ dàng đi bộ tham dự các phiên họp buổi sáng và trở về phòng nghỉ bất cứ lúc nào mà không cần phương tiện trung chuyển.
        </div>
    </div>

    <!-- 01: Saigon Prince Hotel -->
    <section class="hotel-card">
        <div class="hotel-header">
            <div>
                <h2 class="hotel-name">Saigon Prince Hotel</h2>
                <div class="hotel-meta">
                    <span>📍 59–73 Nguyễn Huệ, Quận 1, TP.HCM</span>
                    <span>&bull;</span>
                    <span>🏨 Tiêu chuẩn 4 sao quốc tế (191 phòng)</span>
                    <span>&bull;</span>
                    <span>📞 +84 28 3822 2999</span>
                </div>
            </div>
            <a class="hotel-booking-btn" href="https://saigonprincehotel.com/" target="_blank" rel="noopener">
                <span>Đặt phòng Saigon Prince</span>
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
            </a>
        </div>
        <p style="font-size:15px; color:var(--slate-600); line-height:1.6; margin-bottom: 20px;">Khách sạn cao cấp nằm trên cùng đại lộ với Rex Hotel, hướng nhìn trực diện phố đi bộ Nguyễn Huệ và sông Sài Gòn. Rất thuận lợi cho các đoàn đại biểu cần thêm phòng tiêu chuẩn, phòng thương gia hoặc căn hộ lưu trú dài ngày.</p>

        <div class="rooms-grid" style="margin-top: 10px;">
            <div class="room-card">
                <div>
                    <div class="room-header">
                        <h3 class="room-title">Premier</h3>
                        <div class="room-badges">
                            <span class="room-badge">Khoảng 30 m²</span>
                            <span class="room-badge">Giường đôi hoặc Twin</span>
                        </div>
                    </div>
                    <p class="room-desc">Bố trí ở các tầng thấp, phòng tắm tiện nghi có bồn tắm nằm. Một số phòng tại tầng 3 có tầm nhìn mở ra vườn cảnh phong cách Nhật Bản thanh bình.</p>
                </div>
            </div>

            <div class="room-card">
                <div>
                    <div class="room-header">
                        <h3 class="room-title">Executive</h3>
                        <div class="room-badges">
                            <span class="room-badge">Khoảng 30 m²</span>
                            <span class="room-badge">Dành cho công tác</span>
                        </div>
                    </div>
                    <p class="room-desc">Không gian làm việc và nghỉ ngơi tối ưu, nội thất phong cách hiện đại, wifi đường truyền riêng biệt, phù hợp hoàn hảo cho đại biểu tham dự hội nghị.</p>
                </div>
            </div>

            <div class="room-card">
                <div>
                    <div class="room-header">
                        <h3 class="room-title">Club</h3>
                        <div class="room-badges">
                            <span class="room-badge room-badge-gold">Quyền lợi Club Lounge</span>
                            <span class="room-badge">Khoảng 30 m²</span>
                        </div>
                    </div>
                    <p class="room-desc">Tầm nhìn tuyệt đẹp ra phố đi bộ Nguyễn Huệ hoặc hướng sông Sài Gòn. Khách lưu trú phòng Club được hưởng đặc quyền bữa sáng tại Club Lounge, trà chiều và cocktail giải khát suốt ngày.</p>
                </div>
            </div>

            <div class="room-card">
                <div>
                    <div class="room-header">
                        <h3 class="room-title">Club Suite &amp; Club Grand Suite</h3>
                        <div class="room-badges">
                            <span class="room-badge room-badge-gold">Quyền lợi Club Lounge</span>
                            <span class="room-badge">Khoảng 55 m²</span>
                        </div>
                    </div>
                    <p class="room-desc">Phòng khách sang trọng tách biệt, bàn làm việc doanh nhân, phòng tắm bằng đá cẩm thạch rộng rãi. Hạng Grand Suite trang bị bồn tắm và buồng tắm đứng riêng biệt kèm toàn bộ đặc quyền Club.</p>
                </div>
            </div>

            <div class="room-card col-full">
                <div>
                    <div class="room-header">
                        <h3 class="room-title">Apartment Duplex</h3>
                        <div class="room-badges">
                            <span class="room-badge">Khoảng 95 m²</span>
                            <span class="room-badge">Căn hộ thông tầng</span>
                            <span class="room-badge">Tối đa 3 khách</span>
                        </div>
                    </div>
                    <p class="room-desc">Căn hộ thông 2 tầng trên tầng cao tòa nhà: tầng dưới gồm phòng khách, khu bếp nhỏ và bàn ăn; tầng trên là phòng ngủ riêng tư và phòng tắm sang trọng. Một số căn có ban công ngắm nhìn trọn vẹn nhịp sống đại lộ Nguyễn Huệ.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 02: Oscar Saigon Hotel -->
    <section class="hotel-card">
        <div class="hotel-header">
            <div>
                <h2 class="hotel-name">Oscar Saigon Hotel</h2>
                <div class="hotel-meta">
                    <span>📍 68A Nguyễn Huệ, Quận 1, TP.HCM</span>
                    <span>&bull;</span>
                    <span>🏨 Tiêu chuẩn 4 sao (106 phòng)</span>
                    <span>&bull;</span>
                    <span>📞 +84 28 3829 2978</span>
                </div>
            </div>
            <a class="hotel-booking-btn" href="https://oscar-saigonhotel.com/accommodations/" target="_blank" rel="noopener">
                <span>Đặt phòng Oscar Saigon</span>
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
            </a>
        </div>
        <p style="font-size:15px; color:var(--slate-600); line-height:1.6; margin-bottom: 20px;">Khách sạn 4 sao nằm đối diện trực tiếp phố đi bộ Nguyễn Huệ, kiến trúc mang âm hưởng thuộc địa Pháp cổ điển đan xen tiện nghi đương đại. Vị trí đặc biệt gần Nhà hát Thành phố, Trụ sở UBND Thành phố và chợ Bến Thành.</p>

        <div class="rooms-grid" style="margin-top: 10px;">
            <div class="room-card">
                <div>
                    <div class="room-header">
                        <h3 class="room-title">Oscar Elegant</h3>
                        <div class="room-badges">
                            <span class="room-badge">Yên tĩnh</span>
                            <span class="room-badge">Giường đôi hoặc Twin</span>
                        </div>
                    </div>
                    <p class="room-desc">Phòng thiết kế tối ưu cách âm, không cửa sổ mở ngoài, dành riêng cho quý khách cần giấc ngủ sâu và yên tĩnh tuyệt đối sau những giờ làm việc căng thẳng tại hội nghị.</p>
                </div>
            </div>

            <div class="room-card">
                <div>
                    <div class="room-header">
                        <h3 class="room-title">Deluxe</h3>
                        <div class="room-badges">
                            <span class="room-badge">Nhìn vườn</span>
                            <span class="room-badge">Không gian thoáng</span>
                        </div>
                    </div>
                    <p class="room-desc">Phòng nghỉ ngắm nhìn không gian xanh trong lành, phù hợp cho đại biểu yêu thích ánh sáng tự nhiên và bầu không khí thoáng đãng.</p>
                </div>
            </div>

            <div class="room-card">
                <div>
                    <div class="room-header">
                        <h3 class="room-title">Oscar Deluxe</h3>
                        <div class="room-badges">
                            <span class="room-badge">Nhìn phố đi bộ Nguyễn Huệ</span>
                            <span class="room-badge">View tuyệt đẹp</span>
                        </div>
                    </div>
                    <p class="room-desc">Cửa sổ lớn hướng thẳng ra đại lộ Nguyễn Huệ rực rỡ ánh đèn đêm và nhộn nhịp sinh hoạt văn hóa của trung tâm Sài Gòn.</p>
                </div>
            </div>

            <div class="room-card">
                <div>
                    <div class="room-header">
                        <h3 class="room-title">Oscar Executive Suite</h3>
                        <div class="room-badges">
                            <span class="room-badge room-badge-gold">Tầng cao</span>
                            <span class="room-badge">Khoảng 60 m²</span>
                        </div>
                    </div>
                    <p class="room-desc">Hạng suite cao cấp nhất của khách sạn với phòng khách biệt lập nối liền phòng ngủ, nhìn bao quát phố đi bộ và trụ sở UBND Thành phố lung linh về đêm. Rất phù hợp cho các cuộc gặp gỡ đối tác nhỏ.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Helpful Booking Advice -->
    <div class="section-intro-hint" style="background:#FFFBEB; border-color:#FDE68A;">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--gold-600)" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
        <div style="color:#78350F; font-size:14px; line-height:1.6;">
            <strong>Lưu ý đặt phòng:</strong>
            Mức giá và số lượng phòng trống thay đổi theo từng ngày. Quý đại biểu vui lòng đặt chỗ trực tiếp qua website khách sạn hoặc liên hệ hotline lễ tân và <strong>ghi chú tham dự APSN Forum 2026</strong> để được ưu tiên bố trí phòng phù hợp.
        </div>
    </div>
@endsection
