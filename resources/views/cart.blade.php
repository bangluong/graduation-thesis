@include('frontend.layouts.header')
<!-- inner page banner -->
<div id="inner_banner" class="section inner_banner_section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="full">
                    <div class="title-holder">
                        <div class="title-holder-cell text-left">
                            <h1 class="page-title">Giỏ Hàng</h1>
                            <ol class="breadcrumb">
                                <li><a href="{{url('/')}}">Trang chủ</a></li>
                                <li class="active">Giỏ Hàng</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end inner page banner -->
@if($cart != null)
    <!-- end inner page banner -->
    <div class="section padding_layout_1 Shopping_cart_section">
        @if(session('fe-success'))
            <div class="m-3  alert alert-success alert-dismissible fade show" id="alert-success"
                 role="alert">
                            {{ session('fe-success') }}
            </div>
        @endif
        @if(session('fe-error'))
            <div class="m-3  alert alert-danger alert-dismissible fade show" id="alert-success"
                 role="alert">
                            <span class="alert-text text-white">
                            {{ session('fe-error') }}</span>
            </div>
        @endif
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <div class="product-table">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Sản Phẩm</th>
                                <th>Số Lương</th>
                                <th class="text-center">Đơn Giá</th>
                                <th class="text-center">Tổng Tiền</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cart_items as $cart_item)
                                <tr>
                                <td class="col-sm-8 col-md-6">
                                    <div class="media"><a class="thumbnail pull-left" href="#">
                                            <img class="media-object cart-item-image" src="{{$cart_item->product->img}}"
                                                 alt="#"></a>
                                        <div class="media-body">
                                            <h4 class="media-heading"><a href="#">{{$cart_item->product->name}}</a></h4>
                                            <span>Trạng Thái: </span><span class="text-success">còn hàng</span></div>
                                    </div>
                                </td>
                                <td class="col-sm-1 col-md-1" style="text-align: center">
                                    <div class="flex-update-cart">
                                        <div class="input-group-btn">
                                            <a href="{{url('checkout/cart/update-item/'.$cart_item->id.'/minus')}}">
                                                <i class="fa fa-minus"></i>
                                            </a>

                                        </div>
                                        <input type="text" class="form-control"
                                               value="{{$cart_item->qty}}">
                                        <div class="input-group-btn">
                                            <a href="{{url('checkout/cart/update-item/'.$cart_item->id.'/plus')}}">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                                <td class="col-sm-1 col-md-1 text-center"><p
                                        class="price_table">{{number_format($cart_item->price)}}</p></td>
                                <td class="col-sm-1 col-md-1 text-center"><p
                                        class="price_table">{{number_format($cart_item->row_total)}}</p></td>
                                <td class="col-sm-1 col-md-1">
                                    <button type="button" class="bt_main"><i class="fa fa-trash"></i> Xóa</button>
                                </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="shopping-cart-cart shopping-cart">
                        <table>
                            <tbody>
                            <tr class="head-table">
                                <td><h5>Tổng Giỏ Hàng</h5></td>
                                <td class="text-right"></td>
                            </tr>
                            <tr>
                                <td><h4>Tổng Thành Tiền</h4></td>
                                <td class="text-right"><h4>{{number_format($cart->subtotal)}}</h4></td>
                            </tr>
                            <tr>
                                <td><h5>Phí Vận Chuyển</h5></td>
                                <td class="text-right"><h4>0</h4></td>
                            </tr>
                            <tr>
                                <td><h3>Tổng</h3></td>
                                <td class="text-right"><h4>{{number_format($cart->subtotal)}}</h4></td>
                            </tr>
                            <tr>
                                <td><a href="{{url('/')}}"><button type="button" class="button">Tiếp tục mua hàng</button></a></td>
                                <td><a href="{{url('/checkout')}}"><button class="button">Thanh toán</button></a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <p class="mr-lg-n5">Chưa có sản phẩm nào trong giỏ hàng của bạn</p>
@endif
@include('frontend.layouts.footer')
