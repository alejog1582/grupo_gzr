<?php

namespace App\Imports;

use App\Models\ProductosFidepuntos;
use App\Models\CompaniasFidepuntos;
use App\Models\FabricantesFidepuntos;
use App\Models\CategoriasFidepuntos;
use App\Models\MarcasFidepuntos;
use App\Models\LogsImportacionesFidepuntos;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProductosFidepuntosImport implements ToCollection
{
    private $date = null;
    private $identificador_importacion = null;
    private $usuario = null;

    public function  __construct($identificador_importacion,$date)
    {
        $this->identificador_importacion = $identificador_importacion;
        $this->date = $date;
        $this->usuario = \Auth::user();
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $key => $row)
        {
            $row_sin_procesar = null;
            $producto_nuevo = null;
            $registro_log = null;
            $compania_id = null;
            $nombre_producto = null;
            $codigo_producto = null;
            $ean = null;
            $presentacion_talla_tamano = null;
            $fabricante_id = null;
            $marca_id = null;
            $categoria_id = null;
            $inventario = null;
            $tipo = null;
            $objetivo = null;
            $oferta = null;
            $precio_unitario = null;
            $iva = null;
            $impoconsumo = null;
            $descuento_porcentaje = null;
            $descuento_valor = null;
            $precio = null;
            $precio_puntos = null;
            $precio_antes_impuestos = null;
            $fidelizacion = null;

            if ($key != 0) {
                //campo compania id
                if ($row[0] != null) {
                    $compania = CompaniasFidepuntos::find($row[0]);
                    if (isset($compania->id)) {
                        $compania_id = $compania->id;
                    }else{
                        $compania_id = null;
                    }
                }else{
                    $compania_id = null;
                }
                //campo nombre completo
                if ($row[1] != null) {
                    $nombre_producto = ucwords(strtolower($row[1]));
                }else{
                    $nombre_producto = null;
                }
                //Campo Codigo EAN
                if ($row[3] != null) {
                    $ean = $row[3];
                }else{
                    $ean = null;
                }
                //Campo Codigo Producto
                if ($row[2] != null) {
                    $codigo_producto = $row[2];
                }else{
                    if ($ean != null) {
                        $codigo_producto = $ean;
                    }else{
                        $codigo_producto = null;
                    }
                }
                //Campo Presentacion
                if ($row[4] != null) {
                    $presentacion_talla_tamano = $row[4];
                }else{
                    $presentacion_talla_tamano = null;
                }
                //campo Fabricante id
                if ($row[5] != null) {
                    $fabricante = FabricantesFidepuntos::where('nombre_fabricante', ucwords(strtolower($row[5])))->where('compania_id', $compania_id)->get();
                    if (count($fabricante) > 0) {
                        $fabricante_id = $fabricante[0]->id;
                    }else{
                        if ($compania_id != null) {
                            $fabricante_nuevo = FabricantesFidepuntos::create([
                                'nombre_fabricante' => ucwords(strtolower($row[5])),
                                'compania_id' => $compania_id,
                                'activo' => 1,
                            ]);
                            $fabricante_nuevo->save();
                            $fabricante_id = $fabricante_nuevo->id;
                        }else{
                            $fabricante_id = null;
                        }
                    }
                }else{
                    $fabricante_id = null;
                }
                //campo Marca id
                if ($row[6] != null) {
                    $marca = MarcasFidepuntos::where('nombre_marca', ucwords(strtolower($row[6])))->where('compania_id', $compania_id)->where('fabricante_id', $fabricante_id)->get();
                    if (count($marca) > 0) {
                        $marca_id = $marca[0]->id;
                    }else{
                        if ($compania_id != null && $fabricante_id != null) {
                            $marca_nuevo = MarcasFidepuntos::create([
                                'nombre_marca' => ucwords(strtolower($row[6])),
                                'compania_id' => $compania_id,
                                'fabricante_id' => $fabricante_id,
                                'activo' => 1,
                            ]);
                            $marca_nuevo->save();
                            $marca_id = $marca_nuevo->id;
                        }else{
                            $marca_id = null;
                        }
                    }
                }else{
                    $marca_id = null;
                }
                //campo Categoria
                if ($row[7] != null) {
                    $categoria = CategoriasFidepuntos::where('nombre_categoria', ucwords(strtolower($row[7])))->where('compania_id', $compania_id)->get();
                    if (count($categoria) > 0) {
                        $categoria_id = $categoria[0]->id;
                    }else{
                        if ($compania_id != null) {
                            $categoria_nuevo = CategoriasFidepuntos::create([
                                'nombre_categoria' => ucwords(strtolower($row[7])),
                                'compania_id' => $compania_id,
                                'activo' => 1,
                            ]);
                            $categoria_nuevo->save();
                            $categoria_id = $categoria_nuevo->id;
                        }else{
                            $categoria_generica = CategoriasFidepuntos::where('nombre_categoria', 'Generica')->where('compania_id', $compania_id)->get();
                            $categoria_id = $categoria_generica[0]->id;
                        }
                    }
                }else{
                    $categoria_generica = CategoriasFidepuntos::where('nombre_categoria', 'Generica')->where('compania_id', $compania_id)->get();
                    $categoria_id = $categoria_generica[0]->id;
                }
                //Campo Inventario
                if ($row[8] != null) {
                    $inventario = $row[8];
                }else{
                    $inventario = null;
                }
                //campo tipo
                if ($row[9] != null) {
                    if ($row[9] == "producto" || $row[9] == "servicio") {
                        $tipo = $row[9];
                    }else{
                        $tipo = null;
                    }
                }else{
                    $tipo = null;
                }
                //campo objetivo
                if ($row[10] != null) {
                    if ($row[10] == "ecommerce" || $row[10] == "canje" || $row[10] == "mixto") {
                        $objetivo = $row[10];
                    }else{
                        $objetivo = null;
                    }
                }else{
                    $objetivo = null;
                }
                //campo precio unitario
                if ($row[14] != null) {
                    if (is_int($row[14])) {
                        $precio_unitario = $row[14];
                    }else{
                        $precio_unitario = 0;
                    }
                }else{
                    $precio_unitario = 0;
                }
                //Campo Oferta
                if ($row[11] != null) {
                    if ($row[11] == "1") {
                        $oferta = $row[11];
                    }else{
                        $oferta = 0;
                    }
                }else{
                    $oferta = 0;
                }
                //Campo Descuento Porcentaje
                if ($row[12] != null) {
                    if ($oferta == 1) {
                        if (is_int($row[12]) && $row[12] > 100) {
                            $descuento_porcentaje = 0;
                            $descuento_valor = 0;
                        }else{
                            $descuento_porcentaje = $row[12];
                            $descuento_valor = ($precio_unitario * $descuento_porcentaje) / 100;
                        }
                    }else{
                        $descuento_porcentaje = 0;
                        $descuento_valor = 0;
                    }
                }else{
                    $descuento_porcentaje = 0;
                }
                //Campo Descuento Valor
                if ($row[13] != null) {
                    if ($oferta == 1) {
                        if (is_int($row[13])) {
                            $descuento_valor = $row[13];
                            $descuento_porcentaje = ($descuento_valor / $precio_unitario) * 100;
                        }else{
                            if ($descuento_valor == 0 || $descuento_valor == null) {
                                $descuento_valor = 0;
                            }
                        }
                    }else{
                        $descuento_porcentaje = 0;
                        $descuento_valor = 0;
                    }
                }else{
                    if ($descuento_valor == 0 || $descuento_valor == null) {
                        $descuento_valor = 0;
                    }
                }

                $precio_antes_impuestos = $precio_unitario - $descuento_valor;

                // Campo IVA
                if ($row[15] != null) {
                    if ($row[15] == 1) {
                        $iva = $precio_antes_impuestos * 1.19;
                    }else{
                        $iva = 0;
                    }
                }else{
                    $iva = 0;
                }
                // Campo Impoconsumo
                if ($row[16] != null) {
                    if (is_int($row[16]) && $row[16] < 100) {
                        $impoconsumo =  ($precio_antes_impuestos * $row[16]) / 100;
                    }else{
                        $impoconsumo = 0;
                    }
                }else{
                    $impoconsumo = 0;
                }
                //campo precio puntos
                if ($row[17] != null) {
                    $precio_puntos = $row[17];
                }else{
                    $precio_puntos = 0;
                }
                //campo Fidelizacion
                if ($row[18] != null) {
                    if ($row[18] == 1) {
                        $fidelizacion = 1;
                    }else{
                        $fidelizacion = 0;
                    }
                }else{
                    $fidelizacion = 0;
                }

                $precio = $precio_antes_impuestos + $iva + $impoconsumo;

                if ($compania_id == null || $tipo == null || $nombre_producto == null || $codigo_producto == null
                    || $fabricante_id == null ||  $marca_id == null || $objetivo == null) {
                    $row_sin_procesar = array(
                        'compania_id' => $compania_id,
                        'nombre_producto' => $nombre_producto,
                        'codigo_producto' => $codigo_producto,
                        'ean' => $ean,
                        'presentacion_talla_tamano' => $presentacion_talla_tamano,
                        'fabricante_id' => $fabricante_id,
                        'marca_id' => $marca_id,
                        'categoria_id' => $categoria_id,
                        'inventario' => $inventario,
                        'activo' => 1,
                        'tipo' => $tipo,
                        'objetivo' => $objetivo,
                        'oferta' => $oferta,
                        'precio_unitario' => $precio_unitario,
                        'iva' => $iva,
                        'impoconsumo' => $impoconsumo,
                        'descuento_porcentaje' => $descuento_porcentaje,
                        'descuento_valor' => $descuento_valor,
                        'precio' => $precio,
                        'precio_puntos' => $precio_puntos,
                        'fidelizacion' => $fidelizacion,
                    );
                    $registro_log = LogsImportacionesFidepuntos::create([
                        'proceso' => 'productos',
                        'identificador_importacion' => $this->identificador_importacion,
                        'fecha_ejecucion' => $this->date,
                        'user_id' => $this->usuario->id,
                        'tipo_cargue' => 'excel',
                        'numero_fila_excel' => $key + 1,
                        'resultado' => 'declinado',
                        'motivo_decline' => 'campos requeridos vacios',
                        'data' => json_encode( $row_sin_procesar ),
                    ]);
                    $registro_log->save();
                    continue;
                }else{
                    $producto = ProductosFidepuntos::where('codigo_producto', $codigo_producto)->Where('compania_id', $compania_id)->get();
                    if (count($producto) > 0) {
                        $row_sin_procesar = array(
                            'compania_id' => $compania_id,
                            'nombre_producto' => $nombre_producto,
                            'codigo_producto' => $codigo_producto,
                            'ean' => $ean,
                            'presentacion_talla_tamano' => $presentacion_talla_tamano,
                            'fabricante_id' => $fabricante_id,
                            'marca_id' => $marca_id,
                            'categoria_id' => $categoria_id,
                            'inventario' => $inventario,
                            'activo' => 1,
                            'tipo' => $tipo,
                            'objetivo' => $objetivo,
                            'oferta' => $oferta,
                            'precio_unitario' => $precio_unitario,
                            'iva' => $iva,
                            'impoconsumo' => $impoconsumo,
                            'descuento_porcentaje' => $descuento_porcentaje,
                            'descuento_valor' => $descuento_valor,
                            'precio' => $precio,
                            'precio_puntos' => $precio_puntos,
                            'fidelizacion' => $fidelizacion,
                        );
                        $registro_log = LogsImportacionesFidepuntos::create([
                            'proceso' => 'productos',
                            'identificador_importacion' => $this->identificador_importacion,
                            'fecha_ejecucion' => $this->date,
                            'user_id' => $this->usuario->id,
                            'tipo_cargue' => 'excel',
                            'numero_fila_excel' => $key + 1,
                            'resultado' => 'declinado',
                            'motivo_decline' => 'producto ya existe',
                            'data' => json_encode( $row_sin_procesar ),
                        ]);
                        $registro_log->save();
                        continue;
                    }else{
                        $producto_nuevo = ProductosFidepuntos::create([
                            'compania_id' => $compania_id,
                            'nombre_producto' => $nombre_producto,
                            'codigo_producto' => $codigo_producto,
                            'ean' => $ean,
                            'presentacion_talla_tamano' => $presentacion_talla_tamano,
                            'fabricante_id' => $fabricante_id,
                            'marca_id' => $marca_id,
                            'categoria_id' => $categoria_id,
                            'inventario' => $inventario,
                            'activo' => 1,
                            'tipo' => $tipo,
                            'objetivo' => $objetivo,
                            'oferta' => $oferta,
                            'precio_unitario' => $precio_unitario,
                            'iva' => $iva,
                            'impoconsumo' => $impoconsumo,
                            'descuento_porcentaje' => $descuento_porcentaje,
                            'descuento_valor' => $descuento_valor,
                            'precio' => $precio,
                            'precio_puntos' => $precio_puntos,
                            'fidelizacion' => $fidelizacion,
                            'media_id_principal' => 1,
                        ]);
                        $producto_nuevo->save();
                        $registro_log = LogsImportacionesFidepuntos::create([
                            'proceso' => 'productos',
                            'identificador_importacion' => $this->identificador_importacion,
                            'fecha_ejecucion' => $this->date,
                            'user_id' => $this->usuario->id,
                            'tipo_cargue' => 'excel',
                            'numero_fila_excel' => $key + 1,
                            'resultado' => 'exitoso',
                            'data' => json_encode( $producto_nuevo ),
                        ]);
                        $registro_log->save();
                    }
                }
            }else{
                continue;
            }

        }
        return true;
    }

}
