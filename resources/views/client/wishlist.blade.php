@extends('client.layouts.template')

@section('main')

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{  asset('client/img/breadcrumb.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Danh sách yêu thích</h2>
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
            <div class="col-lg-12 col-md-12">
                <div class="row">
                    @if ($products->count() > 0)
                        @foreach ($products as $product)
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="{{  asset($product->image_path) }}">
                                        <ul class="product__item__pic__hover">
                                            <li><a href="javascript:void(0)" onclick="addToCart({{ $product->id }});"><i class="fa fa-shopping-cart"></i></a></li>
                                            <li><a href="{{ route('client.delete.wishlist',['id' => $product->id]) }}"><i class="fas fa-trash"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product__item__text">
                                        <h6><a href="{{ route('client.product.detail', ['id' => $product->id]) }}">{{ $product->name }}</a></h6>
                                        <h5>{{ number_format($product->price,-3,',',',') }} VND</h5>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            {!! $products->links() !!}
                        </div>
                    @else
                        Hiện tại danh sách yêu thích trống
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Section End -->
@stop