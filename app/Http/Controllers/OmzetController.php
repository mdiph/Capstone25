<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\transaksi2;
use Illuminate\Http\Request;
use App\Charts\OmzetCustomerChart;
use App\Charts\OmzetSalesmanChart;
use Illuminate\Support\Facades\DB;

class OmzetController extends Controller
{
    //

    public function salesman(OmzetSalesmanChart $chart)
    {
        $data = DB::select("SELECT

        salesman.nama_salesman,
        SUM(transaksi.total) AS total_harga
      FROM
        transaksi
        JOIN
        salesman
        ON
        transaksi.salesman_id = salesman.id
      GROUP BY

        salesman.nama_salesman;");



        return view('omzet.salesman')->with('data', $data)->with('chart', $chart->build());
    }

    public function produk()
    {

        $data = DB::select("SELECT
        produk.nama_produk,
        SUM(transaksi_detail.stok_keluar) AS total_stok_keluar,
        produk.harga,
       produk.satuan,
        SUM(transaksi.total) AS total_transaksi
    FROM
        transaksi
    JOIN
        transaksi_detail ON transaksi.id = transaksi_detail.transaksi_id
    JOIN
        produk ON transaksi_detail.produk_id = produk.id
    GROUP BY
        produk.nama_produk, produk.harga, produk.satuan;");

        return view('omzet.produk')->with('data', $data);
    }

    public function customer(OmzetCustomerChart $chart)
    {
        $data  =  DB::select('SELECT customer.nama_customer, customer.alamat, SUM(transaksi.total) AS total_harga
        FROM customer
        JOIN transaksi ON customer.id = transaksi.customer_id
        GROUP BY  customer.nama_customer, customer.alamat;');

        return view('omzet.customer')->with('data', $data)->with('chart', $chart->build());
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
