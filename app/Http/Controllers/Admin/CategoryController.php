<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Family;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')
        ->with('family')  //para evitar problema N+1
        ->paginate(7);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $families = Family::latest('id')->get();

        return view('admin.categories.create', compact('families'));  
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'family_id' => ['required', 'integer', 'exists:families,id']
        ]);

        Category::create($request->all());
        return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $families=Family::all();
        return view('admin.categories.edit', compact('category', 'families'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if($category->subcategories()->count() > 0) {
            session()->flash('swal', [
                'position'=> 'top-end',
                'icon' => 'error',
                'title'=> 'No se puede eliminar porque tiene subcategorias asociadas.'
            ]);

            return redirect()->route('admin.categories.index');
        }

        $category->delete();

        session()->flash('swal', [
            'position'=> 'top-end',
            'icon' => 'success',
            'title'=> 'Eliminado con éxito!',
            'showConfirmButton'=> false,
            'timer' => 1500
        ]);

        return redirect()->route('admin.categories.index');
    }
}
