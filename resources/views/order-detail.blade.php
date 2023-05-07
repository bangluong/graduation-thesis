@include('frontend.layouts.header')
<div>
    <form action="{{url('admin/order/update')}}" method="POST" role="form text-left" enctype="multipart/form-data">
        <div class="container-fluid py-4">
            <div class="card">
                <div class="card-header pb-0 px-3">
                    <h6 class="mb-0">{{ __('Thông tin đơn hàng') }}</h6>
                </div>
                <div class="card-body pt-4 p-3">
                    @csrf
                    @if($errors->any())
                        <div class="mt-3  alert alert-primary alert-dismissible fade show" role="alert">
                            <span class="alert-text text-white">
                            {{$errors->first()}}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
                        </div>
                    @endif
                    @if(session('success'))
                        <div class="m-3  alert alert-success alert-dismissible fade show" id="alert-success"
                             role="alert">
                            <span class="alert-text text-white">
                            {{ session('success') }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
                        </div>
                    @endif
                </div>
                <div class="card-group orders">
                    <div class="card">
                        <div class="card-body pt-2">
                            <strong>Thông Tin Đơn Hàng</strong>
                            <table class="table align-items-start mb-0">
                                <tbody>
                                <tr>
                                    <td>ID</td>
                                    <td>{{$order->id}}</td>
                                </tr>
                                <tr>
                                    <td>Tổng</td>
                                    <td>{{number_format($order->subtotal)}}</td>
                                </tr>
                                <tr>
                                    <td>Số lượng</td>
                                    <td>{{$order->item_count}}</td>
                                </tr>
                                <tr>
                                    <td>Phương Thức Thanh Toán</td>
                                    <td>{{$order->payment_method}}</td>
                                </tr>
                                <tr>
                                    <td>Trạng thái</td>
                                    <td>{{$status_mapper[$order->status]}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body pt-2">
                            <caption>Thông Tin Khách Hàng</caption>
                            <table class="table align-items-start mb-0">
                                <tbody>
                                <tr>
                                    <td>Tên</td>
                                    <td>{{$order->name}}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>{{$order->email}}</td>
                                </tr>
                                <tr>
                                    <td>SĐT</td>
                                    <td>{{$order->sdt}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <strong>Địa Chỉ Giao Hàng</strong>
                        <p>{{$order->adr . ', '.$order->state.', '.$order->city}}</p>
                        <p>SĐT: {{$order->sdt}}</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <strong>Sản Phẩm Đã Đặt</strong>
                        <table class="table align-items-start mb-0">
                            <thead>
                            <th class="align-middle text-center">Tên Sản Phẩm</th>
                            <th class="align-middle text-center">Giá Gốc</th>
                            <th class="align-middle text-center">Giá Bán</th>
                            <th class="align-middle text-center">Số Lượng</th>
                            <th class="align-middle text-center">Tổng</th>
                            </thead>
                            <tbody>
                            @foreach($items as $item)
                                <tr>
                                    <td class="align-middle text-center">{{$item->name}}</td>
                                    <td class="align-middle text-center">{{number_format($item->old_price)}}</td>
                                    <td class="align-middle text-center">{{number_format($item->price)}}</td>
                                    <td class="align-middle text-center">{{$item->qty}}</td>
                                    <td class="align-middle text-center">{{number_format($item->row_total)}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="flex flex-row">
                    <div class="d-flex justify-content-end" style="margin-right: 100px">
                        <a href="{{url('admin/orders/pdf/'.$order->id)}}"><button type="button" class="btn btn-primary px-3">{{ 'Xuất Hóa Đơn' }}</button></a>
                    </div>
                    @if ($order->status != 3 && $order->status != 4)
                        <div class="d-flex justify-content-end" style="margin-right: 100px">
                            <a href="{{url('admin/orders/cancel/'.$order->id)}}"><button type="button" class="btn btn-primary px-3">{{ 'Hủy Đơn Hàng' }}</button></a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </form>
</div>
@include('frontend.layouts.footer')
