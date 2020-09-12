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

Route::get('/developers/{id}', 'App\Http\Controllers\DeveloperController@get')->name('developer.get');
Route::delete('/developers/{id}', 'App\Http\Controllers\DeveloperController@remove')->name('developer.remove');
Route::put('/developers/{id}', 'App\Http\Controllers\DeveloperController@update')->name('developer.update');
Route::get('/developers', 'App\Http\Controllers\DeveloperController@search')->name('developer.search');
Route::post('/developers', 'App\Http\Controllers\DeveloperController@create')->name('developer.create');