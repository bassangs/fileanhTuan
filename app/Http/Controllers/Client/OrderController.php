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
        $orderId = 'order_' . $this->generateRandomString();
        $order = Order::create([
            'id'      => $orderId,
            'user_id' => Auth::user()->id,
            'total'   => $request->total,
            'deposit' => $request->total * 0.1,
            'address' => $request->address,
        ]);
        foreach($cart->items as $key => $row){
            $keyColor = explode('_', $key)[1];
            OrderDetail::create([
                'product_id' => $row['item']['id'],
                'price' => $row['item']['price'],
                'qty' => $row['qty'],
                'order_id' => $orderId,
                'color_id' => $keyColor
            ]);
            $product = Product::find($row['item']['id']);
            Product::where('id',$row['item']['id'])->update(['qty' => $product['qty'] - $row['qty']]);
            Product::where('id',$row['item']['id'])->update(['qty_buy' => $product['qty_buy'] + $row['qty']]);
        }

        foreach($cart->items as $row){
            $productDetail = Product::find($row['item']['id']); 
            $products['items'][] = [
                'name' => $productDetail->name,
                'price' => (int) Currency::convert()
                ->from('VND')
                ->to('USD')
                ->amount($row['item']['price'])
                ->get(),
                'qty' => $row['qty']
            ];
        }
  
        $products['invoice_id'] = $orderId;
        $products['invoice_description'] = "Pay successful, you get the new Order#{$orderId}";
        $products['return_url'] = route('done.payment.paypal');
        $products['cancel_url'] = route('cancel.payment.paypal');
        $products['total'] = (int) Currency::convert()
        ->from('VND')
        ->to('USD')
        ->amount($request->total)
        ->get();
  
        $paypalModule = new ExpressCheckout;
  
        $res = $paypalModule->setExpressCheckout($products);
        $res = $paypalModule->setExpressCheckout($products, true);
  
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
        ->join('products','products.id','=','order_details.product_id')
        ->get(['order_details.*','products.name','products.price']);
        return view('client.show-my-order',compact('orders','id'));
    }
}
