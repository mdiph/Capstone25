<?php

namespace App\Http\Controllers;

use App\Models\salesman;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class SalesmanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $data = salesman::all();

        return view('DataMaster.salesman')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $rules = [
            'nama_salesman' => 'required|max:255',
            'no_telp' => ['required', 'regex:^(?:\+62|62|0)(?:\d{8,15})$^'],
        ];
        $validate = $request->validate($rules);

        try {
            salesman::create($validate);
            return redirect('/salesman')->with('success', 'Data berhasil disimpan');
        } catch (\Exception $e) {
            // Tangani kesalahan penyimpanan
            return redirect('/salesman')->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(salesman $salesman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(salesman $salesman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, salesman $salesman, $id)
    {
        //

        $rules = [
            'nama_salesman' => 'required|max:255',
            'no_telp' => ['required', 'regex:^(?:\+62|62|0)(?:\d{8,15})$^'],
        ];
        $sales = salesman::find($id);

        $validate = $request->validate($rules);

        $sales->update($validate);

        return redirect('/salesman')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(salesman $salesman, $id)
    {
        //

        $sales = salesman::find($id);

        $sales->delete();

        return redirect('/salesman')->with('success', 'Data berhasil dihapus');
    }

    public function trash(){
        $data = salesman::onlyTrashed()->get();

        return view('trash.salesman')->with('data', $data);
    }

    public function kembalikan($id)
{
     $sales = salesman::onlyTrashed()->where('id',$id);
     $sales->restore();
     return redirect('/salesman/trash')->with('success', 'Data berhasil dikembalikan');
}

public function forcedelete($id){
    $data = salesman::onlyTrashed()->where('id',$id);
    $data->forceDelete();
    return redirect('/salesman/trash')->with('success', 'Data berhasil dihapus');
}
}
