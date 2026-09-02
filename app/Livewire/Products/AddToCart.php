<?php

namespace App\Livewire\Products;

use Livewire\Component;

class AddToCart extends Component
{
    public $product;
    public $qty=2;

    public function render()
    {
        return view('livewire.products.add-to-cart');
    }

}
