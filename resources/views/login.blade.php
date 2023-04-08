@include('frontend.layouts.header')
@include('frontend.layouts.topbar')
@include('frontend.layouts.navbar')
@include('frontend.layouts.navbarend')
<div class="container-fluid pt-5">
    @if(isset($message))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <p>{{$message}}</p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="row px-xl-5 justify-content-center">
        <div class="border-5">
            <form action="{{url('login')}}" method="post" enctype="multipart/form-data">
                @csrf
                <!-- Email input -->
                <div class="form-outline mb-4">
                    <label class="form-label" for="form2Example1">Email: </label>
                    <input type="email" id="form2Example1" name="email" class="form-control" />
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                    <label class="form-label" for="form2Example2">Mật Khẩu: </label>
                    <input type="password" id="form2Example2" name="pwd" class="form-control" />
                </div>

                <!-- 2 column grid layout for inline styling -->
                <div class="row mb-4">
                    <div class="col d-flex justify-content-center">
                        <!-- Checkbox -->
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
                            <label class="form-check-label" for="form2Example31"> Ghi nhớ cho lần đăng nhập sau </label>
                        </div>
                    </div>

                    <div class="col">
                        <!-- Simple link -->
                        <a href="#!">Quên Mật Khẩu?</a>
                    </div>
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-4">Đăng Nhập</button>

                <!-- Register buttons -->
                <div class="text-center">
                    <p><a href="{{url('register')}}">Đăng kí</a></p>
                    <p>hoặc đăng nhập với:</p>
                    <button type="button" class="btn btn-link btn-floating mx-1">
                        <i class="fab fa-facebook-f"></i>
                    </button>

                    <button type="button" class="btn btn-link btn-floating mx-1">
                        <i class="fab fa-google"></i>
                    </button>

                    <button type="button" class="btn btn-link btn-floating mx-1">
                        <i class="fab fa-twitter"></i>
                    </button>

                    <button type="button" class="btn btn-link btn-floating mx-1">
                        <i class="fab fa-github"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@include('frontend.layouts.footer')
