<?php

use Illuminate\Support\Facades\Route;
use App\helper\ItemViewHelper;
use App\Http\Controllers\itemController;

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
    Route::resource('item',itemController::class);
    Route::group(['prefix' => 'item'], function() {
        Route::post('/markAsRead', [App\Http\Controllers\itemController::class, 'markNotification']);
        Route::post('/update/{id}', [App\Http\Controllers\itemController::class, 'update']);
        Route::post('/edit/{id}', [App\Http\Controllers\itemController::class, 'edit']);
        Route::post('/delete', [App\Http\Controllers\itemController::class, 'delete']);
        Route::post('/store', [App\Http\Controllers\itemController::class, 'store']);
    });
    Route::get('/home', [App\Http\Controllers\itemController::class, 'index'])->name('home');
});

