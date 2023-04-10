<?php

namespace App\Http\Controllers\Fidepuntos\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\MensajesFidepuntos;
use Illuminate\Http\Request;

class MensajesFidepuntosController extends Controller
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
        $tipo = null;
        $nombre = null;
        $email = null;
        $celular = null;
        $plan_cotizacion = null;
        $nombre_empresa = null;
        $mensaje = null;

        if ($request->tipo && $request->tipo != null) {
            $tipo = $request->tipo;
        }else{
            $tipo = 'mensaje';
        }
        if ($request->nombre && $request->nombre != null) {
            $nombre = $request->nombre;
        }
        if ($request->email && $request->email != null) {
            $email = $request->email;
        }
        if ($request->celular && $request->celular != null) {
            $celular = $request->celular;
        }
        if ($request->plan_cotizacion && $request->plan_cotizacion != null) {
            $plan_cotizacion = $request->plan_cotizacion;
        }
        if ($request->nombre_empresa && $request->nombre_empresa != null) {
            $nombre_empresa = $request->nombre_empresa;
        }
        if ($request->mensaje && $request->mensaje != null) {
            $mensaje = $request->mensaje;
        }
        $mensaje_nuevo = MensajesFidepuntos::create([
            'tipo' => $tipo,
            'nombre' => $nombre,
            'email' => $email,
            'celular' => $celular,
            'plan_cotizacion' => $plan_cotizacion,
            'nombre_empresa' => $nombre_empresa,
            'mensaje' => $mensaje,
            'estado' => 'nuevo'
        ]);
        $mensaje_nuevo->save();

        return response()->json([
            "status" => 200,
            "code" => 34,
            "content" => "Mensaje creado con exito",
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MensajesFidepuntos  $mensajesFidepuntos
     * @return \Illuminate\Http\Response
     */
    public function show(MensajesFidepuntos $mensajesFidepuntos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MensajesFidepuntos  $mensajesFidepuntos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MensajesFidepuntos $mensajesFidepuntos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MensajesFidepuntos  $mensajesFidepuntos
     * @return \Illuminate\Http\Response
     */
    public function destroy(MensajesFidepuntos $mensajesFidepuntos)
    {
        //
    }
}
