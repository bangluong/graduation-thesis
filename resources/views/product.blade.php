@include('frontend.layouts.header')
<!-- inner page banner -->
<div id="inner_banner" class="section inner_banner_section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="full">
                    <div class="title-holder">
                        <div class="title-holder-cell text-left">
                            <h1 class="page-title">Chi Tiết Sản Phẩm</h1>
                            <ol class="breadcrumb">
                                <li><a href="index.html">Home</a></li>
                                <li class="active">{{$product->name}}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Shop Detail Start -->
<div class="container-fluid py-5 product_detail">
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
    <div class="row px-xl-5">
        <div class="col-lg-5 pb-5">
            <div id="product-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner border">
                    @foreach($product->imgs as $image)
                        <div class="carousel-item active">
                            <img class="w-100 h-100" src="{{$image}}" alt="Image">
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                    <i class="fa fa-2x fa-angle-left text-dark"></i>
                </a>
                <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                    <i class="fa fa-2x fa-angle-right text-dark"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-7 pb-5">
            <h3 class="font-weight-semi-bold product-name">{{$product->name}}</h3>
            <div class="d-flex mb-3">
                <div class="text-primary mr-2">
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star"></small>
                    <small class="fas fa-star-half-alt"></small>
                    <small class="far fa-star"></small>
                </div>
                <small class="pt-1">(50 Reviews)</small>
            </div>
{{--            <h3 class="font-weight-semi-bold mb-4">{{$product->price}}đ</h3>--}}
            <div class="product_price">
                @if($product->sale_price)
                    <h3><span class="old_price">{{ number_format($product->price)}}</span> – <span class="new_price">{{number_format($product->sale_price)}} VNĐ</span></h3>
                @else
                    <h3><span class="new_price">{{number_format($product->price)}} VNĐ</span></h3>
                @endif
            </div>
            <p class="mb-4">✔ Bảo hành chính hãng 24 tháng.</p><br>
            <p class="mb-4">✔ Hỗ trợ đổi mới trong 7 ngày.</p><br>
            <p class="mb-4">✔ Windows bản quyền tích hợp.</p><br>
            <p class="mb-4">✔ Miễn phí giao hàng toàn quốc.</p><br>
            <div class="d-flex align-items-center mb-4 pt-2">
                <form action="{{url('checkout/cart/add')}}" method="POST" enctype="multipart/form-data"
                      class="d-flex align-items-center mb-4 pt-2">
                    @csrf
                    <div class="input-group quantity mr-3" style="width: 130px;">
                        <input size="4" step="1" min="1" max="5" type="number" class="input-text qty text form-control"
                               name="qty" value="1">
                        <input type="hidden" value="{{$product->id}}" name="product_id">
                    </div>
                    <button class="btn btn-primary px-3" type="submit"><i class="fa fa-shopping-cart mr-1"></i>Thêm Vào
                        Giỏ Hàng
                    </button>
                </form>
            </div>
            <div class="d-flex pt-2">
                <p class="text-dark font-weight-medium mb-0 mr-2">Chia sẻ:</p>
                <div class="d-inline-flex">
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-pinterest"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row px-xl-5">
        <div class="col-md-12">
            <div class="full">
                <div class="tab_bar_section">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#description">Mô Tả Sản
                                Phẩm</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#detail">Thông Số Kĩ Thuật</a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div id="description" class="tab-pane active">
                            <div class="product_desc">
                                {{$product->description}}
                            </div>
                        </div>
                        <div id="detail" class="tab-pane">
                            <div class="product_desc">
                                <h5>Thông số kĩ thuật</h5>
                                <table class="table table-striped">
                                    <tbody>
                                    @foreach($product->attributes as $attribute)
                                        @if($attribute->label != null || $attribute->label != 'null')
                                            <tr>
                                                <td>{{$attribute->attribute_name}}</td>
                                                <td>{{$attribute->label}}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--        <div class="col ">--}}
        {{--            <div class="nav nav-tabs justify-content-center border-secondary mb-4">--}}
        {{--                <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">Mô Tả</a>--}}
        {{--                <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-2">Thông Tin</a>--}}
        {{--                <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-3">Đánh Giá (0)</a>--}}
        {{--            </div>--}}
        {{--            <div class="tab-content">--}}
        {{--                <div class="tab-pane fade show active" id="tab-pane-1">--}}
        {{--                    <h4 class="mb-3">Mô Tả Sản Phẩm</h4>--}}
        {{--                    {{$product->description}}--}}
        {{--                <div class="tab-pane fade" id="tab-pane-2">--}}
        {{--                    <h3 class="mb-3">Thông tin chi tiết sản phẩm</h3>--}}
        {{--                    <h5>Thông số kĩ thuật</h5>--}}
        {{--                    <table class="table table-striped">--}}
        {{--                        <tbody>--}}
        {{--                        @foreach($product->attributes as $attribute)--}}
        {{--                            @if($attribute->label != null || $attribute->label != 'null')--}}
        {{--                                <tr>--}}
        {{--                                    <td>{{$attribute->attribute_name}}</td>--}}
        {{--                                    <td>{{$attribute->label}}</td>--}}
        {{--                                </tr>--}}
        {{--                            @endif--}}
        {{--                        @endforeach--}}
        {{--                        </tbody>--}}
        {{--                    </table>--}}
        {{--                </div>--}}
        {{--                <div class="tab-pane fade" id="tab-pane-3">--}}
        {{--                    <div class="row">--}}
        {{--                        <div class="col-md-6">--}}
        {{--                            <h4 class="mb-4">1 review for "Colorful Stylish Shirt"</h4>--}}
        {{--                            <div class="media mb-4">--}}
        {{--                                <img src="img/user.jpg" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">--}}
        {{--                                <div class="media-body">--}}
        {{--                                    <h6>John Doe<small> - <i>01 Jan 2045</i></small></h6>--}}
        {{--                                    <div class="text-primary mb-2">--}}
        {{--                                        <i class="fas fa-star"></i>--}}
        {{--                                        <i class="fas fa-star"></i>--}}
        {{--                                        <i class="fas fa-star"></i>--}}
        {{--                                        <i class="fas fa-star-half-alt"></i>--}}
        {{--                                        <i class="far fa-star"></i>--}}
        {{--                                    </div>--}}
        {{--                                    <p>Diam amet duo labore stet elitr ea clita ipsum, tempor labore accusam ipsum et no at. Kasd diam tempor rebum magna dolores sed sed eirmod ipsum.</p>--}}
        {{--                                </div>--}}
        {{--                            </div>--}}
        {{--                        </div>--}}
        {{--                        <div class="col-md-6">--}}
        {{--                            <h4 class="mb-4">Leave a review</h4>--}}
        {{--                            <small>Your email address will not be published. Required fields are marked *</small>--}}
        {{--                            <div class="d-flex my-3">--}}
        {{--                                <p class="mb-0 mr-2">Your Rating * :</p>--}}
        {{--                                <div class="text-primary">--}}
        {{--                                    <i class="far fa-star"></i>--}}
        {{--                                    <i class="far fa-star"></i>--}}
        {{--                                    <i class="far fa-star"></i>--}}
        {{--                                    <i class="far fa-star"></i>--}}
        {{--                                    <i class="far fa-star"></i>--}}
        {{--                                </div>--}}
        {{--                            </div>--}}
        {{--                            <form>--}}
        {{--                                <div class="form-group">--}}
        {{--                                    <label for="message">Your Review *</label>--}}
        {{--                                    <textarea id="message" cols="30" rows="5" class="form-control"></textarea>--}}
        {{--                                </div>--}}
        {{--                                <div class="form-group">--}}
        {{--                                    <label for="name">Your Name *</label>--}}
        {{--                                    <input type="text" class="form-control" id="name">--}}
        {{--                                </div>--}}
        {{--                                <div class="form-group">--}}
        {{--                                    <label for="email">Your Email *</label>--}}
        {{--                                    <input type="email" class="form-control" id="email">--}}
        {{--                                </div>--}}
        {{--                                <div class="form-group mb-0">--}}
        {{--                                    <input type="submit" value="Leave Your Review" class="btn btn-primary px-3">--}}
        {{--                                </div>--}}
        {{--                            </form>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        {{--    </div>--}}
    </div>
    <!-- Shop Detail End -->


@include('frontend.layouts.footer')
