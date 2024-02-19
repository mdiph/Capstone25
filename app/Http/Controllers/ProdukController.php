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

        $data = produk::with('kategori')->get();
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
        //
        $sales = produk::with('kategori')->findOrFail($id);

        $validate = $request->all();
        $kategori = kategori::all();

        $sales->update($validate);

        return redirect('/produk')->with('success', 'Data berhasil diubah')->with('kategori', $kategori);
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
}
