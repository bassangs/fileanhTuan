<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FASHION STORE</title>

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
            <a href="{{ route('client.home') }}"><img src="{{ asset($setting->logo) }}" alt=""></a>
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
                                <li><i class="fa fa-envelope"></i> {{ $setting->email }}</li>
                                <li>Miễn phí ship với hóa đơn từ 500.000 VND</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            @if (!Auth::check())
                                @if (!Auth::guard('admin')->check() || Auth::guard('admin')->user()->role == 0)
                                    <div class="header__top__right__auth">
                                        <a href="{{ route('auth.show.login') }}"><i class="fa fa-user"></i> Đăng nhập</a>
                                    
                                    </div>
                                    <div class="header__top__right__auth">
                                        <a href="{{ route('auth.show.register') }}">| Đăng ký</a>
                                    </div>
                                @else
                                    <div class="header__top__right__auth">
                                        <a href="{{ route('product.list') }}"><i class="fa fa-dashboard"></i> Hệ thống</a>
                                    </div>
                                @endif
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
                        <a href="{{ route('client.home') }}"><img src="{{ asset($setting->logo) }}" width="150" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li><a href={{ route('client.home') }}>Trang chủ</a></li>
                            <li><a href={{ route('client.product') }}>Sản phẩm</a></li>
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

    @include('client.includes.search')
    @yield('main')

    <!-- Footer Section Begin -->
    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="{{ route('client.home') }}"><img src="{{ asset($setting->logo) }}" alt=""></a>
                        </div>
                        <ul>
                            <li>Địa chỉ: {{ $setting->address }}</li>
                            <li>Số điện thoại: {{ $setting->tel }}</li>
                            <li>Email: {{ $setting->email }}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__payment"><img src="{{ asset('client/img/payment-item.png') }}" alt=""></div>
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