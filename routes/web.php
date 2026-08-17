<?php

use App\Http\Controllers\FamilyController;
use App\Http\Controllers\WelcomeController;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome.index');

Route::get('families/{family}', [FamilyController::class, 'show'])->name('families.show');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/product-test', function () {
    $product = Product::find(1);
    $features = $product->options()->get()->pluck('pivot.features')->toArray();

    $combinaciones = generarCombinaciones($features);

    foreach ($combinaciones as $combinacion) {
        $variant=Variant::create([
            'product_id' => $product->id,
        ]);

        $variant->features()->attach($combinacion);
    }

    return response()->json($variant);
})->name('product.test');

Route::get('/prueba', function () {
    $array1 = ['a', 'b', 'c'];
    $array2 = ['a', 'b', 'c'];
    $array3 = ['a', 'b', 'c'];

    $arrays = [$array1, $array2, $array3];

    $combinations = generarCombinaciones($arrays);

    return $combinations;
})->name('prueba.index');

function generarCombinaciones($arrays, $indice = 0, $combinacionActual = []) {
    if($indice === count($arrays)) {
        return [$combinacionActual];
    }
    $resultado = [];
    foreach($arrays[$indice] as $item) {
        $combinacionTemporal = $combinacionActual;
        $combinacionTemporal[] = $item['id'];

        $resultado = array_merge($resultado, generarCombinaciones($arrays, $indice + 1, $combinacionTemporal));
    }

    return $resultado;
};
