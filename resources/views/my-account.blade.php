@include('frontend.layouts.header')

<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-md-3">
            <div class="side_bar">
                <div class="side_bar_blog">
                    <h4>Tài Khoản Của Tôi</h4>
                    <div class="categary">
                        <ul>
                            <li class="active"><a href="{{url('/my-account')}}"><i class="fa fa-angle-right"></i> Thông Tin Tài Khoản</a></li>
                            <li><a href="{{url('/orders')}}"><i class="fa fa-angle-right"></i> Đơn Hàng</a></li>
                            <li><a href="{{url('address')}}"><i class="fa fa-angle-right"></i> Địa chỉ</a></li>
                        </ul>
                    </div>
                </div>
            </div>
    </div>

        <!-- Shop Product Start -->
        <div class="col-md-9">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <form action="{{'customer/update'}}" method="post" style="margin-left: 30%; width: 400px">
                            @csrf
                            <input class="form-control" value="{{$customer->id}}" name="id" type="hidden" placeholder="">
                                <div class="mb-3 form-group">
                                    <label>Họ Và Tên</label>
                                    <input class="form-control required" value="{{$customer->name}}" name="name" type="text" placeholder="" required>
                                    <div class="invalid-feedback">
                                        Trường Này Không được Để trống
                                    </div>
                                </div>
                                <div class="mb-3  form-group">
                                    <label>Ngày Sinh</label>
                                    <input class="form-control required" value="{{$customer->dob}}" name="dob" type="date" placeholder="" required>
                                    <div class="invalid-feedback">
                                        Trường Này Không được Để trống
                                    </div>
                                </div>
                                <div class="mb-3  form-group">
                                    <label>Email</label>
                                    <input class="form-control required" value="{{$customer->email}}" name="email" type="email" placeholder="" required>
                                    <div class="invalid-feedback">
                                        Trường Này Không được Để trống
                                    </div>
                                </div>
                            <div class="mb-3  form-group">
                                <label>Số Điện Thoại</label>
                                <input class="form-control required" value="{{$customer->sdt}}" name="sdt" type="text" placeholder="" required>
                                <div class="invalid-feedback">
                                    Trường Này Không được Để trống
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Lưu</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('frontend.layouts.footer')
