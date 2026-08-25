<?php

namespace App\Livewire;

use App\Models\Option;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\On;
use Livewire\Component;

class Filter extends Component
{
    public $family_id;
    public $category_id;
    public $subcategory_id;
    //public $options;
    public $selected_features = [];
    public $orderBy  = "relevance";
    public $searchOnEvent;

    public function mount() {
        //Se convierte la consulta en un array de manera a que se pueda obtener de el cada vez que se renderice la vista
        //Esto es porque la consulta original devuelve un objeto de Eloquent, y no un array
        //Para evitar esto, se convierte la consulta en un array de manera previa

        //La otra opción es llevar la consulta al método render de manera a que se pueda obtener de el cada vez
        //que se renderice la vista ya que en mount solo lo carga una vez cuando se monta la página

         //$this->options->load('features');
    }

    #[On('search')]
    public function searh($search) {
        $this->searchOnEvent=$search;
    }

     /*  $options = Cache::remember("family_options_{$this->family_id}", now()->addHours(24), function () {
                return Option::whereHas('products.subcategory.category', function($query) {
                    $query->where('family_id', $this->family_id);
                })
                ->with([
                    'features' => function($query) {
                        $query->whereHas('variants.product.subcategory.category', function($query) {
                            $query->where('family_id', $this->family_id);
                        });
                    }
                ])->get();
            }); */


    public function render()
    {
        //Consultas con query scopes
        $options = Option::verifyFamily($this->family_id)
        ->verifyCategory($this->category_id)
        ->verifySubcategory($this->subcategory_id)
        ->get();


        $products = Product::verifyFamily($this->family_id)
        ->verifyCategory($this->category_id)
        ->verifySubcategory($this->subcategory_id)
        ->verifyOrder($this->orderBy)
        ->verifySearch($this->searchOnEvent)
        ->verifyFeatures($this->selected_features)
        ->paginate(12);

        //dd($options, $products);
        return view('livewire.filter', compact('products', 'options'));
    }
}
