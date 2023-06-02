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
    return redirect('login');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('category', 'DatatablesController@index');
    Route::get('get-category-data', 'DatatablesController@categoryData')->name('datatables.category');

    Route::prefix('sensors')->group(function () {
        /*Route::get('/list', 'SensorController@index');
        Route::get('/{id}', 'SensorController@show');
        Route::post('/', 'SensorController@store');
        Route::put('/{id}', 'SensorController@update');
        Route::delete('/{id}', 'SensorController@destroy');*/

        Route::prefix('data')->group(function () {
            Route::get('/', 'SensorReportsDatatableController@index');
            Route::get('/all', 'SensorReportsDatatableController@all')->name('sensorsdata.reports.all');
        });
    });
});
