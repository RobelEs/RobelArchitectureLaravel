<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ChantierController;
use App\Http\Controllers\Api\MaterielController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::apiResource('chantiers', ChantierController::class);
Route::apiResource('materiels', MaterielController::class);

