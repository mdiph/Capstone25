<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\transaksi2;
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
        SUM(total) AS total_harga
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

        $data = DB::select("SELECT
        transaksi.tanggal_transaksi,
        produk.nama_produk,
        transaksi_detail.stok_keluar ,
        produk.harga,
        transaksi.diskon,
        produk.satuan,
        transaksi.total
      FROM
        transaksi
       JOIN
       transaksi_detail
       ON
        transaksi.id= transaksi_detail.transaksi_id
        JOIN
        produk
      ON
        transaksi_detail.produk_id = produk.id");

        return view('omzet.produk')->with('data', $data);
    }

    public function customer()
    {
        $data  =  DB::select('SELECT  transaksi.tanggal_transaksi, customer.nama_customer, SUM(transaksi.total) AS total_harga
        FROM customer
        JOIN transaksi ON customer.id = transaksi.customer_id
        GROUP BY  customer.nama_customer, transaksi.tanggal_transaksi;');

        return view('omzet.customer')->with('data', $data);
    }

    public function dateRangecs(Request $request){

        $fromDate = $request->input('fromdate');
        $toDate = $request->input('todate');

        $query = "SELECT  transaksi.tanggal_transaksi, customer.nama_customer, SUM(transaksi.total) AS total_transaksi
        FROM customer
        JOIN transaksi ON customer.id = transaksi.customer_id
        GROUP BY  customer.nama_customer, transaksi.tanggal_transaksi;
        WHERE transaksi.tanggal_transaksi BETWEEN ? AND ?";

        $data  =  DB::select($query, [$fromDate, $toDate]);
        // ->whereBetween('tanggal_transaksi', [$fromDate, $toDate])->get()

        // dd($data);

        return view('omzet.customer')->with('data', $data);

    }
}
