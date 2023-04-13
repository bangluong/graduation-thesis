@include('frontend.layouts.header')
@include('frontend.layouts.topbar')
@include('frontend.layouts.navbar')
@include('frontend.layouts.navbarend')
    <p class="mr-lg-n5">Cảm Ơn Bạn đã Tin Tưởng vÀ Mua Hàng Tại Trần Anh Computer. Mã Đơn Hàng Cả Bạn là {{$order->id}}</p>
@include('frontend.layouts.footer')
