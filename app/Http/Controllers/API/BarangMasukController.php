<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;

use App\Helpers\ApiFormatter;
use App\Models\BarangMasuk;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class BarangMasukController extends Controller
{

    public function index()
    {

        $data_query = BarangMasuk::with(['produk' => function ($query) {
            $query->withTrashed();
        }])->get();




        $data = $data_query->paginate();

        if($data){
            return ApiFormatter::createApi(200, 'Success', $data);

        } else{
            return ApiFormatter::createApi(400, 'Failled');
        }
    }
}
