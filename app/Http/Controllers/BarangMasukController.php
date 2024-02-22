<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\produk;
use App\Models\produkrecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\DB;

class BarangMasukController extends Controller
{
    public function index()
    {

        $data = BarangMasuk::with(['produk' => function ($query) {
            $query->withTrashed();
        }])->get();




        return view('transaction.stockin')->with('data', $data);
    }

    public function create(Request $request)
    {
        $data = produk::with('kategori')->get();
        return view('transaction.addstockin')->with('data', $data);
    }


    public function dateRange(Request $request)
    {

        $fromDate = $request->input('fromdate');
        $toDate = $request->input('todate');

        $data = BarangMasuk::with('produk')
            ->whereBetween('tanggal_masuk', [$fromDate, $toDate])->get();

        return view('transaction.stockin')->with('data', $data);
    }

    public function edit($id)
    {
        $data = BarangMasuk::with(['produk' => function ($query) {
            $query->withTrashed();
        }])->find($id);



        $produk = produk::with('kategori')->get();

        return view('transaction.editstockin')->with('data', $data)->with('produk', $produk);
    }

    public function update(Request $request, $id)
    {

        DB::beginTransaction();

        try {
        $data = BarangMasuk::with(['produk' => function ($query) {
            $query->withTrashed();
        }])->find($id);

        $rules = [
            'jumlah_lama' => 'required|integer',
            'produk_id' => 'required',
            'produk_idlama' => 'required',
            'jumlah_masuk' => 'required|integer',
            'tanggal_masuk' => 'required|date',
        ];

        $validate = $request->validate($rules);


        $datanow = $validate['jumlah_lama'];
        $select = $validate['produk_id'];
        $Idlama = $validate['produk_idlama'];
        $qty =  $validate['jumlah_masuk'];
        $date = $validate['tanggal_masuk'];

       







        $data->update($validate);

        if ($Idlama == $select) {
            // Case 1: $Idlama equals $select

            if ($qty > $datanow) {
                // Case 1a: $qty > $datanow
                $stok = $qty - $datanow;
                produk::where('id', $select)->increment('stok', $stok);
            } elseif ($qty < $datanow) {
                // Case 1b: $qty < $datanow
                produk::where('id', $select)->decrement('stok', $datanow);
                produk::where('id', $select)->increment('stok', $qty);
            }

        } else {
            // Case 2: $Idlama not equals $select

                produk::where('id', $select)->increment('stok', $qty);

        }


        // Additional error handling or validation might be needed depending on your requirements.

        $queryStatus = 'success';
        $querymsg = 'Data berhasil ditambah';

        DB::commit();
        } catch (\Exception $e) {
            // Tangani kesalahan jika ditemui
            // Rollback untuk membatalkan transaksi
            DB::rollBack();
            $queryStatus = 'error';
            $querymsg= 'Data gagal ditambah. Error: ' . $e->getMessage();
        }

        return redirect('/barangmasuk')->with($queryStatus , $querymsg);
    }

    public function store(Request $request)
    {



        DB::beginTransaction();

        try {

            $validate = $request->all();
            $select = $validate['produk_id'];
            $qty =  $validate['jumlah_masuk'];
            $date = $validate['tanggal_masuk'];





            $produklama =  $validate['stok_lama'];
            BarangMasuk::create($validate);

            produkrecord::create([
                'produk_id' => $select,
                'stok' => $produklama,
                'tanggal' => $date
            ]);

            produk::where('id', $select)->increment('stok', $qty);
            // produk_record create
            $queryStatus = 'Data berhasil ditambah';



            // Jika semua query berhasil, simpan perubahan
            DB::commit();
        } catch (\Exception $e) {
            // Tangani kesalahan jika ditemui
            // Rollback untuk membatalkan transaksi
            DB::rollBack();

            $queryStatus = 'Data gagal ditambah. Error: ' . $e->getMessage();
        }





        // Lakukan operasi-opsi query di sini
        // ...












        return redirect('/barangmasuk')->with('message', $queryStatus);
    }
}
