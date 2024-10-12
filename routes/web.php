<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Backend\GroupController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\OrderDetailController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\Frontend\FrontendUserController;
use App\Http\Controllers\Frontend\FrontendHomeController;
use App\Http\Controllers\LocalizationController;
use App\Models\Discount;

//frontend or website panel

Route::group(['middleware' => 'changeLangMiddleware'], function () {


    Route::get('/change/lang/{lang_name}', [LocalizationController::class, 'changeLang'])->name('change.language');

    Route::get('/', [FrontendHomeController::class, 'frontendHome'])->name('frontend.homepage');
    Route::get('/sign-up', [FrontendUserController::class, 'frontendSignUp'])->name('frontend.sign.up');
    Route::post('/do/sign-up', [FrontendUserController::class, 'frontendDoSignup'])->name('frontend.do.sign.up');
    Route::get('/sign-in', [FrontendUserController::class, 'frontendSignIn'])->name('frontend.sign.in');
    Route::post('/do/sign-in', [FrontendUserController::class, 'frontendDoSignIn'])->name('frontend.do.sign.in');

    Route::group(['middleware' => 'customerAuth'], function () {
        Route::get('/sign-out', [FrontendUserController::class, 'frontendSignOut'])->name('frontend.sign.out');
    });
});

//Backend: Admin Panel
Route::group(['prefix' => 'admin'], function () {

    //Admin Login Logout
    Route::get('/login', [UserController::class, 'adminLogin'])->name('admin.login');
    Route::post('/do/login', [UserController::class, 'adminDoLogin'])->name('admin.do.login');
    Route::group(['middleware' => 'auth'], function () {

        Route::get('/logout', [UserController::class, 'adminLogout'])->name('admin.logout');

        Route::get('/', [HomeController::class, 'home'])->name('homepage');

        //Group
        Route::get('/group/list', [GroupController::class, 'groupList'])->name('admin.group.list');
        Route::get('/group/form', [GroupController::class, 'groupForm'])->name('admin.group.form');
        Route::post('/submit/group/form', [GroupController::class, 'submitGroupForm'])->name('admin.submit.group.form');

        Route::get('/group/edit/{id}', [GroupController::class, 'groupEdit'])->name('admin.group.edit');
        Route::put('/group/update/{id}', [GroupController::class, 'groupUpadte'])->name('admin.group.update');
        Route::get('/group/delete/{id}', [GroupController::class, 'groupDelete'])->name('admin.group.delete');

        //Category
        Route::get('/category/list', [CategoryController::class, 'categoryList'])->name('admin.category.list');
        Route::get('/category/form', [CategoryController::class, 'categoryForm'])->name('admin.category.form');
        Route::post('/submit/category/form', [CategoryController::class, 'submitCategoryForm'])->name('admin.submit.category.form');

        Route::get('/category/edit/{id}', [CategoryController::class, 'categoryEdit'])->name('admin.category.edit');
        Route::put('/category/update/{id}', [CategoryController::class, 'categoryUpdate'])->name('admin.category.update');
        Route::get('/category/delete/{id}', [CategoryController::class, 'categoryDelete'])->name('admin.category.delete');

        //Brand
        Route::get('/brand/list', [BrandController::class, 'brandList'])->name('admin.brand.list');
        Route::get('/brand/form', [BrandController::class, 'brandForm'])->name('admin.brand.form');
        Route::post('/submit/brand/form', [BrandController::class, 'submitBrandForm'])->name('admin.submit.brand.form');

        Route::get('/brand/edit/{id}', [BrandController::class, 'brandEdit'])->name('admin.brand.edit');
        Route::put('/brand/update/{id}', [BrandController::class, 'brandUpdate'])->name('admin.brand.update');
        Route::get('/brand/delete/{id}', [BrandController::class, 'brandDelete'])->name('admin.brand.delete');

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

        //Order
        Route::get('/order/list', [OrderController::class, 'orderList'])->name('admin.order.list');
        Route::get('/order/form', [OrderController::class, 'orderForm'])->name('admin.order.form');
        Route::post('/submit/order/form', [OrderController::class, 'SubmitOrderForm'])->name('admin.submit.order.form');

        Route::get('/order/edit/{id}', [OrderController::class, 'orderEdit'])->name('admin.order.edit');
        Route::put('/order/update/{id}', [OrderController::class, 'orderUpdate'])->name('admin.order.update');
        Route::get('/order/delete/{id}', [OrderController::class, 'orderDelete'])->name('admin.order.delete');

        //Order Detail
        Route::get('/order-detail/list', [OrderDetailController::class, 'orderDetailList'])->name('admin.order.detail.list');
        Route::get('/order-detail/form', [OrderDetailController::class, 'orderDetailForm'])->name('admin.order.detail.form');
        Route::post('/submit/order-detail/form', [OrderDetailController::class, 'SubmitOrderDetailForm'])->name('admin.submit.order.detail.form');

        Route::get('/order-detail/edit/{id}', [OrderDetailController::class, 'orderDetailEdit'])->name('admin.order.detail.edit');
        Route::put('/order-detail/update/{id}', [OrderDetailController::class, 'orderDetailUpdate'])->name('admin.order.detail.update');
        Route::get('/order-detail/delete/{id}', [OrderDetailController::class, 'orderDetailDelete'])->name('admin.order.detail.delete');


        //Role
        Route::get('/role/list', [RoleController::class, 'roleList'])->name('admin.role.list');
        Route::get('/role/form', [RoleController::class, 'roleForm'])->name('admin.role.form');
        Route::post('/submit/role/form', [RoleController::class, 'SubmitRoleForm'])->name('admin.submit.role.form');

        Route::get('/role/edit/{id}', [RoleController::class, 'roleEdit'])->name('admin.role.edit');
        Route::put('/role/update/{id}', [RoleController::class, 'roleUpdate'])->name('admin.role.update');
        Route::get('/role/delete/{id}', [RoleController::class, 'roleDelete'])->name('admin.role.delete');

        //User
        Route::get('/user/list', [UserController::class, 'userList'])->name('admin.user.list');
        Route::get('/user/form', [UserController::class, 'userForm'])->name('admin.user.form');
        Route::post('/submit/user/form', [UserController::class, 'SubmitUserForm'])->name('admin.submit.user.form');

        Route::get('/user/edit/{id}', [UserController::class, 'userEdit'])->name('admin.user.edit');
        Route::put('/user/update/{id}', [UserController::class, 'userUpdate'])->name('admin.user.update');
        Route::get('/user/delete/{id}', [UserController::class, 'userDelete'])->name('admin.user.delete');

        //Discount
        Route::get('discount/list', [DiscountController::class, 'discountList'])->name('admin.discount.list');
        Route::get('/discount/form', [DiscountController::class, 'discountForm'])->name('admin.discount.form');
        Route::post('/submit/discount/form', [DiscountController::class, 'SubmitDiscountForm'])->name('admin.submit.discount.form');

        Route::get('/discount/edit/{id}', [DiscountController::class, 'discountEdit'])->name('admin.discount.edit');
        Route::put('/discount/update/{id}', [DiscountController::class, 'discountUpdate'])->name('admin.discount.update');
        Route::get('/discount/delete/{id}', [DiscountController::class, 'discountDelete'])->name('admin.discount.delete');
    });
});
