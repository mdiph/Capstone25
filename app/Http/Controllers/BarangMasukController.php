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

        $data = BarangMasuk::with('produk')->get();
        return view('transaction.stockin')->with('data', $data);
    }

    public function create(Request $request)
    {
        $data = produk::with('kategori')->get();
        return view('transaction.addstockin')->with('data', $data);
    }


    public function dateRange(Request $request){

        $fromDate = $request->input('fromdate');
        $toDate = $request->input('todate');

        $data = BarangMasuk::with('produk')
        ->whereBetween('tanggal_masuk', [$fromDate, $toDate])->get()
        ;

        return view('transaction.stockin')->with('data', $data);

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
