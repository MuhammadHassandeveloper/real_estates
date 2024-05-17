<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminPropertyController;


// clear all
Route::get('/all-clear', function () {
    Artisan::call('optimize:clear');
    return 'All cleared!';
});


#forntend routes
Route::get('/',[FrontEndController::class,'index'])->name('frontend.index');

Route::get('/login',[AuthController::class,'loginForm'])->name('frontend.login_form');
Route::get('/signup',[AuthController::class,'signupForm'])->name('frontend.signup_form');
Route::post('/user-store',[AuthController::class,'userStore'])->name('frontend.user_store');


Route::get('/',[FrontEndController::class,'index'])->name('frontend.index');


#auth  routes
Route::get('/post-login',[AuthController::class,'postLogin'])->name('post.login');
Route::get('/admin/login',[AuthController::class,'getLoginPage'])->name('admin.get_login');


// Define the routes within prefix
Route::group(['middleware' => 'admin','prefix' => '/'], function () {
    // admin dashboard routes
    Route::group(array('prefix' => 'admin'), function () {
        Route::get('/dashboard',[AdminDashboardController::class,'index'])->name('admin.index');
        Route::group(['prefix' => 'property-types'], function () {
            Route::get('/',[AdminPropertyController::class,'property_types'])->name('admin.property_types');
            Route::post('/store',[AdminPropertyController::class,'property_types_store'])->name('admin.property_types_store');
            Route::post('/update',[AdminPropertyController::class,'property_types_update'])->name('admin.property_types_update');
            Route::post('/delete',[AdminPropertyController::class,'property_types_delete'])->name('admin.property_types_delete');
        });

        Route::group(['prefix' => 'property-features'], function () {
            Route::get('/',[AdminPropertyController::class,'property_features'])->name('admin.property_features');
            Route::post('/store',[AdminPropertyController::class,'property_features_store'])->name('admin.property_features_store');
            Route::post('/update',[AdminPropertyController::class,'property_features_update'])->name('admin.property_features_update');
            Route::post('/delete',[AdminPropertyController::class,'property_features_delete'])->name('admin.property_features_delete');
        });

        Route::group(['prefix' => 'properties'], function () {
            Route::get('/',[AdminPropertyController::class,'properties'])->name('admin.properties');
        });
});

});
