@extends('client.layouts.template')

@section('main')

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{  asset('client/img/breadcrumb.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Trang sản phẩm</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-5">
                <div class="sidebar">
                    <div class="sidebar__item">
                        <h4>Lọc theo hãng</h4>
                        <ul>
                            <li style="cursor: pointer" onMouseOver="this.style.color='black'"
                                onMouseOut="this.style.color='black'" onclick="filterProductByCate(0, event);" class="mb-3 brand_item">Mặc định</li>
                            @foreach ($brands as $brand)
                                <li style="cursor: pointer" onMouseOver="this.style.color='black'"
                                onMouseOut="this.style.color='black'" onclick="filterProductByCate({{ $brand->id }}, event);" class="mb-3 brand_item">{{ $brand->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="sidebar__item">
                        <div class="latest-product__text">
                            <h4>Sản phẩm mới</h4>
                            <div class="latest-product__slider owl-carousel">
                                <div class="latest-prdouct__slider__item">
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
                                <div class="latest-prdouct__slider__item">
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
                </div>
            </div>
            <div class="col-lg-9 col-md-7">
                <div class="filter__item">
                    <div class="row">
                        <div class="col-lg-4 col-md-5">
                            <div class="filter__sort">
                                <span>Sắp xếp theo giá</span>
                                <select id="sort_price">
                                    <option value="0">Mặc định</option>
                                    <option value="1">Cao đến thấp</option>
                                    <option value="2">Thấp đến cao</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="product_grid">
                    @include('client.includes.product-grid',compact('products'))
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Section End -->
@stop