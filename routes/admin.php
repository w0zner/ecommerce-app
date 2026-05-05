<?php

use Illuminate\Support\Facades\Route;

Route::get('/admin', function () {
    return 'Hola mundo desde el admin';
})->name('admin.dashboard');
