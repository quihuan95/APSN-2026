@extends('layouts.app')

@section('title', 'Đã nhận đăng ký')

@section('content')
    <section class="page prose">
        <h1>Đăng ký đã được ghi nhận</h1>
        @if (session('registration_name'))
            <p>Cảm ơn {{ session('registration_name') }}. Ban tổ chức đã lưu thông tin đăng ký của bạn cho APSN Forum 2026 và APSN Council Meeting 2026.</p>
        @else
            <p>Cảm ơn bạn đã đăng ký tham dự APSN Forum 2026 và APSN Council Meeting 2026.</p>
        @endif
        <p>Nếu thông tin chuyến bay hoặc khách sạn chưa có, vui lòng gửi bổ sung cho ban tổ chức khi đã xác nhận.</p>
        <p><a href="{{ route('register') }}">Quay lại trang đăng ký</a></p>
    </section>
@endsection
