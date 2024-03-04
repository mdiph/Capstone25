<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Charts\TransaksiChart;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(TransaksiChart $chart)
    {
        $date = Carbon::today();

        // Query 1
        $query1 = 'SELECT COALESCE(SUM(jumlah_masuk), 0) AS total_masuk FROM barang_masuk WHERE tanggal_masuk = ?;';
        $data1  =  DB::select($query1, [$date]);
        

        // Query 2
        $query2 = 'SELECT COALESCE(COUNT(*), 0) AS total_transaksi FROM transaksi WHERE tanggal_transaksi = ?;';
        $data2  =  DB::select($query2, [$date]);

        // Query 3
        $query3 = 'SELECT COALESCE(SUM(total), 0) AS omzet FROM transaksi WHERE tanggal_transaksi = ?;';
        $data3  =  DB::select($query3, [$date]);

        // Query 4
        $query4 = 'SELECT COALESCE(SUM(transaksi.total - pembayaran.bayar), 0) AS total_hutang
                   FROM transaksi
                   JOIN pembayaran ON transaksi.id = pembayaran.transaksi_id;';
        $data4 = DB::select($query4);

        return view('welcome')
            ->with('chart', $chart->build())
            ->with('date', $date)
            ->with('data1', $data1)
            ->with('data2', $data2)
            ->with('data3', $data3)
            ->with('data4', $data4);
    }
}
