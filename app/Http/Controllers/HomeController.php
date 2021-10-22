<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\ShippingFee;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $dataProducts = Product::all();
        $dataCategories = Category::all();
        $urlPhoto = asset("data/images/upload/products/");
        return view('main.index', [
            'dataProducts' => $dataProducts,
            'dataCategories'=>$dataCategories,
            'urlPhoto' => $urlPhoto,
            'page' => 'HOME'
        ]);
    }

    public function checkoutComplete($orderTracking)
    {
        $order = Order::firstWhere('order_tracking', $orderTracking);
        $checkExistOrder;
        if($order){
            $checkExistOrder = true;
            $cart = new CartController();
            $cart->destroyCart();
            $checkout = new OrderController();
            $checkout->destroyCheckout();
        }else {
            $checkExistOrder = false;
        }
        $dataProducts = Product::all();
        $dataCategories = Category::all();
        $urlPhoto = asset("data/images/upload/products/");
        return view('main.checkout-complete', [
            'dataProducts' => $dataProducts,
            'dataCategories'=>$dataCategories,
            'urlPhoto' => $urlPhoto,
            'page' => 'CHECKOUTCOMPLETE',
            'orderTracking' => $orderTracking,
            'checkExistOrder' => $checkExistOrder,
        ]);
    }

    public function getDataProduct(){
        $product = Product::all();
        return response()->json($product);
    }

     public function home(){
        $dataProducts = Product::all();
        $dataCategories = Category::all();
        $urlPhoto = asset("data/images/upload/products/");
        return view('main.index', [
            'dataProducts' => $dataProducts,
            'dataCategories'=>$dataCategories,
            'urlPhoto' => $urlPhoto,
            'page' => 'HOME'
        ]);
    }

    public function store(){
        //$product = Product::all()->where('category_id', 4);
        $dataProducts = Product::all();
        $dataCategories = Category::all();
        $urlPhoto = asset("data/images/upload/products/");
        return view('main.store', [
            'dataProducts' => $dataProducts,
            'dataCategories'=>$dataCategories,
            'urlPhoto' => $urlPhoto,
            'page' => 'STORE'
        ]);
    }

    public function contacts(){
        //$product = Product::all()->where('category_id', 4);
        $dataProducts = Product::all();
        $dataCategories = Category::all();
        $urlPhoto = asset("data/images/upload/products/");
        return view('main.contacts', [
            'dataProducts' => $dataProducts,
            'dataCategories'=>$dataCategories,
            'urlPhoto' => $urlPhoto,
            'page' => 'STORE'
        ]);
    }

    public function checkoutReview(){
        if(Auth::check()){
            Cart::instance('checkout')->restore(Auth::user()->email);
        }

        $client_name;
        $client_email;
        $client_phone;
        $client_address;
        $order_note;
        $order_ship;
        $order_payment;
        $order_discount;
        $order_tracking;
        $description;
        if(Cart::instance('checkout')->count()){
            foreach(Cart::instance('checkout')->content() as $cartItem) {
                $client_name = $cartItem->options->client_name;
                $client_email = $cartItem->options->client_email;
                $client_phone = $cartItem->options->client_phone;
                $client_address = $cartItem->options->client_address;
                $order_note = $cartItem->options->order_note;
                $order_ship = $cartItem->options->order_ship;
                $order_discount = $cartItem->options->order_discount;
                $order_tracking = $cartItem->options->order_tracking;
                $order_payment = $cartItem->options->order_payment;
                $description = $cartItem->options->description;
            }
        }else{
//            $client_name = Auth::user()->name;
//            $client_email = Auth::user()->email;
//            $client_phone = Auth::user()->phone;
//            $client_address = Auth::user()->address;
//            $order_note = null;
//            $order_ship = null;
//            $order_payment = null;
//            $order_discount = null;
//            $order_tracking = null;
//            $description = null;
              return redirect()->route('main.cartDetails');
        };

        $dataProducts = Product::all();
        $dataCategories = Category::all();
        $urlPhoto = asset("data/images/upload/products/");
        $dataPaymentMethods = PaymentMethod::all();

        return view('main.checkout-review', [
            'dataProducts' => $dataProducts,
            'dataCategories'=>$dataCategories,
            'urlPhoto' => $urlPhoto,
            'page' => 'CHECKOUTREVIEW',
            'client_name' => $client_name,
            'client_email' => $client_email,
            'client_phone' => $client_phone,
            'client_address' => $client_address,
            'order_note' => $order_note,
            'order_ship' => $order_ship,
            'order_discount' => $order_discount,
            'order_tracking' => $order_tracking,
            'description' => $description,
            'order_payment' => $order_payment,
            'dataPaymentMethods' => $dataPaymentMethods,
        ]);
    }

    public function cartDetails(){
        //$product = Product::all()->where('category_id', 4);
        $dataProducts = Product::all();
        $dataCategories = Category::all();
        $dataShippingFee = ShippingFee::find(1);
        $dataPaymentMethods = PaymentMethod::all();
        $urlPhoto = asset("data/images/upload/products/");
        return view('main.cart-details', [
            'dataProducts' => $dataProducts,
            'dataCategories'=>$dataCategories,
            'urlPhoto' => $urlPhoto,
            'page' => 'CARTDETAILS',
            'dataShippingFee' =>  $dataShippingFee,
            'dataPaymentMethods' => $dataPaymentMethods,
        ]);
    }


    public function getSearch(Request $request){
        $search = $request->input('search_keyword');
        $result = false;
        $products = Product::query()
            ->where('product_name_vi', 'LIKE', "%{$search}%")
            ->orWhere('product_name_ru', 'LIKE', "%{$search}%")
            ->get();

        $categories = Category::all();
        if($products->isNotEmpty()){
            $result = true;
        }
        return response()->json([
            'categories' =>$categories,
            'products' =>$products,
            'result' => $result,
        ]);
    }
}
