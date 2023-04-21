<?php

namespace App\Http\Controllers\Fidepuntos\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\ProductosFidepuntos;
use App\Models\CompaniasFidepuntos;
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
        $categorias_ecommerce = [];
        $categorias_ecommerce_prov = [];
        $categorias_canje = [];
        $categorias_canje_prov = [];
        $productosEcommerce = [];
        $productosCanje = [];
        $productosFidepuntos = ProductosFidepuntos::where('compania_id', $id)->where('activo', 1)->get();
        //Comentario* Se agrupan los productos por objetivo ecommerce o canje
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
                'inventario' => intval($pf->inventario),
                'cantidad' => 1,
                'tipo' => $pf->tipo,
                'objetivo' => $pf->objetivo,
                'oferta' => $pf->oferta,
                'precio_unitario' => intval($pf->precio_unitario),
                'iva' => intval($pf->iva),
                'impoconsumo' => intval($pf->impoconsumo),
                'descuento_porcentaje' => $pf->descuento_porcentaje,
                'descuento_valor' => intval($pf->descuento_valor),
                'precio' => intval($pf->precio),
                'precio_puntos' => intval($pf->precio_puntos),
                'fidelizacion' => $pf->fidelizacion,
                'media_id_principal' => $pf->mediaprincial->url,
            );
            if ($pf->objetivo == 'ecommerce') {
                array_push($productosEcommerce, $producto_tmp);
            }
            if ($pf->objetivo == 'canje') {
                array_push($productosCanje, $producto_tmp);
            }
        }

        //Comentario* Se extraen las categorias para cada uno de los tipos de productos
        foreach ($productosFidepuntos as $key => $pfcatgeneral) {
            if (!in_array($pfcatgeneral->categoria->nombre_categoria, $categorias_ecommerce_prov) && $pfcatgeneral->objetivo == 'ecommerce') {
                array_push($categorias_ecommerce_prov, $pfcatgeneral->categoria->nombre_categoria);
            }
            if (!in_array($pfcatgeneral->categoria->nombre_categoria, $categorias_canje_prov) && $pfcatgeneral->objetivo == 'canje') {
                array_push($categorias_canje_prov, $pfcatgeneral->categoria->nombre_categoria);
            }
        }

        //Comentario* Se relaciona categorias con prodcutos para tienda ecommerce
        foreach ($categorias_ecommerce_prov as $key => $cep) {
            $prod_cat_ecom_tmp = [];
            foreach ($productosEcommerce as $key => $pec) {
                if ($cep == $pec['categoria']) {
                    array_push($prod_cat_ecom_tmp, $pec);
                }
            }
            $cat_ecommerce_tmp = array(
                'nombre_categoria' => $cep,
                'productos' => $prod_cat_ecom_tmp,
            );
            array_push($categorias_ecommerce, $cat_ecommerce_tmp);
        }

        //Comentario* Se relaciona categorias con prodcutos para catalago
        foreach ($categorias_canje_prov as $key => $ccp) {
            $prod_cat_canje_tmp = [];
            foreach ($productosCanje as $key => $pc) {
                if ($ccp == $pc['categoria']) {
                    array_push($prod_cat_canje_tmp, $pc);
                }
            }
            $cat_canje_tmp = array(
                'nombre_categoria' => $ccp,
                'productos' => $prod_cat_canje_tmp,
            );
            array_push($categorias_canje, $cat_canje_tmp);
        }

        //Comentario* Se construye el objeto final
        return response()->json([
            "tienda_online" => $categorias_ecommerce,
            "catalogo" => $categorias_canje,
        ]);
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
