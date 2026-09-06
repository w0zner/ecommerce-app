<?php

namespace App\Livewire\Products;

use App\Models\Product;
use Livewire\Component;
use Binafy\LaravelCart\LaravelCart;
use Binafy\LaravelCart\Models\Cart;
use Binafy\LaravelCart\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class AddToCart extends Component
{
    public $product;
    public $qty=1;

    public function eliminar() {
                $user=Auth::user();

        LaravelCart::emptyCart($user->id);
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
            ]);
            $cart->items()->save($cartItem);
        }

        $this->dispatch('swal', [
            'title' => 'Bien hecho!',
            'icon' => 'success',
            'text' => 'Has agregado el producto: '.$this->product->name.' al carrito',
        ]);
    }

    public function render()
    {
        return view('livewire.products.add-to-cart');
    }

}
