<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

// Modul Produk
Route::get('/products', [ProductController::class, 'apiIndex']);
Route::post('/products', [ProductController::class, 'store']);
Route::post('/products/{id}/sell', [ProductController::class, 'sell']);
Route::put('/products/{id}', [ProductController::class, 'update']);
Route::delete('/products/{id}', [ProductController::class, 'destroy']);


// Modul User
Route::get('/users', [UserController::class, 'index']);
Route::put('/users/{id}/change-role', [UserController::class, 'changeRole']);