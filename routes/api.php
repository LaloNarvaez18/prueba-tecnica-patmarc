<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\ProductsApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/v1/products', [ProductsApiController::class, 'index'])
    ->name('api.products.index');

Route::get('/v1/products/categories', [ProductsApiController::class, 'byCategories'])
    ->name('api.products.categories');

Route::get('/v1/products/{id}', [ProductsApiController::class, 'show'])
    ->name('api.products.show');
