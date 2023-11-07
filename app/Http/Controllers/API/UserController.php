<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;

use App\Helpers\ApiFormatter;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class UserController extends Controller
{

    public function Register(Request $request){





            $request->validate([
               'nim' => ['required', 'integer', 'unique:users'],
               'nama' => ['required', 'string', 'max:255'],
               'password' => ['required', 'string'],
            ]);

            User::create([
                'nim' => $request->nim,
                'nama' => $request->nama,
                'password' => Hash::make($request->password)
            ]);

            $user = User::where('nim', $request->nim)->first();

            $tokenresult= $user->createToken('authToken')->plainTextToken;

            return ApiFormatter::createApi(200,
                'user terdaftar',
                ['access_token' => $tokenresult,
            'token_type' => 'Bearer',
            'user' => $user]);



    }

    public function login(Request $request){


        try{
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = request(['email', 'password']);

        if(!Auth::attempt($credentials)){
            return ApiFormatter::createApi(500, 'unauthorized user');
        }

            $user = User::where('email', $request->email)->first();

            if(! Hash::check($request->password, $user->password, [])) {
                throw new  \Exception('Invalid Credentials');
            }

            $tokenresult = $user->createToken('authToken')->plainTextToken;
            return ApiFormatter::createApi(200, 'login berhasil',
            [
                'access_token' => $tokenresult,
            'token_type' => 'Bearer',
            'user' => $user
            ]);

        } catch (Exception $error){
            return ApiFormatter::createApi(500, 'Error');
        }
        }

        public function user(Request $request){
            return ApiFormatter::createApi(200, 'data profile', $request->user());
        }

        public function logout(Request $request){

            $token = $request->user()->currentAccessToken()->delete();
            return ApiFormatter::createApi(200, 'Berhasil Logout', $token);
        }
}
