<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SalesmanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/register', [LoginController::class, 'register']);


Route::get('/salesman', [SalesmanController::class, 'index']);
Route::post('/salesman/store', [SalesmanController::class, 'store']);
Route::post('/salesman/update/{id}', [SalesmanController::class, 'update']);
Route::post('/salesman/delete/{id}', [SalesmanController::class, 'destroy']);


Route::get('/customer', [CustomerController::class, 'index']);
Route::post('/customer/store', [CustomerController::class, 'store']);
Route::post('/customer/update/{id}', [CustomerController::class, 'update']);
Route::post('/customer/delete/{id}', [CustomerController::class, 'destroy']);

Route::get('/kategori', [KategoriController::class, 'index']);
Route::post('/kategori/store', [KategoriController::class, 'store']);
Route::post('/kategori/update/{id}', [KategoriController::class, 'update']);
Route::post('/kategori/delete/{id}', [KategoriController::class, 'destroy']);

Route::get('/produk', [ProdukController::class, 'index'])->middleware('admin');
Route::post('/produk/store', [ProdukController::class, 'store']);
Route::post('/produk/update/{id}', [ProdukController::class, 'update']);
Route::post('/produk/delete/{id}', [ProdukController::class, 'destroy']);

Route::middleware(['auth'])->group(function () {
Route::get('/User', [UserController::class, 'index']);
Route::post('/User/store', [UserController::class, 'store']);
Route::post('/User/update/{id}', [UserController::class, 'update']);
Route::post('/User/delete/{id}', [UserController::class, 'destroy']);
Route::get('/', function () {
    return view('welcome');
});
});





