<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\ExpressCheckout;
use AmrShawky\Currency;

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
        $products = [];
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $order = Order::create([
            'id'      => 'order_' . $this->generateRandomString(),
            'user_id' => Auth::user()->id,
            'total'   => Session::get('cart')->totalPrice,
            'address' => $request->address,
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

        foreach($cart->items as $row){
            $productDetail = Product::find($row['item']['id']); 
            $products['items'][] = [
                'name' => $productDetail->name,
                'price' => round(Currency::convert()
                ->from('VND')
                ->to('USD')
                ->amount($row['price'])
                ->get(), 2),
                'qty' => $row['qty']
            ];
        }
  
        $products['invoice_id'] = $order->id;
        $products['invoice_description'] = "Pay successful, you get the new Order#{$order->id}";
        $products['return_url'] = route('done.payment.paypal');
        $products['cancel_url'] = route('cancel.payment.paypal');
        $products['total'] = round(Currency::convert()
        ->from('VND')
        ->to('USD')
        ->amount(Session::get('cart')->totalPrice)
        ->get(), 2);;
  
        $paypalModule = new ExpressCheckout;
  
        $res = $paypalModule->setExpressCheckout($product);
        $res = $paypalModule->setExpressCheckout($product, true);
  
        return redirect($res['paypal_link']);
    }

    private function generateRandomString($length = 24) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function cancelPaymentPaypal()
    {
        toastr()->error('Bạn đã hủy thanh toán');

        return redirect()->route('client.checkout');
    }
  
    public function donePaymentPaypal(Request $request)
    {
        $paypalModule = new ExpressCheckout;
        $response = $paypalModule->getExpressCheckoutDetails($request->token);
  
        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            Session::forget('cart');
            return redirect()->route('thank');
        }
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
}
