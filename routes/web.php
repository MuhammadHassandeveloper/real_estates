<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontEndController;


// clear all
Route::get('/all-clear', function () {
    Artisan::call('optimize:clear');
    return 'All cleared!';
});


Route::get('/',[FrontEndController::class,'index'])->name('index.page');

