<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subcategories = Subcategory::orderBy('id', 'desc')->with('category.family')->paginate(7);
        //return $subcategories;
        return view('admin.subcategories.index', compact("subcategories"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::latest('id')->get();
        return view('admin.subcategories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(Subcategory $subcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subcategory $subcategory)
    {
        return view('admin.subcategories.edit', compact('subcategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subcategory $subcategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subcategory $subcategory)
    {
        if($subcategory->products->count() > 0) {
            session()->flash('swal', [
                'position'=> 'top-end',
                'icon' => 'error',
                'title'=> 'No se puede eliminar porque tiene categorias asociadas.'
            ]);

            return redirect()->route('admin.subcategories.edit');
        }

        $subcategory->delete();

        session()->flash('swal', [
            'position'=> 'top-end',
            'icon' => 'success',
            'title'=> 'Eliminado con éxito!',
            'showConfirmButton'=> false,
            'timer' => 1500
        ]);

        return redirect()->route('admin.subcategories.index');
    }
}
