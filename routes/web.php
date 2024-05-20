<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\AuthController;

//admin
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminPropertyController;

//agent
use App\Http\Controllers\AgentDashboardController;
use App\Http\Controllers\AgentPropertyController;


// clear all
Route::get('/all-clear', function () {
    Artisan::call('optimize:clear');
    return 'All cleared!';
});



//forntend routes
Route::get('/', [FrontEndController::class, 'index'])->name('frontend.index');

Route::get('/login', [AuthController::class, 'loginForm'])->name('frontend.login_form');
Route::get('/signup', [AuthController::class, 'signupForm'])->name('frontend.signup_form');
Route::post('/user-store', [AuthController::class, 'userStore'])->name('frontend.user_store');

Route::get('logout', [AuthController::class, 'destroy'])->name('logout');
Route::get('/', [FrontEndController::class, 'index'])->name('frontend.index');


// admin login and logout routes
Route::get('/post-login', [AuthController::class, 'postLogin'])->name('post.login');
Route::get('/admin/login', [AuthController::class, 'getLoginPage'])->name('admin.get_login');
Route::get('admin/logout', [AuthController::class, 'adminLogout'])->name('admin.logout');

// agent login and logout
Route::get('agent/login', [AuthController::class, 'agentLogin'])->name('agent.login');
Route::get('agent/logout', [AuthController::class, 'agentLogout'])->name('agent.logout');


//Define the routes within prefix
Route::group(['middleware' => 'admin', 'prefix' => '/'], function () {
    // admin dashboard routes
    Route::group(array('prefix' => 'agent'), function () {
        Route::get('/dashboard', [AgentDashboardController::class, 'index'])->name('agent.index');
        Route::get('/profile', [AgentDashboardController::class, 'profile'])->name('agent.profile');

        //properties routes
        Route::get('/properties', [AgentPropertyController::class, 'properties'])->name('agent.properties');
        Route::get('/property-create', [AgentPropertyController::class, 'propertyCreate'])->name('agent.create_property');
        Route::post('/upload', [AgentPropertyController::class, 'uploadImages'])->name('agent.property.upload_images');
        Route::post('/property-store', [AgentPropertyController::class, 'propertyStore'])->name('agent.store_property');
        Route::get('/property-detail/{id}', [AgentPropertyController::class, 'propertyDetail'])->name('agent.detail_property');
        Route::get('/property-edit/{id}', [AgentPropertyController::class, 'propertyEdit'])->name('agent.update_property');
        Route::post('/property-update', [AgentPropertyController::class, 'propertyUpdate'])->name(' [agent.update_property');
        Route::post('/delete', [AgentPropertyController::class, 'propertyDelete'])->name('agent.property.delete_property');
    });


    // admin dashboard routes
    Route::group(array('prefix' => 'admin'), function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.index');
        Route::group(['prefix' => 'property-types'], function () {
            Route::get('/', [AdminPropertyController::class, 'property_types'])->name('admin.property_types');
            Route::post('/store', [AdminPropertyController::class, 'property_types_store'])->name('admin.property_types_store');
            Route::post('/update', [AdminPropertyController::class, 'property_types_update'])->name('admin.property_types_update');
            Route::post('/delete', [AdminPropertyController::class, 'property_types_delete'])->name('admin.property_types_delete');
        });

        Route::group(['prefix' => 'property-features'], function () {
            Route::get('/', [AdminPropertyController::class, 'property_features'])->name('admin.property_features');
            Route::post('/store', [AdminPropertyController::class, 'property_features_store'])->name('admin.property_features_store');
            Route::post('/update', [AdminPropertyController::class, 'property_features_update'])->name('admin.property_features_update');
            Route::post('/delete', [AdminPropertyController::class, 'property_features_delete'])->name('admin.property_features_delete');
        });

        Route::group(['prefix' => 'properties'], function () {
            Route::get('/', [AdminPropertyController::class, 'properties'])->name('admin.properties');
        });
    });

});
