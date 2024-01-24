<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function(){

    Route::post('logout', [\App\Http\Controllers\API\UserController::class, 'logout']);
    Route::get('barangmasuk', [\App\Http\Controllers\API\BarangMasukController::class, 'index']);
    Route::get('user', [\App\Http\Controllers\API\UserController::class, 'user']);
    Route::get('omzet/salesman', [\App\Http\Controllers\API\OmzetController::class, 'salesman']);
    Route::get('omzet/produk', [\App\Http\Controllers\API\OmzetController::class, 'produk']);
    Route::get('transaksi', [\App\Http\Controllers\API\BarangKeluarController::class, 'transaksi']);

Route::get('omzet/customer', [\App\Http\Controllers\API\OmzetController::class, 'customer']);

});

Route::post('login', [\App\Http\Controllers\API\UserController::class, 'login']);

Route::get('tes', [\App\Http\Controllers\API\PersediaanBarangController::class, 'index']);
Route::get('tes/{date}', [\App\Http\Controllers\API\PersediaanBarangController::class, 'query']);





