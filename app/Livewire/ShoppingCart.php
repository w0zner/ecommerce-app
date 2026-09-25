<?php

namespace App\Livewire;

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

    public function render()
    {
        return view('livewire.shopping-cart');
    }
}
