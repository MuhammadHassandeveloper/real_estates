<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\AuthController;

//agent Controllers
use App\Http\Controllers\AgentDashboardController;
use App\Http\Controllers\AgentPropertyController;

//agency Controllers
use App\Http\Controllers\AgencyDashboardController;
use App\Http\Controllers\AgencyPropertyController;
use App\Http\Controllers\AgencyAgentController;

//admin Controllers
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminPropertyController;
use App\Http\Controllers\AdminCountryController;
use App\Http\Controllers\AdminStateController;
use App\Http\Controllers\AdminCityController;


// clear all
Route::get('/all-clear', function () {
    Artisan::call('optimize:clear');
    return 'All cleared!';
});



//forntend routes
Route::get('/', [FrontEndController::class, 'index'])->name('frontend.index');
Route::get('/properties', [FrontEndController::class, 'properties'])->name('frontend.properties');
Route::get('/properties/filter', [FrontEndController::class, 'filterProperties'])->name('frontend.properties.filter');

Route::get('/property-detail/{id}/{title}', [FrontEndController::class, 'propertyDetail'])->name('frontend.property-detail');
Route::get('/agencies', [FrontEndController::class, 'agencies'])->name('frontend.agencies');
Route::get('/agents', [FrontEndController::class, 'agents'])->name('frontend.agents');
Route::get('/agent-detail/{id}', [FrontEndController::class, 'agentDetail'])->name('frontend.agent');
Route::get('/agency-detail/{id}', [FrontEndController::class, 'agencyDetail'])->name('frontend.agency');

Route::get('/about-us', [FrontEndController::class, 'aboutUs'])->name('frontend.about-us');
Route::get('/contact-us', [FrontEndController::class, 'contactUs'])->name('frontend.contact-us');



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
    // agent dashboard routes
    Route::group(array('prefix' => 'agent'), function () {
        Route::get('/dashboard', [AgentDashboardController::class, 'index'])->name('agent.index');
        Route::get('/profile', [AgentDashboardController::class, 'profile'])->name('agent.profile');
        Route::post('/profile-update', [AgentDashboardController::class, 'profileUpdate'])->name('agent.profile_update');
        Route::post('/password-update', [AgentDashboardController::class, 'passwordUpdate'])->name('agent.password_update');
        Route::get('/activities', [AgentDashboardController::class, 'activities'])->name('agent.activities');

        //properties routes
        Route::get('/properties', [AgentPropertyController::class, 'properties'])->name('agent.properties');
        Route::get('/sale-properties', [AgentPropertyController::class, 'saleProperties'])->name('agent.sale.properties');
        Route::get('/rent-properties', [AgentPropertyController::class, 'rentProperties'])->name('agent.rent.properties');
        Route::get('/property-create', [AgentPropertyController::class, 'propertyCreate'])->name('agent.create_property');
        Route::post('/upload', [AgentPropertyController::class, 'uploadImages'])->name('agent.property.upload_images');
        Route::post('/property-store', [AgentPropertyController::class, 'propertyStore'])->name('agent.store_property');
        Route::get('/property-detail/{id}', [AgentPropertyController::class, 'propertyDetail'])->name('agent.detail_property');
        Route::get('/property-edit/{id}', [AgentPropertyController::class, 'propertyEdit'])->name('agent.edit_property');
        Route::post('/property-update', [AgentPropertyController::class, 'propertyUpdate'])->name('agent.update_property');
        Route::post('/delete', [AgentPropertyController::class, 'propertyDelete'])->name('agent.property.delete_property');
    });

    // agency dashboard routes
    Route::group(array('prefix' => 'agency'), function () {
        Route::get('/dashboard', [AgencyDashboardController::class, 'index'])->name('agency.index');
        Route::get('/profile', [AgencyDashboardController::class, 'profile'])->name('agency.profile');
        Route::post('/profile-update', [AgencyDashboardController::class, 'profileUpdate'])->name('agency.profile_update');
        Route::post('/password-update', [AgencyDashboardController::class, 'passwordUpdate'])->name('agency.password_update');
        Route::get('/activities', [AgencyDashboardController::class, 'activities'])->name('agency.activities');

        //properties routes
        Route::get('/properties', [AgencyPropertyController::class, 'properties'])->name('agency.properties');
        Route::get('/sale-properties', [AgencyPropertyController::class, 'saleProperties'])->name('agency.sale.properties');
        Route::get('/rent-properties', [AgencyPropertyController::class, 'rentProperties'])->name('agency.rent.properties');
        Route::get('/property-create', [AgencyPropertyController::class, 'propertyCreate'])->name('agency.create_property');
        Route::post('/upload', [AgencyPropertyController::class, 'uploadImages'])->name('agency.property.upload_images');
        Route::post('/property-store', [AgencyPropertyController::class, 'propertyStore'])->name('agency.store_property');
        Route::get('/property-detail/{id}', [AgencyPropertyController::class, 'propertyDetail'])->name('agency.detail_property');
        Route::get('/property-edit/{id}', [AgencyPropertyController::class, 'propertyEdit'])->name('agency.edit_property');
        Route::post('/property-update', [AgencyPropertyController::class, 'propertyUpdate'])->name('agency.update_property');
        Route::post('/delete', [AgencyPropertyController::class, 'propertyDelete'])->name('agency.property.delete_property');

        //agents routes
        Route::get('/agents', [AgencyAgentController::class, 'agents'])->name('agency.agents');
        Route::get('/agent-create', [AgencyAgentController::class, 'agentCreate'])->name('agency.create_agent');
        Route::post('/agent-store', [AgencyAgentController::class, 'agentStore'])->name('agency.store_agent');
        Route::get('/agent-detail/{id}', [AgencyAgentController::class, 'agentDetail'])->name('agency.detail_agent');
        Route::get('/agent-edit/{id}', [AgencyAgentController::class, 'agentEdit'])->name('agency.edit_agent');
        Route::post('/agent-update', [AgencyAgentController::class, 'agentUpdate'])->name('agency.update_agent');
        Route::post('/agent-delete', [AgencyAgentController::class, 'agentDelete'])->name('agency.property.delete_agent');
    });


    // admin dashboard routes
    Route::group(array('prefix' => 'admin'), function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.index');


        Route::group(['prefix' => 'countries'], function () {
            Route::get('/', [AdminCountryController::class, 'countries'])->name('admin.countries');
            Route::post('/store', [AdminCountryController::class, 'countryStore'])->name('admin.country_store');
            Route::post('/update', [AdminCountryController::class, 'countryUpdate'])->name('admin.country_update');
            Route::post('/delete', [AdminCountryController::class, 'countryDelete'])->name('admin.country_delete');
            Route::get('/change-status/{id}', [AdminCountryController::class, 'changeStatus'])->name('admin.change.status');
        });

        Route::group(['prefix' => 'states'], function () {
            Route::get('/', [AdminStateController::class, 'states'])->name('admin.states');
            Route::post('/store', [AdminStateController::class, 'stateStore'])->name('admin.state_store');
            Route::post('/update', [AdminStateController::class, 'stateUpdate'])->name('admin.state_update');
            Route::post('/delete', [AdminStateController::class, 'stateDelete'])->name('admin.state_delete');
        });

        // City routes
        Route::group(['prefix' => 'cities'], function () {
            Route::get('/', [AdminCityController::class, 'index'])->name('admin.cities');
            Route::post('/store', [AdminCityController::class, 'store'])->name('admin.city_store');
            Route::post('/update', [AdminCityController::class, 'update'])->name('admin.city_update');
            Route::post('/delete', [AdminCityController::class, 'delete'])->name('admin.city_delete');
        });


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
