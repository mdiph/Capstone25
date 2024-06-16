<?php

namespace App\Http\Controllers\API;
use Exception;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Produk;
use App\Models\Piutang;
use App\Models\Transaksi;
use App\Models\Pembayaran;
use App\Models\transaksi2;
use App\Models\BarangMasuk;
use App\Models\transaksi_detail;
use App\Models\Barangkeluar;
use App\Models\produkrecord;
use Illuminate\Http\Request;
use App\Helpers\ApiFormatter;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\cart_salesman;

class TransaksiController extends Controller
{

    public function addCart(Request $request)
{
    // Validasi input
    $validate = $request->validate([
        'produk_id' => 'required',
        'no_batch' => 'required',
        'tanggal_kedaluwarsa' => 'required|date',
        'jumlah_keluar' => 'required|numeric|min:1',
        'diskon' => 'numeric|min:0|max:100',
        'harga_jual' => 'required|numeric|min:0',
    ]);

    // Get the authenticated salesman
    $salesman = $request->user();

    // Validasi apakah jumlah keluar tidak melebihi stok produk
    $produk = Produk::findOrFail($validate['produk_id']);
    if ($validate['jumlah_keluar'] > $produk->stok) {
        // Jika jumlah keluar melebihi stok, kembalikan response dengan pesan error
        return response()->json(['message' => 'Jumlah keluar melebihi stok produk'], 422);
    }

    // Validasi apakah jumlah keluar tidak melebihi stok tersisa di BarangMasuk dan tidak sudah kadaluarsa
    $totalTersedia = 0;
    $barangMasukRecords = BarangMasuk::where('produk_id', $validate['produk_id'])
        ->where('tanggal_kadaluarsa', '>', now()) // Hanya ambil barang yang belum kadaluarsa
        ->orderBy('tanggal_masuk', 'asc') // Urutkan berdasarkan tanggal masuk (FIFO)
        ->get();

    foreach ($barangMasukRecords as $barangMasuk) {
        $totalTersedia += $barangMasuk->stok_tersisa;
        if ($totalTersedia >= $validate['jumlah_keluar']) {
            break;
        }
    }

    if ($validate['jumlah_keluar'] > $totalTersedia) {
        return response()->json(['message' => 'Jumlah keluar melebihi stok tersisa dari barang masuk yang valid'], 422);
    }

    // Hitung diskon
    $diskon = $validate['harga_jual'] * $validate['jumlah_keluar'] - ($validate['harga_jual'] * $validate['jumlah_keluar'] * $validate['diskon'] / 100);

    // Tambahkan ke keranjang jika validasi berhasil
    cart_salesman::create([
        'salesman_id' => $salesman->id, // Add the salesman ID
        'produk_id' => $request->produk_id,
        'no_batch' => $request->no_batch,
        'tanggal_kedaluwarsa' => $request->tanggal_kedaluwarsa,
        'jumlah_keluar' => $request->jumlah_keluar,
        'diskon' => $request->diskon,
        'harga_jual' => $request->harga_jual,
        'total' => $diskon
    ]);

    return response()->json(['message' => 'Produk berhasil ditambahkan ke keranjang'], 200);
}


public function deleteCart(Request $request, $id)
{
    // Get the authenticated salesman
    $salesman = $request->user();

    // Find the cart item
    $cartItem = cart_salesman::where('id', $id)->where('salesman_id', $salesman->id)->firstOrFail();

    // Delete tcart_salesman item
    $cartItem->delete();

    return response()->json(['message' => 'Cart item deleted successfully'], 200);
}

public function getCart(Request $request)
{
    // Get the authenticated salesman
    $salesman = $request->user();

    // Retrieve the cart items for the logged-in salesman
    $tes = cart_salesman::with('produk')->where('salesman_id', $salesman->id)->get();
    $total = $tes->sum('total');

    $responseData = [
        'cartData' => $tes,
        'total' => $total,
    ];

    return response()->json($responseData);
}

public function store(Request $request)
{
    DB::beginTransaction();

    try {
        $validate = $request->validate([
            'kode_transaksi' => 'required|string',
            'tanggal_transaksi' => 'required|date',
            'total' => 'required|numeric',
            'diskon' => 'nullable|numeric',
            'subtotal' => 'required|numeric',
            'customer_id' => 'required|exists:customers,id',
            'metode' => 'required|string',
            'bayar' => 'required|numeric',
        ]);

        // Get the authenticated salesman
        $salesman = $request->user();
        $salesman_id = $salesman->id;
        $customer_id = $validate['customer_id'];
        $date = Carbon::parse($validate['tanggal_transaksi'])->format('Ymd');
        $transaction_code = "TRA{$date}{$salesman_id}{$customer_id}";

        $transaksi = Transaksi::create([
            'kode_transaksi' => $validate['kode_transaksi'],
            'tanggal_transaksi' => $validate['tanggal_transaksi'],
            'total' => $validate['total'],
            'diskon' => $validate['diskon'] ?? 0,
            'subtotal' => $validate['subtotal'],
            'salesman_id' => $salesman_id,
            'customer_id' => $customer_id
        ]);

        $cart = cart_salesman::with('produk')->where('salesman_id', $salesman_id)->get();
        if ($cart->isEmpty()) {
            return response()->json(['message' => 'Keranjang kosong, silahkan masukan barang.'], 422);
        }

        if ($validate['metode'] == "Tempo") {
            if ($validate['bayar'] >= $validate['total']) {
                return response()->json(['message' => 'Jumlah bayar tidak boleh sama atau lebih dari total untuk metode Tempo.'], 422);
            } else {
                $konfirmasi = "Belum Lunas";
                $jatuhTempo = Carbon::parse($validate['tanggal_transaksi'])->addDays(30);
            }
        } else if ($validate['metode'] == "Cash" && $validate['bayar'] == $validate['total']) {
            $konfirmasi = "Lunas";
            $jatuhTempo = $validate['tanggal_transaksi'];
        } else {
            return response()->json(['message' => 'Bayar harus sesuai total.'], 422);
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
            $product = [
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
            ];

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

            // Update stok_tersisa in BarangMasuk
            $barangMasukRecords = BarangMasuk::where('produk_id', $value->produk_id)
                ->orderBy('tanggal_masuk', 'asc') // Assuming FIFO method
                ->get();

            $remainingQty = $value->jumlah_keluar;

            foreach ($barangMasukRecords as $barangMasuk) {
                if ($barangMasuk->stok_tersisa >= $remainingQty) {
                    $barangMasuk->decrement('stok_tersisa', $remainingQty);
                    break;
                } else {
                    $remainingQty -= $barangMasuk->stok_tersisa;
                    $barangMasuk->update(['stok_tersisa' => 0]);
                }
            }

            transaksi_detail::create($product);

            cart_salesman::where('id', $value->id)->delete();
        }

        DB::commit();
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json(['message' => 'Terdapat kesalahan', 'error' => $e->getMessage()], 500);
    }

    return response()->json(['message' => 'Transaksi Berhasil'], 200);
}


}
