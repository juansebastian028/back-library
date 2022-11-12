<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Auth\Events\Registered;

class PassportAuthController extends Controller
{
    public function register(Request $request)
    {
        // if($image = $request->file('img')){
        //     $img_name = $image->getClientOriginalName();
        //     $image->move('uploads', $image->getClientOriginalName());
        // }

        $user = User::create([
            'cedula'=> $request->cedula,
            'nombre'=> $request->nombre,
            'apellidos'=> $request->apellidos,
            'fecha_nacimiento'=> $request->fecha_nacimiento,
            'genero'=> $request->genero,
            'email'=> $request->email,
            'rol_id'=> $request->rol_id,
            'noticias'=> $request->noticias,
            'nombre_usuario'=> $request->nombre_usuario,
            'password'=> bcrypt($request->password),
            // 'foto'=> asset('/uploads/' . $img_name),
        ]);
        $rol = $user->rol()->first();

        $token = $this->createToken($user);

        event(new Registered($user));

        return response()->json([
            'token' => $token->accessToken,
            'rol' => $rol,
            'user' => $user
        ]);
    }

    public function login(Request $request)
    {
        $data = $request->all();
  
        $fieldType = filter_var($request->usuario, FILTER_VALIDATE_EMAIL) ? 'email' : 'nombre_usuario';

        if(Auth::attempt( [$fieldType=>$data['usuario'], 'password' => $data['password']] )){
            
            $user = Auth::user();
            $rol = $user->rol()->first();
            
            $token = $this->createToken($user);

            return response()->json([
                'token' => $token->accessToken,
                'rol' => $rol,
                'user' => $user
            ]);
        }else{
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function createToken($user)
    {
        $userRole = $user->rol()->first();
              
        if ($userRole) {
            $this->scope = $userRole->type;
        }

        return $user->createToken($user->email.'-'.now(), [$this->scope]);
    }
}
