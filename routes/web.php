<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\PaymentController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Set locale
Route::get('set-locale/{locale}',[
    'as' => 'setting.locale',
    'uses' => 'LocalizationController@index'
]);



Route::get('/', function () {
    return view('welcome');
});




Route::prefix('admin')->group(function (){

    Route::middleware(['auth:admin', 'PreventBrowserBackHistory'])->group(function (){

        Route::get('', [
            'as' => 'admin.dashboard',
            'uses' => 'AdminController@dashboard'
        ]);

        Route::prefix('category')->group(function () {

            Route::get('/add-category', [
                'as' => 'category.add-category',
                'uses' => 'CategoryController@addCategory'
            ]);
            Route::get('/all-categories', [
                'as' => 'category.all-categories',
                'uses' => 'CategoryController@allCategories'
            ]);

            Route::post('/insert', [
                'as' => 'category.insert',
                'uses' => 'CategoryController@insert'
            ]);

            Route::post('/delete', [
                'as' => 'category.delete',
                'uses' => 'CategoryController@delete'
            ]);

            Route::post('/update', [
                'as' => 'category.update',
                'uses' => 'CategoryController@update'
            ]);

            Route::get('/admin-get-category-by-ID/{id}', [
                'as' => 'category.adminGetCategoryByID',
                'uses' => 'CategoryController@getCategoryByID'
            ]);

            Route::get('/getCategories', [
                'as' => 'category.getCategories',
                'uses' => 'CategoryController@getCategories'
            ]);

        });

        Route::prefix('product')->group(function () {
            Route::get('/add-product', [
                'as' => 'product.add-product',
                'uses' => 'ProductController@addProduct'
            ]);
            Route::get('/all-products', [
                'as' => 'product.all-products',
                'uses' => 'ProductController@allProducts'
            ]);

            Route::post('/insert', [
                'as' => 'product.insert',
                'uses' => 'ProductController@insert'
            ]);

            Route::post('/update', [
                'as' => 'product.update',
                'uses' => 'ProductController@update'
            ]);

            Route::post('/delete', [
                'as' => 'product.delete',
                'uses' => 'ProductController@delete'
            ]);

            Route::get('/getProducts', [
                'as' => 'product.getProducts',
                'uses' => 'ProductController@getProducts'
            ]);

            Route::get('/AdminGetProductByID/{id}', [
                'as' => 'product.adminGetProductByID',
                'uses' => 'ProductController@getProductByID'
            ]);
        });
    });

    Route::middleware(['guest:admin', 'PreventBrowserBackHistory'])->group(function (){

        Route::get('/login', [
            'as' => 'login',
            'uses' => 'AdminController@login'
        ]);

        Route::post('/check', [
            'as' => 'admin.check',
            'uses' => 'AdminController@check'
        ]);

        Route::prefix('category')->group(function () {

            Route::get('/get-category-by-ID/{id}', [
                'as' => 'category.getCategoryByID',
                'uses' => 'CategoryController@getCategoryByID'
            ]);

        });

        Route::prefix('product')->group(function () {

            Route::get('/getProductByID/{id}', [
                'as' => 'product.getProductByID',
                'uses' => 'ProductController@getProductByID'
            ]);
        });

    });

});

// ====== - START - Category ====== //
//Route::prefix('admin/category')->group(function () {
////    Route::get('/add-category', [
////        'as' => 'category.add-category',
////        'uses' => 'CategoryController@addCategory'
////    ]);
////    Route::get('/all-categories', [
////        'as' => 'category.all-categories',
////        'uses' => 'CategoryController@allCategories'
////    ]);
////
////    Route::post('/insert', [
////        'as' => 'category.insert',
////        'uses' => 'CategoryController@insert'
////    ]);
////
////    Route::post('/delete', [
////        'as' => 'category.delete',
////        'uses' => 'CategoryController@delete'
////    ]);
////
////    Route::post('/update', [
////        'as' => 'category.update',
////        'uses' => 'CategoryController@update'
////    ]);
////
////    Route::get('/get-category-by-ID/{id}', [
////        'as' => 'category.getCategoryByID',
////        'uses' => 'CategoryController@getCategoryByID'
////    ]);
//
//    Route::get('/getCategories', [
//        'as' => 'category.getCategories',
//        'uses' => 'CategoryController@getCategories'
//    ]);
//
//});Route::prefix('admin/category')->group(function () {
////    Route::get('/add-category', [
////        'as' => 'category.add-category',
////        'uses' => 'CategoryController@addCategory'
////    ]);
////    Route::get('/all-categories', [
////        'as' => 'category.all-categories',
////        'uses' => 'CategoryController@allCategories'
////    ]);
////
////    Route::post('/insert', [
////        'as' => 'category.insert',
////        'uses' => 'CategoryController@insert'
////    ]);
////
////    Route::post('/delete', [
////        'as' => 'category.delete',
////        'uses' => 'CategoryController@delete'
////    ]);
////
////    Route::post('/update', [
////        'as' => 'category.update',
////        'uses' => 'CategoryController@update'
////    ]);
////
////    Route::get('/get-category-by-ID/{id}', [
////        'as' => 'category.getCategoryByID',
////        'uses' => 'CategoryController@getCategoryByID'
////    ]);
//
//    Route::get('/getCategories', [
//        'as' => 'category.getCategories',
//        'uses' => 'CategoryController@getCategories'
//    ]);
//
//});
// ====== - END - Category ====== //
//
//
//// ====== - START - Product ====== //
//Route::prefix('admin/product')->group(function () {
//    Route::get('/add-product', [
//        'as' => 'product.add-product',
//        'uses' => 'ProductController@addProduct'
//    ]);
//    Route::get('/all-products', [
//        'as' => 'product.all-products',
//        'uses' => 'ProductController@allProducts'
//    ]);
//
//    Route::post('/insert', [
//        'as' => 'product.insert',
//        'uses' => 'ProductController@insert'
//    ]);
//
//    Route::post('/update', [
//        'as' => 'product.update',
//        'uses' => 'ProductController@update'
//    ]);
//
//    Route::post('/delete', [
//        'as' => 'product.delete',
//        'uses' => 'ProductController@delete'
//    ]);
//
//    Route::get('/getProducts', [
//        'as' => 'product.getProducts',
//        'uses' => 'ProductController@getProducts'
//    ]);
//
//    Route::get('/getProductByID/{id}', [
//        'as' => 'product.getProductByID',
//        'uses' => 'ProductController@getProductByID'
//    ]);
//});
//// ====== - END - Product ====== //


