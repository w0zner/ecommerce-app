<?php

namespace App\Http\Controllers;

use App\Models\Cover;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index() {
        $covers = Cover::where('is_active', true)
        ->where('start_at', '<=', now())
        //->where('end_at', '>=', now())
        ->orderBy('order')->get();

        return view('welcome', compact('covers'));
    }


}
