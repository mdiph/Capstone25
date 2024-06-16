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
        COALESCE(sr.stok_awal, p.stok) AS stok_awal,
        COALESCE(bm.stok_masuk, 0) AS stok_masuk,
        COALESCE(bk.stok_keluar, 0) AS stok_keluar,
        COALESCE(sr.stok_awal, 0) + COALESCE(bm.stok_masuk, 0) - COALESCE(bk.stok_keluar, 0) AS stok_akhir
    FROM produk p
    LEFT JOIN (
        SELECT pr.produk_id, COALESCE(pr.stok, 0) AS stok_awal
        FROM produk_record pr
        WHERE pr.tanggal = ?
    ) sr ON p.id = sr.produk_id
    LEFT JOIN (
        SELECT bm.produk_id, COALESCE(SUM(bm.jumlah_masuk), 0) AS stok_masuk
        FROM barang_masuk bm
        WHERE bm.tanggal_masuk = ?
        GROUP BY bm.produk_id
    ) bm ON p.id = bm.produk_id
    LEFT JOIN (
        SELECT bk.produk_id, COALESCE(SUM(bk.jumlah_keluar), 0) AS stok_keluar
        FROM barang_keluar bk
        WHERE bk.tanggal_keluar = ?
        GROUP BY bk.produk_id
    ) bk ON p.id = bk.produk_id
    GROUP BY p.nama_produk, p.satuan;";


        $data = DB::select($query, [$date, $date, $date]);


        return view('persediaan')->with('data', $data);
    }

    public function changedate(Request $request)
    {



        $date = $request->input('date');

        $query = "SELECT
        p.nama_produk,
        p.satuan,
        COALESCE(sr.stok_awal, p.stok) AS stok_awal,
        COALESCE(bm.stok_masuk, 0) AS stok_masuk,
        COALESCE(bk.stok_keluar, 0) AS stok_keluar,
        COALESCE(sr.stok_awal, 0) + COALESCE(bm.stok_masuk, 0) - COALESCE(bk.stok_keluar, 0) AS stok_akhir
    FROM produk p
    LEFT JOIN (
        SELECT pr.produk_id, COALESCE(pr.stok, 0) AS stok_awal
        FROM produk_record pr
        WHERE pr.tanggal = ?
    ) sr ON p.id = sr.produk_id
    LEFT JOIN (
        SELECT bm.produk_id, COALESCE(SUM(bm.jumlah_masuk), 0) AS stok_masuk
        FROM barang_masuk bm
        WHERE bm.tanggal_masuk = ?
        GROUP BY bm.produk_id
    ) bm ON p.id = bm.produk_id
    LEFT JOIN (
        SELECT bk.produk_id, COALESCE(SUM(bk.jumlah_keluar), 0) AS stok_keluar
        FROM barang_keluar bk
        WHERE bk.tanggal_keluar = ?
        GROUP BY bk.produk_id
    ) bk ON p.id = bk.produk_id
    GROUP BY p.nama_produk, p.satuan;";


        $data = DB::select($query, [$date, $date, $date]);


        return view('persediaan')->with('data', $data);
    }
}
