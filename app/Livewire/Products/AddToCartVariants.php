<?php

namespace App\Livewire\Products;

use App\Models\Feature;
use App\Models\Product;
use Binafy\LaravelCart\Models\Cart;
use Binafy\LaravelCart\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;

class AddToCartVariants extends Component
{
    public $product;
    public $qty=1;
    public $selected_features = [];

    public function mount() {
        foreach($this->product->options as $option) {
            $features=collect($option->pivot->features);
            $this->selected_features[$option->id]=$features->first()['id'];
        }
    }

    #[Computed()]
    public function variant() {
        return $this->product->variants->load('features')->filter(function($variant) {
            return !array_diff($variant->features->pluck('id')->toArray(), $this->selected_features);
        })->first();
    }

    public function add_to_cart() {
        //Verifico que el usuario esté autenticado
        if(!Auth::check()){
            return redirect()->route('login');
        }

        //obtengo datos del usuario autenticado
        $user=Auth::user();

        //obtengo el carrito del usuario
        $cart = Cart::query()
            ->where('user_id', $user->id)
            ->first();

        //Si no existe el carrito, lo creo
        if(!$cart){
            $cart = Cart::query()->firstOrCreate(['user_id' => $user->id]);
        }

        //Verifico si el producto ya está en el carrito
        $cartItem = $cart->items()->where('itemable_id', $this->product->id)->first();

        //Si el producto ya está en el carrito, actualizo la cantidad
        if($cartItem){
            $cartItem->quantity += $this->qty;
            $cartItem->save();
        }else{
            //Si el producto no está en el carrito, lo agrego con la cantidad especificada
            $cartItem = new CartItem([
                'itemable_id' => $this->product->id,
                'itemable_type' => Product::class,
                'quantity' => $this->qty,
                'options'       => json_encode([
                    'image' => $this->variant->image,
                    'sku'        => $this->variant->sku,
                    'features'   => Feature::whereIn('id', $this->selected_features)->pluck('description', 'id')->toArray(),
                ]),
            ]);
            $cart->items()->save($cartItem);
        }
        $this->dispatch('refreshCartCount');
        $this->dispatch('swal', [
            'title' => 'Bien hecho!',
            'icon' => 'success',
            'text' => 'Has agregado el producto: '.$this->product->name.' al carrito',
        ]);
    }

    public function render()
    {
        return view('livewire.products.add-to-cart-variants');
    }
}
