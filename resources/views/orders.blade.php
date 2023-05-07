@include('frontend.layouts.header')

<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-md-3">
            <div class="side_bar">
                <div class="side_bar_blog">
                    <h4>Tài Khoản Của Tôi</h4>
                    <div class="categary">
                        <ul>
                            <li><a href="{{url('my-account')}}"><i class="fa fa-angle-right"></i> Thông Tin Tài Khoản</a></li>
                            <li class="active"><a href="{{url('/orders')}}"><i class="fa fa-angle-right"></i> Đơn Hàng</a></li>
                            <li><a href="{{url('address')}}"><i class="fa fa-angle-right"></i> Địa chỉ</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Shop Product Start -->
        <div class="col-md-9">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <table class="table table-striped">
                            <thead>
                            <td>
                                ID
                            </td>
                            <td>
                                Tổng Tiền
                            </td>
                            <td>
                                Số Lượng
                            </td>
                            <td>
                                Trạng Thái
                            </td>
                            <td></td>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{$order->id}}</td>
                                    <td>{{number_format($order->subtotal)}}</td>
                                    <td>{{$order->item_count}}</td>
                                    <td>{{$status_mapper[$order->status]}}</td>
                                    <td><a href="{{url('orders/'.$order->id)}}">Xem</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('frontend.layouts.footer')
