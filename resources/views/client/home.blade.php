@extends('client.layouts.template')

@section('main')
@include('client.includes.search')
<h3 class="text-center mb-4">Hãng xe</h3>
@include('client.includes.brand')
<!-- Featured Section Begin -->
<section class="featured spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Các dòng xe</h2>
                </div>
                <div class="featured__controls">
                    <ul>
                        <li class="active" data-filter="*">All</li>
                        @foreach ($brands as $brand)
                            <li data-filter=".{{ str_replace(' ', '', $brand->name) }}">{{ $brand->name }}</li> 
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="row featured__filter">
            @foreach ($products as $product)
                <div class="col-lg-3 col-md-4 col-sm-6 mix {{ str_replace(' ', '', $product->brand_title) }}">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg" data-setbg="{{ asset($product->image) }}">
                            <ul class="featured__item__pic__hover">
                                <li><a href="javascript:void(0)" onclick="addToCart({{ $product->id }});"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="{{ route('client.product.detail', ['id' => $product->id]) }}">{{ $product->name }}</a></h6>
                            <h5>{{ number_format($product->price,-3,',',',') }} VND</h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Featured Section End -->

<!-- Banner Begin -->
<div class="banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="banner__pic">
                    <img src="{{ asset('client/img/banner/banner-1.jpg') }}" height="350" alt="">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="banner__pic">
                    <img src="{{ asset('client/img/banner/banner-2.jpg') }}" height="350" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Banner End -->

<!-- Latest Product Section Begin -->
<section class="latest-product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="latest-product__text">
                    <h4>Dòng xe mới nhất</h4>
                    <div class="latest-product__slider owl-carousel">
                        <div class="latest-product__slider__item">
                            @foreach ($product_slide_1 as $product)
                                <a href="{{ route('client.product.detail', ['id' => $product->id]) }}" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="{{  asset($product->image) }}" alt="{{ $product->name }}">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>{{ $product->name }}</h6>
                                        <span>{{ number_format($product->price,-3,',',',') }} VND</span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                        <div class="latest-product__slider__item">
                            @foreach ($product_slide_2 as $product)
                                <a href="{{ route('client.product.detail', ['id' => $product->id]) }}" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="{{  asset($product->image) }}" alt="{{ $product->name }}">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>{{ $product->name }}</h6>
                                        <span>{{ number_format($product->price,-3,',',',') }} VND</span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="latest-product__text">
                    <h4>Dòng xe bán chạy nhất</h4>
                    <div class="latest-product__slider owl-carousel">
                        <div class="latest-prdouct__slider__item">
                            @foreach ($product_top_sale_1 as $product)
                                <a href="{{ route('client.product.detail', ['id' => $product->id]) }}" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="{{  asset($product->image) }}" alt="{{ $product->name }}">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>{{ $product->name }}</h6>
                                        <span>{{ number_format($product->price,-3,',',',') }} VND</span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                        <div class="latest-prdouct__slider__item">
                            @foreach ($product_top_sale_2 as $product)
                                <a href="{{ route('client.product.detail', ['id' => $product->id]) }}" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="{{  asset($product->image) }}" alt="{{ $product->name }}">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>{{ $product->name }}</h6>
                                        <span>{{ number_format($product->price,-3,',',',') }} VND</span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                        <div class="latest-prdouct__slider__item">
                            @foreach ($product_top_sale_3 as $product)
                                <a href="{{ route('client.product.detail', ['id' => $product->id]) }}" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="{{  asset($product->image) }}" alt="{{ $product->name }}">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>{{ $product->name }}</h6>
                                        <span>{{ number_format($product->price,-3,',',',') }} VND</span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop