<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;
use App\Http\Controllers\ProdukController;

Route::get('/produk', function (){
    return view('produk.view');
});

Route::resource('produk', ProdukController::class);
