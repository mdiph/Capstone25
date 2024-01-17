<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\customer;
use App\Models\detailtran;
use App\Models\produk;
use App\Models\salesman;
use App\Models\Transaksi;
use App\Models\transaksi2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Transaksi2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // $data = transaksi2::with(['salesman', 'customer', 'detail.produk'])->get();



        $data = DB::table('transaksi2s')
        ->leftJoin('salesman', 'transaksi2s.salesman_id', '=', 'salesman.id')
        ->leftJoin('transaksi_detail', 'transaksi2s.id', '=', 'transaksi_detail.transaksi_id')
        ->leftJoin('produk', 'transaksi_detail.produk_id', '=', 'produk.id')
        ->leftJoin('customer', 'transaksi2s.customer_id', '=', 'customer.id')
        ->select([
            'transaksi2s.id',
            'transaksi2s.kode_transaksi',
            'transaksi2s.tanggal_transaksi',
            'transaksi2s.diskon',
            'transaksi2s.total',
            'transaksi2s.subtotal',
            'transaksi2s.diskon',
            'salesman.nama_salesman',
            'customer.nama_customer',
            'transaksi_detail.harga_jual',
            'transaksi_detail.stok_keluar',
            'produk.nama_produk',
        ])
        ->get();


        return view('transaction.transaksi')->with('data', $data);
    }



    public function addCart(Request $request)
    {


        $validate = $request->all();
        // $select = $validate['produk_id'];
        // $qty =  $validate['qty'];



        cart::create($validate);

        // DB::transaction(function () use ($qty, $select) {
        // });

        return redirect('/tes');
    }

    public function DeleteCart(Request $request,  $id)
    {

        $id = cart::findOrFail($id);

        $id->delete();





        return redirect('/tes');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        $salesman = salesman::all();
        $customer = customer::all();
        $tes = cart::with('produk')->get();
        // $total = $tes->sum('harga');


        $data = produk::with('kategori')->get();
        return view('transaction.prototrans')->with('data', $data)->with('tes', $tes)->with('salesman', $salesman)->with('customer', $customer);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validate = $request->all();

        dd($validate);



        $transaksi = transaksi2::create($validate);

        $cart = cart::with('produk')->get();

        foreach($cart as $key => $value){
            $product = array(
                'transaksi_id' =>$transaksi->id,
                'stok_keluar' => $request->stok_keluar,
                'harga_jual' => $request->harga_jual,
                'produk_id' => $value->produk_id,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            );

            $orderproduct = detailtran::create($product);

            $deletecart = cart::where('id', $value->id)->delete();


        }

        return redirect('/tes');





    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        //

        $data = transaksi2::with('detail')->find($id);


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
