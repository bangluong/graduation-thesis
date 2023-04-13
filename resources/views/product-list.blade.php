@include('frontend.layouts.header')
<!-- inner page banner -->
<div id="inner_banner" class="section inner_banner_section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="full">
                    <div class="title-holder">
                        <div class="title-holder-cell text-left">
                            <h1 class="page-title">Shop Page</h1>
                            <ol class="breadcrumb">
                                <li><a href="index.html">Home</a></li>
                                <li class="active">Shop</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end inner page banner -->

<!-- Shop Start -->

<!-- section -->
<div class="section padding_layout_1 product_list_main">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="side_bar">
                    <div class="side_bar_blog">
                        <h4>Tìm Kiếm</h4>
                        <div class="side_bar_search">
                            <form action="{{url('/search')}}" method="GET">
                                @csrf
                                <div class="input-group stylish-input-group">
                                    <input class="form-control" placeholder="Nhập Từ Khóa" name="q" type="text">
                                    <span class="input-group-addon">
                <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                </span> </div>
                            </form>
                        </div>
                    </div>
                    <div class="side_bar_blog">
                        <h4>Category</h4>
                        <div class="categary">
                            <ul>
                                @foreach($cates as $cate)
                                <li class="mb-1" ><a href="{{url('category/'.$cate->id)}}">{{$cate->title}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
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
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        @foreach($pages as $page)
                            <li class="page-item {{$page['class']}}"><a class="page-link" href="{{$page['url']}}">{{$page['label']}}</a></li>
                        @endforeach
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div><!-- Shop End -->
@include('frontend.layouts.footer')
