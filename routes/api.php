<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ChantierController;
use App\Http\Controllers\Api\MaterielController;


//créer moi une route login 
Route::group(['middleware' => ['guest']], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
});

// créer un group middlew
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('chantiers', ChantierController::class);
    Route::apiResource('materiels', MaterielController::class);
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('users', UserController::class);

});

