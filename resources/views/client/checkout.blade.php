@extends('client.layouts.template')

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
        @if(Session::has('invalid'))
            <div class="alert alert-danger alert-dismissible mt-2">
                <a class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{Session::get('invalid')}}
            </div>
        @endif
        <div class="checkout__form">
            <h4>Đặt hàng</h4>
            <form action="{{ route('pay') }}" method="POST" id="checkout-form">

                @csrf
                <input type='hidden' name='currency_code' value='VND'> 

                <div class="row">
                    <div class="col-lg-8 col-md-6">
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
                            <p>Số thẻ</p>
                            <input type="text" placeholder="Nhập số thẻ" id="card-number" class="checkout__input__add" required>
                        </div>
                        <div class="checkout__input">
                            <p>Hạn mức tháng</p>
                            <input type="number" placeholder="Nhập số thẻ" id="card-expiry-month" min=1 max=12 class="checkout__input__add" required>
                        </div>
                        <div class="checkout__input">
                            <p>Hạn mức năm</p>
                            <input type="number" placeholder="Nhập số thẻ" id="card-expiry-year" min=2022 max=2030 class="checkout__input__add" required>
                        </div>
                        <div class="checkout__input">
                            <p>CVC</p>
                            <input type="text" placeholder="Nhập CVC" id="card-cvc" class="checkout__input__add" required>
                        </div>
                        <div class="checkout__input">
                            <p>Địa chỉ</p>
                            <input type="text" placeholder="Nhập địa chỉ" class="checkout__input__add" name="address" required>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="checkout__order">
                            <h4>Chi tiết đơn hàng</h4>
                            <div class="checkout__order__products">Dòng xe <span>Tổng tiền</span></div>
                            <ul>
                                @php
                                    use App\Models\Cart;
                                    $oldCart = Session::get('cart');
                                    $cart = new Cart($oldCart);
                                @endphp
                                @foreach ($cart->items as $row)
                                    <li>{{ strlen($row['item']['name']) > 20 ? substr($row['item']['name'], 0, 20) . '...' : $row['item']['name'] }} <span>{{ number_format($row['price'],-3,',',',') }} VND</span></li>
                                @endforeach
                            </ul>
                            <div class="checkout__order__total">Thành tiền <span class="total-cart">{{ number_format(Session::get('cart')->totalPrice,-3,',',',') }} VND</span></div>
                            <input type="hidden" id="total" value="{{ Session::get('cart')->totalPrice }}" />
                            <input type="text" class="form-control" placeholder="Nhập voucher của bạn" id="voucher" />
                            <button type="button" id="voucher-add" class="btn btn-primary">KIỂM TRA MÃ</button>
                            <button type="submit" class="site-btn">ĐẶT HÀNG</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- Checkout Section End -->
@stop