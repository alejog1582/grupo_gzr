<?php

namespace App\Http\Controllers\Fidepuntos\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\PedidosFidepuntos;
use App\Models\CompaniasFidepuntos;
use App\Models\ClienteFidepuntos;
use App\Models\ProductosFidepuntos;
use App\Models\PedidosxProductosFidepuntos;
use App\Models\PlanPuntosxCompaniaFidepuntos;
use App\Models\PuntosxComprasFidepuntos;
use App\Models\MovimientosPuntosFidepuntos;
use App\Models\PuntosxproductosFidepuntos;
use App\Models\ConfigFidelizacionClientesFidepuntos;
use App\Models\FidelizacionClientesFidepuntos;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PedidosFidepuntosController extends Controller
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
        $valor_pedido = 0;
        $puntos_asignar_compras = 0;
        $puntos_asignar_productos = 0;
        $compania = CompaniasFidepuntos::where('nombre_compania', $request->compania)->first();
        $cliente = ClienteFidepuntos::where('identificacion', $request->identificacion)->where('compania_id', $compania->id)->first();
        $productos = $request->products;
        $cod_aleatorio = rand(1000000,9999999);
        $cod_pedido = $compania->id . "-" . $cod_aleatorio;
        $date = Carbon::now();
        $pedido_nuevo = PedidosFidepuntos::create([
            'codigo_pedido' => $cod_pedido,
            'valor_pedido' => $valor_pedido,
            'estado_pedido' => 1,
            'compania_id' => $compania->id,
            'identificacion_cliente' => $cliente->identificacion,
            'cliente_id' => $cliente->id,
            'fecha_envio' => $date,
            'metodo_pago' => $request->metodopago,
            'fecha_pago' => $date,
        ]);
        $pedido_nuevo->save();
        foreach ($productos as $key => $prod) {
            $producto_tmp = ProductosFidepuntos::find($prod["id"]);
            $pedidoxproducto_nuevo = PedidosxProductosFidepuntos::create([
                'pedido_id' => $pedido_nuevo->id,
                'codigo_producto' => $prod["codigo_producto"],
                'producto_id' => $prod["id"],
                'cantidad' => $prod["cantidad"],
                'objetivo' => $producto_tmp->objetivo,
                'oferta' => $prod["oferta"],
                'precio_unitario' => $prod["precio_unitario"],
                'iva' => $prod["iva"],
                'impoconsumo' => $prod["impoconsumo"],
                'descuento_porcentaje' => $prod["descuento_porcentaje"],
                'descuento_valor' => $prod["descuento_valor"],
                'precio' => $prod["precio"],
                'precio_puntos' => $prod["precio_puntos"],
                'fidelizacion' => $prod["fidelizacion"],
            ]);
            $pedidoxproducto_nuevo->save();
            $valor_pedido = $valor_pedido + ($prod["precio"] * $prod["cantidad"]);
            $pedido_nuevo->valor_pedido = $valor_pedido;
            $pedido_nuevo->save();
        }
        // Se valida si la compañia cuenta con plan puntos x compra
        $plan_puntosxcompras = PlanPuntosxCompaniaFidepuntos::where('compania_id', $compania->id)->where('plan_puntos_id', '1')->first();
        if ($plan_puntosxcompras) {
            $config_puntosxcompra = PuntosxComprasFidepuntos::where('plan_puntos_compania_id', $plan_puntosxcompras->id)->first();
            $puntos_asignar_compras = round($valor_pedido / $config_puntosxcompra->valor_punto);
            $movimiento_puntos_compra_nuevo = MovimientosPuntosFidepuntos::create([
                'pedido_id' => $pedido_nuevo->id,
                'puntaje_anterior' => $cliente->puntos_total,
                'tipo' => "compras",
                'puntos_compras_id' => $config_puntosxcompra->id,
                'puntos_otrogados' => $puntos_asignar_compras,
                'puntos_actuales' => $cliente->puntos_total + $puntos_asignar_compras,
            ]);
            $movimiento_puntos_compra_nuevo->save();
            $cliente->puntos_total = $cliente->puntos_total + $puntos_asignar_compras;
            $cliente->save();
        }
        // Se valida si la compañia cuenta con plan puntos x producto
        $plan_puntosxproductos = PlanPuntosxCompaniaFidepuntos::where('compania_id', $compania->id)->where('plan_puntos_id', '2')->first();
        if ($plan_puntosxproductos) {
            $config_puntosxproductos = PuntosxproductosFidepuntos::where('plan_puntos_compania_id', $plan_puntosxproductos->id)->get();
            foreach ($productos as $key => $prod_selec) {
                $producto_aplicar_puntos = ProductosFidepuntos::find($prod_selec["id"]);
                foreach ($config_puntosxproductos as $key => $cpp) {
                    if ($cpp->fabricante_id != null && $producto_aplicar_puntos->fabricante_id == $cpp->fabricante_id) {
                        $puntos_asignar_productos = $puntos_asignar_productos + $cpp->puntaje_asignado;
                        $movimiento_puntos_fabricante_nuevo = MovimientosPuntosFidepuntos::create([
                            'pedido_id' => $pedido_nuevo->id,
                            'puntaje_anterior' => $cliente->puntos_total,
                            'tipo' => "productos",
                            'puntos_productos_id' => $cpp->id,
                            'puntos_otrogados' => $cpp->puntaje_asignado,
                            'puntos_actuales' => $cliente->puntos_total + $puntos_asignar_productos,
                        ]);
                        $movimiento_puntos_fabricante_nuevo->save();
                        $cliente->puntos_total = $cliente->puntos_total + $puntos_asignar_productos;
                        $cliente->save();
                        $puntos_asignar_productos = 0;
                    }
                    if ($cpp->marca_id != null && $producto_aplicar_puntos->marca_id == $cpp->marca_id) {
                        $puntos_asignar_productos = $puntos_asignar_productos + $cpp->puntaje_asignado;
                        $movimiento_puntos_marca_nuevo = MovimientosPuntosFidepuntos::create([
                            'pedido_id' => $pedido_nuevo->id,
                            'puntaje_anterior' => $cliente->puntos_total,
                            'tipo' => "productos",
                            'puntos_productos_id' => $cpp->id,
                            'puntos_otrogados' => $cpp->puntaje_asignado,
                            'puntos_actuales' => $cliente->puntos_total + $puntos_asignar_productos,
                        ]);
                        $movimiento_puntos_marca_nuevo->save();
                        $cliente->puntos_total = $cliente->puntos_total + $puntos_asignar_productos;
                        $cliente->save();
                        $puntos_asignar_productos = 0;
                    }
                    if ($cpp->categoria_id != null && $producto_aplicar_puntos->categoria_id == $cpp->categoria_id) {
                        $puntos_asignar_productos = $puntos_asignar_productos + $cpp->puntaje_asignado;
                        $movimiento_puntos_categorias_nuevo = MovimientosPuntosFidepuntos::create([
                            'pedido_id' => $pedido_nuevo->id,
                            'puntaje_anterior' => $cliente->puntos_total,
                            'tipo' => "productos",
                            'puntos_productos_id' => $cpp->id,
                            'puntos_otrogados' => $cpp->puntaje_asignado,
                            'puntos_actuales' => $cliente->puntos_total + $puntos_asignar_productos,
                        ]);
                        $movimiento_puntos_categorias_nuevo->save();
                        $cliente->puntos_total = $cliente->puntos_total + $puntos_asignar_productos;
                        $cliente->save();
                        $puntos_asignar_productos = 0;
                    }
                    if ($cpp->producto_id != null && $producto_aplicar_puntos->id == $cpp->producto_id) {
                        $puntos_asignar_productos = $puntos_asignar_productos + $cpp->puntaje_asignado;
                        $movimiento_puntos_producto_nuevo = MovimientosPuntosFidepuntos::create([
                            'pedido_id' => $pedido_nuevo->id,
                            'puntaje_anterior' => $cliente->puntos_total,
                            'tipo' => "productos",
                            'puntos_productos_id' => $cpp->id,
                            'puntos_otrogados' => $cpp->puntaje_asignado,
                            'puntos_actuales' => $cliente->puntos_total + $puntos_asignar_productos,
                        ]);
                        $movimiento_puntos_producto_nuevo->save();
                        $cliente->puntos_total = $cliente->puntos_total + $puntos_asignar_productos;
                        $cliente->save();
                        $puntos_asignar_productos = 0;
                    }
                }
            }
        }
        // Se valida si hay productos con Fidelizacion de clientes
        $plan_fidelizacion = PlanPuntosxCompaniaFidepuntos::where('compania_id', $compania->id)->where('plan_puntos_id', '3')->first();
        if ($plan_fidelizacion) {
            $config_fidelizacion = ConfigFidelizacionClientesFidepuntos::where('plan_puntos_compania_id', $plan_fidelizacion->id)->get();
            foreach ($config_fidelizacion as $key => $cf) {
                foreach ($productos as $key => $prod_fidelizacion) {
                    if ($cf->producto_id ==  $prod_fidelizacion["id"]) {
                        $fidelizacion_nuevo = FidelizacionClientesFidepuntos::create([
                            'config_fidelizacion_cliente_id' => $cf->id,
                            'pedido_id' => $pedido_nuevo->id,
                            'canjeado' => 0,
                        ]);
                        $fidelizacion_nuevo->save();
                    }
                }
            }
        }

        return response()->json([
            "status" => 200,
            "code" => 34,
            "content" => "Pedido creado con exito",
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PedidosFidepuntos  $pedidosFidepuntos
     * @return \Illuminate\Http\Response
     */
    public function show(PedidosFidepuntos $pedidosFidepuntos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PedidosFidepuntos  $pedidosFidepuntos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PedidosFidepuntos $pedidosFidepuntos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PedidosFidepuntos  $pedidosFidepuntos
     * @return \Illuminate\Http\Response
     */
    public function destroy(PedidosFidepuntos $pedidosFidepuntos)
    {
        //
    }
}
