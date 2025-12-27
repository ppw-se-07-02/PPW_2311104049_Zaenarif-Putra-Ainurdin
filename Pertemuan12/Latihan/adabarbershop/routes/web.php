<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KapsterController;

Route::get('/', fn () => view('dashboard.index'));

Route::get('/kapster', [KapsterController::class, 'index']);
Route::post('/kapster/raw', [KapsterController::class, 'storeRaw']);
Route::post('/kapster/query', [KapsterController::class, 'storeQuery']);
Route::post('/kapster/eloquent', [KapsterController::class, 'storeEloquent']);
