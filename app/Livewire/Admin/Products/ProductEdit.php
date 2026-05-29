<?php

namespace App\Livewire\Admin\Products;

use App\Models\Category;
use App\Models\Family;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductEdit extends Component
{
    use WithFileUploads;
    public $product;

    public $families;
    public $family_id="";
    public $category_id="";
    public $image;

    public $productEdit = [
        'sku' => '',
        'name' => '',
        'description' => '',
        'image_path' => '',
        'price' => '',
        'subcategory_id' => '',
    ];

    public function mount() {
        $this->families = Family::all();

        $this->productEdit = [ 
            'sku' => $this->product->sku,
            'name' => $this->product->name,
            'description' => $this->product->description,
            'image_path' => $this->product->image_path,
            'price' => $this->product->price,
            'subcategory_id' => $this->product->subcategory_id,
        ];

        //$this->image = $this->product->image_path;


        $this->family_id = $this->product->subcategory->category->family_id;
        $this->category_id = $this->product->subcategory->category_id;
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
            'image' => 'nullable|image|max:1024',
            'productEdit.image_path' => 'required|string|max:255',
            'productEdit.sku' => 'required|string|max:255',
            'productEdit.name' => 'required|string|max:255|unique:products,name,'. $this->product->id,
            'productEdit.description' => 'required|string|max:500',
            'productEdit.price' => 'required|numeric|min:0',
            'family_id' => 'required|exists:families,id',
            'category_id' => 'required|exists:categories,id',
            'productEdit.subcategory_id' => 'required|exists:subcategories,id',
        ],[],
        [
            'productEdit.sku' => 'sku',
            'productEdit.name' => 'nombre',
            'productEdit.description' => 'descripción',
            'family_id' => 'familia',
            'category_id' => 'categoría',
            'productEdit.subcategory_id' => 'subcategoria'
        ]);

        if($this->image) {
            $this->productEdit['image_path'] = $this->image->store('products');
            if($this->product->image_path) {
                Storage::disk('public')->delete($this->product->image_path);
            }
        }

        $this->product->update($this->productEdit);

        session()->flash('swal', [
            'icon' => 'success',
            'title'=> 'Info!',
            'text'=> 'Registro actualizado con éxito!'
        ]);

        return redirect()->route('admin.products.index');
    }

    public function render()
    {
        return view('livewire.admin.products.product-edit');
    }
}
