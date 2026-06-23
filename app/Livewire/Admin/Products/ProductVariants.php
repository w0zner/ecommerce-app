<?php

namespace App\Livewire\Admin\Products;

use App\Models\Feature;
use App\Models\Option;
use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ProductVariants extends Component
{
    public Product $product;
    public $openModal = true;
    public $options = [];
    public $variant = [
        'option_id' => '',
        'features' => [
            [
                'id' => '',
                'value' => '',
                'description' => '',
            ]
        ],
    ];

    public function mount()
    {
        $this->options = Option::all();
    }

    #[Computed()]
    public function features() {
        return Feature::where('option_id', $this->variant['option_id'])->get();
    }

    public function addFeature() {
        $this->variant['features'][] = [
            'id' => '',
            'value' => '',
            'description' => '',
        ];
    }

    public function removeFeature(int $index): void {
        if(count($this->variant['features']) > 1) {
            unset($this->variant['features'][$index]);
            $this->variant['features'] = array_values($this->variant['features']);
        }
    }

    public function featureChange($index) {
        $feature = Feature::find($this->variant['features'][$index]['id']);
        if($feature) {
            $this->variant['features'][$index]['value'] = $feature->value;
            $this->variant['features'][$index]['description'] = $feature->description;
        } else {
            $this->variant['features'][$index]['value'] = '';
            $this->variant['features'][$index]['description'] = '';
        }
    }

    public function updateOptionVariantId() {
        $this->variant['features'] = [
            [
                'id' => '',
                'value' => '',
                'description' => '',
            ]
        ];
    }

    public function save() {
        $this->validate([
            'variant.option_id' => 'required|exists:options,id',
            'variant.features' => 'required|array|min:1',
            'variant.features.*.id' => 'required',
        ],[],[
            'variant.option_id' => 'opción',
            'variant.features' => 'valores',
            'variant.features.*.id' => 'valor',
        ]);

        $this->product->options()->attach($this->variant['option_id'], [
            'features' => $this->variant['features']  //si no hubieramos creado el modelo intermedio OptionProduct, tendriamos que hacer un json_encode($this->variant['features']) para guardarlo como string en la base de datos
        ]);

        $this->reset(['variant', 'openModal']);
    }

    public function render()
    {
        return view('livewire.admin.products.product-variants');
    }
}
