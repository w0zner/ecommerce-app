<?php

namespace App\Http\Controllers;

use App\Models\Cover;
use App\Models\Product;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index() {
        $covers = Cover::where('is_active', true)
        ->where('start_at', '<=', now())
        //->where('end_at', '>=', now())
        ->orderBy('order')->get();

        $lastProducts = Product::orderBy('id', 'desc')->take(12)->get();

        return view('welcome', compact('covers', 'lastProducts'));
    }


}
