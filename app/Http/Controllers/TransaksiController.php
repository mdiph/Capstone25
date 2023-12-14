<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\produk;
use App\Models\cart;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $tes = cart::with('produk')->get();
        $data = DB::select('SELECT * FROM produk WHERE id NOT IN (SELECT produk_id FROM cart);');
        return view('transaction.transaksi')->with('data', $data)->with('tes', $tes);
    }


    public function addCart(Request $request,  $id){


        $validate = $request->all();
        $select = $validate['produk_id'];
        $qty =  $validate['qty'];


        cart::create($validate);

        DB::transaction(function () use($qty, $select) {
            produk::where('id', $select)->decrement('stok', $qty);



        });

        return redirect('/transaksi');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi)
    {
        //
    }
}
