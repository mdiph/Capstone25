<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

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


        


        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/salesman');
        }

        return back()->with('LoginFailed', 'Password atau email salah');
    }
}
