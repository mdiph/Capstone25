<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersediaanBarangController extends Controller
{
    public function index()
    {



        $date = Carbon::today();

        $query = "SELECT
        p.nama_produk,
        p.satuan,
        COALESCE(sr.stok, p.stok) AS stok_awal,
        COALESCE((bm.jumlah_masuk), 0) AS stok_masuk,
        COALESCE((bk.jumlah_keluar), 0) AS stok_keluar,
        COALESCE((sr.stok + COALESCE((bm.jumlah_masuk), 0) - COALESCE((bk.jumlah_keluar), 0)), 0) AS stok_akhir
    FROM produk p
    LEFT JOIN produk_record sr ON p.id = sr.produk_id AND sr.tanggal = ?
    LEFT JOIN barang_masuk bm ON p.id = bm.produk_id AND bm.tanggal_masuk = ?
    LEFT JOIN barang_keluar bk ON p.id = bk.produk_id AND bk.tanggal_keluar = ?
    GROUP BY p.nama_produk, p.satuan;";


        $data = DB::select($query, [$date, $date, $date]);


        return view('persediaan')->with('data', $data);
    }
}
