<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasienController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('pasien', PasienController::class);

Route::get('/pasien', function (){
    return view('pasien.view');
});
