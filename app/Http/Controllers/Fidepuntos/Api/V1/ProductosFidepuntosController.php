<?php

namespace App\Http\Controllers\Fidepuntos\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\ProductosFidepuntos;
use Illuminate\Http\Request;

class ProductosFidepuntosController extends Controller
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
     * @param  \App\Models\ProductosFidepuntos  $productosFidepuntos
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $productosFidepuntos = ProductosFidepuntos::where('compania_id', $id)->where('activo', 1)->get();
        return $productosFidepuntos;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductosFidepuntos  $productosFidepuntos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductosFidepuntos $productosFidepuntos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductosFidepuntos  $productosFidepuntos
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductosFidepuntos $productosFidepuntos)
    {
        //
    }
}
