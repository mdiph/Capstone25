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
        }])->latest()->get();




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

    // Check if toDate is less than fromDate
    if (strtotime($toDate) < strtotime($fromDate)) {
        return redirect()->back()->with('error', 'Tanggal akhir tidak boleh kurang dari tanggal mulai.');
    }

    $data = BarangMasuk::with(['produk' => function ($query) {
        $query->withTrashed();
    }])
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
                'jumlah_lama' => 'required',
                'produk_id' => 'required',
                'produk_idlama' => 'required',
                'jumlah_masuk' => 'required|numeric',
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
            $querymsg = 'Data gagal ditambah. Error: ' . $e->getMessage();
        }

        return redirect('/barangmasuk')->with($queryStatus, $querymsg);
    }

    public function store(Request $request)
    {



        DB::beginTransaction();

        try {

            $rules = [

                'produk_id' => 'required',
                'stok_lama' => 'required',
                'jumlah_masuk' => 'required|numeric',
                'tanggal_masuk' => 'required|date',
            ];



            $validate = $request->validate($rules);
            $select = $validate['produk_id'];
            $qty =  $validate['jumlah_masuk'];
            $date = $validate['tanggal_masuk'];

            $lastDigitOfYear = substr($date, -2, 2); // Mengambil 2 digit terakhir tahun
            $month = date('m', strtotime($date)); // Mengambil bulan dari tanggal transaksi
            $day = date('d', strtotime($date)); // Mengambil tanggal dari tanggal transaksi

            // Mendapatkan digit terakhir dari barangkeluar dibuat ke berapa pada tanggal tersebut
            $lastDigitFromBarangKeluar = BarangMasuk::whereDate('tanggal_masuk', $date)->count() + 1;

            $validate['id_masuk'] = "BM-" . $lastDigitOfYear . $month . $day . $lastDigitFromBarangKeluar . $select;




            $produklama =  $validate['stok_lama'];
            BarangMasuk::create($validate);

            produkrecord::create([
                'produk_id' => $select,
                'stok' => $produklama,
                'tanggal' => $date
            ]);

            produk::where('id', $select)->increment('stok', $qty);
            // produk_record create
            $message = 'success';
            $queryStatus = 'Data berhasil ditambah';



            // Jika semua query berhasil, simpan perubahan
            DB::commit();
        } catch (\Exception $e) {
            // Tangani kesalahan jika ditemui
            // Rollback untuk membatalkan transaksi
            DB::rollBack();

            $message = 'error';
            $queryStatus = 'Data gagal ditambah. Error: ' . $e->getMessage();
        }





        // Lakukan operasi-opsi query di sini
        // ...












        return redirect('/barangmasuk')->with($message, $queryStatus);
    }

    public function delete($id)
    {
        $bm =  BarangMasuk::find($id);

        $select = $bm->produk_id;
        $stok = $bm->jumlah_masuk;

        produk::where('id', $select)->decrement('stok', $stok);
        $bm->delete();

        return redirect('/barangmasuk')->with('success', 'Barang berhasil dihapus.');
    }

    public function kembalikan($id)
{
    // Retrieve the soft-deleted record with its associated product
    $sales = BarangMasuk::onlyTrashed()->with(['produk' => function ($query) {
        $query->withTrashed();
    }])->where('id', $id)->first();

    if ($sales) {
        // Access the product ID and quantity
        $select = $sales->produk->id; // Assuming 'id' is the correct column for product ID
        $stok = $sales->jumlah_masuk;

        // Increment the stock of the product
        produk::where('id', $select)->increment('stok', $stok);

        // Restore the sales record
        $sales->restore();

        return redirect('/barangmasuk/trash')->with('success', 'Data berhasil dikembalikan');
    } else {
        return redirect('/barangmasuk/trash')->with('error', 'Data tidak ditemukan');
    }
}


    public function trash(){
        $data = BarangMasuk::onlyTrashed()->with(['produk' => function ($query) {
            $query->withTrashed();
        }])->get();

        return view('trash.stockin')->with('data', $data);
    }

    public function forcedelete($id){
        $data = BarangMasuk::onlyTrashed()->where('id',$id);
        $data->forceDelete();
        return redirect('/barangmasuk/trash')->with('success', 'Data berhasil dihapus');
    }


}
