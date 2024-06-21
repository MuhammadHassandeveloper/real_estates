<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\ApiController;


Route::get('states', [ApiController::class, 'states']);
Route::get('cities', [ApiController::class, 'cities']);
Route::post('state-cities', [ApiController::class, 'StateCites']);

//User Auth Controller
Route::post('register', [ApiAuthController::class, 'register']);
Route::post('login', [ApiAuthController::class, 'login']);
Route::post('logout', [ApiAuthController::class, 'logout'])->middleware('auth:sanctum');





//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
