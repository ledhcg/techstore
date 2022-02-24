<?php

namespace App\Providers;

use App\Http\Controllers\HomeController;
use App\Models\Category;
use App\Models\Product;
use App\Service\PaymentService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PaymentService::class, function ($app){
            return new PaymentService();
        });

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('errors/404', function ($view) {
            $view->with([
                'page' => '404',
            ]);
        });
        view()->composer('partials-main/navbar', function ($view) {
            $dataProducts = Product::all();
            $dataCategories = Category::all();
            $urlPhoto = asset("data/images/upload/products/");
            $view->with([
                'dataProducts' => $dataProducts,
                'dataCategories'=>$dataCategories,
                'urlPhoto' => $urlPhoto,
            ]);
        });

        view()->composer('layouts/main-user-layout', function ($view) {
            $urlPhoto = asset("data/images/upload/users/");
            $view->with([
                'urlPhoto' => $urlPhoto,
            ]);
        });
    }
}
