<?php

use App\Http\Controllers\Admin\FamillyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.dashboard');
})->name('dashboard');

Route::resource('families', FamillyController::class);
