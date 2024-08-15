<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\AuthController;

//agent Controllers
use App\Http\Controllers\AgentDashboardController;
use App\Http\Controllers\AgentPropertyController;

//admin Controllers
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminPropertyController;
use App\Http\Controllers\AdminCountryController;
use App\Http\Controllers\AdminStateController;
use App\Http\Controllers\AdminCityController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\SiteDataController;

//customer controllers
use App\Http\Controllers\CustomerDashboardController;
use App\Http\Controllers\CustomerPropertyController;

// clear all
Route::get('/all-clear', function () {
    Artisan::call('optimize:clear');
    return 'All cleared!';
});


// Call the Artisan command to generate the CSV
Route::get('/update-status', function () {
    Artisan::call('rental:update-status');
    return 'successfully statues chnage and command run';
});


//forntend routes
Route::get('/', [FrontEndController::class, 'index'])->name('frontend.index');
Route::get('/properties', [FrontEndController::class, 'properties'])->name('frontend.properties');
Route::get('/properties/filter', [FrontEndController::class, 'filterProperties'])->name('frontend.properties.filter');

Route::get('/property-detail/{id}/{title}', [FrontEndController::class, 'propertyDetail'])->name('frontend.property-detail');
Route::get('/property-make-fav/{id}', [FrontEndController::class, 'propertyMakeFav'])->name('frontend.property-make-favourite');

Route::get('/agencies', [FrontEndController::class, 'agencies'])->name('frontend.agencies');
Route::get('/agents', [FrontEndController::class, 'agents'])->name('frontend.agents');
Route::get('/agent-detail/{id}', [FrontEndController::class, 'agentDetail'])->name('frontend.agent');
Route::post('/property-customer-message', [FrontEndController::class, 'propertyCustomerMessage'])->name('frontend.property.customer.message');
Route::post('/property-customer-review', [FrontEndController::class, 'propertyCustomerReview'])->name('frontend.property.customer.review');

//rent and purchased property routes
Route::post('/property-rent', [FrontEndController::class, 'propertyRent'])->name('frontend.property.rent');
Route::get('/property-purchased/{id}', [FrontEndController::class, 'propertyPurchased'])->name('frontend.property.purchased');

Route::get('/property_stripe_success', [FrontEndController::class, 'stripe_success']);
Route::get('/purchased_property_stripe_success', [FrontEndController::class, 'purchased_property_stripe_success']);
Route::get('/property_stripe_cancel', [FrontEndController::class, 'stripe_cancel']);


Route::get('/contact-us', [FrontEndController::class, 'contactUs'])->name('frontend.contact-us');
Route::get('/about-us', [FrontEndController::class, 'aboutUs'])->name('frontend.about-us');



Route::get('/login', [AuthController::class, 'loginForm'])->name('frontend.login_form');
Route::get('/signup', [AuthController::class, 'signupForm'])->name('frontend.signup_form');
Route::post('/user-store', [AuthController::class, 'userStore'])->name('frontend.user_store');
Route::get('logout', [AuthController::class, 'destroy'])->name('logout');
Route::get('/', [FrontEndController::class, 'index'])->name('frontend.index');
Route::get('get-cities/{state_id}', [FrontEndController::class, 'getCities'])->name('get-cities');

// admin login and logout routes
Route::get('/post-login', [AuthController::class, 'postLogin'])->name('post.login');
Route::get('/admin/login', [AuthController::class, 'getLoginPage'])->name('admin.get_login');
Route::get('admin/logout', [AuthController::class, 'adminLogout'])->name('admin.logout');

// agent login and logout
Route::get('agent/login', [AuthController::class, 'agentLogin'])->name('agent.login');
Route::get('agent/logout', [AuthController::class, 'agentLogout'])->name('agent.logout');

//forgot password section
Route::get('forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('forgot-password');
Route::post('forgot-password', [AuthController::class, 'sendResetPasswordEmail']);
Route::get('reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('reset-password');
Route::post('reset-password', [AuthController::class, 'resetPassword']);




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

        //customer properties routes
        Route::get('/customer-favourite-properties', [AgentPropertyController::class, 'customerFavouriteProperties'])->name('agent.customer.favourite.properties');
        Route::get('/customer-purchased-properties', [AgentPropertyController::class, 'customerPurchasedProperties'])->name('agent.customer.purchased.properties');
        Route::get('/customer-rental-properties', [AgentPropertyController::class, 'customerRentalProperties'])->name('agent.customer.rent.properties');

    });

    // customer dashboard routes
    Route::group(array('prefix' => 'customer'), function () {
        Route::get('/dashboard', [CustomerDashboardController::class, 'index'])->name('customer.index');
        Route::get('/profile', [CustomerDashboardController::class, 'profile'])->name('customer.profile');
        Route::post('/profile-update', [CustomerDashboardController::class, 'profileUpdate'])->name('customer.profile_update');
        Route::post('/password-update', [CustomerDashboardController::class, 'passwordUpdate'])->name('customer.password_update');
        Route::get('/activities', [CustomerDashboardController::class, 'activities'])->name('customer.activities');

        //properties routes
        Route::get('/fav-properties', [CustomerPropertyController::class, 'favProperties'])->name('customer.fav-properties');
        Route::get('/purchased-properties', [CustomerPropertyController::class, 'purchasedProperties'])->name('customer.purchased.properties');
        Route::get('/rent-properties', [CustomerPropertyController::class, 'rentalProperties'])->name('customer.rent.properties');
        Route::get('/property-detail/{id}', [CustomerPropertyController::class, 'propertyDetail'])->name('customer.detail_property');
        Route::post('/property-delete', [CustomerPropertyController::class, 'propertyDelete'])->name('customer.delete_property');
    });


    // admin dashboard routes
    Route::group(array('prefix' => 'admin'), function () {

        Route::get('/site-data/edit', [SiteDataController::class, 'edit'])->name('admin.siteData.edit');
        Route::post('/site-data/update', [SiteDataController::class, 'updateSiteData'])->name('admin.siteData.update');

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.index');
        Route::get('/profile', [AdminDashboardController::class, 'profile'])->name('admin.profile');
        Route::post('/profile-update', [AdminDashboardController::class, 'profileUpdate'])->name('admin.profile_update');
        Route::post('/password-update', [AdminDashboardController::class, 'passwordUpdate'])->name('admin.password_update');

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
            Route::get('/property-detail/{id}', [AdminPropertyController::class, 'propertyDetail'])->name('admin.properties.detail_property');
            Route::get('/customer-rental', [AdminPropertyController::class, 'customerRentalProperties'])->name('admin.customer.rent.properties');
            Route::get('/customer-purchased', [AdminPropertyController::class, 'customerPurchasedProperties'])->name('admin.customer.purchased.properties');
            Route::get('/customer-favourite', [AdminPropertyController::class, 'customerFavrouriteProperties'])->name('admin.customer.favourite.properties');
            Route::get('/set-review', [AdminPropertyController::class, 'setReview'])->name('admin.properties.review.set');
        });
        Route::group(['prefix' => 'users'], function () {
            Route::get('/agents', [AdminUserController::class, 'agents'])->name('admin.agents');
            Route::get('/agencies', [AdminUserController::class, 'agencies'])->name('admin.agencies');
            Route::get('/customers', [AdminUserController::class, 'customers'])->name('admin.customers');
            Route::get('/agent-detail/{id}', [AdminUserController::class, 'agentDetail'])->name('admin.agent_detail');
            Route::get('/customer-detail/{id}', [AdminUserController::class, 'customerDetail'])->name('admin.customer_detail');

        });


    });

});
