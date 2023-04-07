<!-- Categories Section Begin -->
<section class="categories mb-4">
    <div class="container">
        <div class="row">
            <div class="categories__slider owl-carousel">
                @foreach ($brands as $brand)
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="{{ asset($brand->image) }}">
                            <h5><a href="{{ route('client.product.brand',['brand' => $brand->id]) }}">{{ $brand->name }}</a></h5>
                        </div>
                    </div>  
                @endforeach
            </div>
        </div>
    </div>
</section>
<!-- Categories Section End -->