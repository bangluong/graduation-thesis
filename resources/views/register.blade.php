@include('frontend.layouts.header')
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
<div class="container-fluid pt-5 flex justify-content-center" style="display: flex; justify-content: center">
    <div class="row px-xl-5 justify-content-center" style="display: block !important; width: 35%">
        <div class="border-5">
        <form action="{{url('register')}}" method="post" enctype="multipart/form-data">
            @csrf
            <!-- Email input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="form2Example1">Họ Và Tên: </label>
                <input type="text" id="form2Example1" name="name" class="form-control" />
            </div>
            <!-- Email input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="form2Example1">Ngày Sinh: </label>
                <input type="date" id="form2Example1" name="dob" class="form-control" />
            </div>
            <!-- Email input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="form2Example1">Email: </label>
                <input type="email" id="form2Example1" name="email" class="form-control" />
            </div>

            <div class="form-outline mb-4">
                <label class="form-label" for="form2Example1">Số Điện Thoại: </label>
                <input type="text" id="form2Example1" name="sdt" class="form-control" />
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="form2Example2">Mật Khẩu: </label>
                <input type="password" id="form2Example2" name="pwd" class="form-control" />
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="form2Example2">Nhập Lại Mật Khẩu: </label>
                <input type="password" id="form2Example2" name="pwd2" class="form-control" />
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
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block mb-4">Đăng Kí</button>
        </form>
        </div>
    </div>
</div>
@include('frontend.layouts.footer')
