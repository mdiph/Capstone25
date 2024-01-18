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
        $data = DB::select("SELECT
        tanggal_transaksi,
        salesman.nama_salesman,
        SUM(harga_akhir) AS total_harga
      FROM
        transaksi
        JOIN
        salesman
        ON
        transaksi.salesman_id = salesman.id
      GROUP BY
        tanggal_transaksi,
        salesman_id;");



        return view('omzet.salesman')->with('data', $data);
    }

    public function produk()
    {
        // $data = DB::select("SELECT transaksi.id, transaksi.tanggal_transaksi, transaksi.stok_keluar, produk.nama_produk, transaksi.harga_jual, produk.harga, (transaksi.harga_jual - produk.harga) AS keuntungan, FORMAT(((transaksi.harga_jual - produk.harga) / produk.harga) * 100, '0.00%') AS persentase FROM transaksi INNER JOIN produk ON transaksi.produk_id = produk.id ");

        $data = DB::select('SELECT
        transaksi.tanggal_transaksi,
        produk.nama_produk,
        transaksi.stok_keluar,
        transaksi.harga_jual,
        transaksi.diskon,
        produk.satuan,
        transaksi.harga_akhir
      FROM
        transaksi
      JOIN
        produk
      ON
        transaksi.produk_id = produk.id;');
        return view('omzet.produk')->with('data', $data);
    }

    public function customer()
    {
        $data  =  DB::select('SELECT
        transaksi.tanggal_transaksi,
        customer.nama_customer,
        produk.nama_produk,
        transaksi.stok_keluar,
        transaksi.harga_jual,
        produk.satuan,
        transaksi.stok_keluar * transaksi.harga_jual as total_harga
      FROM
        transaksi
      JOIN
        produk
        ON
        transaksi.produk_id = produk.id
        JOIN
        customer
        ON
        transaksi.customer_id = customer.id;');

        return view('omzet.customer')->with('data', $data);
    }
}
