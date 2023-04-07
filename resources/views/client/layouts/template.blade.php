<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Xe Tốt - @yield('title')</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Font Awaesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('client/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('client/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('client/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('client/css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('client/css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('client/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('client/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('client/css/style.css') }}" type="text/css">
    <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>
    <link rel="shortcut icon" href="{{ asset('client/img/logo.png') }}" type="image/png">
    @yield('css')
</head>

<body>
    @include('sweetalert::alert')
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="{{ route('client.home') }}"><img src="{{ asset('client/img/logo.png') }}" width="80" alt=""></a>
        </div>
        <div class="humberger__menu__widget">
            @if (!Auth::check())
                <div class="header__top__right__auth">
                    <a href="{{ route('auth.show.login') }}"><i class="fa fa-user"></i> Đăng nhập</a>
                
                </div>
                <div class="header__top__right__auth">
                    <a href="{{ route('auth.show.register') }}">| Đăng ký</a>
                </div>
            @else
                <div class="header__top__right__language">
                    <div>Xin chào, {{ Auth::user()->name }}</div>
                    <span class="arrow_carrot-down"></span>
                    <ul>
                        <li><a href="{{ route('my.order') }}">Đơn hàng của tôi</a></li>
                        <li><a href="{{ route('auth.logout') }}">Đăng xuất</a></li>
                    </ul>
                </div>
            @endif
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> lienhe@xetot.com</li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> lienhe@xetot.com</li>
                                <li>Miễn phí ship với hóa đơn từ 500.000 VND</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            @if (!Auth::check())
                                <div class="header__top__right__auth">
                                    <a href="{{ route('auth.show.login') }}"><i class="fa fa-user"></i> Đăng nhập</a>
                                
                                </div>
                                <div class="header__top__right__auth">
                                    <a href="{{ route('auth.show.register') }}">| Đăng ký</a>
                                </div>
                            @else
                                <div class="header__top__right__auth">
                                    <a href="{{ route('my.order') }}">Xin chào, {{ Auth::user()->name }}</a>
                                </div>
                                <div class="header__top__right__auth">
                                    <a href="{{ route('auth.logout') }}">| Đăng xuất</a>
                                </div>
                            @endif 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="{{ route('client.home') }}"><img src="{{ asset('client/img/logo.png') }}" width="80" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li><a href={{ route('client.home') }}>Trang chủ</a></li>
                            <li><a href={{ route('client.product') }}>Dòng xe</a></li>
                            <li><a href={{ route('client.introduce') }}>Giới thiệu</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                            @if (Auth::check())
                                <li><a href="{{ route('client.wishlist') }}"><i class="fa fa-heart"></i> <span>{{ !is_null(\App\Models\Wishlist::where('user_id',Auth::user()->id)->get()) ? \App\Models\Wishlist::where('user_id',Auth::user()->id)->get()->count() : 0 }}</span></a></li>
                            @endif
                            <li><a href="{{ route('client.shopping.cart') }}"><i class="fa fa-shopping-bag"></i> <span id="qty_cart">{{ Session::has('cart') ? Session::get('cart')->totalQty : 0 }}</span></a></li>
                        </ul>
                        <div class="header__cart__price">Tổng: <span id="price_cart">{{ Session::has('cart') ? number_format(Session::get('cart')->totalPrice,-3,',',',') : 0 }} VND</span></div>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->
    
    @yield('main')

    <!-- Footer Section Begin -->
    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="{{ route('client.home') }}">
                                <img src="{{ asset('client/img/logo.png') }}" width="200" alt="">
                            </a>
                        </div>
                        <ul>
                            <li>Địa chỉ: Hà Nội</li>
                            <li>Số điện thoại: +01 23.456.789</li>
                            <li>Email: lienhe@xetot.com</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>Giới thiệu Xe Tốt</h6>
                        <ul>
                            <li><a href="{{ route('client.introduce') }}">Về Xe Tốt</a></li>
                            <li><a href="#">Tuyển dụng</a></li>
                            <li><a href="#">Chính sách bảo mật thanh toán</a></li>
                            <li><a href="#">Chính sách giải quyết khiếu nại</a></li>
                            <li><a href="#">Điều khoản sử dụng</a></li>
                            <li><a href="#">Điều kiện vận chuyển</a></li>
                        </ul>
                        <ul>
                            <li><a href="#">Hướng dẫn trả góp</a></li>
                            <li><a href="#">Chính sách đổi trả</a></li>
                            <li><a href="#">Phương thức vận chuyển</a></li>
                            <li><a href="#">Hướng dẫn đặt hàng</a></li>
                            <li><a href="#">Gửi yêu cầu hỗ trợ</a></li>
                            <li><a href="#">Chính sách hàng nhập khẩu</a></li>
                        </ul>
                    </div>
                    <div class="footer__widget">
                        <h6 class="mt-3">Hợp tác và liên kết</h6>
                        <ul>
                            <li><a href="#">Quy chế hoạt động</a></li>
                            <li><a href="#">Bán hàng cùng Xe Tốt</a></li>
                        </ul>
                        <ul>
                            <li><a href="#">Trở thành thành viên Xe Tốt</a></li>
                            <li><a href="#">Lợi ích</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12">
                    <div class="footer__widget">
                        <h6>Liên hệ</h6>
                        <div class="footer__widget__social">
                            <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d59587.94583106255!2d105.80194388744769!3d21.022816135876386!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab9bd9861ca1%3A0xe7887f7b72ca17a9!2zSGFub2ksIEhvw6BuIEtp4bq_bSwgSGFub2ksIFZpZXRuYW0!5e0!3m2!1sen!2s!4v1680891006915!5m2!1sen!2s" width="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="mt-3"></iframe>
                        <div class="mt-3" style="font-weight: bold;color:black;">Chứng nhận bởi</div>
                        <img src="{{ asset('client/img/bo-cong-thuong.svg') }}" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text"><p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright ©<script>document.write(new Date().getFullYear());</script> | Bản quyền thuộc công ty TNHH Xe Tốt
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="{{ asset('client/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('client/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('client/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('client/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('client/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('client/js/mixitup.min.js') }}"></script>
    <script src="{{ asset('client/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('client/js/main.js') }}"></script>
    <script src="{{ asset('client/js/add-to-cart.js') }}"></script>
    <script src="{{ asset('client/js/filter.js') }}"></script>
    <script src="{{ asset('client/js/sort.js') }}"></script>
    <script src="{{ asset('client/js/voucher.js') }}"></script>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
	<script>
		Stripe.setPublishableKey('pk_test_51JnN53HEueodV3DAJxPIvHgy2bBdP5BmKIlvaUb1WZ64OSUZ9UcsbP2iKXzHZulqcVWvXigwCF6Wsh5Si1Ral20M00Wvg1qjBH');
		var $form = $('#checkout-form');
		$form.submit(function(event) {
		$('#charge-error').addClass('hidden');
		$form.find('button').prop('disabled', true);
		Stripe.card.createToken({
			number: $('#card-number').val(),
			cvc: $('#card-cvc').val(),
			exp_month: $('#card-expiry-month').val(),
			exp_year: $('#card-expiry-year').val(),
			name: $('#card-name').val()
		}, stripeResponseHandler);
		return false;
		});	
	function stripeResponseHandler(status, response) {
		var token = response.id;
        $form.append($('<input type="hidden" name="stripeToken" />').val(token));
        // Submit the form:
        $form.get(0).submit();
	}
	</script>
</body>

</html>