<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //


    public function index(){

        $user = User::all();
        return view('Admin.list')->with('user', $user);
    }

    public function store(Request $request){


        $validateData = $request->validate([
            'nama' => 'required|max:255',
            'email' => 'required|email:dns|unique:users',
            'role' => 'required',
            'password' => 'required|min:5|max:30'
          ]);

          //enkripsi password di my sql
          $validateData['password'] = bcrypt($validateData['password']);


          //$request->session()->flash('success', 'Registrasi selesai, silahkan login');

          User::create($validateData);

       return redirect('/User')->with('success', 'Tambah data berhasil');
    }

    public function update(Request $request, $id){

        $user  =  User::find($id);

        $validateData = $request->validate([
            'nama' => 'required|max:255',
            'email' => 'required|email:dns|unique:users',
            'role' => 'required',

          ]);

          //enkripsi password di my sql
          
        $user->update($validateData);

        return redirect('/User')->with('success', 'Ubah data berhasil');
    }

    public function destroy(Request $request, $id){
        $user  = User::find($id);

        $user->delete();

        return redirect('/User')->with('success', 'Hapus data berhasil');
    }



}
