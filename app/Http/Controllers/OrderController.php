<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    function addOrderToReview(Request $request){
        $validator = \Validator::make($request->all(), [
            'client_name'  => 'required|string',
            'client_email' => 'required|email',
            'client_phone' => 'required|phone:RU',
            'client_address' => 'required|string',
            'order_ship' => 'required',
            'order_total' => 'not_in:0',
        ]);
        if(!$validator->passes()){
            return response()->json(['code'=> 0, 'error'=> $validator->errors()->toArray()]);
        } else {
            $order_note;
            if($request->input('order_note') == null){
                $order_note = __('main.Nothing');
            } else {
                $order_note = $request->input('order_note');
            }
            Cart::instance('checkout')->add([
                'id' => '1',
                'name' => '1',
                'qty' => 1,
                'price' => 1,
                'options' => [
                    'client_name'  => $request->input('client_name'),
                    'client_email' => $request->input('client_email'),
                    'client_phone' => $request->input('client_phone'),
                    'client_address' => $request->input('client_address'),
                    'order_note' => $order_note,
                    'order_ship' => $request->input('order_ship'),
                    'order_discount' => $request->input('order_discount'),
                    'order_tracking' => $request->input('order_tracking'),
                    'order_payment' => $request->input('order_payment'),
                    'description' => $request->input('description'),
                ]
            ]);

            if(Auth::check()){
                Cart::instance('checkout')->store(Auth::user()->email);
            }

            return response()->json(['code'=> 1, 'success' => 'Success']);
        }
    }


    public function createOrder(Request $request){
        $order_note;
        if($request->input('order_note') == null){
            $order_note = 'Nothing';
        } else {
            $order_note = $request->input('order_note');
        }
        $order = Order::create([
            'user_id' => Auth::user()->id,
            'client_name'  => $request->input('client_name'),
            'client_email' => $request->input('client_email'),
            'client_phone' => $request->input('client_phone'),
            'client_address' => $request->input('client_address'),
            'order_status' => 1,
            'order_total' => $request->input('order_total'),
            'order_note' => $order_note,
            'order_ship' => $request->input('order_ship'),
            'order_discount' => $request->input('order_discount'),
            'order_tracking' => $request->input('order_tracking'),
            'order_payment' => $request->input('order_payment'),
            'order_description' => $request->input('description'),
        ]);
        if($order){
            foreach(Cart::instance('cart')->content() as $cartItem) {
                $orderDetail = OrderDetail::create([
                    'order_id' => $request->input('order_tracking'),
                    'product_id' => $cartItem->id,
                    'product_price' => $cartItem->price,
                    'product_quantity' => $cartItem->qty,
                ]);
            }
            return redirect()->route('user.checkoutComplete', ['orderTracking'=>$request->input('order_tracking')]);
        }
    }

    public function destroyCheckout(){
        Cart::instance('checkout')->destroy();
        if(Auth::check()){
            Cart::instance('checkout')->store(Auth::user()->email);
        }
    }
}
