@include('frontend.layouts.header')


<div class="container">
    <div class="col">
        <p class="mr-lg-n5">Cảm Ơn Bạn đã Tin Tưởng Và Mua Hàng Tại Trần Anh Computer. Mã Đơn Hàng Cả Bạn là <a style="color: #039ee3; font-weight: 700" href="{{url('orders/'.$order->id)}}">#{{$order->id}}</a></p>
        <table>
            <tr>
                <td>
                    <p>Số Lượng: {{$order->item_count}}</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>Thành Tiền: {{number_format($order->subtotal)}} VNĐ</p>
                </td>
            </tr>
        </table>
    </div>
</div>
@include('frontend.layouts.footer')
