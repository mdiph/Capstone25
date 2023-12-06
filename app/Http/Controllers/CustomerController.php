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
        $validate = $request->all();

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
        $sales = customer::find($id);

        $validate = $request->all();

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
}
