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


class BarangKeluarController extends Controller
{

    public function transaksi()
    {

        $data = Transaksi::with([
            'salesman' => function ($query) {
                $query->withTrashed();
            },
            'customer' => function ($query) {
                $query->withTrashed();
            },
            'detailTransaksi' => function ($query) {
                $query->with(['produk' => function ($query) {
                    $query->withTrashed();
                }]);
            },
            'pembayaran.piutang'
        ])->get();





        if($data){
            return ApiFormatter::createApi(200, 'Success', $data);

        } else{
            return ApiFormatter::createApi(400, 'Failled');
        }
    }

    public function dateRangetransaksi($startDate , $endDate  )
    {



        $data = Transaksi::with([
            'salesman' => function ($query) {
                $query->withTrashed();
            },
            'customer' => function ($query) {
                $query->withTrashed();
            },
            'detailTransaksi' => function ($query) {
                $query->with(['produk' => function ($query) {
                    $query->withTrashed();
                }]);
            },
            'pembayaran.piutang'
        ])
            ->whereBetween('tanggal_transaksi', [$startDate, $endDate])
            ->get();





        if($data){
            return ApiFormatter::createApi(200, 'Success', $data);

        } else{
            return ApiFormatter::createApi(400, 'Failled');
        }
    }
}
