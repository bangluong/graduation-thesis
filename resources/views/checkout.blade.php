@include('frontend.layouts.header')
@include('frontend.layouts.topbar')
@include('frontend.layouts.navbar')
@include('frontend.layouts.navbarend')

<!-- Checkout Start -->
<div class="container-fluid pt-5">
    <form method="post" action="{{url('place-order')}}" class="row px-xl-5 needs-validation">
        @csrf
        <div class="col-lg-8">
            <div class="mb-4">
                <h4 class="font-weight-semi-bold mb-4">Địa Chỉ Nhận Hàng</h4>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Họ Và Tên</label>
                        <input class="form-control required" name="name" type="text" placeholder="">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>E-mail</label>
                        <input class="form-control" name="email" type="text" placeholder="example@email.com">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Số Điên Thoai</label>
                        <input class="form-control" name="phone" type="text" placeholder="+123 456 789">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Địa Chỉ</label>
                        <input class="form-control" name="address[address]" type="text" placeholder="123 Street">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Thành Phố</label>
                        <input class="form-control" name="address[city]" type="text" placeholder="Hà Nội">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Quận/Huyện</label>
                        <input class="form-control" name="address[district]" type="text" placeholder="Quận Cầu giấy">
                    </div>
                    <div class="col-md-12 form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="newaccount">
                            <label class="custom-control-label" for="newaccount">Create an account</label>
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="shipto">
                            <label class="custom-control-label" for="shipto"  data-toggle="collapse" data-target="#shipping-address">Ship to different address</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card border-secondary mb-5">
                <div class="card-header bg-secondary border-0">
                    <h4 class="font-weight-semi-bold m-0">Tổng Đơn Hàng</h4>
                </div>
                <div class="card-body">
                    <h5 class="font-weight-medium mb-3">Sản Phẩm</h5>
                    @foreach($cart_items as $cart_item)
                        <div class="d-flex justify-content-between">
                            <p class="w-50">{{$cart_item->product->name}}</p>
                            <p class="w-10"> x{{$cart_item->qty}}</p>
                            <p class="w-40">{{$cart_item->row_total}} đ</p>
                        </div>
                    @endforeach
                    <hr class="mt-0">
                    <div class="d-flex justify-content-between mb-3 pt-1">
                        <h6 class="font-weight-medium">Subtotal</h6>
                        <h6 class="font-weight-medium">{{$cart->subtotal}}</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Phí Vận Chuyển</h6>
                        <h6 class="font-weight-medium">-</h6>
                    </div>
                </div>
                <div class="card-footer border-secondary bg-transparent">
                    <div class="d-flex justify-content-between mt-2">
                        <h5 class="font-weight-bold">Total</h5>
                        <h5 class="font-weight-bold">{{$cart->subtotal}}</h5>
                    </div>
                </div>
            </div>
            <div class="card border-secondary mb-5">
                <div class="card-header bg-secondary border-0">
                    <h4 class="font-weight-semi-bold m-0">Phương Thức Thanh Toán</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" name="payment" id="cod" value="cod">
                            <label class="custom-control-label" for="cod">COD - nhận hàng & chyển tiền tại nhà</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" name="payment" id="vnpay" value="vnpay">
                            <label class="custom-control-label" for="vnpay">Thanh Toán qua VNpay</label>
                        </div>
                    </div>
                </div>
                <div class="card-footer border-secondary bg-transparent">
                    <button type="submit" class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3">Place Order</button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- Checkout End -->

@include('frontend.layouts.footer')
