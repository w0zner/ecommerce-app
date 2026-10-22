<?php

namespace App\Http\Controllers;

use Binafy\LaravelCart\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index() {
         if(!Auth::check()){
            return redirect()->route('login');
        }

        $user=Auth::user();
        $cart = Cart::query()
            ->where('user_id', $user->id)
            ->first();

        $cartItems=[];
        $totalPrice=0;
        if($cart) {
            $cartItems = $cart->items()->with('itemable')->get();

            if(count($cartItems) > 0) {
                $totalPrice = $cartItems->sum(function($item){
                    return $item['itemable']['price'] * $item['quantity'];
                });
            } else {
                $totalPrice = 0;
            }
        }
        $precioEnvio = 25000;

        return view('checkout.index', compact('cartItems', 'totalPrice', 'precioEnvio'));
    }
}
