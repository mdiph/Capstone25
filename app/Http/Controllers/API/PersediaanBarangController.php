<?php

namespace App\Http\Controllers\API;

use Exception;

use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Helpers\ApiFormatter;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class PersediaanBarangController extends Controller
{


    public function index()
    {

    //     $data = DB::select('SELECT
    //     p.nama_produk,
    //     COALESCE(sr.stok,0) AS stok_awal,
    //    COALESCE(bm.jumlah_masuk,0) AS stok_masuk,
    //     COALESCE(bk.jumlah_keluar,0) AS stok_keluar,
    //     COALESCE((sr.stok + COALESCE(bm.jumlah_masuk,0) - COALESCE(bk.jumlah_keluar,0) ),0) AS stok_akhir
    //   FROM produk p
    //   LEFT JOIN barang_masuk bm ON p.id = bm.produk_id
    //   LEFT JOIN barang_keluar bk ON p.id = bk.produk_id
    //   LEFT JOIN produk_record sr ON p.id = sr.produk_id
    //   GROUP BY p.id;');

    $date = Carbon::today();

    $query = "SELECT
        p.kode,
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





if ($data) {
    return ApiFormatter::createApi(200, 'Success', $data);
} else {
    return ApiFormatter::createApi(400, 'Failled');
}
    }


    public function query($date)
    {

        // $date = Carbon::today();

        $query = "SELECT
        p.kode,
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


        $stockData = DB::select($query, [$date, $date, $date]);

        if ($stockData ) {
            return ApiFormatter::createApi(200, 'Success', $stockData );
        } else {
            return ApiFormatter::createApi(400, 'Failled');
        }
    }
}
