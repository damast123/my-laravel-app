<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\StockKendaraanController;

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
    return view('welcome');
});

Route::resource('kendaraan', KendaraanController::class);
Route::resource('stokkendaraan', StockKendaraanController::class);
Route::resource('penjualan', PenjualanController::class);
