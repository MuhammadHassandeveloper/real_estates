<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AuthController;

// clear all
Route::get('/all-clear', function () {
    Artisan::call('optimize:clear');
    return 'All cleared!';
});


#forntend routes
Route::get('/',[FrontEndController::class,'index'])->name('frontend.index');


#auth  routes
Route::get('/post-login',[AuthController::class,'postLogin'])->name('post.login');
Route::get('/admin/login',[AuthController::class,'getLoginPage'])->name('admin.get_login');


// Define the routes within prefix
Route::group(['middleware' => 'admin','prefix' => '/'], function () {
    // admin dashboard routes
    Route::group(array('prefix' => 'admin'), function () {
        Route::get('/dashboard',[AdminDashboardController::class,'index'])->name('admin.index');
    });
});
