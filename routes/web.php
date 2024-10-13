<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\DistributorController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\FlashsaleController;
// Guest Route
Route::group(['middleware' => 'guest'], function () {
    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/post-register', [AuthController::class, 'post_register'])->name('post.register');
    Route::post('/post-login', [AuthController::class, 'login']);
})->middleware('guest');
// Admin Route
Route::group(['middleware' => 'admin'], function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/product/create', [ProductController::class,'create'])->name('product.create');
    Route::post('/product/store', [ProductController::class,'store'])->name('product.store');
    Route::get('/admin/product/detail/{id}' , [ProductController::class, 'detail'])->name('product.detail');
    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/product/update/{id}' , [ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
    // Product Routesssss
    Route::get('/product', [ProductController::class, 'index'])->name('admin.product');
    Route::get('/admin-logout', [AuthController::class, 'admin_logout'])->name('admin.logoust');
    // Distributor Route
    Route::post('/distributor/update/{id}' , [DistributorController::class, 'update'])->name('distributor.update');
    Route::get('/distributor/detail/{id}' , [DistributorController::class, 'detail'])->name('distributor.detail');
    Route::get('/distributor/create',[DistributorController::class,'create'])->name('distributor.create');
    Route::get('/distributor', [DistributorController::class, 'index'])->name('admin.distributor');
    Route::get('/admin-logout', [AuthController::class, 'admin_logout'])->name('admin.logout');
    Route::post('/distributor/store', [DistributorController::class,'store'])->name('distributor.store');
    Route::delete('/distributor/delete/{id}', [DistributorController::class, 'delete'])->name('distributor.delete');
    Route::get('/distributor/edit/{id}', [DistributorController::class, 'edit'])->name('distributor.edit');
})->middleware('admin');

//Flashsale Route
    Route::get('/flash', [FlashsaleController::class, 'index'])->name('admin.flash');
    Route::get('/flash/create',[FlashsaleController::class,'create'])->name('flash.create');
    Route::post('/flash/toko', [FlashsaleController::class,'toko'])->name('flash.toko');
    Route::post('/flash/update/{id}' , [FlashsaleController::class, 'update'])->name('flash.update');
    Route::get('/flash/detail/{id}' , [FlashsaleController::class, 'detail'])->name('flash.detail');
    Route::delete('/flash/delete/{id}', [FlashsaleController::class, 'delete'])->name('flash.delete');
    Route::get('/flash/edit/{id}', [FlashsaleController::class, 'edit'])->name('flash.edit');
    
// User Route
Route::group(['middleware' => 'web'], function () {
    Route::get('/user', [UserController::class, 'index'])->name('user.dashboard'); 
    Route::get('/user-logout', [AuthController::class, 'user_logout'])->name('user.logout');
    Route::get('/user/product/detail/{id}', [UserController::class , 'detail_product' ])->name('user.detail.product');
    Route::get('/product/purchase/{productId}/{userId}' , [UserController::class,'purchase']);
    Route::get('/user/flash/detailflash/{id}', [UserController::class , 'detail_flash' ])->name('user.detailflash.flash');
    Route::get('/flash/purchaseSale/{flashId}/{userId}' , [UserController::class,'purchaseSale']);
})->middleware('web');