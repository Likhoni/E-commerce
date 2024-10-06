<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\Frontend\FrontendUserController;
use App\Http\Controllers\Frontend\FrontendHomeController;

//frontend
Route::get('/', [FrontendHomeController::class, 'frontendHome'])->name('frontend.homepage');
Route::get('/sign-up', [FrontendUserController::class, 'frontendSignUp'])->name('frontend.sign.up');
Route::post('/do/sign-up', [FrontendUserController::class, 'frontendDoSignup'])->name('frontend.do.sign.up');
Route::get('/sign-in', [FrontendUserController::class, 'frontendSignIn'])->name('frontend.sign.in');
Route::post('/do/sign-in', [FrontendUserController::class, 'frontendDoSignIn'])->name('frontend.do.sign.in');

Route::group(['middleware' => 'customerAuth'], function(){
Route::get('/sign-out',[FrontendUserController::class, 'frontendSignOut'])->name('frontend.sign.out');
});

//Backend: Admin Panel
Route::group(['prefix' => 'admin'], function () {

    //Admin Login Logout
    Route::get('/login', [UserController::class, 'adminLogin'])->name('admin.login');
    Route::post('/do/login', [UserController::class, 'adminDoLogin'])->name('admin.do.login');
    Route::group(['middleware' => 'auth'], function () {
    
        Route::get('/logout', [UserController::class, 'adminLogout'])->name('admin.logout');

        Route::get('/', [HomeController::class, 'home'])->name('homepage');
        //Category
        Route::get('/category/list', [CategoryController::class, 'categoryList'])->name('admin.category.list');
        Route::get('/category/form', [CategoryController::class, 'categoryForm'])->name('admin.category.form');
        Route::post('/submit/category/form', [CategoryController::class, 'submitCategoryForm'])->name('admin.submit.category.form');

        Route::get('/category/edit/{id}', [CategoryController::class, 'categoryEdit'])->name('admin.category.edit');
        Route::put('/category/update/{id}', [CategoryController::class, 'categoryUpadte'])->name('admin.category.update');
        Route::get('/category/delete/{id}', [CategoryController::class, 'categoryDelete'])->name('admin.category.delete');

        //Product
        Route::get('/product/list', [ProductController::class, 'productList'])->name('admin.product.list');
        Route::get('/product/form', [ProductController::class, 'productForm'])->name('admin.product.form');
        Route::post('/submit/product/form', [ProductController::class, 'SubmitProductForm'])->name('admin.submit.product.form');

        Route::get('/product/edit/{id}', [ProductController::class, 'productEdit'])->name('admin.product.edit');
        Route::put('/product/update/{id}', [ProductController::class, 'productUpdate'])->name('admin.product.update');
        Route::get('/product/delete/{id}', [ProductController::class, 'productDelete'])->name('admin.product.delete');

        //Customer
        Route::get('/customer/list', [CustomerController::class, 'customerList'])->name('admin.customer.list');
        Route::get('/customer/form', [CustomerController::class, 'customerForm'])->name('admin.customer.form');
        Route::post('/submit/customer/form', [CustomerController::class, 'SubmitCustomerForm'])->name('admin.submit.customer.form');

        Route::get('/customer/edit/{id}', [CustomerController::class, 'customerEdit'])->name('admin.customer.edit');
        Route::put('/customer/update/{id}', [CustomerController::class, 'customerUpdate'])->name('admin.customer.update');
        Route::get('/customer/delete/{id}', [CustomerController::class, 'customerDelete'])->name('admin.customer.delete');

        
        //Role
        Route::get('/role/list', [RoleController::class, 'roleList'])->name('admin.role.list');
        Route::get('/role/form', [RoleController::class, 'roleForm'])->name('admin.role.form');
        Route::post('/submit/role/form', [RoleController::class, 'SubmitRoleForm'])->name('admin.submit.role.form');

        // Route::get('/user/edit/{id}', [UserController::class, 'userEdit'])->name('admin.user.edit');
        // Route::put('/user/update/{id}', [UserController::class, 'userUpdate'])->name('admin.user.update');
        // Route::get('/user/delete/{id}', [UserController::class, 'userDelete'])->name('admin.user.delete');
        Route::get('/role/permission/{id}', [RoleController::class, 'asssignPermission'])->name('admin.role.assign.permission');

        //User
        Route::get('/user/list', [UserController::class, 'userList'])->name('admin.user.list');
        Route::get('/user/form', [UserController::class, 'userForm'])->name('admin.user.form');
        Route::post('/submit/user/form', [UserController::class, 'SubmitUserForm'])->name('admin.submit.user.form');

        Route::get('/user/edit/{id}', [UserController::class, 'userEdit'])->name('admin.user.edit');
        Route::put('/user/update/{id}', [UserController::class, 'userUpdate'])->name('admin.user.update');
        Route::get('/user/delete/{id}', [UserController::class, 'userDelete'])->name('admin.user.delete');

    });
});
