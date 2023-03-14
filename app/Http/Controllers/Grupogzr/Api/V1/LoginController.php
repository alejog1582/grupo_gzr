<?php

namespace App\Http\Controllers\Grupogzr\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Logins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->identificacion == null || $request->password == null) {
            return response()->json([
                "status" => 400,
                "code" => 34,
                "content" => "No existe el campo de identificacion o password",
            ]);
        }

        $login = Logins::where('identificacion', $request->identificacion)->first();
        if (isset($login->id)) {
            if(password_verify($request->password, $login->password) === TRUE){
                $token = $login->createToken($request->identificacion)->plainTextToken;
                return response()->json([
                    "status" => 200,
                    "access_token" => $token,
                    "content" => "Success",
                ]);
              }else{
                return response()->json([
                    "status" => 400,
                    "code" => 34,
                    "content" => "Credenciales Incorrectas",
                ]);
              }
        }else{
            return response()->json([
                "status" => 400,
                "code" => 34,
                "content" => "Usuario no existe",
            ]);
        }
        dd($request->identificacion);
        dd($request->password);
        /* return response()->json([
            "status" => 200,
            "code" => 34,
            "content" => "Acceso incorrecto",
        ]); */
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Logins  $logins
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $loginFidepunto = Logins::find($id);
        return new LoginsResource($loginFidepunto);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Logins  $logins
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Logins $logins)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Logins  $logins
     * @return \Illuminate\Http\Response
     */
    public function destroy(Logins $logins)
    {
        //
    }
}