Route::get('/', [
    'as' => 'main.home',
    'uses' => 'HomeController@home'
]);

Route::get('/store', [
    'as' => 'main.store',
    'uses' => 'HomeController@store'
]);

Route::get('/contacts', [
    'as' => 'main.contacts',
    'uses' => 'HomeController@contacts'
]);

Route::get('/cart-details', [
    'as' => 'main.cartDetails',
    'uses' => 'HomeController@cartDetails'
]);

Route::match(['GET', 'POST'], '/payment/callback', [
    'as' => 'payment.callback',
    'uses' => 'PaymentController@callback'
]);

Route::post('/getSearch', [
    'as' => 'main.getSearch',
    'uses' => 'HomeController@getSearch'
]);


// ====== - START - Cart ====== //
Route::prefix('cart')->name('cart.')->group(function () {
    Route::post('/add-to-cart', [
        'as' => 'addToCart',
        'uses' => 'CartController@addToCart'
    ]);

    Route::post('/destroy-cart', [
        'as' => 'destroyCart',
        'uses' => 'CartController@destroyCart'
    ]);

    Route::post('/remove-cart-item', [
        'as' => 'removeCartItem',
        'uses' => 'CartController@removeCartItem'
    ]);

    Route::post('/update-quantity', [
        'as' => 'updateQuantity',
        'uses' => 'CartController@updateQuantity'
    ]);

    Route::get('/reload-cart', [
        'as' => 'reloadCart',
        'uses' => 'CartController@reloadCart'
    ]);


    Route::post('/add-to-wishlist', [
        'as' => 'addToWishlist',
        'uses' => 'CartController@addToWishlist'
    ]);

    Route::post('/remove-from-wishlist', [
        'as' => 'removeFromWishlist',
        'uses' => 'CartController@removeFromWishlist'
    ]);

    Route::post('/destroy-wishlist', [
        'as' => 'destroyWishlist',
        'uses' => 'CartController@destroyWishlist'
    ]);

    Route::get('/reload-wishlist', [
        'as' => 'reloadWishlist',
        'uses' => 'CartController@reloadWishlist'
    ]);



});
// ====== - END - Product ====== //

Auth::routes();

Route::prefix('user')->name('user.')->group(function (){
    Route::middleware(['guest:web', 'PreventBrowserBackHistory'])->group(function (){
        Route::get('/login', [
            'as' => 'login',
            'uses' => 'User\UserController@login'
        ]);
        Route::get('/register', [
            'as' => 'register',
            'uses' => 'User\UserController@register'
        ]);

        Route::post('/create', [
            'as' => 'create',
            'uses' => 'User\UserController@create'
        ]);
        Route::post('/check', [
            'as' => 'check',
            'uses' => 'User\UserController@check'
        ]);


    });

    Route::middleware(['auth:web', 'PreventBrowserBackHistory'])->group(function (){
        Route::get('/profile', [
            'as' => 'profileInfo',
            'uses' => 'User\UserController@profileInfo'
        ]);

        Route::get('/wishlist', [
            'as' => 'wishlist',
            'uses' => 'User\UserController@wishlist'
        ]);

        Route::get('/orders', [
            'as' => 'orders',
            'uses' => 'User\UserController@orders'
        ]);

        Route::post('/logout', [
            'as' => 'logout',
            'uses' => 'User\UserController@logout'
        ]);
        Route::post('/update-avatar', [
            'as' => 'updateAvatar',
            'uses' => 'User\UserController@updateAvatar'
        ]);
        Route::post('/update', [
            'as' => 'update',
            'uses' => 'User\UserController@update'
        ]);
        Route::post('/change-password', [
            'as' => 'changePassword',
            'uses' => 'User\UserController@changePassword'
        ]);

        Route::post('/add-order-to-review', [
            'as' => 'addOrderToReview',
            'uses' => 'OrderController@addOrderToReview'
        ]);

        Route::get('/checkout-review', [
            'as' => 'checkoutReview',
            'uses' => 'HomeController@checkoutReview'
        ]);

        Route::get('/checkout-complete/{orderTracking}', [
            'as' => 'checkoutComplete',
            'uses' => 'HomeController@checkoutComplete'
        ]);



        Route::post('/payment/create', [
            'as' => 'payment.create',
            'uses' => 'PaymentController@create'
        ]);

        Route::post('/order/create', [
            'as' => 'order.create',
            'uses' => 'OrderController@createOrder'
        ]);
    });
});

