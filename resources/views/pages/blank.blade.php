@extends('layouts.app')

@section('title', 'Khách sạn vệ tinh')

@section('content')
    <article class="page">
        <h1>Khách sạn vệ tinh</h1>
        <p class="lede">Rex Hotel Saigon là nơi họp chính. Khi phòng tại Rex đã kín, đại biểu có thể đặt hai khách sạn vệ tinh cùng phố đi bộ Nguyễn Huệ, cách địa điểm họp vài phút đi bộ. Đặt phòng trực tiếp với khách sạn và ghi rõ tham dự APSN Forum 2026.</p>

        <section class="hotel">
            <h2>Saigon Prince Hotel</h2>
            <p class="meta">59–73 Nguyễn Huệ, phường Sài Gòn · 191 phòng · +84 28 3822 2999</p>
            <p>Khách sạn nằm trên cùng đại lộ với Rex, nhìn phố đi bộ Nguyễn Huệ. Phù hợp cho đoàn cần thêm phòng tiêu chuẩn và một số suite hoặc căn hộ.</p>
            <div class="rooms">
                <section class="room">
                    <h3>Premier</h3>
                    <div class="meta">Khoảng 30 m² · giường đôi hoặc twin</div>
                    <p>Phòng ở tầng thấp, phòng tắm có bồn. Một số phòng tầng 3 nhìn vườn Nhật.</p>
                </section>
                <section class="room">
                    <h3>Executive</h3>
                    <div class="meta">Khoảng 30 m² · giường đôi hoặc twin</div>
                    <p>Phòng làm việc và nghỉ, bố trí hiện đại, phù hợp khách đi công tác.</p>
                </section>
                <section class="room">
                    <h3>Club</h3>
                    <div class="meta">Khoảng 30 m² · quyền lợi Club Lounge</div>
                    <p>Nhìn phố Nguyễn Huệ, trung tâm thành phố hoặc sông. Khách Club Lounge có bữa sáng, trà chiều và đồ uống trong ngày.</p>
                </section>
                <section class="room">
                    <h3>Club Suite và Club Grand Suite</h3>
                    <div class="meta">Khoảng 55 m²</div>
                    <p>Phòng khách tách biệt, bàn làm việc, phòng tắm rộng. Club Grand Suite có bồn tắm và vòi sen riêng, kèm quyền lợi Club Lounge.</p>
                </section>
                <section class="room">
                    <h3>Apartment</h3>
                    <div class="meta">Khoảng 95 m² · duplex · tối đa 3 khách</div>
                    <p>Căn hộ hai tầng trên tầng cao: phòng khách, bếp nhỏ và khu ăn ở tầng dưới; phòng ngủ và phòng tắm ở tầng trên. Một số căn có ban công nhìn Nguyễn Huệ.</p>
                </section>
            </div>
            <p><a class="book" href="https://saigonprincehotel.com/" target="_blank" rel="noopener">Đặt phòng Saigon Prince</a></p>
        </section>

        <section class="hotel">
            <h2>Oscar Saigon Hotel</h2>
            <p class="meta">68A Nguyễn Huệ, phường Sài Gòn · 106 phòng · +84 28 3829 2978</p>
            <p>Khách sạn 4 sao trên cùng phố Nguyễn Huệ, kiến trúc kiểu thuộc địa đã được cải tạo. Gần Nhà hát Thành phố, UBND thành phố và chợ Bến Thành.</p>
            <div class="rooms">
                <section class="room">
                    <h3>Oscar Elegant</h3>
                    <div class="meta">Phòng yên, không cửa sổ</div>
                    <p>Dành cho khách muốn ngủ yên sau ngày họp. Có bản giường đôi và twin.</p>
                </section>
                <section class="room">
                    <h3>Deluxe</h3>
                    <div class="meta">Nhìn vườn</div>
                    <p>Phòng nghỉ nhìn vườn, phù hợp khách muốn không gian thoáng hơn phòng trong.</p>
                </section>
                <section class="room">
                    <h3>Oscar Deluxe</h3>
                    <div class="meta">Nhìn phố đi bộ Nguyễn Huệ</div>
                    <p>Cửa sổ hướng đại lộ Nguyễn Huệ, nhìn đèn phố và hoạt động ban đêm trên phố đi bộ.</p>
                </section>
                <section class="room">
                    <h3>Oscar Executive Suite</h3>
                    <div class="meta">Khoảng 60 m² · tầng cao</div>
                    <p>Phòng khách tách khỏi phòng ngủ, nhìn Nguyễn Huệ và trụ sở UBND thành phố. Phù hợp khách cần chỗ tiếp khách nhỏ.</p>
                </section>
            </div>
            <p><a class="book" href="https://oscar-saigonhotel.com/accommodations/" target="_blank" rel="noopener">Đặt phòng Oscar Saigon</a></p>
        </section>

        <p class="hint">Giá và phòng trống thay đổi theo ngày. Hạng phòng lấy theo mô tả công khai của từng khách sạn. Nên xác nhận lại khi đặt, vì trang này không giữ chỗ hộ.</p>
    </article>
@endsection
