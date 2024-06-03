<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', )->middleware('auth:sanctum');

//autenticacion

Route::group(['middleware' => ['cors']], function () {
    Route::post('/registro',[AuthController::class, 'register']);
    Route::post('/login',[AuthController::class, 'login']);
    Route::apiResource('/categorias',CategoriaController::class);
    Route::apiResource('/productos',ProductoController::class);
    
});