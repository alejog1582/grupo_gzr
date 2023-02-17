<?php

namespace App\Http\Controllers\Eval_\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\ClienteEval;
use Illuminate\Http\Request;
use App\Http\Resources\Eval_\V1\ClienteEvalResource;

class ClienteEvalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ClienteEvalResource::collection(ClienteEval::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClienteEval  $clienteEval
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $clienteEval = ClienteEval::find($id);
        return new ClienteEvalResource($clienteEval);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClienteEval  $clienteEval
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClienteEval $clienteEval)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClienteEval  $clienteEval
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $clienteEval = ClienteEval::find($id);
        $clienteEval->delete();
        return response()->json([
            'message' => 'Registro Eliminado con Exito'
        ]);
    }
}
