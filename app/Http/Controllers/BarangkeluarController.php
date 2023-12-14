<?php

namespace App\Http\Controllers;

use App\Models\Barangkeluar;
use Illuminate\Http\Request;
use App\Models\produk;
use Illuminate\Support\Facades\DB;

class BarangkeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Barangkeluar::with('produk')->get();
        return view ("transaction.stockout")->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $data = produk::with('kategori')->get();
        return view('transaction.addstockout')->with('data', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validate = $request->all();

        $select = $validate['produk_id'];
        $qty =  $validate['jumlah_keluar'];
        $harga = $validate['harga'];



        $query = Barangkeluar::create($validate);

        DB::transaction(function () use($harga, $query, $qty, $select) {
            produk::where('id', $select)->decrement('stok', $qty);
            $query->increment('harga_jual', $harga * $qty );


        });
        // if($query){

        // } else {
        //     $queryStatus = 'Data gagal ditambah';
        // }


        return redirect('/barangkeluar');

    }

    /**
     * Display the specified resource.
     */
    public function show(Barangkeluar $barangkeluar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barangkeluar $barangkeluar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barangkeluar $barangkeluar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barangkeluar $barangkeluar)
    {
        //
    }
}
