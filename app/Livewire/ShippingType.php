<?php

namespace App\Livewire;

use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class ShippingType extends Component
{
    public $cart;
    public $cartItems;
    public $totalPrice;
    public $shippingType = 'delivery';
    public $shippingCost = 25000;
    public $addresses= null;

    public function mount()
    {
        // Recuperar de sesión si ya existe, sino usar defaults
        $this->shippingType = session('shipping_type', 'carry_out');
        $this->shippingCost = $this->shippingType === 'carry_out' ? 0 : 25000;

        $this->setTipoEnvio();
        /* session([
            'shipping_type' => $this->shippingType,
            'shipping_cost' => $this->shippingCost,
        ]); */
    }

    public function updatedShippingType($value)
    {
        if ($value === 'carry_out') {
            $this->shippingCost = 0;
        } else {
            $this->shippingCost = 25000;
        }

        session([
            'shipping_type' => $this->shippingType,
            'shipping_cost' => $this->shippingCost,
        ]);

        $this->dispatch('shipping-updated', shippingType: $this->shippingType, shippingCost: $this->shippingCost);
    }

    public function setTipoEnvio() {
        //dd("hola");
        $this->addresses = Address::where('user_id', Auth::user()->id)->get() ?? collect();
        if($this->addresses->count() == 0){
            $this->shippingType = 'carry_out';
        }

        $this->shippingCost = $this->shippingType === 'carry_out' ? 0 : 25000;


        session([
            'shipping_type' => $this->shippingType,
            'shipping_cost' => $this->shippingCost,
        ]);
    }

    #[On('shipping-exist')]
    public function shippingExist()
    {
        $this->setTipoEnvio();
    }

    public function render()
    {
        return view('livewire.shipping-type');
    }
}
