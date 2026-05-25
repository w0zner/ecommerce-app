<?php

namespace App\Livewire\Admin\Subcategories;

use App\Models\Category;
use App\Models\Family;
use Livewire\Attributes\Computed;
use Livewire\Component;

class SubcategoryEdit extends Component
{
    public $subcategory;
    public $families;
    public $subcategoryEdit = [
        'family_id' => '',
        'category_id' => '',
        'name' => ''
    ];

    public function mount() {
        $this->families = Family::all();

        $this->subcategoryEdit = [
        'family_id' => $this->subcategory->category->family_id,
        'category_id' => $this->subcategory->category_id,
        'name' => $this->subcategory->name
    ];
    }

    public function updatedSubcategoryEditFamilyId() {
        $this->subcategoryEdit['category_id']='';
    }

    public function save(){
        
        $this->validate([
            'subcategoryEdit.family_id' => 'required|exists:families,id',
            'subcategoryEdit.category_id' => 'required|exists:categories,id',
            'subcategoryEdit.name' => 'required|string|max:255'
        ],[],
        [
            'subcategoryEdit.family_id' => 'familia',
            'subcategoryEdit.category_id' => 'categoría',
            'subcategoryEdit.name' => 'nombre'
        ]);
        
         $this->subcategory->update($this->subcategoryEdit);
        
        session()->flash('swal', [
            'icon' => 'success',
            'title'=> 'Info!',
            'text'=> 'Registro actualizado con éxito!'
        ]);

        return redirect()->route('admin.subcategories.index');
    }

    #[Computed()]
    public function categories() {
        return Category::where('family_id', $this->subcategoryEdit['family_id'])->get();
    }

    public function render()
    {
        return view('livewire.admin.subcategories.subcategory-edit');
    }
}
