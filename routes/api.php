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


Route::resource('locations', 'LocationAPIController');

Route::resource('tanks', 'TankAPIController');
Route::post('transfer', 'LiquidController@store');
Route::get('sum', 'LiquidController@sumOfDailyContent');
Route::get('volume/change/{id}', 'LiquidController@volumeOffloading');

Route::resource('new_volumes', 'NewVolumeAPIController');