<?php

namespace App\Http\Controllers\API;

use App\Models\ResetCodePassword;
use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CodeCheckController extends Controller
{
    /**
     * Check if the code is exist and vaild one (Setp 2)
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

        
        return ApiFormatter::createApi(200, 'Success', $passwordReset->code);
        // return $this->jsonResponse(['code' => $passwordReset->code], trans('passwords.code_is_valid'), 200);
    }
}
