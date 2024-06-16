<?php

namespace App\Http\Controllers;

use App\Models\produk;
use App\Models\kategori;
use Illuminate\Http\Request;

use Flasher\Prime\FlasherInterface;
use yajra\Datatables\Facades\DataTables;
use App\Http\Requests\StoreprodukRequest;
use App\Http\Requests\UpdateprodukRequest;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //


        $data = produk::with(['kategori' => function ($query) {
            $query->withTrashed();
        }])->get();
        $kategori = kategori::all();


        return view ('DataMaster.produk')->with('data', $data)->with('kategori', $kategori);
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
    public function store(FlasherInterface $flasher, Request $request)
    {
        //

        $rules = [
            'nama_produk' => 'required|max:255',
            'deskripsi' => 'required|max:255',
            'harga' => 'required|numeric',
            'satuan' => 'required',
            'kategori_id' => 'required'

        ];
        $validate = $request->validate($rules);
        $validate = $request->all();
        $kategori = kategori::all();
        produk::create($validate);


        return redirect('/produk')->with('kategori',$kategori)->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(produk $produk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, produk $produk, $id)
{
    $sales = produk::with('kategori')->findOrFail($id);

    $rules = [
        'nama_produk' => 'required|max:255',
        'deskripsi' => 'required|max:255',
        'harga' => 'required|numeric',
        'satuan' => 'required',
        // Kategori ID tidak divalidasi di sini
    ];

    $validate = $request->validate($rules);

    // Periksa kategori secara manual termasuk yang di-soft delete
    $kategoriId = $request->input('kategori_id');
    $kategori = kategori::withTrashed()->find($kategoriId);

    if (!$kategori) {
        return redirect()->back()->withErrors(['kategori_id' => 'Kategori yang dipilih tidak valid.']);
    }

    // Update produk dengan kategori yang valid
    $sales->update([
        'nama_produk' => $validate['nama_produk'],
        'deskripsi' => $validate['deskripsi'],
        'harga' => $validate['harga'],
        'satuan' => $validate['satuan'],
        'kategori_id' => $kategoriId,
    ]);

    return redirect('/produk')->with('success', 'Data berhasil diubah');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(produk $produk, $id)
    {
        //
        $sales = produk::find($id);

        $sales->delete();

        return redirect('/produk')->with('success', 'Data berhasil dihapus');
    }

    public function trash(){
        $data = produk::onlyTrashed()->get();

        return view('trash.produk')->with('data', $data);
    }

    public function kembalikan($id)
{
     $sales = produk::onlyTrashed()->where('id',$id);
     $sales->restore();
     return redirect('/produk/trash')->with('success', 'Data berhasil dikembalikan');
}

public function forcedelete($id){
    $data = produk::onlyTrashed()->where('id',$id);
    $data->forceDelete();
    return redirect('/produk/trash')->with('success', 'Data berhasil dihapus');
}
}
