@extends('client.layouts.template')

@section('title', 'Đặt hàng')

@section('main')

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{ asset('client/img/breadcrumb.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Đặt hàng</h2>
                    <div class="breadcrumb__option">
                        <a href="{{ route('client.home') }}">Trang chủ</a>
                        <span>Đặt hàng</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <h4>Đặt hàng</h4>
            <form action="{{ route('pay') }}" method="POST" id="checkout-form">

                @csrf

                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="checkout__input">
                                    <p>Họ tên</p>
                                    <input type="text" value="{{ Auth::user()->name }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Số điện thoại</p>
                                    <input type="text" value="{{ Auth::user()->phone }}" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Email</p>
                                    <input type="text" value="{{ Auth::user()->email }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="checkout__input">
                            <p>Địa chỉ</p>
                            <input type="text" placeholder="Nhập địa chỉ" class="checkout__input__add" name="address" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="checkout__order">
                            <h4>Chi tiết đơn hàng</h4>
                            <div class="checkout__order__products">Dòng xe <span>Tổng tiền</span></div>
                            <ul>
                                @php
                                    use App\Models\Cart;
                                    $oldCart = Session::get('cart');
                                    $cart = new Cart($oldCart);
                                @endphp
                                @foreach ($cart->items as $key => $row)
                                    @php
                                        $keyColor = explode('_', $key)[1];
                                    @endphp
                                    <li>{{ $row['item']['name'] }} ({{ \App\Models\Color::find($keyColor)->name }}) x {{ $row['qty'] }} <span>{{ number_format($row['price'],-3,',',',') }} VND</span></li>
                                @endforeach
                            </ul>
                            <div class="checkout__order__total">Thành tiền <span class="total-cart">{{ number_format(Session::get('cart')->totalPrice,-3,',',',') }} VND</span></div>
                            <div class="checkout__order__total">Phí đặt cọc (10% thành tiền) <span class="total-cart">{{ number_format(0.1 * Session::get('cart')->totalPrice,-3,',',',') }} VND</span></div>
                            <input type="hidden" name="total" value="{{ Session::get('cart')->totalPrice }}" />
                            <button type="submit" class="site-btn">ĐẶT CỌC</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- Checkout Section End -->
@stop