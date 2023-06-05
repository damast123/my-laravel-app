<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\KendaraanController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\StockKendaraanController;
use App\Http\Controllers\Api\PenjualanController;

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

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::group(['middleware' => 'jwt.auth'], function () {
    Route::get('/kendaraan', [KendaraanController::class, 'index']);
    Route::get('/kendaraan/show/{id}', [KendaraanController::class, 'show']);
    Route::post('/kendaraan', [KendaraanController::class, 'store']);
    Route::put('/kendaraan/{id}', [KendaraanController::class, 'update']);
    Route::delete('/kendaraan/{id}', [KendaraanController::class, 'destroy']);

    Route::get('/stokkendaraan', [StockKendaraanController::class, 'index']);
    Route::get('/stokkendaraan/show/{id}', [StockKendaraanController::class, 'show']);
    Route::post('/stokkendaraan', [StockKendaraanController::class, 'store']);
    Route::put('/stokkendaraan/update/{id}', [StockKendaraanController::class, 'update']);

    Route::get('/penjualan', [PenjualanController::class, 'index']);
    Route::get('/penjualan/detail', [PenjualanController::class, 'detail']);
    Route::get('/penjualan/show/{id}', [PenjualanController::class, 'show']);
    Route::post('/penjualan', [PenjualanController::class, 'store']);
});
