<?php

namespace App\Livewire;

use Livewire\Component;

class ShippingType extends Component
{
    public $cart;
    public $cartItems;
    public $totalPrice;
    public $shippingType = 'delivery';
    public $shippingCost = 25000;

    public function mount()
    {
        // Recuperar de sesión si ya existe, sino usar defaults
        $this->shippingType = session('shipping_type', 'delivery');
        $this->shippingCost = $this->shippingType === 'carry_out' ? 0 : 25000;

        session([
            'shipping_type' => $this->shippingType,
            'shipping_cost' => $this->shippingCost,
        ]);
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

    public function render()
    {
        return view('livewire.shipping-type');
    }
}
