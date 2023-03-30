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
        $productos = [];
        $productosFidepuntos = ProductosFidepuntos::where('compania_id', $id)->where('activo', 1)->get();
        foreach ($productosFidepuntos as $key => $pf) {
            $producto_tmp = array(
                'id' => $pf->id,
                'nombre_producto' => $pf->nombre_producto,
                'codigo_producto' => $pf->codigo_producto,
                'ean' => $pf->ean,
                'presentacion_talla_tamano' => $pf->presentacion_talla_tamano,
                'fabricante' => $pf->fabricante->nombre_fabricante,
                'marca' => $pf->marca->nombre_marca,
                'categoria' => $pf->categoria->nombre_categoria,
                'compania' => $pf->compania->nombre_compania,
                'inventario' => $pf->inventario,
                'tipo' => $pf->tipo,
                'objetivo' => $pf->objetivo,
                'oferta' => $pf->oferta,
                'precio_unitario' => $pf->precio_unitario,
                'iva' => $pf->iva,
                'impoconsumo' => $pf->impoconsumo,
                'descuento_porcentaje' => $pf->descuento_porcentaje,
                'descuento_valor' => $pf->descuento_valor,
                'precio' => $pf->precio,
                'precio_puntos' => $pf->precio_puntos,
                'fidelizacion' => $pf->fidelizacion,
                'media_id_principal' => $pf->mediaprincial->url,
            );
            array_push($productos, $producto_tmp);
        }
        return $productos;
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
