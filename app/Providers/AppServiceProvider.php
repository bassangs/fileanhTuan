<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Product;
use App\Models\Brand;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        $products = Product::join('brands', 'products.brand_id', '=', 'brands.id')
        ->where('products.qty','>',0)
        ->get(['products.*', 'brands.name AS brand_title']);
        View::share('products', $products);
        View::share('brands', Brand::all());
    }
}
