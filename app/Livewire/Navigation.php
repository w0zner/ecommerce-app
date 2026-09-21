<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Family;
use Binafy\LaravelCart\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class Navigation extends Component
{
    public $families;
    public $family_id;
    public $cart = null;
    public $cartCount = 0;

    public function mount() {
        $this->families = Family::all();
        $this->family_id = $this->families->first()->id;

        if(Auth::check()) {
            $this->cart = Cart::query()
            ->where('user_id', Auth::user()->id)
            ->first();

            $this->cartCount = $this->cart ? $this->cart->items()->sum('quantity') : 0;
        }
    }

    #[Computed()]
    public function categories() {
        return Category::where('family_id', $this->family_id)
            ->with('subcategories')
            ->get();
    }

    #[Computed()]
    public function familyName() {
        return Family::find($this->family_id)->name;
    }

    //Escuchamos el evento refreshCartCount emitido desde AddToCart.php y AddToCartVariants.php
    //para actualizar la cantidad de productos en el carrito
    #[On('refreshCartCount')]
    public function refreshCartCount() {
        $this->cartCount = $this->cart->items()->sum('quantity') ?? 0;
    }

    public function render()
    {
        return view('livewire.navigation');
    }
}
