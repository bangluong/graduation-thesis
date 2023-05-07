<!-- Modal -->
<div class="modal fade" id="search_bar" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="fa fa-close"></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-8 offset-lg-2 offset-md-2 offset-sm-2 col-xs-10 col-xs-offset-1">
                        <div class="navbar-search">
                            <form action="{{url('all-products')}}" method="get" id="search-global-form" class="search-global">
                                <input type="text" placeholder="Nhập từ khóa tìm kiếm" autocomplete="off" name="s" id="search" value="" class="search-global__input">
                                <button class="search-global__btn"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Model search bar -->
<!-- footer -->
<footer class="footer_style_2">
    <div class="container-fuild">
        <div class="row">
            <div class="map_section">
                <div id="map"></div>
            </div>
            <div class="footer_blog">
                <div class="row">
                    <div class="col-md-6">
                        <div class="main-heading left_text">
                            <h2>Trần Anh Computer</h2>
                        </div>
                        <p>Nhà Bán lẻ máy tính, laptop, gaming gear</p>
                        <ul class="social_icons">
                            <li class="social-icon fb"><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li class="social-icon tw"><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            <li class="social-icon gp"><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <div class="main-heading left_text">
                            <h2>Thông tin</h2>
                        </div>
                        <ul class="footer-menu">
                            <li><a href="it_about.html"><i class="fa fa-angle-right"></i> Về chúng tôi</a></li>
                            <li><a href="it_term_condition.html"><i class="fa fa-angle-right"></i> Điều khoản sử dụng</a></li>
                            <li><a href="it_privacy_policy.html"><i class="fa fa-angle-right"></i> Chính sách bảo mật</a></li>
                            <li><a href="it_contact.html"><i class="fa fa-angle-right"></i> Liên hệ</a></li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <div class="main-heading left_text">
                            <h2>Dịch Vụ</h2>
                        </div>
                        <ul class="footer-menu">
                            <li><a href="it_data_recovery.html"><i class="fa fa-angle-right"></i> Sửa chữa máy tính, lap top</a></li>
                            <li><a href="it_computer_repair.html"><i class="fa fa-angle-right"></i> Tư vấn buidl PC</a></li>
                            <li><a href="it_mobile_service.html"><i class="fa fa-angle-right"></i> Customize keyboard</a></li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <div class="main-heading left_text">
                            <h2>Địa chỉ</h2>
                        </div>
                        <p>48 Tố Hữu, Nam Từ Liêm, Hà Nội<br>
                            <span style="font-size:18px;"><a href="tel:+9876543210">+987 654 3210</a></span></p>
                        <div class="footer_mail-section">
                            <form>
                                <fieldset>
                                    <div class="field">
                                        <input placeholder="Email" type="text">
                                        <button class="button_custom"><i class="fa fa-envelope" aria-hidden="true"></i></button>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cprt">
                <p>ItNext © Copyrights 2019 Design by html.design</p>
            </div>
        </div>
    </div>
</footer>
<!-- end footer -->
<!-- js section -->
<script src="{{url('js/jquery.min.js')}}"></script>
<script src="{{url('js/bootstrap.min.js')}}"></script>
<!-- menu js -->
<script src="{{url('js/menumaker.js')}}"></script>
<!-- wow animation -->
{{--<script src="{{url('js/wow.js')}}"></script>--}}
<!-- custom js -->
{{--<script src="{{url('js/custom.js')}}"></script>--}}
<!-- revolution js files -->
{{--<script src="{{url('revolution/js/jquery.themepunch.tools.min.js')}}"></script>--}}
{{--<script src="{{url('revolution/js/jquery.themepunch.revolution.min.js')}}"></script>--}}
{{--<script src="{{url('revolution/js/extensions/revolution.extension.actions.min.js')}}"></script>--}}
{{--<script src="{{url('revolution/js/extensions/revolution.extension.carousel.min.js')}}"></script>--}}
{{--<script src="{{url('revolution/js/extensions/revolution.extension.kenburn.min.js')}}"></script>--}}
{{--<script src="{{url('revolution/js/extensions/revolution.extension.layeranimation.min.js')}}"></script>--}}
{{--<script src="{{url('revolution/js/extensions/revolution.extension.migration.min.js')}}"></script>--}}
{{--<script src="{{url('revolution/js/extensions/revolution.extension.navigation.min.js')}}"></script>--}}
{{--<script src="{{url('revolution/js/extensions/revolution.extension.parallax.min.js')}}"></script>--}}
{{--<script src="{{url('revolution/js/extensions/revolution.extension.slideanims.min.js')}}"></script>--}}
{{--<script src="{{url('revolution/js/extensions/revolution.extension.video.min.js')}}"></script>--}}
<!-- map js -->
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function () {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    console.log($(this));
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    console.log(form.classList);
                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>
<!-- google map js -->
<!-- end google map js -->
</body>
</html>
