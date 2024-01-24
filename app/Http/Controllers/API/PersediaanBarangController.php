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

        $data = DB::select('SELECT
        p.nama_produk,
        COALESCE(sr.stok,0) AS stok_awal,
       COALESCE(bm.jumlah_masuk,0) AS stok_masuk,
        COALESCE(bk.jumlah_keluar,0) AS stok_keluar,
        COALESCE((sr.stok + COALESCE(bm.jumlah_masuk,0) - COALESCE(bk.jumlah_keluar,0) ),0) AS stok_akhir
      FROM produk p
      LEFT JOIN barang_masuk bm ON p.id = bm.produk_id
      LEFT JOIN barang_keluar bk ON p.id = bk.produk_id
      LEFT JOIN produk_record sr ON p.id = sr.produk_id
      GROUP BY p.id;');






if ($data) {
    return ApiFormatter::createApi(200, 'Success', $data);
} else {
    return ApiFormatter::createApi(400, 'Failled');
}
    }


    public function query($date)
    {

        $tanggal = Carbon::today();

        $query = "SELECT
        p.id,
        p.nama_produk,
        COALESCE(sr.stok, 0) AS stok_awal,
        COALESCE(bm.jumlah_masuk, 0) AS stok_masuk,
        COALESCE(bk.stok_keluar, 0) AS stok_keluar,
        COALESCE((sr.stok + COALESCE(bm.jumlah_masuk, 0) - COALESCE(bk.stok_keluar, 0)), 0) AS stok_akhir
    FROM produk p
    LEFT JOIN produk_record sr ON p.id = sr.produk_id AND sr.tanggal = ?
    LEFT JOIN barang_masuk bm ON p.id = bm.produk_id AND bm.tanggal_masuk = ?
    LEFT JOIN transaksi bk ON p.id = bk.produk_id AND bk.tanggal_transaksi = ?
    GROUP BY p.id, p.nama_produk, sr.stok, bm.jumlah_masuk, bk.stok_keluar
";


        $stockData = DB::select($query, [$date, $date, $date]);

        if ($stockData ) {
            return ApiFormatter::createApi(200, 'Success', $stockData );
        } else {
            return ApiFormatter::createApi(400, 'Failled');
        }
    }
}
