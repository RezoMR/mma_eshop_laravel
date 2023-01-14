<?php

use App\Http\Controllers\calendarController;
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

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => 'auth'], function () {

    Route::controller(\App\Http\Controllers\BojovniciController::class)->group(function(){
    Route::get('/bojovnici', 'index')->name('bojovnici');
        Route::get('/addBoj', 'addBojView')->name('addBojView');
        Route::post('addBoj','addBoj')->name('addBoj');
        Route::get('/bojobnikDelete/{id}','delete')->name('delete.bojovnik');
        Route::get('addPrehra/{id}','incPrehra')->name('addPrehra');
        Route::get('addVyhra/{id}','incVyhra')->name('addVyhra');

    });

    Route::controller(\App\Http\Controllers\shopController::class)->group(function(){
        Route::get('/shop', 'index')->name('shopView');
        Route::get('/addProd', 'addProdView')->name('addProdView');
        Route::post('addProd','addProd')->name('addProd');
        Route::get('/ProductShow', 'showAll')->name('productShow');
        Route::get('/productDelete/{id}','delete')->name('deleteProduct');
        Route::get('/productEdit/{id}','edit')->name('editProduct');
        Route::post('productEdit/{id}','update')->name('updateProduct');

    });

    Route::controller(\App\Http\Controllers\CartController::class)->group(function(){
        Route::get('/cart', 'index')->name('cartView');
        //Route::post('addToCart','addToCart')->name('addToCart');

    });
    Route::post('addToCart', [\App\Http\Controllers\CartController::class, 'addToCart'])->name('addToCart');

    Route::get('/contact', '\App\Http\Controllers\ContactController@index')->name('contactForm');
    Route::post('contact', '\App\Http\Controllers\ContactController@store')->name('sendContact');
    Route::get('/contactShow', '\App\Http\Controllers\ContactController@showAll')->name('contactShow');
    Route::get('/contactDelete/{id}','\App\Http\Controllers\ContactController@delete')->name('deleteContact');


    //-------------------PROFILE------
    Route::controller(\App\Http\Controllers\profileController::class)->group(function(){
    Route::get('/editProfile', 'edit')->name('editProfile');
    Route::post('editProfile','update')->name('updateProfile');
    Route::get('/deleteProfile','deleteProf')->name('deleteProfilenav');
    Route::post('deleteProfile', 'del')->name('remove');
    });

    //-------------------GAME------
    Route::controller(\App\Http\Controllers\GameController::class)->group(function(){
    Route::get('game', 'index')->name('game');
////        Route::post('gameAjax', 'gameAjaxx')->name('gameAjax');
    });
    Route::post('/gameAjaxx', [\App\Http\Controllers\GameController::class, 'gameAjaxx'])->name('gameAjaxx');

    //-------------------CALENDAR------
    Route::controller(\App\Http\Controllers\FullCalenderController::class)->group(function(){
        Route::get('fullcalender', 'index')->name('calender');
        Route::post('fullcalenderAjax', 'ajax');
    });

});

