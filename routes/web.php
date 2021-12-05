<?php

use App\Http\Controllers\CountryController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
});

require __DIR__.'/auth.php';
