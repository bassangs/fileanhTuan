<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index() {
        $product_slide_1 = Product::where('qty','>',0)->where('status',1)->orderBy('id', 'DESC')->limit(3)->get();
        $product_slide_2 = Product::where('qty','>',0)->where('status',1)->orderBy('id', 'DESC')->skip(3)->limit(3)->get();
        $product_top_sale_1 = Product::where('qty','>',0)->where('status',1)->orderBy('qty_buy', 'DESC')->limit(3)->get();
        $product_top_sale_2 = Product::where('qty','>',0)->where('status',1)->orderBy('qty_buy', 'DESC')->skip(3)->limit(3)->get();
        $product_top_sale_3 = Product::where('qty','>',0)->where('status',1)->orderBy('qty_buy', 'DESC')->skip(6)->limit(3)->get();
        return view('client.home', compact('product_slide_1', 'product_slide_2', 'product_top_sale_1', 'product_top_sale_2', 'product_top_sale_3'));
    }

    public function introduce()
    {
        return view('client.introduce');
    }
}
