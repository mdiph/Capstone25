<?php

namespace App\Http\Controllers;

use App\Models\customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = customer::all();

        return view ('DataMaster.customer')->with('data', $data);
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
            'nama_customer' => 'required|max:255',
            'no_telp' => ['required', 'regex:^(?:\+62|62|0)(?:\d{8,15})$^'],
            'alamat' => 'required|max:255'
        ];
        $validate = $request->validate($rules);

      customer::create($validate);

      return redirect('/customer')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, customer $customer, $id)
    {
        //

        $rules = [
            'nama_customer' => 'required|max:255',
            'no_telp' => ['required', 'regex:^(?:\+62|62|0)(?:\d{8,15})$^'],
            'alamat' => 'required|max:255'
        ];
        $sales = customer::find($id);

        $validate = $request->validate($rules);

        $sales->update($validate);

        return redirect('/customer')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(customer $customer, $id)
    {
        //
        $sales = customer::find($id);

        $sales->delete();

        return redirect('/customer')->with('success', 'Data berhasil dihapus');
    }

    public function trash(){
        $data = customer::onlyTrashed()->get();

        return view('trash.customer')->with('data', $data);
    }

    public function kembalikan($id)
{
     $sales = customer::onlyTrashed()->where('id',$id);
     $sales->restore();
     return redirect('/customer/trash')->with('success', 'Data berhasil dikembalikan');
}

public function forcedelete($id){
    $data = customer::onlyTrashed()->where('id',$id);
    $data->forceDelete();
    return redirect('/customer/trash')->with('success', 'Data berhasil dihapus');
}
}
