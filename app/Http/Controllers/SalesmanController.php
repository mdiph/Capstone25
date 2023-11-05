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

        return view ('DataMaster.salesman')->with('data', $data);
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
        $validate = $request->all();

      salesman::create($validate);

      return redirect('/salesman')->with('success', 'Data berhasil disimpan');

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
        $sales = salesman::find($id);

        $validate = $request->all();

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
}
