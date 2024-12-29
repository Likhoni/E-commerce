<?php

use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/get-products',[ProductController::class, 'getProduct']);
Route::get('/get-product/{id}',[ProductController::class, 'getSingleProduct']);
Route::post('/create/product',[ProductController::class, 'createProduct']);
Route::post('/update/product/{id}',[ProductController::class, 'updateProduct']);
Route::get('/delete/product/{id}',[ProductController::class, 'deleteProduct']);
