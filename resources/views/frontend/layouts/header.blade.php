<!DOCTYPE html>
<html lang="en">
<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>TA Computer</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- site icons -->
    <link rel="icon" href="{{url('images/fevicon/fevicon.png')}}" type="image/gif" />
    <!-- bootstrap css -->
    <link rel="stylesheet" href="{{url('css/bootstrap.min.css')}}" />
    <!-- Site css -->
    <link rel="stylesheet" href="{{url('css/style.css')}}" />
    <!-- responsive css -->
    <link rel="stylesheet" href="{{url('css/responsive.css')}}" />
    <!-- colors css -->
    <link rel="stylesheet" href="{{url('css/colors1.css')}}" />
    <!-- custom css -->
    <link rel="stylesheet" href="{{url('css/custom.css')}}" />
    <!-- wow Animation css -->
    <link rel="stylesheet" href="{{url('css/animate.css')}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/fontawesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" />
    <!-- revolution slider css -->
    <link rel="stylesheet" type="text/css" href="{{url('revolution/css/settings.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{url('revolution/css/layers.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{url('revolution/css/navigation.css')}}" />

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body id="default_theme" class="it_service">
<!-- loader -->
<div class="bg_load"> <img class="loader_animation" src="{{url('images/loaders/loader_1.png')}}" alt="#" /> </div>
<!-- end loader -->
<!-- header -->
<header id="default_header" class="header_style_1">
    <!-- header top -->
    <div class="header_top">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="full">
                        <div class="topbar-left">
                            <ul class="list-inline">
                                <li> <span class="topbar-label"><i class="fa  fa-home"></i></span> <span class="topbar-hightlight">48 Tố Hữu, Nam Từ Liêm, Hà Nội</span> </li>
                                <li> <span class="topbar-label"><i class="fa fa-envelope-o"></i></span> <span class="topbar-hightlight"><a href="mailto:info@yourdomain.com">sales@tacomputer.com</a></span> </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 right_section_header_top">
                    <div class="float-left">
                        <div class="social_icon">
                            <ul class="list-inline">
                                <li><a class="fa fa-facebook" href="https://www.facebook.com/" title="Facebook" target="_blank"></a></li>
                                <li><a class="fa fa-google-plus" href="https://plus.google.com/" title="Google+" target="_blank"></a></li>
                                <li><a class="fa fa-twitter" href="https://twitter.com" title="Twitter" target="_blank"></a></li>
                                <li><a class="fa fa-linkedin" href="https://www.linkedin.com" title="LinkedIn" target="_blank"></a></li>
                                <li><a class="fa fa-instagram" href="https://www.instagram.com" title="Instagram" target="_blank"></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="float-right">
                        <div class="make_appo"> <a class="btn white_btn" href="make_appointment.html">Đặt Lịch Tư Vấn Build PC</a> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end header top -->
    <!-- header bottom -->
    <div class="header_bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                    <!-- logo start -->
                    <div class="logo"> <a href="{{url('/')}}"><img src="{{url('logo.png')}}" alt="logo" /></a> </div>
                    <!-- logo end -->
                </div>
                <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                    <!-- menu start -->
                    <div class="menu_side">
                        <div id="navbar_menu">
                            <ul class="first-ul">
                                <li> <a class="active" href="{{url('/')}}">Trang Chủ</a>
                                </li>
                                <li><a href="it_about.html">Sản Phẩm</a>
                                    <ul>
                                        <li><a href="">LapTop</a></li>
                                        <li> <a href="it_service.html">PC</a></li>
                                        <li> <a href="it_blog.html">Gaming gear</a>
                                            <ul>
                                                <li><a href="it_blog.html">Blog List</a></li>
                                                <li><a href="it_blog_grid.html">Blog Grid</a></li>
                                                <li><a href="it_blog_detail.html">Blog Detail</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li> <a href="it_contact.html">Liên Hệ</a>
                                </li>
                                @if(session()->get('customer'))
                                    <li>
                                        <a href="{{url('my-account')}}" class="nav-item nav-link">Tài Khoản của tôi</a>
                                    </li>
                                    <li>
                                        <a href="{{url('logout')}}" class="nav-item nav-link">Đăng Xuất</a>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{url('login')}}" class="nav-item nav-link">Đăng Nhâp</a>
                                    </li>
                                    <li>
                                        <a href="{{url('register')}}" class="nav-item nav-link">Đăng kí</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                        <div class="search_icon">
                            <ul>
                                <li><a href="#" data-toggle="modal" data-target="#search_bar"><i class="fa fa-search" aria-hidden="true"></i></a></li>
                            </ul>
                            <a href="{{url('checkout/cart')}}" class="cart-icon">
                                <i class="fas fa-shopping-cart text-primary"></i>
                                <span class="badge cart-count">{{\Illuminate\Support\Facades\Session::get('cart_count') ?? 0}}</span>
                            </a>
                        </div>

                        <div class="col-lg-3 col-6 text-right">

                        </div>
                    </div>
                    <!-- menu end -->
                </div>
            </div>
        </div>
    </div>
    <!-- header bottom end -->
</header>
<!-- end header -->
