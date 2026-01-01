<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;

Route::resource('bukus', BukuController::class);

Route::get('/', function () {
    return redirect()->route('bukus.index');
});