<?php

namespace App\Http\Controllers\API;
use Exception;

use App\Models\Transaksi;
use App\Models\Barangkeluar;
use Illuminate\Http\Request;
use App\Helpers\ApiFormatter;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class BarangKeluarController extends Controller
{

    public function transaksi()
    {

        $data = Transaksi::with('customer', 'salesman', 'produk')->get();





        if($data){
            return ApiFormatter::createApi(200, 'Success', $data);

        } else{
            return ApiFormatter::createApi(400, 'Failled');
        }
    }
}
