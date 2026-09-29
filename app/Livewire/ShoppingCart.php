<?php

namespace App\Livewire;

use Binafy\LaravelCart\LaravelCart;
use Binafy\LaravelCart\Models\Cart;
use Binafy\LaravelCart\Models\CartItem;
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

    public function removeItem($itemId) {
         $user=Auth::user();
         //LaravelCart::removeItem($itemId);

         //$deleted = CartItem::query()->where('id', $itemId)

         $cart = Cart::query()
          ->where('user_id', $user->id)
            ->first();

        $deleted = $cart->items()->where('id', $itemId)->delete();
             //($cartItems);

        if($deleted){
           /*  session()->flash('swal', [
                'position'=> 'top-end',
                'icon' => 'error',
                'title'=> 'Producto eliminado.',
                'showConfirmButton'=> false,
                'timer' => 1500
            ]); */

            return redirect()->route('cart.index');
        }

        return redirect()->route('cart.index');
    }

    public function render()
    {
        return view('livewire.shopping-cart');
    }
}
