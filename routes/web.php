<?php

use Illuminate\Support\Facades\Route;
use App\helper\itemFormHelper;
//use App\Http\Controllers\Auth;

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function() {

    Route::group(['prefix' => 'item'], function() {

        
        Route::get('/create', function () {return (new ItemFormHelper)->getParamsToView('/iten/store/', 'itemform',-1);;});


        Route::post('/update/{id}', [App\Http\Controllers\itemController::class, 'update']);
        Route::post('/edit/{id}', [App\Http\Controllers\itemController::class, 'edit']);
        Route::post('/delete/{id}', [App\Http\Controllers\itemController::class, 'delete']);
        Route::post('/destroy/{id}', [App\Http\Controllers\itemController::class, 'destroy']);
        Route::get('/list', [App\Http\Controllers\itemController::class, 'show']);
        Route::post('/store', [App\Http\Controllers\itemController::class, 'store']);
    });


    Route::get('/home', [App\Http\Controllers\itemController::class, 'index'])->name('home');
});
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
