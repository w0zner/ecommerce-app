<?php

namespace App\Livewire\Admin\Products;

use App\Models\Category;
use App\Models\Family;
use App\Models\Product;
use App\Models\Subcategory;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductCreate extends Component
{
    use WithFileUploads;
    
    public $families;

    public $family_id="";
    public $category_id="";

    public $image;

    public $product = [
        'sku' => '',
        'name' => '',
        'description' => '',
        'image_path' => '',
        'price' => '',
        'stock' => '',
        'subcategory_id' => '',
    ];

    public function mount() {
        $this->families = Family::all();
    }

    #[Computed()]
    public function categories() {
        return Category::where('family_id', $this->family_id)->get();
    }

    #[Computed()]
    public function subcategories() {
        return Subcategory::where('category_id', $this->category_id)->get();
    }

    public function save() {
        //dd(json_encode($this->product)  . $this->family_id . ','. $this->category_id .','. $this->subcategory_id);
        $this->validate([
            'image' => 'required|image|max:1024',
            'product.sku' => 'required|string|max:255',
            'product.name' => 'required|string|unique:products,name|max:255',
            'product.description' => 'required|string|max:500',
            'product.price' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
            'product.stock' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
            'family_id' => 'required|exists:families,id',
            'category_id' => 'required|exists:categories,id',
            'product.subcategory_id' => 'required|exists:subcategories,id',
        ],[],
        [
            'product.sku' => 'sku',
            'product.name' => 'nombre',
            'product.description' => 'descripción',
            'product.stock' => 'stock',
            'family_id' => 'familia',
            'category_id' => 'categoría',
            'product.subcategory_id' => 'subcategoria'
        ]);

        $this->product['image_path'] = $this->image->store('products');

        Product::create($this->product);

        session()->flash('swal', [
            'icon' => 'success',
            'title'=> 'Info!',
            'text'=> 'Registro guardado con éxito!'
        ]);

        return redirect()->route('admin.products.index');
    }

    public function render()
    {
        return view('livewire.admin.products.product-create');
    }
}
