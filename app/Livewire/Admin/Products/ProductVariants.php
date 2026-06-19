<?php

namespace App\Livewire\Admin\Products;

use App\Models\Option;
use Livewire\Component;

class ProductVariants extends Component
{
    public $openModal = true;
    public $options = [];
    public $variant = [
        'option_id' => '',
        'features' => [],
    ];

    public function mount()
    {
        $this->options = Option::all();
    }

    public function render()
    {
        return view('livewire.admin.products.product-variants');
    }
}
