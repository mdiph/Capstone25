<?php

use App\Models\Piutang;
use App\Models\Transaksi;
use App\Models\Barangkeluar;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OmzetController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PiutangController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SalesmanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\Transaksi2Controller;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangkeluarController;
use App\Http\Controllers\API\PersediaanBarangController;
use App\Http\Controllers\ForgotPasswordController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\PersediaanBarangController as ControllersPersediaanBarangController;
use App\Models\produk;

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

Route::middleware(["guest"])->group(function () {

    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate']);

    // Route::post('/register', [LoginController::class, 'register']);
    Route::post('/forgot/password/email', [ForgotPasswordController::class, 'email']);
    Route::post('/forgot/password/code', [ForgotPasswordController::class, 'code']);
    Route::post('/forgot/password/', [ForgotPasswordController::class, 'password']);
});










// Route::get('/barangkeluar/add', [BarangkeluarController::class, 'create']);
// Route::post('/barangkeluar/store', [BarangkeluarController::class, 'store']);



Route::get('/hai', [TransaksiController::class, 'index'])->name('transaksi');
// Route::post('/transaksi', [TransaksiController::class, 'dateRange'])->name('caritransaksi');






Route::middleware(["auth"])->group(function () {

    // Route::get('/', function () {
    //     return view('welcome');
    // });
    Route::get('/barangkeluar', [BarangkeluarController::class, 'index']);
    Route::get('/barangmasuk', [BarangMasukController::class, 'index']);
    Route::get('/barangmasuk/edit/{id}', [BarangMasukController::class, 'edit']);
    Route::post('/barangmasuk/edit/{id}', [BarangMasukController::class, 'update']);
    Route::get('/barangmasuk/add', [BarangMasukController::class, 'create']);
    Route::post('/barangmasuk/store', [BarangMasukController::class, 'store']);
    Route::post('/barangmasuk', [BarangMasukController::class, 'dateRange'])->name('caristockin');
    Route::post('/barangmasuk/delete/{id}', [BarangMasukController::class, 'delete']);
    Route::get('/stok', [ControllersPersediaanBarangController::class, 'index']);
    Route::get('/', [DashboardController::class, 'index']);
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

Route::middleware(['admin'])->group(function () {
    Route::get('/User', [UserController::class, 'index']);
    Route::post('/User/store', [UserController::class, 'store']);
    Route::post('/User/update/{id}', [UserController::class, 'update']);
    Route::post('/User/delete/{id}', [UserController::class, 'destroy']);

    Route::get('/produk', [ProdukController::class, 'index'])->name('produk')->middleware('admin');
    Route::post('/produk/store', [ProdukController::class, 'store']);
    Route::post('/produk/update/{id}', [ProdukController::class, 'update']);
    Route::post('/produk/delete/{id}', [ProdukController::class, 'destroy']);
    Route::get('/produk/trash', [ProdukController::class, 'trash']);
    Route::post('/produk/kembali/{id}', [ProdukController::class, 'kembalikan']);

    Route::get('/salesman', [SalesmanController::class, 'index']);
    Route::get('/salesman/trash', [SalesmanController::class, 'trash']);
    Route::post('/salesman/kembali/{id}', [SalesmanController::class, 'kembalikan']);
    Route::post('/salesman/store', [SalesmanController::class, 'store']);
    Route::post('/salesman/update/{id}', [SalesmanController::class, 'update']);
    Route::post('/salesman/delete/{id}', [SalesmanController::class, 'destroy']);

    Route::get('/customer', [CustomerController::class, 'index']);
    Route::get('/customer/trash', [CustomerController::class, 'trash']);
    Route::post('/customer/store', [CustomerController::class, 'store']);
    Route::post('/customer/update/{id}', [CustomerController::class, 'update']);
    Route::post('/customer/delete/{id}', [CustomerController::class, 'destroy']);
    Route::post('/customer/kembali/{id}', [CustomerController::class, 'kembalikan']);
    Route::get('/kategori', [KategoriController::class, 'index']);
    Route::get('/kategori/trash', [KategoriController::class, 'trash']);
    Route::post('/kategori/store', [KategoriController::class, 'store']);
    Route::post('/kategori/update/{id}', [KategoriController::class, 'update']);
    Route::post('/kategori/delete/{id}', [KategoriController::class, 'destroy']);
    Route::post('/kategori/kembali/{id}', [KategoriController::class, 'kembalikan']);

    Route::get('/transaksi/add', [TransaksiController::class, 'create']);
    Route::post('/transaksi/delete/{id}', [Transaksi2Controller::class, 'destroy']);
    Route::post('/transaksi/telat', [Transaksi2Controller::class, 'telat']);
    Route::post('/transaksi/store', [TransaksiController::class, 'store']);
    Route::post('/addcart', [Transaksi2Controller::class, 'addCart']);
    Route::get('/deletecart/{id}', [Transaksi2Controller::class, 'DeleteCart']);
    Route::get('/transaksi/detail/{id}', [Transaksi2Controller::class, 'show']);
    Route::get('/transaksi/detail/piutang/{id}', [Transaksi2Controller::class, 'piutang']);
    Route::post('bayar/angsuran/{id}', [Transaksi2Controller::class, 'bayarUtang']);

    Route::get('/omzet/salesman', [OmzetController::class, 'salesman']);
    Route::get('/omzet/produk', [OmzetController::class, 'produk']);
    Route::get('/omzet/customer', [OmzetController::class, 'customer']);
    Route::post('/omzet/customer', [OmzetController::class, 'dateRangecs'])->name('cariomzetcs');
    Route::post('/omzet/salesman', [OmzetController::class, 'dateRangesl'])->name('cariomzetsl');
    Route::post('/omzet/produk', [OmzetController::class, 'dateRangepr'])->name('cariomzetpr');
    Route::get('/transaksi', [Transaksi2Controller::class, 'index']);
    Route::get('/tes', [Transaksi2Controller::class, 'create']);
    Route::get('/tes/cart', [Transaksi2Controller::class, 'getCart']);
    Route::post('/tes/add', [Transaksi2Controller::class, 'store']);
    Route::get('hutang', [PiutangController::class, 'Index']);
    Route::get('hutang/{id}', [PiutangController::class, 'show']);

    Route::get('/a', function () {
        return view('tes');
    });
});
