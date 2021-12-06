<?php

use App\Http\Controllers\CountryController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProviderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => ['auth']],function(){
    Route::inertia('/','Dashboard')->name('dashboard');

    Route::resource('/countries',CountryController::class)->except('show');

    Route::resource('/categories',ProductCategoryController::class)->except('show');
    Route::post('/categories/{category}/update-order',[ProductCategoryController::class,'updateOrder'])->name('categories.update-order');

    Route::resource('/providers',ProviderController::class)->except('show');
});

require __DIR__.'/auth.php';
