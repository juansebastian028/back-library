<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    protected function sendResetLinkResponse(Request $request)
    {
        $input = $request->only('email');

        $validator = Validator::make($input, [
            'email' => "required|email"
        ]);

        if ($validator->fails()) {
            return response(['errors'=> $validator->errors()->all() ], 422);
        }
        
        $response =  Password::sendResetLink($input);

        if ($response == Password::RESET_LINK_SENT) {
            $message = "Correo enviado con éxito";
        } else {
            $message = "No se pudo enviar el correo";
        }

        $response = ['data' => '', 'message' => $message];
        return response($response, 200);
    }
    
}
