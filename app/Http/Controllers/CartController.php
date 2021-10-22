<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function addToCart(Request $request){
        $product_id = $request->id;
        $product = Product::findOrFail($product_id);

        $quantity = 0;
        foreach(Cart::instance('cart')->content() as $cartItem) {
            if($cartItem->id == $product_id){
                $quantity = $cartItem->qty;
            }
        }
        $quantity += $request->quantity;

        $price = $product->product_price_last;
        //Check have discount
        if($product->product_quantity_to_discount){
            //Check quantity and quantity to discount
            if(!($quantity < $product->product_quantity_to_discount)){
                $price = $product->product_price_discount;
            }
        }

        $category = Category::findOrFail($product->category_id);

        Cart::instance('cart')->add(
            $product->id,
            $product->product_name_vi,
            $request->quantity,
            $price,
            [
                'product_name_ru' => $product->product_name_ru,
                'product_name_vi' => $product->product_name_vi,
                'category_name_vi' => $category->category_name_vi,
                'category_name_ru' => $category->category_name_ru,
                'product_unit_vi' =>$product->product_unit_vi,
                'product_unit_ru'=>$product->product_unit_ru,
                'product_price_last'=>$product->product_price_last,
                'product_price_fix'=>$product->product_price_fix,
                'product_price_discount'=>$product->product_price_discount,
                'product_quantity_to_discount'=>$product->product_quantity_to_discount,
                'product_image' => $product->product_image
            ],
        );




        $data_array = [
            'content' => Cart::instance('cart')->content(),
            'count' => Cart::instance('cart')->content()->count(),
            'subtotal' => Cart::instance('cart')->subtotal()
        ];
        if(Auth::check()){
            Cart::instance('cart')->store(Auth::user()->email);
        }
        return response()->json($data_array);
    }


    public function updateQuantity(Request $request){
        $rowId = $request->input('rowId');
        $product_item = Cart::instance('cart')->get($rowId);
        $product = Product::findOrFail($product_item->id);
        //$quantity = $request->input('quantity');

        $quantity = $request->input('quantity');

        $price = $product->product_price_last;
        //Check have discount
        if($product->product_quantity_to_discount){
            //Check quantity and quantity to discount
            if(!($quantity < $product->product_quantity_to_discount)){
                $price = $product->product_price_discount;
            }
        }

        Cart::instance('cart')->update($rowId, ['qty'=>$quantity,'price' => $price]);
        if(Auth::check()){
            Cart::instance('cart')->store(Auth::user()->email);
        }
    }


    public function removeCartItem(Request $request){
        Cart::instance('cart')->remove($request->rowId);
        if(Auth::check()){
            Cart::instance('cart')->store(Auth::user()->email);
        }
    }

    public function destroyCart(){
        \Log::info(Cart::instance('cart')->content());
        Cart::instance('cart')->destroy();
        if(Auth::check()){
            Cart::instance('cart')->store(Auth::user()->email);
        }
    }

    public function destroyWishlist(){
        Cart::instance('wishlist')->destroy();
        if(Auth::check()){
            Cart::instance('wishlist')->store(Auth::user()->email);
        }
    }

    public function reloadCart(){
        if(Auth::check()){
            Cart::instance('cart')->restore(Auth::user()->email);
        }
        $data_array = [
            'content' => Cart::instance('cart')->content(),
            'count' => Cart::instance('cart')->content()->count(),
            'subtotal' => Cart::instance('cart')->subtotal(1,',',' ')
        ];
        return response()->json($data_array);
    }

    public function reloadWishlist(){
        if(Auth::check()){
            Cart::instance('wishlist')->restore(Auth::user()->email);
        }

        $products = Product::all();
        $data_array = [
            'content' => Cart::instance('wishlist')->content(),
            'count' => Cart::instance('wishlist')->content()->count(),
            'subtotal' => Cart::instance('wishlist')->subtotal(),
            'products' => $products
        ];
        return response()->json($data_array);
    }

    public function addToWishlist(Request $request){
        $product_id = $request->id;
        $product = Product::findOrFail($product_id);

        $category = Category::findOrFail($product->category_id);

        Cart::instance('wishlist')->add(
            $product->id,
            $product->product_name_vi,
            1,
            $product->product_price_last,
            [
                'product_name_ru' => $product->product_name_ru,
                'product_name_vi' => $product->product_name_vi,
                'category_name_vi' => $category->category_name_vi,
                'category_name_ru' => $category->category_name_ru,
                'product_unit_vi' =>$product->product_unit_vi,
                'product_unit_ru'=>$product->product_unit_ru,
                'product_price_last'=>$product->product_price_last,
                'product_price_fix'=>$product->product_price_fix,
                'product_price_discount'=>$product->product_price_discount,
                'product_quantity_to_discount'=>$product->product_quantity_to_discount,
                'product_image' => $product->product_image
            ],
        );

        $data_array = [
            'content' => Cart::instance('wishlist')->content(),
            'count' => Cart::instance('wishlist')->content()->count(),
            'subtotal' => Cart::instance('wishlist')->subtotal()
        ];
        if(Auth::check()){
            Cart::instance('wishlist')->store(Auth::user()->email);
        }
        return response()->json($data_array);
    }

    public function removeFromWishlist(Request $request){
        $product_id = $request->id;
        $product = Product::findOrFail($product_id);

        foreach(Cart::instance('wishlist')->content() as $wishlistItem) {
            if($wishlistItem->id == $product_id){
                Cart::instance('wishlist')->remove($wishlistItem->rowId);
            }
        }

        if(Auth::check()){
            Cart::instance('wishlist')->store(Auth::user()->email);
        }
    }



}
