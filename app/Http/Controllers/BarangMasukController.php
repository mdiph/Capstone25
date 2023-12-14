<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class BarangMasukController extends Controller
{
    public function index()
    {

        $data = BarangMasuk::with('produk')->get();
        return view('transaction.stockin')->with('data', $data);
    }

    public function create(Request $request)
    {


        //     $tes = BarangMasuk::create([
        //         "id_masuk" => "BA002",
        //         "tanggal_masuk" => "2023-01-01",
        //         "tanggal_expired" => "2024-01-01",
        //         "jumlah_masuk" => 20,
        //         "produk_id" => 1,
        //     ]);


        //    $qty =  $tes['jumlah_masuk'];

        //    produk::where('id', 1)->increment('stok', $qty);
        $data = produk::with('kategori')->get();
        return view('transaction.addstockin')->with('data', $data);
    }

    public function store(Request $request)
    {
        $validate = $request->all();
        $select = $validate['produk_id'];
        $qty =  $validate['jumlah_masuk'];



        $query = BarangMasuk::create($validate);

        if($query){
            produk::where('id', $select)->increment('stok', $qty);
            $queryStatus = 'Data berhasil ditambah';
        } else {
            $queryStatus = 'Data gagal ditambah';
        }


        return redirect('/barangmasuk')->with('message', $queryStatus);
    }
}
