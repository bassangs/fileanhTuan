<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Session;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function product() {
        $products = Product::where('qty','>',0)->get();
        return view('client.product-grid', compact('products'));
    }

    public function product_detail($id) {
        if (Auth::check()) {
            $wishlist = Wishlist::where('user_id',Auth::user()->id)->pluck('product_id')->toArray();
        } else {
            $wishlist = [];
        }
        $product = Product::where('products.id', $id)->select(['products.*'])->first();
        $products = Product::where('brand_id',$product->brand_id)->where('qty','>',0)->where('products.id','<>',$id)->limit(4)->get();
        return view('client.product-detail', compact('product', 'products', 'wishlist'));
    }

    public function search(Request $request)
    {
        $q = $request->input('q');
        if (!is_null($q)) {
            $products = Product::where([['qty','>',0],['name','like','%'.$q.'%']])->paginate(12);
        } else {
            $products = Product::where('qty','>',0)->paginate(12);
        }
        $product_slide_1 = Product::where('qty','>',0)->orderBy('id', 'DESC')->limit(3)->get();
        $product_slide_2 = Product::where('qty','>',0)->orderBy('id', 'DESC')->skip(3)->limit(3)->get();
        return view('client.search',compact('products', 'product_slide_1', 'product_slide_2', 'q'));
    }

    public function addToCart(Request $request)
    {
        $product = Product::find($request->id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product,$product->id,$request->color);
        $request->session()->put('cart',$cart);
        return response()->json([
            'status' => 200,
            'qty'    => Session::get('cart')->totalQty,
            'price'  => Session::get('cart')->totalPrice
        ]);
    }

    public function deleteItem($id, $color)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->deleteItem($id, $color);
        if(count($cart->items) > 0){
            Session::put('cart',$cart);
        }else{
            Session::forget('cart');
        }
        return redirect()->back();
    }

    public function filter(Request $request)
    {
        if ($request->id != 0) {
            $products = Product::where('brand_id',$request->id)->where('qty','>',0)->paginate(12);
        } else {
            $products = Product::where('qty','>',0)->paginate(12);
        }
        return response()->json([
            'status' => 200,
            'data'   => view('client.includes.product-grid', compact('products'))->render()
        ]);
    }

    public function sort(Request $request)
    {
        if ($request->sort == 0) {
            $products = Product::where('qty','>',0)->paginate(12);
        } elseif ($request->sort == 1) {
            $products = Product::where('qty','>',0)->orderBy('price','DESC')->paginate(12);
        } else {
            $products = Product::where('qty','>',0)->orderBy('price','ASC')->paginate(12);
        }
        return response()->json([
            'status' => 200,
            'data'   => view('client.includes.product-grid', compact('products'))->render()
        ]);
    }

    public function brand($brand)
    {
        $products = Product::where('qty','>',0)->where('brand_id',$brand)->paginate(12);
        return view('client.product-brand',compact('products', 'brand'));
    }

    public function wishlist()
    {
        $products = Wishlist::select('products.*')->where('user_id',Auth::user()->id)
        ->join('products','products.id','=','wishlists.product_id')
        ->paginate(12);
        return view('client.wishlist',compact('products'));
    }

    public function addWishlist($id)
    {
        Wishlist::create([
            'user_id' => Auth::user()->id,
            'product_id' => $id
        ]);
        return redirect()->back();
    }


    public function deleteWishlist($id)
    {
        Wishlist::where('product_id',$id)->where('user_id',Auth::user()->id)->delete();
        return redirect()->back();
    }

    public function changeQty(Request $request)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->changeQty($request);
        Session::put('cart', $cart);
        return response()->json([
            'status' => 200,
            'price'  => number_format($cart->items[$request->id . '_' . $request->color]['price'],-3,',',',') . ' VND',
            'totalQty' => $cart->totalQty,
            'totalPrice' => number_format($cart->totalPrice,-3,',',',') . ' VND',
            'productId' => $request->id . '_' . $request->color
        ]);
    }
}
