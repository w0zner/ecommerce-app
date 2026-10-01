<?php

namespace App\Livewire;

use Binafy\LaravelCart\LaravelCart;
use Binafy\LaravelCart\Models\Cart;
use Binafy\LaravelCart\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShoppingCart extends Component
{
    public $cart;
    public $cartItems;
    public $totalPrice;

    public function mount() {}

    public function obtenerItems() {
        if($this->cart) {
            $this->cartItems = $this->cart->items()->with('itemable')->get();
        }

        if(count($this->cartItems) > 0) {
            $this->totalPrice = $this->cartItems->sum(function($item){
                return $item['itemable']['price'] * $item['quantity'];
            });
        } else {
            $this->totalPrice = 0;
        }
    }

    public function limpiarCarrito() {
        $user=Auth::user();

        LaravelCart::emptyCart($user->id);
        $this->dispatch('refreshCartCount');
        return redirect()->route('cart.index');
    }

    public function decreaseQuantity($itemId) {
        $cartItem = CartItem::query()->where('id', $itemId)->firstOrFail();
        if($cartItem) {
            if($cartItem->quantity > 1) {
                $cartItem->quantity--;
                $cartItem->save();
            } else {
                $this->removeItem($itemId);
            }
        }
        //dd($this->cartItems);
        $this->dispatch('refreshCartCount');
    }

        public function increaseQuantity($itemId) {
        $cartItem = CartItem::query()->where('id', $itemId)->firstOrFail();
        if($cartItem) {
            //if($cartItem->quantity < 9) {
                $cartItem->quantity++;
                $cartItem->save();
            //} else {
               // $this->removeItem($itemId);
            //}
        }

        $this->dispatch('refreshCartCount');
    }

    public function removeItem($itemId) {
         $deleted = CartItem::query()->where('id', $itemId)->delete();

        if($deleted){
            return redirect()->route('cart.index');
        }

        return redirect()->route('cart.index');
    }

    public function render()
    {
        $this->obtenerItems();
        return view('livewire.shopping-cart');
    }
}
