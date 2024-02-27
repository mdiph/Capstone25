<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use App\Http\Requests\StorekategoriRequest;
use App\Http\Requests\UpdatekategoriRequest;
use Illuminate\Http\Request;
class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = kategori::with('produk')->get();



        return view ('DataMaster.kategori')->with('data', $data);
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

        $rules = [
            'nama_kategori' => 'required|max:255',

        ];
        $validate = $request->validate($rules);
        $validate = $request->all();

        kategori::create($validate);

        return redirect('/kategori')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(kategori $kategori)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, kategori $kategori, $id)
    {
        //
        $sales = kategori::find($id);

        $rules = [
            'nama_kategori' => 'required|max:255',

        ];
        $validate = $request->validate($rules);

        $sales->update($validate);

        return redirect('/kategori')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(kategori $kategori, $id)
    {
        //
        $sales = kategori::find($id);

        $sales->delete();

        return redirect('/kategori')->with('success', 'Data berhasil dihapus');
    }

    public function trash(){
        $data = kategori::onlyTrashed()->get();

        return view('trash.kategori')->with('data', $data);
    }

    public function kembalikan($id)
{
     $sales = kategori::onlyTrashed()->where('id',$id);
     $sales->restore();
     return redirect('/kategori/trash')->with('success', 'Data berhasil dikembalikan');
}
}
