<?php

namespace App\Livewire;

use Binafy\LaravelCart\LaravelCart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShoppingCart extends Component
{
    public $cartItems;
    public $totalPrice;

    public function mount() {
        $this->totalPrice = $this->cartItems->sum(function($item){
            return $item['itemable']['price'] * $item['quantity'];
        });
    }

    public function limpiarCarrito() {
        $user=Auth::user();

        LaravelCart::emptyCart($user->id);
        $this->dispatch('refreshCartCount');

        return redirect()->route('cart.index');
    }

    public function render()
    {
        return view('livewire.shopping-cart');
    }
}
