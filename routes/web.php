<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomeController as FrontendHomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;



Route::get('/',[HomeController::class,'home'])->name('homepage');

//Category
Route::get('/category/list',[CategoryController::class,'categoryList'])->name('admin.category.list');
Route::get('/category/form',[CategoryController::class,'categoryForm'])->name('admin.category.form');
Route::post('/submit/category/form',[CategoryController::class,'submitCategoryForm'])->name('admin.submit.category.form');

Route::get('/category/edit/{id}',[CategoryController::class,'categoryEdit'])->name('admin.category.edit');
Route::put('/category/update/{id}',[CategoryController::class,'categoryUpadte'])->name('admin.category.update');
Route::get('/category/delete/{id}',[CategoryController::class,'categoryDelete'])->name('admin.category.delete');

//Product
Route::get('/product/list',[ProductController::class,'productList'])->name('admin.product.list');
Route::get('/product/form',[ProductController::class,'productForm'])->name('admin.product.form');
Route::post('/submit/product/form',[ProductController::class,'SubmitProductForm'])->name('admin.submit.product.form');

Route::get('/product/edit/{id}',[ProductController::class,'productEdit'])->name('admin.product.edit');
Route::put('/product/update/{id}',[ProductController::class,'productUpdate'])->name('admin.product.update');
Route::get('/product/delete/{id}',[ProductController::class,'productDelete'])->name('admin.product.delete');

Route::get('/website',[FrontendHomeController::class,'frontendHome'])->name('frontend.homepage');
