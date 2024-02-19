<?php

namespace App\Http\Controllers\API;

use App\helpers\ApiFormatter;
use App\Models\ResetCodePassword;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\ResetPasswordRequest;

class ResetPasswordController extends Controller
{
    /**
     * Change the password (Setp 3)
     *
     * @param  mixed $request
     * @return void
     */
    public function __invoke(Request $request)


    {



        $passwordReset = ResetCodePassword::firstWhere('code', $request->code);

        if ($passwordReset->isExpire()) {

            return ApiFormatter::createApi(422, 'passwords.code_is_expire');
        }

        $user = User::firstWhere('email', $passwordReset->email);

        $user->update($request->only('password'));

        $passwordReset::where('email', $passwordReset->email)->delete();


        return ApiFormatter::createApi(200, 'Reset Password Success');
    }
}
