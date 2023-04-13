<!-- Navbar Start -->
<div class=" container mb-5">
    <div class="row border-top px-xl-5">
        <div class="col-lg-12">
            <nav class="menu_side navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                <div class="navbar_menu navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <a href="{{url('/')}}" class="nav-item nav-link active">Trang Chủ</a>
                        <a href="{{url('all-products')}}" class="nav-item nav-link">Sản Phẩm</a>
                        <a href="{{url('products/laptop')}}" class="nav-item nav-link">Laptop</a>
                        <a href="{{url('products/pc')}}" class="nav-item nav-link">PC</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Gaming Gear</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="cart.html" class="dropdown-item">Mechanical Keyboard</a>
                                <a href="checkout.html" class="dropdown-item">Mouse Gaming</a>
                            </div>
                        </div>
                        <a href="{{url('contact-us')}}" class="nav-item nav-link">Liên Hệ</a>
                    </div>
                    <div class="navbar-nav ml-auto py-0">
                        @if(session()->get('customer'))
                            <a href="{{url('my-account')}}" class="nav-item nav-link">Tài Khoản của tôi</a>
                            <a href="{{url('logout')}}" class="nav-item nav-link">Đăng Xuất</a>
                        @else
                            <a href="{{url('login')}}" class="nav-item nav-link">Đăng Nhâp</a>
                            <a href="{{url('register')}}" class="nav-item nav-link">Đăng kí</a>
                        @endif
                    </div>
                </div>
            </nav>

