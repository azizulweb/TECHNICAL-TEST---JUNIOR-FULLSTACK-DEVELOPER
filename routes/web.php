<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/inventaris', [ProductController::class, 'index']);
Route::get('/products/{id}/edit', [ProductController::class, 'edit']);
Route::put('/products/{id}/update', [ProductController::class, 'update']);

Route::get('/users', function () {
    return view('users');
});