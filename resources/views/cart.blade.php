@include('frontend.layouts.header')
@include('frontend.layouts.topbar')
@include('frontend.layouts.navbar')
@include('frontend.layouts.navbarend')
<!-- Cart Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-bordered text-center mb-0">
                <thead class="bg-secondary text-dark">
                <tr>
                    <th>Sản Phẩm</th>
                    <th>Đơn Giá</th>
                    <th>Số Lương</th>
                    <th>Thành Tiền</th>
                    <th>Xóa</th>
                </tr>
                </thead>
                <tbody class="align-middle">
                @foreach($cart_items as $cart_item)
                    <tr>
                        <td class="align-middle">
                            <img src="{{$cart_item->product->img}}" alt="" style="width: 50px;">
                            {{$cart_item->product->name}}</td>
                        <td class="align-middle">{{$cart_item->product->price}}</td>
                        <td class="align-middle">
                            <div class="input-group quantity mx-auto" style="width: 100px;">
                                <div class="input-group-btn">
                                    <a href="{{url('checkout/cart/update-item/'.$cart_item->id.'/minus')}}">
                                        <button class="btn btn-sm btn-primary btn-minus" >
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </a>

                                </div>
                                <input type="text" class="form-control form-control-sm bg-secondary text-center" value="{{$cart_item->qty}}">
                                <div class="input-group-btn">
                                    <a href="{{url('checkout/cart/update-item/'.$cart_item->id.'/plus')}}">
                                        <button class="btn btn-sm btn-primary btn-plus">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle">{{$cart_item->row_total}}</td>
                        <td class="align-middle">
                            <a href="{{url('checkout/cart-item/delete/'.$cart_item->id)}}">
                                <button class="btn btn-sm btn-primary"><i class="fa fa-times"></i></button>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-lg-4">
            <form class="mb-5" action="">
                <div class="input-group">
                    <input type="text" class="form-control p-4" placeholder="Coupon Code">
                    <div class="input-group-append">
                        <button class="btn btn-primary">Apply Coupon</button>
                    </div>
                </div>
            </form>
            <div class="card border-secondary mb-5">
                <div class="card-header bg-secondary border-0">
                    <h4 class="font-weight-semi-bold m-0">Cart Summary</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3 pt-1">
                        <h6 class="font-weight-medium">Tổng Tiền Hàng</h6>
                        <h6 class="font-weight-medium">{{$cart->subtotal}}</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Vận Chuyển</h6>
                        <h6 class="font-weight-medium">0đ</h6>
                    </div>
                </div>
                <div class="card-footer border-secondary bg-transparent">
                    <div class="d-flex justify-content-between mt-2">
                        <h5 class="font-weight-bold">Tổng</h5>
                        <h5 class="font-weight-bold">{{$cart->subtotal}}</h5>
                    </div>
                    <button class="btn btn-block btn-primary my-3 py-3">Thanh Toán</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->
@include('frontend.layouts.footer')
