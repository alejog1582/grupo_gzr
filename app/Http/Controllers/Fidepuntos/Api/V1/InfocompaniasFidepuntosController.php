<?php

namespace App\Http\Controllers\Fidepuntos\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\CompaniasFidepuntos;
use Illuminate\Http\Request;

class InfocompaniasFidepuntosController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CompaniasFidepuntos  $companiasFidepuntos
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $compania = CompaniasFidepuntos::find($id);

        return response()->json([
            "img_logo" => $compania->img_logo,
            "valor_minimo_compra" => intval($compania->valor_minimo_compra),
            "tiempo_entrega" => intval($compania->tiempo_entrega),
            "pedio_express" => intval($compania->pedio_express),
            "costo_pedio_express" => intval($compania->costo_pedio_express),
            "valida_stock" => intval($compania->valida_stock),
            "costo_envio" => intval($compania->costo_envio),
            "tope_compra_costo_cero" => intval($compania->costo_pedio_express),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CompaniasFidepuntos  $companiasFidepuntos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CompaniasFidepuntos $companiasFidepuntos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CompaniasFidepuntos  $companiasFidepuntos
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompaniasFidepuntos $companiasFidepuntos)
    {
        //
    }
}
