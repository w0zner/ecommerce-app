<?php

namespace App\Http\Controllers;

use Binafy\LaravelCart\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        if(!Auth::check()){
            return redirect()->route('login');
        }

        $user=Auth::user();
        $cart = Cart::query()
            ->where('user_id', $user->id)
            ->first();

        $cartItems = $cart->items()->with('itemable')->get();

        return view('cart.index', compact('cartItems'));
    }
}
