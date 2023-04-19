@extends('client.layouts.template')

@section('title')
    {{ $product->name }}
@endsection

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
                    <h2>{{ $product->name }}</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Product Details Section Begin -->
<section class="product-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__item">
                        <img class="product__details__pic__item--large"
                            src="{{  asset($product->image) }}" alt="{{ $product->name }}">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="product__details__text">
                    <h3>{{ $product->name }}</h3>
                    <div class="product__details__price text-danger">{{ number_format($product->price,-3,',',',') }} VND</div>
                    <select class="form-control mb-2" style="width: 30%;" id="color-{{ $product->id }}">
                        @foreach (explode(',', $product->colors) as $item)
                            @php
                                $color = \App\Models\Color::find($item);
                            @endphp
                            <option value="{{ $color->id }}">{{ $color->name }}</option>
                        @endforeach
                    </select>
                    <a href="javascript:void(0)" onclick="addToCart({{ $product->id }});" class="primary-btn">THÊM GIỎ HÀNG</a> 
                    @if (Auth::check())
                      @if (!in_array($product->id,$wishlist))
                        <a href="{{ route('client.add.wishlist',['id' => $product->id]) }}"><button type="button" class="btn btn-danger" style="padding:0.84rem;">YÊU THÍCH</button></a>
                      @else
                        <a href="{{ route('client.add.wishlist',['id' => $product->id]) }}"><button type="button" class="btn btn-secondary" style="padding:0.84rem;" disabled>ĐÃ YÊU THÍCH</button></a>
                      @endif
                    @endif
                    <ul>
                        <li><b>Hãng xe</b> <span>{{ \App\Models\Brand::find($product->brand_id)->name }}</span></li>
                        <li><b>Trạng thái</b> <span>{{ $product->qty > 0 ? 'Còn hàng' : 'Hết hàng' }}</span></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="product__details__tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active">Mô tả xe</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <div class="product__details__tab__desc">
                                <p>{!! $product->description !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Details Section End -->

<!-- Related Product Section Begin -->
<section class="related-product">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title related__product__title">
                    <h2>Dòng xe liên quan</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($products as $product)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="{{  asset($product->image) }}">
                            <ul class="product__item__pic__hover">
                                <li><a href="javascript:void(0)" onclick="addToCart({{ $product->id }});"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="{{ route('client.product.detail', ['id' => $product->id]) }}">{{ $product->name }}</a></h6>
                            <h5>{{ number_format($product->price,-3,',',',') }} VND</h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Related Product Section End -->
@stop