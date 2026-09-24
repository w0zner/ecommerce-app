<?php

namespace App\Livewire;

use Livewire\Component;

class ShoppingCart extends Component
{
    public $cartItems;

    public function render()
    {
        return view('livewire.shopping-cart');
    }
}
