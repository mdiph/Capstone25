<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Helpers\ApiFormatter;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OmzetController extends Controller
{
    //

    public function salesman()
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





        if ($data) {
            return ApiFormatter::createApi(200, 'Success', $data);
        } else {
            return ApiFormatter::createApi(400, 'Failled');
        }
    }

    public function dateRangesalesman($fromDate, $toDate)
    {
        $query = "SELECT
        salesman.nama_salesman,

        COALESCE(SUM(transaksi.total), 0) AS total_harga
    FROM
       salesman
    LEFT JOIN
       transaksi ON salesman.id= transaksi.salesman_id
        AND transaksi.tanggal_transaksi BETWEEN ? AND ?
    GROUP BY
        salesman.nama_salesman";



        $data  =  DB::select($query, [$fromDate, $toDate]);

        if ($data) {
            return ApiFormatter::createApi(200, 'Success', $data);
        }
    }

    public function carisalesman($fromDate, $toDate, $nama)
    {
        // $query = "SELECT transaksi.kode_transaksi, transaksi.tanggal_transaksi, salesman.nama_salesman, produk.nama_produk, customer.nama_customer, transaksi.harga_jual, transaksi.stok_keluar,  transaksi.diskon, transaksi.harga_akhir FROM transaksi JOIN salesman ON transaksi.salesman_id = salesman.id JOIN customer ON transaksi.customer_id = customer.id JOIN produk ON transaksi.produk_id = produk.id
        // WHERE salesman_id = ? AND tanggal_transaksi = ?";


        $query = "SELECT
        salesman.nama_salesman,
        customer.nama_customer,
        customer.alamat,
        SUM(transaksi.total) as total_omzet
    FROM
        salesman
    JOIN
        transaksi ON transaksi.salesman_id = salesman.id
    JOIN
        customer ON transaksi.customer_id = customer.id
    WHERE
        transaksi.tanggal_transaksi BETWEEN ? AND ? AND salesman.nama_salesman = ?
    GROUP BY
        salesman.nama_salesman, customer.nama_customer;"
         ;

    $query2 = "SELECT
    salesman.nama_salesman,
    produk.nama_produk,
    produk.satuan,
    SUM(transaksi_detail.stok_keluar) as stok_keluar,
    SUM(transaksi_detail.total) as total_omzet
FROM
    salesman
JOIN
    transaksi ON transaksi.salesman_id = salesman.id
JOIN
    transaksi_detail ON transaksi.id = transaksi_detail.transaksi_id
JOIN
	produk
    ON transaksi_detail.produk_id = produk.id
WHERE
    transaksi.tanggal_transaksi BETWEEN ? AND ? AND salesman.nama_salesman = ?
GROUP BY
    salesman.nama_salesman, produk.nama_produk, produk.satuan;";

        $data = DB::select($query, [$fromDate, $toDate, $nama]);

        $data2 = DB::select($query2, [$fromDate, $toDate, $nama]);

        $data = [
            'customer' => $data,
            'produk' => $data2,
        ];

        if (!empty($data['customer']) && !empty($data['produk'])) {
            return ApiFormatter::createApi(200, 'Success', $data);
        } else {
            return ApiFormatter::createApi(400, 'Data not Found');
        }
    }

    public function produk()
    {
        // $data = DB::select("SELECT transaksi.id, transaksi.tanggal_transaksi, transaksi.stok_keluar, produk.nama_produk, transaksi.harga_jual, produk.harga, (transaksi.harga_jual - produk.harga) AS keuntungan, FORMAT(((transaksi.harga_jual - produk.harga) / produk.harga) * 100, '0.00%') AS persentase FROM transaksi INNER JOIN produk ON transaksi.produk_id = produk.id ");

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


        if ($data) {
            return ApiFormatter::createApi(200, 'Success', $data);
        } else {
            return ApiFormatter::createApi(400, 'Failled');
        }
    }

    public function dateRangeproduk($fromDate, $toDate)
    {
        $query = "SELECT
        produk.nama_produk,
        COALESCE(SUM(td.stok_keluar), 0) AS total_stok_keluar,
        produk.harga,
        produk.satuan,
        COALESCE(SUM(t.total), 0) AS total_transaksi
    FROM
        produk
    LEFT JOIN (
        SELECT
            transaksi_detail.produk_id,
            COALESCE(SUM(transaksi_detail.stok_keluar), 0) AS stok_keluar
        FROM
            transaksi_detail
        JOIN
            transaksi ON transaksi.id = transaksi_detail.transaksi_id
        WHERE
            transaksi.tanggal_transaksi BETWEEN ? AND ?
        GROUP BY
            transaksi_detail.produk_id
    ) AS td ON produk.id = td.produk_id

    LEFT JOIN (
        SELECT
            transaksi_detail.produk_id,
            COALESCE(SUM(transaksi.total), 0) AS total
        FROM
            transaksi_detail
        JOIN
            transaksi ON transaksi.id = transaksi_detail.transaksi_id
        WHERE
            transaksi.tanggal_transaksi BETWEEN ? AND ?
        GROUP BY
            transaksi_detail.produk_id
    ) AS t ON produk.id = t.produk_id

    GROUP BY
        produk.nama_produk, produk.harga, produk.satuan;
         ";



        $data  =  DB::select($query, [$fromDate, $toDate, $fromDate, $toDate]);

        if ($data) {
            return ApiFormatter::createApi(200, 'Success', $data);
        } else {
            return ApiFormatter::createApi(404, 'No data found for the specified date range.', $data);
        }
    }

    public function customer()
    {
        $data  =  DB::select('SELECT customer.nama_customer, customer.alamat, SUM(transaksi.total) AS total_harga
        FROM customer
        JOIN transaksi ON customer.id = transaksi.customer_id
        GROUP BY  customer.nama_customer, customer.alamat;');

        if ($data) {
            return ApiFormatter::createApi(200, 'Success', $data);
        } else {
            return ApiFormatter::createApi(400, 'Failled');
        }
    }

    public function dateRangecustomer($fromDate, $toDate)
    {
        $query = "SELECT
        customer.nama_customer,
        customer.alamat,
        COALESCE(SUM(transaksi.total), 0) AS total_harga
    FROM
        customer
    LEFT JOIN
        transaksi ON customer.id = transaksi.customer_id
        AND transaksi.tanggal_transaksi BETWEEN ? AND ?
    GROUP BY
        customer.nama_customer, customer.alamat;
    ";



        $data  =  DB::select($query, [$fromDate, $toDate]);

        if ($data) {
            return ApiFormatter::createApi(200, 'Success', $data);
        } else {
            return ApiFormatter::createApi(404, 'No data found for the specified date range.', $data);
        }
    }
}
