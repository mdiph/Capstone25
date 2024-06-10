<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PiutangController extends Controller
{
    //
    public function Index(){
        $data = DB::select('SELECT
        salesman.id,
        IFNULL(salesman.nama_salesman, "Salesman telah terhapus") AS nama_salesman,
        SUM(transaksi.total - pembayaran.bayar) AS sisa_utang
    FROM
        transaksi
    LEFT JOIN
        salesman ON salesman.id = transaksi.salesman_id
    LEFT JOIN
        pembayaran ON transaksi.id = pembayaran.transaksi_id
    WHERE
        pembayaran.status = "Belum Lunas" OR pembayaran.status = "Telat"
    GROUP BY
        salesman.nama_salesman, salesman.id');

        return view('piutang')->with('data', $data);
    }

    public function show($id){

        $query = "SELECT transaksi.id AS transaksi_id, salesman.nama_salesman, customer.nama_customer,customer.alamat, SUM(transaksi.total - pembayaran.bayar) AS sisa_utang
        FROM salesman
        JOIN transaksi ON salesman.id = transaksi.salesman_id
        JOIN pembayaran ON transaksi.id = pembayaran.transaksi_id
        JOIN customer ON transaksi.customer_id = customer.id
        WHERE (pembayaran.status = 'Belum Lunas' OR pembayaran.status = 'Telat') AND salesman.id = ?
        GROUP BY salesman.id, customer.nama_customer;";

        $data= DB::select($query, [$id]);



        return view('detailpiutang')->with('data', $data);
    }
}
