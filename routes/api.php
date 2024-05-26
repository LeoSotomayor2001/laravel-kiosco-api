<?php

use App\Http\Controllers\CategoriaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', )->middleware('auth:sanctum');
Route::apiResource('/categorias',CategoriaController::class);
