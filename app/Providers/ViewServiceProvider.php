<?php

namespace App\Providers;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer(['back.products.create', 'back.products.edit', 'front.includes.header'], function($view) {
            $categories =  Category::select('id', 'name')->whereStatus('Active')->get();
            $brands =  Brand::select('id', 'name')->whereStatus('Active')->get();

            $view->with(compact('categories', 'brands'));
        });

        View::composer(['front.includes.header'], function($view) {
            $totalPrice = 0;
            $totalQty = 0;

            if(Request::hasCookie('ecom_cart')) {
                $cart = collect(json_decode(Request::cookie('ecom_cart'), true));

                $totalPrice = $cart->sum('total');
                $totalQty = $cart->sum('qty');
            }

            $view->with(compact('totalPrice', 'totalQty'));
        });
    }
}
