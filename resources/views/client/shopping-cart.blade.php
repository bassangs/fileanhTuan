@extends('client.layouts.template')

@section('title', 'Giỏ hàng')

@section('css')
    <style>
        .primary-btn:hover {
            color: white;
        }
    </style>
@stop

@section('main')

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{  asset('client/img/breadcrumb.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Giỏ hàng</h2>
                    <div class="breadcrumb__option">
                        <a href="{{ route('client.home') }}">Trang chủ</a>
                        <span>Giỏ hàng</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shoping Cart Section Begin -->
<section class="shoping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th class="shoping__product">Dòng xe</th>
                                <th width="200">Đơn giá</th>
                                <th>Số lượng</th>
                                <th width="350">Tổng tiền</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                use App\Models\Cart;
                                $oldCart = Session::get('cart');
                                $cart = new Cart($oldCart);
                            @endphp
                            @if (!empty($cart->items))
                                @foreach ($cart->items as $row)
                                    <tr>
                                        <td class="shoping__cart__item">
                                            <img src="{{  asset($row['item']['image']) }}" alt="{{ $row['item']['name'] }}" width="100">
                                            <h5>{{ $row['item']['name'] }}</h5>
                                        </td>
                                        <td class="shoping__cart__price">
                                            {{ number_format($row['item']['price'],-3,',',',') }} VND
                                        </td>
                                        <td class="shoping__cart__quantity">
                                            <div class="quantity">
                                                <div class="pro-qty">
                                                    <input type="text" value="{{ $row['qty'] }}" onkeyup="changeQty(this.value, {{ $row['item']['id'] }})">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="shoping__cart__total" id="cart-item-total-{{ $row['item']['id'] }}">
                                            {{ number_format($row['price'],-3,',',',') }} VND
                                        </td>
                                        <td class="shoping__cart__item__close">
                                            <a href="{{ route('delete.item', ['id' => $row['item']['id']]) }}"><span class="icon_close"></span></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" align="center">Chưa có dòng xe</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__btns">
                    <a href="{{ route('client.home') }}" class="primary-btn cart-btn">TIẾP TỤC MUA HÀNG</a>
                </div>
            </div>
            @if (!empty($cart->items))
                <div class="col-lg-6">
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Giỏ hàng</h5>
                        <ul>
                            <li id="cart-total">Tổng tiền <span>{{ number_format(Session::get('cart')->totalPrice,-3,',',',') }} VND</span></li>
                        </ul>
                        @if (Auth::check())
                            <a href="{{ route('client.checkout') }}" class="primary-btn">THANH TOÁN</a>
                        @else
                            <a href="{{ route('auth.show.login') }}" class="primary-btn">VUI LÒNG ĐĂNG NHẬP</a>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
<!-- Shoping Cart Section End -->
@stop