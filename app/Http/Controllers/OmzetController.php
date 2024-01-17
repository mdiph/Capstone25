<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OmzetController extends Controller
{
    //

    public function salesman()
    {
        $data = DB::select("SELECT transaksi.id, transaksi.tanggal_transaksi, salesman.nama_salesman, produk.nama_produk, transaksi.harga_jual, produk.harga, (transaksi.harga_jual - produk.harga) AS keuntungan, FORMAT(((transaksi.harga_jual - produk.harga) / produk.harga) * 100, '0.00%') AS persentase FROM transaksi INNER JOIN produk ON transaksi.produk_id = produk.id JOIN salesman ON transaksi.salesman_id = salesman.id");



        return view('omzet.salesman')->with('data', $data);
    }

    public function produk(){
        $data = DB::select("SELECT transaksi.id, transaksi.tanggal_transaksi, transaksi.stok_keluar, produk.nama_produk, transaksi.harga_jual, produk.harga, (transaksi.harga_jual - produk.harga) AS keuntungan, FORMAT(((transaksi.harga_jual - produk.harga) / produk.harga) * 100, '0.00%') AS persentase FROM transaksi INNER JOIN produk ON transaksi.produk_id = produk.id ");

        return view('omzet.produk')->with('data', $data);
    }
}
