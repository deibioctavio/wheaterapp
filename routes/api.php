<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('sensors')->group(function () {
    Route::post('code/hash', 'APISecurityController@generateReversibleHash');
    Route::post('code/unhash', 'APISecurityController@reverseHash');
    Route::post('data', 'SensorDataController@store');
});

Route::post('login', 'APIController@login');
Route::post('register', 'APIController@register');

Route::group(['middleware' => 'auth.jwt'], function () {
    Route::get('logout', 'APIController@logout');

    Route::get('tasks', 'TaskController@index');
    Route::get('tasks/{id}', 'TaskController@show');
    Route::post('tasks', 'TaskController@store');
    Route::put('tasks/{id}', 'TaskController@update');
    Route::delete('tasks/{id}', 'TaskController@destroy');

    Route::prefix('sensors')->group(function () {
        Route::get('/list', 'SensorController@index');
        Route::get('/{id}', 'SensorController@show');
        Route::post('/', 'SensorController@store');
        Route::put('/{id}', 'SensorController@update');
        Route::delete('/{id}', 'SensorController@destroy');

        Route::prefix('data')->group(function () {
            Route::get('/all', 'SensorDataController@index');
            Route::get('list/{ascendantSortOrder?}/{limit?}/{offset?}', 'SensorDataController@show');
            Route::get('/bysensor/{sensor_id}/{ascendantSortOrder?}/{limit?}/{offset?}', 'SensorDataController@showBySensorId');
            Route::delete('/{id}', 'SensorDataController@destroy');
        });
    });
});
