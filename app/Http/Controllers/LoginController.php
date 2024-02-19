<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{


    public function index(){

        return view('login');
    }
    //
    public function authenticate(Request $request)
    {
        $credentials =  $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);





        if (Auth::attempt(array_merge($credentials, ['role' => 'Admin'])) || Auth::attempt(array_merge($credentials, ['role' => 'Gudang']))) {


            $request->session()->regenerate();

            return redirect()->intended('/')->with('success', 'Login Berhasil');
        }

        return back()->with('error', 'Password atau email salah');
    }


    public function logout(Request $request){

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');

    }


    public function register(Request $request){
        $validateData = $request->validate([
            'nama' => 'required|max:255',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:30'
          ]);

          //enkripsi password di my sql
          $validateData['password'] = bcrypt($validateData['password']);


          //$request->session()->flash('success', 'Registrasi selesai, silahkan login');

          User::create($validateData);
    }
}
