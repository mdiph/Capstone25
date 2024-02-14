<?php

namespace App\Http\Controllers\API;
use Exception;

use App\Models\Transaksi;
use App\Models\transaksi2;
use App\Models\Barangkeluar;
use Illuminate\Http\Request;
use App\Helpers\ApiFormatter;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class PiutangController extends Controller
{

    public function index(){
        $data = DB::select('SELECT salesman.id, salesman.nama_salesman, SUM(transaksi.total - pembayaran.bayar) AS sisa_utang FROM salesman JOIN transaksi ON salesman.id = transaksi.salesman_id JOIN pembayaran ON transaksi.id = pembayaran.transaksi_id WHERE pembayaran.status = "Belum Lunas" OR pembayaran.status = "Telat" GROUP BY salesman.nama_salesman, salesman.id;');

        if($data){
            return ApiFormatter::createApi(200, 'Success', $data);

        } else{
            return ApiFormatter::createApi(400, 'Failled');
        }
    }

    public function show($nama){

        $query = "SELECT  salesman.nama_salesman, customer.nama_customer,customer.alamat, SUM(transaksi.total - pembayaran.bayar) AS sisa_utang
        FROM salesman
        JOIN transaksi ON salesman.id = transaksi.salesman_id
        JOIN pembayaran ON transaksi.id = pembayaran.transaksi_id
        JOIN customer ON transaksi.customer_id = customer.id
        WHERE (pembayaran.status = 'Belum Lunas' OR pembayaran.status = 'Telat') AND salesman.nama_salesman = ?
        GROUP BY salesman.id, customer.nama_customer;";

        $data= DB::select($query, [$nama]);



        if($data){
            return ApiFormatter::createApi(200, 'Success', $data);

        } else{
            return ApiFormatter::createApi(400, 'Failled');
        }
    }



}
