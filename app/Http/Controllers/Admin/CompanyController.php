<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index() {
        $company = Company::query()->first();
       // dd($company);
        return view('admin.company.index', compact('company'));
    }

    public function create() {
        return view('admin.company.create');
    }

    public function store(Request $request) {
        //$company = Company::query()->create($request->all());
        //return redirect()->route('admin.company.index');
        //dd($request->all());

        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:255|unique:users,email',
            'phone' => 'required|string|min:7|max:10',
            'whatsapp' => 'required|string|min:7|max:10',
            'city' => 'required|string|max:100',
            'address' => 'required|string|max:255',
        ]);

        Company::create($validatedData);

        session()->flash('swal', [
            'icon' => 'success',
            'title'=> 'Info!',
            'text'=> 'Registro guardado con éxito!'
        ]);

        return redirect()->route('admin.company.index');
    }

    public function edit(Company $company) {
        return view('admin.company.edit', compact('company'));
    }

    public function destroy(Company $company) {
        $company->delete();

        session()->flash('swal', [
            'position'=> 'top-end',
            'icon' => 'success',
            'title'=> 'Registro eliminado con éxito!',
            'showConfirmButton'=> false,
            'timer' => 1500
        ]);

        return redirect()->route('admin.company.index');
    }
}
