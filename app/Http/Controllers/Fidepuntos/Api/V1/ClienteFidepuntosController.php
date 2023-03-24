<?php

namespace App\Http\Controllers\Fidepuntos\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\ClienteFidepuntos;
use App\Models\ProductosFidepuntos;
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
        $productosEcommerce = [];
        $productosCanje = [];
        $productosMixto = [];
        $clienteFidepunto = ClienteFidepuntos::where('identificacion', $id)->first();
        $productosFidepunto = ProductosFidepuntos::where('compania_id', $clienteFidepunto->compania_id)->where('activo', 1)->get();
        foreach ($productosFidepunto as $key => $pf) {
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
            if ($pf->objetivo == 'ecommerce') {
                array_push($productosEcommerce, $producto_tmp);
            }
            if ($pf->objetivo == 'canje') {
                array_push($productosCanje, $producto_tmp);
            }
            if ($pf->objetivo == 'mixto') {
                array_push($productosMixto, $producto_tmp);
            }
        }
        /* return new ClienteFidepuntosResource($clienteFidepunto); */
        return response()->json([
            "status" => 200,
            "content" => "Success",
            "id" => $clienteFidepunto->id,
            "tipo" => $clienteFidepunto->tipo,
            "identificacion" => $clienteFidepunto->identificacion,
            "nombre_completo" => $clienteFidepunto->nombre_completo,
            "nombre_comercial" => $clienteFidepunto->nombre_comercial,
            "puntos" => $clienteFidepunto->puntos_total,
            "celular" => $clienteFidepunto->celular,
            "telefono" => $clienteFidepunto->telefono,
            "email" => $clienteFidepunto->email,
            "direccion" => $clienteFidepunto->direccion,
            "ciudad" => $clienteFidepunto->ciudad,
            "barrio" => $clienteFidepunto->barrio,
            "compania" => $clienteFidepunto->compania->nombre_compania,
            "productos_ecommerce" => $productosEcommerce,
            "productos_canje" => $productosCanje,
            "productos_mixto" => $productosMixto,
        ]);
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
