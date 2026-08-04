<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\FamillyController;
use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CoverController;
use App\Http\Controllers\Admin\SubcategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.dashboard');
})->name('dashboard');

Route::resource('families', FamillyController::class);

Route::resource('categories', CategoryController::class);

Route::resource('subcategories', SubcategoryController::class);

Route::resource('products', ProductController::class);

Route::resource('options', OptionController::class);

Route::get('products/{product}/variants/{variant}', [ProductController::class, 'variants'])
->name('products.variants')
->scopeBindings();

Route::put('products/{product}/variants/{variant}', [ProductController::class, 'variantsUpdate'])
->name('products.variantsUpdate')
->scopeBindings();

Route::resource('covers', CoverController::class);