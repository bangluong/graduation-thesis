@include('frontend.layouts.header')
@include('frontend.layouts.slider')
<!-- section -->
<div class="section padding_layout_1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="full">
                    <div class="main_heading text_align_center">
                        <h2>Sản Phẩm Bán Chạy</h2>
                        <p class="large">We package the products with best services to make you a happy customer.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($products as $product)
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 margin_bottom_30_all">
                    <a href="{{url('product/'.$product->sku)}}">
                        <div class="product_list">
                            <div class="product_img"> <img class="img-responsive" src="{{$product->img}}" alt=""> </div>
                            <div class="product_detail_btm">
                                <div class="center">
                                    <h4><a href="{{url('product/'.$product->sku)}}">{{$product->name}}</a></h4>
                                </div>
                                <div class="starratin">
                                    <div class="center"> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true">
                                        </i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> </div>
                                </div>
                                <div class="product_price">
                                    @if($product->sale_price)
                                        <p><span class="old_price">{{$product->price}}</span> – <span class="new_price">{{$product->sale_price}}</span></p>
                                    @else
                                        <p><span class="new_price">{{$product->price}}</span></p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </a>

                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- end section -->
@include('frontend.layouts.footer')
