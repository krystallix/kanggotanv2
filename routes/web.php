<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
            Route::get('/bulk-store', 'DashboardController@haulMassalBulk')->name('haul-massal.bulk-store');
            Route::get('/log', 'DashboardController@HaulMassalLog')->name('haul-massal.log');
        });
        Route::group(['prefix' => 'users'], function () {
            Route::get('/create-user', 'DashboardController@CreateUser')->name('create-user');
            Route::get('/list-user', 'DashboardController@ShowUser')->name('list-user');
        });
        Route::get('/secretary-area', 'DashboardController@SecretaryArea')->name('secretary-area');
        Route::get('/secretary-area/2', 'DashboardController@SecretaryArea2')->name('secretary-area-2');
        Route::get('/bendahara-area', 'DashboardController@BendaharaArea')->name('bendahara-area');
        Route::get('/superadmin-area', 'DashboardController@SuperadminArea')->name('superadmin-area');
    });
    Route::get('/print-page', 'DashboardController@PrintPage');
    Route::post('/ajax', 'DashboardController@ajaxRequest');
    Route::post('/ajax/bulk', 'DashboardController@bulkRequest');
    Route::post('/ajax/add', 'DashboardController@ajaxRequestAdd');
    Route::get('/haul-massal/2022/', 'Controller@haul2022')->name('haul-massal.2022');
    Route::get('/haul-massal/2023/', 'Controller@haul2023')->name('haul-massal.2023');
});