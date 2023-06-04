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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/kendaraan', 'KendaraanController@index');
Route::get('/kendaraan/{id}', 'KendaraanController@show');
Route::post('/kendaraan', 'KendaraanController@store');
Route::put('/kendaraan/{id}', 'KendaraanController@update');
Route::delete('/kendaraan/{id}', 'KendaraanController@destroy');

Route::get('/stokkendaraan', 'StockKendaraanController@index');
Route::get('/stokkendaraan/id', 'StockKendaraanController@show');
Route::post('/stokkendaraan', 'StockKendaraanController@store');
Route::put('/stokkendaraan/{id}', 'StockKendaraanController@update');

Route::get('/penjualan', 'PenjualanController@index');
Route::get('/penjualan/{id}', 'PenjualanController@show');
Route::post('/penjualan', 'PenjualanController@store');
