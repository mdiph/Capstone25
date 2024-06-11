<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\produk;
use App\Models\customer;
use App\Models\salesman;
use App\Models\Transaksi;
use App\Models\detailtran;
use App\Models\transaksi2;
use App\Models\BarangMasuk;
use App\Models\Barangkeluar;
use App\Models\Pembayaran;
use App\Models\Piutang;
use App\Models\produkrecord;
use Illuminate\Http\Request;
use App\Models\transaksi_detail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Transaksi2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Transaksi::with([
            'salesman' => function ($query) {
                $query->withTrashed();
            },
            'customer' => function ($query) {
                $query->withTrashed();
            }, 'pembayaran'
        ])->latest()->get();




        return view('transaction.transaksi')->with('data', $data);
    }



    public function addCart(Request $request)
    {
        // Validasi input
        $validate = $request->validate([
            'produk_id' => 'required',
            'no_batch' => 'required',
            'tanggal_kedaluwarsa' => 'required',
            'jumlah_keluar' => 'required|numeric|min:1',
            'diskon' => 'numeric|min:0|max:100',
            'harga_jual' => 'required|numeric|min:0',
        ]);

        // Validasi apakah jumlah keluar tidak melebihi stok produk
        $produk = Produk::findOrFail($validate['produk_id']);
        if ($validate['jumlah_keluar'] > $produk->stok) {
            // Jika jumlah keluar melebihi stok, kembalikan response dengan pesan error
            return response()->json(['message' => 'Jumlah keluar melebihi stok produk'], 422);
        }

        // Hitung diskon
        $diskon = $validate['harga_jual'] * $validate['jumlah_keluar'] - ($validate['harga_jual'] * $validate['jumlah_keluar'] * $validate['diskon'] / 100);

        // Tambahkan ke keranjang jika validasi berhasil
        cart::create([
            'produk_id' => $request->produk_id,
            'no_batch' => $request->no_batch,
            'tanggal_kedaluwarsa' => $request->tanggal_kedaluwarsa,
            'jumlah_keluar' => $request->jumlah_keluar,
            'diskon' => $request->diskon,
            'harga_jual' => $request->harga_jual,
            'total' => $diskon
        ]);

        // Redirect atau lanjutkan dengan logika lainnya...
    }


    public function DeleteCart(Request $request,  $id)
    {

        $id = cart::findOrFail($id);

        $id->delete();
    }
    /**
     * Show the form for creating a new resource.
     */

    public function getCart()
    {
        $tes = cart::with('produk')->get();
        $total = $tes->sum('total');

        $responseData = [
            'cartData' => $tes,
            'total' => $total,
        ];

        return response()->json($responseData);
    }
    public function create()
    {
        //

        $salesman = salesman::all();
        $customer = customer::all();
        $tes = cart::with('produk')->get();
        $total = $tes->sum('total');




        $produk = produk::with('kategori')->get();

        return view('transaction.prototrans')->with('produk', $produk)->with('tes', $tes)->with('salesman', $salesman)->with('customer', $customer)->with('total', $total);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //



        DB::beginTransaction();





        try {


            $validate = $request->all();

            $salesman_id = $validate['salesman_id'];
            $customer_id = $validate['customer_id'];
            $date = Carbon::parse($validate['tanggal_transaksi'])->format('Ymd');
            $transaction_code = "TRA{$date}{$salesman_id}{$customer_id}";


            $transaksi = Transaksi::create([
                'kode_transaksi' => $validate['kode_transaksi'],
                'tanggal_transaksi' => $validate['tanggal_transaksi'],

                'total' => $validate['total'],
                'diskon' => $validate['diskon'] ?? 0,
                'subtotal' => $validate['subtotal'],
                'salesman_id' => $validate['salesman_id'],
                'customer_id' => $validate['customer_id']

            ]);
            $cart = cart::with('produk')->get();
            if ($cart->isEmpty()) {
                // Redirect back or display an error message
                return redirect()->back()->with('error', 'Keranjang kosong, silahkan masukan barang.');
            }

            if ($validate['metode'] == "Tempo") {
                if ($validate['bayar'] >= $validate['total']) {
                    return redirect()->back()->with('error', 'Jumlah bayar tidak boleh sama atau lebih dari total untuk metode Tempo.');
                } else {
                    $konfirmasi = "Belum Lunas";
                    $jatuhTempo = Carbon::parse($validate['tanggal_transaksi'])->addDays(30);
                }
            } else if ($validate['metode'] == "Cash" && $validate['bayar'] == $validate['total']) {
                $konfirmasi = "Lunas";
                $jatuhTempo = $validate['tanggal_transaksi'];
            } else {
                return redirect()->back()->with('error', 'Bayar harus sesuai total.');
            }

            $pembayaran = Pembayaran::create([
                'transaksi_id' => $transaksi->id,
                'status' => $konfirmasi,
                'metode' => $validate['metode'],
                'tanggal_bayar' => $validate['tanggal_transaksi'],
                'bayar' => $validate['bayar'],
                'jatuh_tempo' => $jatuhTempo
            ]);

            if ($pembayaran->status == 'Belum Lunas') {

                Piutang::create([
                    'pembayaran_id' => $pembayaran->id,
                    'tanggal_bayar' => $pembayaran->tanggal_bayar,
                    'angsuran' => $pembayaran->bayar,

                ]);
            }



            foreach ($cart as $key => $value) {
                $product = array(
                    'transaksi_id' => $transaksi->id,
                    'stok_keluar' => $value->jumlah_keluar,
                    'harga_jual' => $value->harga_jual,
                    'diskon' => $value->diskon,
                    'produk_id' => $value->produk_id,
                    'no_batch' => $value->no_batch,
                    'tanggal_kedaluwarsa' => $value->tanggal_kedaluwarsa,
                    'total' => $value->total,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                );



                produkrecord::create([
                    'produk_id' => $value->produk_id,
                    'stok' => $value->produk->stok,
                    'tanggal' => $validate['tanggal_transaksi']
                ]);
                $lastDigitOfYear = substr($validate['tanggal_transaksi'], -2, 2); // Mengambil 2 digit terakhir tahun
                $month = date('m', strtotime($validate['tanggal_transaksi'])); // Mengambil bulan dari tanggal transaksi
                $day = date('d', strtotime($validate['tanggal_transaksi'])); // Mengambil tanggal dari tanggal transaksi

                // Mendapatkan digit terakhir dari barangkeluar dibuat ke berapa pada tanggal tersebut
                $lastDigitFromBarangKeluar = Barangkeluar::whereDate('tanggal_keluar', $validate['tanggal_transaksi'])->count() + 1;

                $id_keluar = "BK-" . $lastDigitOfYear . $month . $day . $lastDigitFromBarangKeluar . $value->produk_id;

                Barangkeluar::create([
                    'id_keluar' => $id_keluar,
                    'tanggal_keluar' => $validate['tanggal_transaksi'],
                    'jumlah_keluar' => $value->jumlah_keluar,
                    'produk_id' => $value->produk_id,
                    'transaksi_id' => $transaksi->id
                ]);
                produk::where('id', $value->produk_id)->decrement('stok', $value->jumlah_keluar);
                transaksi_detail::create($product);


                $deletecart = cart::where('id', $value->id)->delete();
            }






            // Jika semua query berhasil, simpan perubahan
            DB::commit();
        } catch (\Exception $e) {
            // Tangani kesalahan jika ditemui
            // Rollback untuk membatalkan transaksi
            DB::rollBack();
            return redirect()->back()->with('error', 'Terdapat kesalahan');
        }


        return redirect('/transaksi')->with('success', 'Transaksi Berhasil');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        // Mengambil data transaksi beserta relasinya, termasuk yang di-soft delete
        $data = Transaksi::withTrashed()->with([
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
            ->find($id);




        // Memeriksa apakah data ditemukan




        // Menampilkan view dengan data yang telah disiapkan
        return view('transaction.detailtransaksi')->with('data', $data);
    }

    public function piutang(Request $request, $id)
    {
        //

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
        ])->find($id);




        return view('transaction.detailpiutang')->with('data', $data);
    }

    public function bayarUtang(Request $request, $id)
    {
        $validate = $request->all();
        $data = Transaksi::with(['salesman', 'customer', 'detailTransaksi.produk', 'pembayaran.piutang'])->find($id);



        Piutang::create([
            'pembayaran_id' => $id,
            'tanggal_bayar' => $validate['tanggal_bayar'],
            'angsuran' => $validate['angsuran']
        ]);

        Pembayaran::where('id', $id)->increment('bayar', $validate['angsuran']);



        $pembayaran = Pembayaran::find($id);
        $transaksiid = $pembayaran->transaksi_id;
        $transaksiTotal = Transaksi::where('id', $transaksiid)->first();



        if ($pembayaran->bayar >= $transaksiTotal->total) {
            // Jika sama, ubah kolom 'status' menjadi 'Lunas'
            $pembayaran->update([
                'status' => 'Lunas'
            ]);
        }

        // if ($pembayaran->bayar <= $transaksiTotal->total && now()->greaterThan($pembayaran->jatuh_tempo)) {
        //     // Jika sama, ubah kolom 'status' menjadi 'Lunas'
        //     $pembayaran->update([
        //         'status' => 'Telat'
        //     ]);
        // }

        return redirect()->back()->with('success', 'Angsuran dibayarkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function telat()
    {
        // Fetch all transactions with related payment and debt information
        $transactions = Transaksi::with(['pembayaran.piutang'])->get();

        $updated = false;

        // Iterate over each transaction in the collection
        foreach ($transactions as $transaction) {
            // Accessing relationships
            $pembayaran = $transaction->pembayaran;
            $piutang = $pembayaran->piutang;

            // Check conditions for each transaction
            if (
                $pembayaran->metode === 'Tempo' &&
                $pembayaran->status === "Belum Lunas" &&
                now()->greaterThan($pembayaran->jatuh_tempo)
            ) {

                // Check if payment is overdue
                if ($pembayaran->bayar <= $transaction->total) {
                    // Update 'status' to 'Telat' if conditions are met
                    $pembayaran->update([
                        'status' => 'Telat'
                    ]);
                    $updated = true; // Set flag indicating update occurred
                }
            }
        }

        if ($updated) {
            return redirect()->back()->with('success', 'Transaksi diubah');
        } else {
            return redirect()->back()->with('info', 'Tidak ada yang telat');
        }
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
    public function destroy(Request $request, $id)
    {
        // Temukan transaksi
        $transaksi = Transaksi::findOrFail($id);


        // Temukan detail transaksi
        $transaksiDetails = transaksi_detail::where('transaksi_id', $id)->get();

        // Kembalikan stok produk yang sebelumnya dikurangkan oleh transaksi
        foreach ($transaksiDetails as $detail) {
            produk::where('id', $detail->produk_id)->increment('stok', $detail->stok_keluar);
            // Barangkeluar::where('transaksi_id', $detail->id)->delete();
            // $transaksiDetails = transaksi_detail::where('transaksi_id', $detail->id)->delete();
        }



        // Hapus transaksi
        // Pembayaran::where('transaksi_id', $id)->delete();
        $transaksi->delete();

        return redirect('/transaksi')->with('success', 'Transaksi berhasil dihapus');
    }

    public function kembalikan($id)
    {
        $sales = Transaksi::onlyTrashed()->with([
            'salesman' => function ($query) {
                $query->withTrashed();
            },
            'customer' => function ($query) {
                $query->withTrashed();
            }, 'pembayaran'
        ])->where('id', $id)->first();

        $transaksiDetails = transaksi_detail::where('transaksi_id', $id)->get();

        // Kembalikan stok produk yang sebelumnya dikurangkan oleh transaksi
        foreach ($transaksiDetails as $detail) {
            produk::where('id', $detail->produk_id)->decrement('stok', $detail->stok_keluar);
        }

        $sales->restore();
        return redirect('/transaksi/trash')->with('success', 'Data berhasil dikembalikan');
     }

    public function trash()
    {

        $data = Transaksi::onlyTrashed()->with([
            'salesman' => function ($query) {
                $query->withTrashed();
            },
            'customer' => function ($query) {
                $query->withTrashed();
            }, 'pembayaran'
        ])->latest()->get();

        return view('trash.transaksi')->with('data', $data);
    }

    public function forcedelete($id){
        $data = Transaksi::onlyTrashed()->where('id',$id);
        $data->forceDelete();
        return redirect('/transaksi/trash')->with('success', 'Data berhasil dihapus');
    }

    public function dateRange(Request $request)
{
    $fromDate = $request->input('fromdate');
    $toDate = $request->input('todate');

    // Check if toDate is less than fromDate
    if (strtotime($toDate) < strtotime($fromDate)) {
        return redirect()->back()->with('error', 'Tanggal akhir tidak boleh kurang dari tanggal mulai.');
    }

    $data = Transaksi::with([
        'salesman' => function ($query) {
            $query->withTrashed();
        },
        'customer' => function ($query) {
            $query->withTrashed();
        }, 'pembayaran'
    ])->whereBetween('tanggal_transaksi', [$fromDate, $toDate])->get();

    return view('transaction.transaksi')->with('data', $data);
}
}
