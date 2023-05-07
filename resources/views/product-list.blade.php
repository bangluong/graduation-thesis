@include('frontend.layouts.header')
<!-- inner page banner -->
<div id="inner_banner" class="section inner_banner_section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="full">
                    <div class="title-holder">
                        <div class="title-holder-cell text-left">
                            <h1 class="page-title">Danh Sách Sản Phẩm</h1>
                            <ol class="breadcrumb">
                                <li><a href="index.html">Trang Chủ</a></li>
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
                        <h4>Bộ Lọc</h4>
                    <div class="side_bar_blog" data-id="category">
                        <h4>Danh Mục</h4>
                        <div class="categary" id="category" style="display: none">
                            <ul>
                                @foreach($cates as $cate)
                                <li class="mb-1" ><a href="{{url('category/'.$cate->url)}}">{{$cate->title}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="side_bar_blog" data-id="khoang-gia">
                        <h4>Khoảng Giá</h4>
                        <div class="categary" id="khoang-gia" style="display: none">
                            <ul>
                                <li><a href="{{request()->url().'/?filter=price1'}}">Dưới 10 triệu</a></li>
                                <li><a href="{{request()->url().'/?filter=price2'}}">10-20 triệu</a></li>
                                <li><a href="{{request()->url().'/?filter=price3'}}">Trên 20 triệu</a> </li>
                            </ul>
                        </div>
                    </div>

                    <div class="side_bar_blog" data-id="brand">
                        <h4>Thương Hiệu</h4>
                        <div class="categary" id="brand" style="display: none">
                            <ul>
                                @foreach($brands as $brand)
                                    <li><a href="{{request()->url().'/?brand='.$brand->value}}">{{$brand->swatch}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <select class="form-select form-control sortby-select" aria-label="Default select example">
                    <option>Sắp xếp theo</option>
                    <option value="price" @if(request()->get('sort') == 'price') selected @endif>Giá</option>
                    <option value="name" @if(request()->get('sort') == 'name') selected @endif>Tên</option>
                </select>
                @if($products)
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
                                                    <p><span class="old_price">{{ number_format($product->price)}}</span> – <span class="new_price">{{number_format($product->sale_price)}}</span></p>
                                                @else
                                                    <p><span class="new_price">{{number_format($product->price)}}</span></p>
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
                @else
                    <p>Không có kết quả phù hợp</p>
                @endif

            </div>
        </div>
    </div>
</div><!-- Shop End -->
@include('frontend.layouts.footer')
<style>
    .sortby-select {
        width: 25% !important;
        margin-bottom: 10px !important;
        margin-left: 74% !important;
    }
    .side_bar_blog {
        cursor: pointer;
        margin-bottom: 0 !important;
        margin-top: 10px;
    }
</style>
<script>
    $('.sortby-select').change(function() {
        console.log(this);
        console.log($(this).val());
        var url = window.location.href;
        if (url.includes('sort=name')) {
            url.replace('name', 'price');
        } else if (url.includes('sort=price')) {
            url.replace('sort=price', 'sort=name');
        } else {
            if (url.includes('?')) {
                url = url + '&sort='+$(this).val();
            } else {
                url = url + '?sort='+$(this).val();
            }
        }
        console.log(url);
        window.location.href = url;
    })
    $('.side_bar_blog').click(function () {
        var id = $(this).data('id');
        if ($('#'+id).hasClass('active')) {
            $('#'+id).hide();
            $('#'+id).removeClass('active');
        } else {
            $('#'+id).show();
            $('#'+id).addClass('active');
        }
    })
</script>
