<?php

namespace App\Http\Controllers\Fidepuntos\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\ClienteFidepuntos;
use Illuminate\Http\Request;
use App\Http\Resources\Fidepuntos\V1\ClienteFidepuntosResource;

class ClienteFidepuntosController extends Controller
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
        return response()->json([
            "status" => 200,
            "code" => 34,
            "content" => "Acceso incorrecto",
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClienteFidepuntos  $clienteFidepuntos
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $clienteFidepunto = ClienteFidepuntos::find($id);
        return new ClienteFidepuntosResource($clienteFidepunto);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClienteFidepuntos  $clienteFidepuntos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClienteFidepuntos $clienteFidepuntos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClienteFidepuntos  $clienteFidepuntos
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClienteFidepuntos $clienteFidepuntos)
    {
        //
    }
}