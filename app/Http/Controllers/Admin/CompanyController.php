<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index() {
        $company = Company::query()->first();
        return view('admin.company.index', compact('company'));
    }

    public function create() {
        return view('admin.company.create');
    }

    public function store(Request $request) {
        //$company = Company::query()->create($request->all());
        //return redirect()->route('admin.company.index');
        dd($request->all());
    }
}
