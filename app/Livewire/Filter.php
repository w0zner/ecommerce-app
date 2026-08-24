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

        $options = Option::when($this->family_id, function($query) {
            $query->whereHas('products.subcategory.category', function($query) {
                $query->where('family_id', $this->family_id);
            })
            ->with([
                'features' => function($query) {
                    $query->whereHas('variants.product.subcategory.category', function($query) {
                        $query->where('family_id', $this->family_id);
                    });
                }
            ]);
        })
        ->when($this->category_id, function($query) {
            $query->whereHas('products.subcategory', function($query) {
                $query->where('category_id', $this->category_id);
            })
            ->with([
                'features' => function($query) {
                    $query->whereHas('variants.product.subcategory', function($query) {
                        $query->where('category_id', $this->category_id);
                    });
                }
            ]);
        })
        ->when($this->subcategory_id, function($query) {
            $query->whereHas('products', function($query) {
                $query->where('subcategory_id', $this->subcategory_id);
            })
            ->with([
                'features' => function($query) {
                    $query->whereHas('variants.product', function($query) {
                        $query->where('subcategory_id', $this->subcategory_id);
                    });
                }
            ]);
        })
        ->get();


        $products = Product::when($this->family_id, function($query) {
            $query->whereHas('subcategory.category', function($query) {
                $query->where('family_id', $this->family_id);
            });
        })
        ->when($this->category_id, function($query) {
            $query->whereHas('subcategory', function($query) {
                $query->where('category_id', $this->category_id);
            });
        })
        ->when($this->subcategory_id, function($query) {
                $query->where('subcategory_id', $this->subcategory_id);
        })
        ->when($this->orderBy=="relevance", function($query) {
            $query->orderBy("created_at", "desc");
        })
        ->when($this->orderBy=="price", function($query) {
            $query->orderBy("price", "asc");
        })
        ->when($this->orderBy=="price_desc", function($query) {
            $query->orderBy("price", "desc");
        })
        ->when($this->searchOnEvent, function($query) {
            $query->where('name', 'like', '%' . $this->searchOnEvent . '%');
        })
        ->when($this->selected_features, function($query) {
            $query->whereHas('variants.features', function($query) {
                $query->whereIn('features.id', $this->selected_features);
            });
        })
        ->paginate(12);

        //dd($options, $products);
        return view('livewire.filter', compact('products', 'options'));
    }
}
