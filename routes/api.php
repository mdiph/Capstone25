<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CodeCheckController;
use App\Http\Controllers\API\ResetPasswordController;
use App\Http\Controllers\API\ForgotPasswordController;
use App\Http\Controllers\API\TransaksiController;

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

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/cart/add', [TransaksiController::class, 'addCart']);
    Route::post('/addTransaksi', [TransaksiController::class, 'store']);
    Route::post('/cart/delete/{id}', [TransaksiController::class, 'deleteCart']);
    Route::get('/cart', [TransaksiController::class, 'getCart']);
    Route::post('logout', [\App\Http\Controllers\API\UserController::class, 'logout']);
    Route::get('barangmasuk', [\App\Http\Controllers\API\BarangMasukController::class, 'index']);
    Route::get('user', [\App\Http\Controllers\API\UserController::class, 'user']);
    Route::get('omzet/salesman', [\App\Http\Controllers\API\OmzetController::class, 'salesman']);
    Route::get('omzet/salesman/{fromDate}/{toDate}', [\App\Http\Controllers\API\OmzetController::class, 'dateRangesalesman']);
    Route::get('omzet/customer/{fromDate}/{toDate}', [\App\Http\Controllers\API\OmzetController::class, 'dateRangecustomer']);
    Route::get('omzet/produk/{fromDate}/{toDate}', [\App\Http\Controllers\API\OmzetController::class, 'dateRangeproduk']);
    Route::get('omzet/salesman/cari/{fromDate}/{toDate}/{nama}', [\App\Http\Controllers\API\OmzetController::class, 'carisalesman']);
    Route::get('omzet/produk', [\App\Http\Controllers\API\OmzetController::class, 'produk']);
    Route::get('transaksi', [\App\Http\Controllers\API\BarangKeluarController::class, 'transaksi']);
    Route::get('transaksi/{startDate}/{endDate}', [\App\Http\Controllers\API\BarangKeluarController::class, 'dateRangetransaksi']);
    Route::get('stok', [\App\Http\Controllers\API\PersediaanBarangController::class, 'index']);
    Route::get('stok/{date}', [\App\Http\Controllers\API\PersediaanBarangController::class, 'query']);

    Route::get('omzet/customer', [\App\Http\Controllers\API\OmzetController::class, 'customer']);
    Route::get('hutang', [\App\Http\Controllers\API\PiutangController::class, 'Index']);
Route::get('hutang/{nama}', [\App\Http\Controllers\API\PiutangController::class, 'show']);
});

Route::post('login', [\App\Http\Controllers\API\UserController::class, 'login']);
Route::post('password/email',  ForgotPasswordController::class);
Route::post('password/code/check', CodeCheckController::class);
Route::post('password/reset', ResetPasswordController::class);
