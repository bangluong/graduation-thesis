<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" charset=utf-8>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hóa Đơn</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>
<body>
<div class="row">
    <div class="column">
        <div class="d-flex justify-content-between">
            <strong>Hóa Đơn</strong>
            <h1>Công Ty Máy Tính Trần Anh</h1>
        </div>
        <div class="d-flex justify-content-between">
            <strong>Thông Tin Khách Hàng</strong>
            <div class="d-flex flex-col">
                <span>Khách Hàng:</span>
                <span>{{$order->name}}</span>
            </div>
            <div class="d-flex flex-col">
                <span>Email:</span>
                <span>{{$order->email}}</span>
            </div>
            <div class="d-flex flex-col">
                <span>Số Điện Thoại:</span>
                <span>{{$order->sdt}}</span>
            </div>
        </div>
        <div class="d-flex justify-content-between">
            <strong>Địa Chỉ Giao Hàng</strong>
            <div class="d-flex flex-col">
                <span>Thành Phố:</span>
                <span>{{$order->city}}</span>
            </div>
            <div class="d-flex flex-col">
                <span>Quận/Huyện:</span>
                <span>{{$order->state}}</span>
            </div>
            <div class="d-flex flex-col">
                <span>Địa Chỉ:</span>
                <span>{{$order->adr}}</span>
            </div>
        </div>
        <br>
        <h2>Thông Tin Đơn Hàng</h2>
        <table>
            <thead>
            <tr>
                <th scope="col left">Tên Sản Phẩm</th>
                <th scope="col right">Số Lượng</th>
                <th scope="col left">Đơn Giá</th>
                <th scope="col right">Thành Tiền</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orderItems as $item)
                <tr>
                    <td>{{$item->name}}</td>
                    <td>{{$item->qty}}</td>
                    <td>{{number_format($item->price)}}</td>
                    <td>{{number_format($item->row_total)}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <br>
        <div class="d-flex justify-content-between">
            <strong>Tổng Thanh Toán:</strong>
            <span>{{number_format($order->subtotal)}} (VND)</span>
        </div>
        @if($order->payment_method == 'vnpay')
            <div class="d-flex justify-content-between">
                <strong>Phương Thức Thanh Toán:</strong>
                <span>Thanh Toán Qua VNPAY</span>
            </div>
        @else
            <div class="d-flex justify-content-between">
                <strong>Phương Thức Thanh Toán: </strong>
                <span>Thanh Toán Khi Nhận Hàng</span>
            </div>
        @endif
        <hr/>
        <div class="d-flex flex-col">
            <p>Cảm ơn bạn đã tin tưởng và mua hàng của chúng tôi</p>
        </div><br/>
        </div><br/><br/>
        <div class="d-flex">
            <span>Date:</span>
            <span>______________</span>
        </div>

    </div>
</div>
</body>
</html>
