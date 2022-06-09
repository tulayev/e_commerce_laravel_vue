<?php

use Illuminate\Support\Facades\Route;

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('product')->group(function () {
        Route::post('/', [\App\Http\Controllers\Api\ProductController::class, 'store']);
        Route::post('/{id}', [\App\Http\Controllers\Api\ProductController::class, 'update']);
        Route::delete('/{id}', [\App\Http\Controllers\Api\ProductController::class, 'destroy']);
    });

    Route::post('/user/{id}', [\App\Http\Controllers\Api\UserController::class, 'update']);
    Route::get('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);
});

// Public routes
Route::get('/products', [\App\Http\Controllers\Api\ProductController::class, 'index']);
Route::get('/product/{id}', [\App\Http\Controllers\Api\ProductController::class, 'show']);
Route::post('/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);

