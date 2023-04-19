@php
    $count = 1;
@endphp
@if ($products->count() > 0)
    @foreach ($products as $product)
        <div class="col-lg-4 col-md-6 col-sm-6 {{ $count > 9 ? 'd-none' : '' }}">
            <div class="product__item">
                <div class="product__item__pic set-bg" data-setbg="{{ asset($product->image) }}">
                    <ul class="product__item__pic__hover">
                        <li><a href="javascript:void(0)" onclick="addToCart({{ $product->id }});"><i class="fa fa-shopping-cart"></i></a></li>
                    </ul> 
                </div>
                <div class="product__item__text">
                    <h6><a href="{{ route('client.product.detail', ['id' => $product->id]) }}">{{ $product->name }}</a></h6>
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <select class="form-control" id="color-{{ $product->id }}">
                                        @foreach (explode(',', $product->colors) as $item)
                                            @php
                                                $color = \App\Models\Color::find($item);
                                            @endphp
                                            <option value="{{ $color->id }}">{{ $color->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <h5 class="text-danger">{{ number_format($product->price,-3,',',',') }} VND</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @php
            $count++;
        @endphp
    @endforeach
    @if ($products->count() > 9)
        <div class="col-lg-12 col-md-12 col-sm-12 text-center">
            <button class="primary-btn" id="seeMore">XEM THÊM</button>
        </div>
    @endif
@else
    <div class="col-lg-4 col-md-6 col-sm-6">
        Không có dòng xe nào
    </div>
@endif