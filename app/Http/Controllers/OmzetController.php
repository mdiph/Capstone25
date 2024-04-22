<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\transaksi2;
use Illuminate\Http\Request;
use App\Charts\OmzetProdukChart;
use App\Charts\OmzetCustomerChart;
use App\Charts\OmzetSalesmanChart;
use Illuminate\Support\Facades\DB;
use ArielMejiaDev\LarapexCharts\LarapexChart;

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

    public function produk(OmzetProdukChart $chart)
    {

        $data = DB::select("SELECT
        produk.nama_produk,
        SUM(transaksi_detail.stok_keluar) AS total_stok_keluar,
        produk.harga,
        produk.satuan,
        SUM(transaksi_detail.total - ROUND(transaksi_detail.total * (CAST(transaksi.diskon AS DECIMAL(18,2)) / 100))) AS total_transaksi
    FROM
        transaksi
    JOIN
        transaksi_detail ON transaksi.id = transaksi_detail.transaksi_id
    JOIN
        produk ON transaksi_detail.produk_id = produk.id
    

    GROUP BY
        produk.nama_produk, produk.harga, produk.satuan;");

        return view('omzet.produk')->with('data', $data)->with('chart', $chart->build());
    }

    public function customer(OmzetCustomerChart $chart)
    {
        $data  =  DB::select('SELECT customer.nama_customer, customer.alamat, SUM(transaksi.total) AS total_harga
        FROM customer
        JOIN transaksi ON customer.id = transaksi.customer_id
        GROUP BY  customer.nama_customer, customer.alamat;');

        return view('omzet.customer')->with('data', $data)->with('chart', $chart->build());
    }

    public function dateRangecs(Request $request)
    {

        $fromDate = $request->input('fromdate');
        $toDate = $request->input('todate');

        $query = "SELECT   customer.nama_customer, customer.alamat, SUM(transaksi.total) AS total_harga
        FROM customer
        JOIN transaksi ON customer.id = transaksi.customer_id
        WHERE transaksi.tanggal_transaksi BETWEEN ? AND ?
        GROUP BY  customer.nama_customer, customer.alamat";

        $data  =  DB::select($query, [$fromDate, $toDate]);

        $ch = new OmzetCustomerChart(app(LarapexChart::class));
        $chart = $ch->buildByDateRange($fromDate, $toDate);
        // ->whereBetween('tanggal_transaksi', [$fromDate, $toDate])->get()

        // dd($data);

        return view('omzet.customer')->with('data', $data)->with('chart', $chart);
    }

    public function dateRangesl(Request $request)
    {

        $fromDate = $request->input('fromdate');
        $toDate = $request->input('todate');

        $query = "SELECT

        salesman.nama_salesman,
        SUM(transaksi.total) AS total_harga
      FROM
        transaksi
        JOIN
        salesman
        ON
        transaksi.salesman_id = salesman.id
        WHERE transaksi.tanggal_transaksi BETWEEN ? AND ?
      GROUP BY

        salesman.nama_salesman;";

        $data  =  DB::select($query, [$fromDate, $toDate]);

        $ch = new OmzetSalesmanChart(app(LarapexChart::class));
        $chart = $ch->buildByDateRange($fromDate, $toDate);
        // ->whereBetween('tanggal_transaksi', [$fromDate, $toDate])->get()

        // dd($data);

        return view('omzet.salesman')->with('data', $data)->with('chart', $chart);
    }

    public function dateRangepr(Request $request)
    {

        $fromDate = $request->input('fromdate');
        $toDate = $request->input('todate');

        $query = "SELECT
        produk.nama_produk,
        SUM(transaksi_detail.stok_keluar) AS total_stok_keluar,
        produk.harga,
        produk.satuan,
        SUM(transaksi_detail.total - ROUND(transaksi_detail.total * (CAST(transaksi.diskon AS DECIMAL(18,2)) / 100))) AS total_transaksi
    FROM
        transaksi
    JOIN
        transaksi_detail ON transaksi.id = transaksi_detail.transaksi_id
    JOIN
        produk ON transaksi_detail.produk_id = produk.id
    WHERE
        transaksi.tanggal_transaksi BETWEEN ? AND ?
    GROUP BY
        produk.nama_produk, produk.harga, produk.satuan;";

        $data  =  DB::select($query, [$fromDate, $toDate]);

        $ch = new OmzetProdukChart(app(LarapexChart::class));
        $chart = $ch->buildByDateRange($fromDate, $toDate);


        return view('omzet.produk')->with('data', $data)->with('chart', $chart);
    }
}
