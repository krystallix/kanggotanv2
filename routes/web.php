<?php

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
})->name('home');

Route::group(['namespace' => '\App\Http\Controllers'], function () {
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/', 'DashboardController@index')->name('dashboard');
        Route::group(['prefix' => 'haul-massal'], function () {
            Route::get('/store', 'DashboardController@HaulMassalStore')->name('haul-massal.input');
            Route::get('/show', 'DashboardController@HaulMassalShow')->name('haul-massal.show');
        });
    });
    Route::post('/ajax', 'DashboardController@ajaxRequest');
});