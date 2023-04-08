@extends('layouts.user_type.auth')

@section('content')

    <div>
        <div class="container-fluid">
            <div class="page-header min-height-300 border-radius-xl mt-4">
                <span class="mask bg-gradient-primary opacity-6"></span>
            </div>
            <div class="card card-body blur shadow-blur mx-4 mt-n6">
                <div class="row gx-4">
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mb-1">
                                {{ __($label) }}
                            </h5>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                        <div class="nav-wrapper position-relative end-0">
                            <ul class="nav nav-pills nav-fill p-1 bg-transparent" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link mb-0 px-0 py-1 active " data-bs-toggle="tab" href="javascript:;"
                                       role="tab" aria-controls="overview" aria-selected="true">
                                        <svg class="text-dark" width="16px" height="16px" viewBox="0 0 42 42"
                                             version="1.1"
                                             xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <g id="Basic-Elements" stroke="none" stroke-width="1" fill="none"
                                               fill-rule="evenodd">
                                                <g id="Rounded-Icons" transform="translate(-2319.000000, -291.000000)"
                                                   fill="#FFFFFF" fill-rule="nonzero">
                                                    <g id="Icons-with-opacity"
                                                       transform="translate(1716.000000, 291.000000)">
                                                        <g id="box-3d-50" transform="translate(603.000000, 0.000000)">
                                                            <path class="color-background"
                                                                  d="M22.7597136,19.3090182 L38.8987031,11.2395234 C39.3926816,10.9925342 39.592906,10.3918611 39.3459167,9.89788265 C39.249157,9.70436312 39.0922432,9.5474453 38.8987261,9.45068056 L20.2741875,0.1378125 L20.2741875,0.1378125 C19.905375,-0.04725 19.469625,-0.04725 19.0995,0.1378125 L3.1011696,8.13815822 C2.60720568,8.38517662 2.40701679,8.98586148 2.6540352,9.4798254 C2.75080129,9.67332903 2.90771305,9.83023153 3.10122239,9.9269862 L21.8652864,19.3090182 C22.1468139,19.4497819 22.4781861,19.4497819 22.7597136,19.3090182 Z"
                                                                  id="Path"></path>
                                                            <path class="color-background"
                                                                  d="M23.625,22.429159 L23.625,39.8805372 C23.625,40.4328219 24.0727153,40.8805372 24.625,40.8805372 C24.7802551,40.8805372 24.9333778,40.8443874 25.0722402,40.7749511 L41.2741875,32.673375 L41.2741875,32.673375 C41.719125,32.4515625 42,31.9974375 42,31.5 L42,14.241659 C42,13.6893742 41.5522847,13.241659 41,13.241659 C40.8447549,13.241659 40.6916418,13.2778041 40.5527864,13.3472318 L24.1777864,21.5347318 C23.8390024,21.7041238 23.625,22.0503869 23.625,22.429159 Z"
                                                                  id="Path" opacity="0.7"></path>
                                                            <path class="color-background"
                                                                  d="M20.4472136,21.5347318 L1.4472136,12.0347318 C0.953235098,11.7877425 0.352562058,11.9879669 0.105572809,12.4819454 C0.0361450918,12.6208008 6.47121774e-16,12.7739139 0,12.929159 L0,30.1875 L0,30.1875 C0,30.6849375 0.280875,31.1390625 0.7258125,31.3621875 L19.5528096,40.7750766 C20.0467945,41.0220531 20.6474623,40.8218132 20.8944388,40.3278283 C20.963859,40.1889789 21,40.0358742 21,39.8806379 L21,22.429159 C21,22.0503869 20.7859976,21.7041238 20.4472136,21.5347318 Z"
                                                                  id="Path" opacity="0.7"></path>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                        <span class="ms-1">{{ __('Overview') }}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab" href="javascript:;"
                                       role="tab" aria-controls="teams" aria-selected="false">
                                        <svg class="text-dark" width="16px" height="16px" viewBox="0 0 40 44"
                                             version="1.1" xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <title>document</title>
                                            <g id="Basic-Elements" stroke="none" stroke-width="1" fill="none"
                                               fill-rule="evenodd">
                                                <g id="Rounded-Icons" transform="translate(-1870.000000, -591.000000)"
                                                   fill="#FFFFFF" fill-rule="nonzero">
                                                    <g id="Icons-with-opacity"
                                                       transform="translate(1716.000000, 291.000000)">
                                                        <g id="document" transform="translate(154.000000, 300.000000)">
                                                            <path class="color-background"
                                                                  d="M40,40 L36.3636364,40 L36.3636364,3.63636364 L5.45454545,3.63636364 L5.45454545,0 L38.1818182,0 C39.1854545,0 40,0.814545455 40,1.81818182 L40,40 Z"
                                                                  id="Path" opacity="0.603585379"></path>
                                                            <path class="color-background"
                                                                  d="M30.9090909,7.27272727 L1.81818182,7.27272727 C0.814545455,7.27272727 0,8.08727273 0,9.09090909 L0,41.8181818 C0,42.8218182 0.814545455,43.6363636 1.81818182,43.6363636 L30.9090909,43.6363636 C31.9127273,43.6363636 32.7272727,42.8218182 32.7272727,41.8181818 L32.7272727,9.09090909 C32.7272727,8.08727273 31.9127273,7.27272727 30.9090909,7.27272727 Z M18.1818182,34.5454545 L7.27272727,34.5454545 L7.27272727,30.9090909 L18.1818182,30.9090909 L18.1818182,34.5454545 Z M25.4545455,27.2727273 L7.27272727,27.2727273 L7.27272727,23.6363636 L25.4545455,23.6363636 L25.4545455,27.2727273 Z M25.4545455,20 L7.27272727,20 L7.27272727,16.3636364 L25.4545455,16.3636364 L25.4545455,20 Z"
                                                                  id="Shape"></path>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                        <span class="ms-1">{{ __('Teams') }}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab" href="javascript:;"
                                       role="tab" aria-controls="dashboard" aria-selected="false">
                                        <svg class="text-dark" width="16px" height="16px" viewBox="0 0 40 40"
                                             version="1.1" xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <title>settings</title>
                                            <g id="Basic-Elements" stroke="none" stroke-width="1" fill="none"
                                               fill-rule="evenodd">
                                                <g id="Rounded-Icons" transform="translate(-2020.000000, -442.000000)"
                                                   fill="#FFFFFF" fill-rule="nonzero">
                                                    <g id="Icons-with-opacity"
                                                       transform="translate(1716.000000, 291.000000)">
                                                        <g id="settings" transform="translate(304.000000, 151.000000)">
                                                            <polygon class="color-background" id="Path"
                                                                     opacity="0.596981957"
                                                                     points="18.0883333 15.7316667 11.1783333 8.82166667 13.3333333 6.66666667 6.66666667 0 0 6.66666667 6.66666667 13.3333333 8.82166667 11.1783333 15.315 17.6716667">
                                                            </polygon>
                                                            <path class="color-background"
                                                                  d="M31.5666667,23.2333333 C31.0516667,23.2933333 30.53,23.3333333 30,23.3333333 C29.4916667,23.3333333 28.9866667,23.3033333 28.48,23.245 L22.4116667,30.7433333 L29.9416667,38.2733333 C32.2433333,40.575 35.9733333,40.575 38.275,38.2733333 L38.275,38.2733333 C40.5766667,35.9716667 40.5766667,32.2416667 38.275,29.94 L31.5666667,23.2333333 Z"
                                                                  id="Path" opacity="0.596981957"></path>
                                                            <path class="color-background"
                                                                  d="M33.785,11.285 L28.715,6.215 L34.0616667,0.868333333 C32.82,0.315 31.4483333,0 30,0 C24.4766667,0 20,4.47666667 20,10 C20,10.99 20.1483333,11.9433333 20.4166667,12.8466667 L2.435,27.3966667 C0.95,28.7083333 0.0633333333,30.595 0.00333333333,32.5733333 C-0.0583333333,34.5533333 0.71,36.4916667 2.11,37.89 C3.47,39.2516667 5.27833333,40 7.20166667,40 C9.26666667,40 11.2366667,39.1133333 12.6033333,37.565 L27.1533333,19.5833333 C28.0566667,19.8516667 29.01,20 30,20 C35.5233333,20 40,15.5233333 40,10 C40,8.55166667 39.685,7.18 39.1316667,5.93666667 L33.785,11.285 Z"
                                                                  id="Path"></path>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                        <span class="ms-1">{{ __('Projects') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form action="{{$url}}" method="POST" role="form text-left" enctype="multipart/form-data">
            <div class="container-fluid py-4">
                <div class="card">
                    <div class="card-header pb-0 px-3">
                        <h6 class="mb-0">{{ __('Product Properties') }}</h6>
                    </div>
                    <div class="card-body pt-4 p-3">
                        @csrf
                        @if($errors->any())
                            <div class="mt-3  alert alert-primary alert-dismissible fade show" role="alert">
                            <span class="alert-text text-white">
                            {{$errors->first()}}</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    <i class="fa fa-close" aria-hidden="true"></i>
                                </button>
                            </div>
                        @endif
                        @if(session('success'))
                            <div class="m-3  alert alert-success alert-dismissible fade show" id="alert-success"
                                 role="alert">
                            <span class="alert-text text-white">
                            {{ session('success') }}</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    <i class="fa fa-close" aria-hidden="true"></i>
                                </button>
                            </div>
                        @endif
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user-name" class="form-control-label">{{ __('Name') }}</label>
                                <div class="border rounded-3">
                                    @if(isset($product))
                                        <input class="form-control" value="{{$product->name}}" type="text" placeholder="name"
                                               id="attribute-label" name="name">
                                        <input class="form-control" value="{{$product->id}}" type="hidden"
                                               id="attribute-label" name="id">
                                    @else
                                        <input class="form-control" value="" type="text" placeholder="name"
                                               id="attribute-label" name="name">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">{{ __('SKU') }}</label>
                                <div class="border rounded-3">
                                    <input class="form-control" type="text" id="attribute-code" name="sku"
                                           value="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">{{ __('Category') }}</label>
                                <div class="border rounded-3">
                                    <select class="form-control" id="categories" name="category[]" multiple="multiple">
                                        @foreach($categories as $cate)
                                            <option value="{{$cate['value']}}">{{$cate['label']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">{{ __('Attribute Set') }}</label>
                                <div class="border rounded-3">
                                    <select class="form-control" id="input-product_set" name="attribute_set_id">
                                        @foreach($sets as $set)
                                            <option value="{{$set->id}}">{{$set->attribute_set_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        @foreach($sets as $set)
                            <div class="list-attr {{$set->attribute_set_name}}">
                                @include('admin.product.attribute-input', ['set'=>$set])
                            </div>
                        @endforeach
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">{{ __('price') }}</label>
                                <div class="border rounded-3">
                                    <input class="form-control" type="text" id="attribute-code" name="price"
                                           value="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">{{ __('quantity') }}</label>
                                <div class="border rounded-3">
                                    <input class="form-control" type="text" id="attribute-code" name="qty"
                                           value="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">{{ __('Description') }}</label>
                                <div class="border rounded-3">
                                    <textarea class="form-control" type="text" id="attribute-code" name="description">

                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="input-group hdtuto control-group lst increment" >
                            <div class="list-input-hidden-upload">
                                <input type="file" name="filenames[]" id="file_upload" class="myfrm form-control hidden">
                            </div>
                            <div class="input-group-btn">
                                <button class="btn btn-success btn-add-image" type="button"><i class="fldemo glyphicon glyphicon-plus"></i>+Add image</button>
                            </div>
                        </div>
                        <div class="list-images">
                            @if (isset($list_images) && !empty($list_images))
                                @foreach (json_decode($list_images) as $key => $img)
                                    <div class="box-image">
                                        <input type="hidden" name="images_uploaded[]" value="{{ $img }}" id="img-{{ $key }}">
                                        <img src="{{ asset('files/'.$img) }}" class="picture-box">
                                        <div class="wrap-btn-delete"><span data-id="img-{{ $key }}" class="btn-delete-image">x</span></div>
                                    </div>
                                @endforeach
                                <input type="hidden" name="images_uploaded_origin" value="{{ $list_images }}">
                                <input type="hidden" name="img_id" value="{{ $id }}">
                            @endif
                        </div>
                        <div class="form-check form-switch">
                            <label class="form-check-label" for="flexSwitchCheckDefault">Use in layer navigation</label>
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" checked="">
                        </div>

                        <div class="form-check form-switch">
                            <label class="form-check-label" for="flexSwitchCheckDefault">Use to sort</label>
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" checked="">
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user-email" class="form-control-label">{{ __('Input Type') }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end" style="margin-right: 100px">
                        <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Save' }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            // $('#input-product_set').change(function () {
            //     $('.list-attr').hide();
            //     $('.'+this.text());
            // });
            $(".btn-add-image").click(function(){
                $('#file_upload').trigger('click');
            });

            $('.list-input-hidden-upload').on('change', '#file_upload', function(event){
                let today = new Date();
                let time = today.getTime();
                let image = event.target.files[0];
                let file_name = event.target.files[0].name;
                let box_image = $('<div class="box-image"></div>');
                box_image.append('<img src="' + URL.createObjectURL(image) + '" class="picture-box">');
                box_image.append('<div class="wrap-btn-delete"><span data-id='+time+' class="btn-delete-image">x</span></div>');
                $(".list-images").append(box_image);

                $(this).removeAttr('img_id');
                $(this).attr( 'img_id', time);
                let input_type_file = '<input type="file" name="filenames[]" id="file_upload" class="myfrm form-control hidden">';
                $('.list-input-hidden-upload').append(input_type_file);
            });

            $(".list-images").on('click', '.btn-delete-image', function(){
                let id = $(this).data('id');
                $('#'+id).remove();
                $(this).parents('.box-image').remove();
            });
        });
    </script>
    <style>
        .list-images {
            width: 50%;
            margin-top: 20px;
            display: inline-block;
        }
        .hidden { display: none; }
        .box-image {
            width: 100px;
            height: 108px;
            position: relative;
            float: left;
            margin-left: 5px;
        }
        .box-image img {
            width: 100px;
            height: 100px;
        }
        .wrap-btn-delete {
            position: absolute;
            top: -8px;
            right: 0;
            height: 2px;
            font-size: 20px;
            font-weight: bold;
            color: red;
        }
        .btn-delete-image {
            cursor: pointer;
        }
        .table {
            width: 15%;
        }
    </style>
    <script>
        jQuery(document).ready(function () {
            ImgUpload();
        });

        function ImgUpload() {
            var imgWrap = "";
            var imgArray = [];

            $('.upload__inputfile').each(function () {
                $(this).on('change', function (e) {
                    imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
                    var maxLength = $(this).attr('data-max_length');

                    var files = e.target.files;
                    console.log(files);
                    var filesArr = Array.prototype.slice.call(files);
                    var iterator = 0;
                    filesArr.forEach(function (f, index) {

                        if (!f.type.match('image.*')) {
                            return;
                        }

                        if (imgArray.length > maxLength) {
                            return false
                        } else {
                            var len = 0;
                            for (var i = 0; i < imgArray.length; i++) {
                                if (imgArray[i] !== undefined) {
                                    len++;
                                }
                            }
                            if (len > maxLength) {
                                return false;
                            } else {
                                imgArray.push(f);

                                var reader = new FileReader();
                                reader.onload = function (e) {
                                    var html = "<div class='upload__img-box'><div style='background-image: url(" + e.target.result + ")' data-number='" + $(".upload__img-close").length + "' data-file='" + f.name + "' class='img-bg'><div class='upload__img-close'></div></div></div>";
                                    imgWrap.append(html);
                                    iterator++;
                                }
                                reader.readAsDataURL(f);
                            }
                        }
                    });
                });
            });

            $('body').on('click', ".upload__img-close", function (e) {
                var file = $(this).parent().data("file");
                for (var i = 0; i < imgArray.length; i++) {
                    if (imgArray[i].name === file) {
                        imgArray.splice(i, 1);
                        break;
                    }
                }
                $(this).parent().parent().remove();
            });
        }
    </script>
    <style>
        html * {
            box-sizing: border-box;
        }
        p {
            margin: 0;
        }
        .upload__box {
            padding: 40px;
        }
        .upload__inputfile {
            width: 0.1px;
            height: 0.1px;
            opacity: 0;
            overflow: hidden;
            position: absolute;
            z-index: -1;
        }
        .upload__btn {
            display: inline-block;
            font-weight: 600;
            color: #fff;
            text-align: center;
            min-width: 116px;
            padding: 5px;
            transition: all 0.3s ease;
            cursor: pointer;
            border: 2px solid;
            background-color: #4045ba;
            border-color: #4045ba;
            border-radius: 10px;
            line-height: 26px;
            font-size: 14px;
        }
        .upload__btn:hover {
            background-color: unset;
            color: #4045ba;
            transition: all 0.3s ease;
        }
        .upload__btn-box {
            margin-bottom: 10px;
        }
        .upload__img-wrap {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -10px;
        }
        .upload__img-box {
            width: 200px;
            padding: 0 10px;
            margin-bottom: 12px;
        }
        .upload__img-close {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background-color: rgba(0,0,0,0.5);
            position: absolute;
            top: 10px;
            right: 10px;
            text-align: center;
            line-height: 24px;
            z-index: 1;
            cursor: pointer;
        }
        .upload__img-close:after {
            content: '\2716';
            font-size: 14px;
            color: #fff;
        }
        .img-bg {
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            position: relative;
            padding-bottom: 100%;
        }
    </style>
@endsection
