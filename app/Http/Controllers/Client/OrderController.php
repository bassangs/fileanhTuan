<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Stripe;
use Stripe\user;
use Illuminate\Support\Facades\Session;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Voucher;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function shopping_cart() {
        return view('client.shopping-cart');
    }

    public function checkout() {
        return view('client.checkout');
    }

    /**
     * Pay
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function pay(Request $request){
        if(!Session::has('cart')){
            return view('cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        Stripe::setApiKey('sk_test_51JnN53HEueodV3DA6Tg8aSXzG889RFopEqtwKsw2bbTLLDC2xzS03LHixGaan93SsqP52J1klY6DtE6Cxk7AicjF00JxnNE8cT');
        $user = new user();
        $userDetailsAry = array(
            'email' => $request->input('email'),
            'source' => $request->input('stripeToken')
        );
        $userDetails = $user->create($userDetailsAry);
        try {
            $charge = Charge::create(array(
                "user" => $userDetails->id,
                "amount" => $cart->totalPrice,
                "currency" => $request->input('currency_code'),
            ));
            if (isset($request->voucher)) {
                $voucher = Voucher::where('code',$request->voucher)->first();
                Voucher::where('code',$request->voucher)->update(['qty' => $voucher->qty -1]);
            }
            $order = Order::create([
                'id'      => $charge->id,
                'user_id' => Auth::user()->id,
                'total'   => Session::get('cart')->totalPrice,
                'address' => $request->address,
                'voucher_code' => $request->voucher
            ]);
            foreach($cart->items as $row){
                OrderDetail::create([
                    'product_id' => $row['item']['id'],
                    'price' => $row['price'],
                    'qty' => $row['qty'],
                    'order_id' => $order->id
                ]);
                $product = Product::find($row['item']['id']);
                Product::where('id',$row['item']['id'])->update(['qty' => $product['qty'] - $row['qty']]);
                Product::where('id',$row['item']['id'])->update(['qty_buy' => $product['qty_buy'] + $row['qty']]);
            }
        } catch (\Exception $e) {
            return redirect()->route('client.checkout')->with('invalid', $e->getMessage());
        }
        Session::forget('cart');
        return redirect()->route('thank');
    }

    public function thank()
    {
        return view('client.thank');
    }

    public function myOrder()
    {
        $orders = Order::where('user_id',Auth::user()->id)->get();
        return view('client.my-order',compact('orders'));
    }

    public function showMyOrder($id)
    {
        $orders = OrderDetail::where('order_id',$id)
        ->join('products','products.id','=','orders_detail.product_id')
        ->get(['orders_detail.*','products.name','products.price']);
        return view('client.show-my-order',compact('orders','id'));
    }

    public function checkVoucher(Request $request)
    {
        $voucher = Voucher::where('code',$request->code)->first();
        if (!is_null($voucher)) {
            return response()->json([
                'status' => 200,
                'total' => $request->total - $voucher->price,
                'code' => $request->code
            ]);
        } else {
            return response()->json([
                'status' => 403,
                'msg'   => 'Voucher không tồn tại',
                'total' => $request->total
            ]);
        }
    }
}
