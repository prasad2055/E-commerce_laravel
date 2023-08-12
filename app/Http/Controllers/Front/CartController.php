<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function index(Request $request) {
        $cart = [];

        if($request->hasCookie('ecom_cart')) {
            $cart = json_decode($request->cookie('ecom_cart'), true);
        }

        foreach($cart as $id => $v) {
            $product = Product::find($id);

            $cart[$id]['product'] = $product;
        }

        $cart = collect($cart);

        return view('front.cart.index', compact('cart'));
    }
    public function store (Request $request, Product $product, int $qty = 1) {
        $cart = [];

        if($request->hasCookie('ecom_cart')) {
            $cart = json_decode($request->cookie('ecom_cart'), true);
        }

        $price = $product->discounted_price ?? $product->price;

        if(key_exists($product->id, $cart)) {
            $qty += $cart[$product->id]['qty'];
        }

        $cart[$product->id] = [
            'price' => $price,
            'qty' => $qty,
            'total' => $price * $qty
        ];

        flash('Product added to cart.')->success();

        return response('Ok')->withCookie('ecom_cart', json_encode($cart), 30 * 24 * 60, '/');
    }

    public function update(Request $request) {
        $cart = json_decode($request->cookie('ecom_cart'), true);

        foreach($request->qty as $k => $v) {
            $cart[$k]['qty'] = $v;
        }

        flash('Product updated in cart.')->success();

        return redirect()->route('front.cart.index')->withCookie('ecom_cart', json_encode($cart), 30 * 24 * 60, '/');
    }

    public function destroy(Request $request, $id) {
        $cart = [];

        if($request->hasCookie('ecom_cart')) {
            $cart = json_decode($request->cookie('ecom_cart'), true);
        }

        if(key_exists($id, $cart)) {
            unset($cart[$id]);
        }

        if(!empty($cart)) {
            flash('Product removed from cart.')->success();

            return redirect()->route('front.cart.index')->withCookie('ecom_cart', json_encode($cart), 30 * 24 * 60, '/');
        } else {
            flash('The cart is empty.')->success();

            return redirect()->route('front.cart.index')->withoutCookie('ecom_cart');
        }
    }
}
