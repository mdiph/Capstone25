<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ResetCodePassword;
use App\Mail\SendCodeResetPassword;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function email(Request $request)
    {
        //
        $data = $request->all(); // Use validated() method for validation


        if (User::where('email', $request->email)->exists()) {
            ResetCodePassword::where('email', $request->email)->delete();
        } else {
            return back()->with('error', 'Email tidak terdaftar');
        }


        $data['code'] = mt_rand(100000, 999999);

        $codeData = ResetCodePassword::create($data);

        Mail::to($request->email)->send(new SendCodeResetPassword($codeData->code));

        $pw = $data['email'];

        return view('reset.code')->with('success', 'Email kode dikirim ke email anda')->with('pw', $pw);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function code(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code'  => 'required|string'
        ]);



        // Cari catatan reset password berdasarkan email dan kode
        $passwordReset = ResetCodePassword::where('email', $request->email)
            ->where('code', $request->code)
            ->first();

            $e = $request->email;
        if (!$passwordReset) {
            return view('reset.code')->with('error', 'Kode tidak valid')->with('pw', $e);
        }

        // Check if the code has expired
        if ($passwordReset->isExpire()) {
            return view('reset.code')->with('error', 'Kode sudah hangus silahkan ulangi lagi')->with('pw', $e);
        }


        $pw = $passwordReset['code'];
        return view("reset.password")->with('success', 'Kode sesuai')->with('pw', $pw);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function password(Request $request)
    {
        $passwordReset = ResetCodePassword::firstWhere('code', $request->code);

        if (!$passwordReset) {
            return back()->with('error', 'Kode tidak valid');
        }

        // Check if the code has expired
        if ($passwordReset->isExpire()) {
            return back()->with('error', 'Kode sudah hangus silahkan ulangi lagi');
        }

        $user = User::firstWhere('email', $passwordReset->email);

        $user->update($request->only('password'));

        $passwordReset::where('email', $passwordReset->email)->delete();


        return redirect('/login')->with('success', 'Password berhasil diganti');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
