<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use App\Models\ProductosFidepuntos;
use App\Models\FabricantesFidepuntos;
use App\Models\MarcasFidepuntos;
use App\Models\CategoriasFidepuntos;
//use Log;

class ActualizacionProductosFidepuntos implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private $client;
    private $actualizados = 0;
    private $creados = 0;
    private $compania_id = null;
    private $nombre_compania = null;
    private $endpoint = null;
    private $token = null;
    private $data_connection = null;

    public function __construct($compania_id, $nombre_compania, $endpoint, $token, $data_connection)
    {
        $this->compania_id = $compania_id;
        $this->nombre_compania = $nombre_compania;
        $this->endpoint = $endpoint;
        $this->token = $token;
        $this->data_connection = $data_connection;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info("Inicia actualizacion productos compañia: " . $this->nombre_compania);
        $response = Http::get($this->endpoint . 'GetArticulos');
        $servicio = $response->json($key = null, $default = null);
        $productos = $servicio['Articulos'];
        Log::info("Numero de productos : " . count($productos));
        foreach ($productos as $key => $p) {
            if ($key < 11) {
                $producto = ProductosFidepuntos::where('codigo_producto', $p['Codigo'])->Where('compania_id', $this->compania_id)->get();
                if (count($producto) > 0) {
                    foreach ($producto as $key => $p_bd) {
                        $this->actualizados = $this->actualizados + 1;
                        Log::info("Se actualizo producto. Nombre: " . $p['Descripcion']);
                    }
                }else{
                    $precio_unitario = rand(1000, 100000);
                    $iva = $precio_unitario * 0.19;
                    $precio = $precio_unitario + $iva;
                    $fabricante = FabricantesFidepuntos::where('nombre_fabricante', ucwords(strtolower($p['Marca'])))->where('compania_id', $this->compania_id)->get();
                    if (count($fabricante) > 0) {
                        $fabricante_id = $fabricante[0]->id;
                    }else{
                        $fabricante_nuevo = FabricantesFidepuntos::create([
                            'nombre_fabricante' => ucwords(strtolower($p['Marca'])),
                            'compania_id' => $this->compania_id,
                            'activo' => 1,
                        ]);
                        $fabricante_nuevo->save();
                        $fabricante_id = $fabricante_nuevo->id;
                    }
                    $marca = MarcasFidepuntos::where('nombre_marca', ucwords(strtolower($p['Linea'])))->where('compania_id', $this->compania_id)->where('fabricante_id', $fabricante_id)->get();
                    if (count($marca) > 0) {
                        $marca_id = $marca[0]->id;
                    }else{
                        $marca_nuevo = MarcasFidepuntos::create([
                            'nombre_marca' => ucwords(strtolower($p['Linea'])),
                            'compania_id' => $this->compania_id,
                            'fabricante_id' => $fabricante_id,
                            'activo' => 1,
                        ]);
                        $marca_nuevo->save();
                        $marca_id = $marca_nuevo->id;
                    }
                    $categoria = CategoriasFidepuntos::where('nombre_categoria', ucwords(strtolower($p['Categoria'])))->where('compania_id', $this->compania_id)->get();
                    if (count($categoria) > 0) {
                        $categoria_id = $categoria[0]->id;
                    }else{
                        $categoria_nuevo = CategoriasFidepuntos::create([
                            'nombre_categoria' => ucwords(strtolower($p['Categoria'])),
                            'compania_id' => $this->compania_id,
                            'activo' => 1,
                        ]);
                        $categoria_nuevo->save();
                        $categoria_id = $categoria_nuevo->id;
                    }
                    $producto_nuevo = ProductosFidepuntos::create([
                        'compania_id' => $this->compania_id,
                        'nombre_producto' => $p['Descripcion'],
                        'codigo_producto' => $p['Codigo'],
                        'ean' => $p['CodBarras'],
                        'presentacion_talla_tamano' => $p['Embalaje'],
                        'fabricante_id' => $fabricante_id,
                        'marca_id' => $marca_id,
                        'categoria_id' => $categoria_id,
                        'inventario' => '1',
                        'activo' => 1,
                        'tipo' => 'producto',
                        'objetivo' => 'ecommerce',
                        'oferta' => '0',
                        'precio_unitario' => $precio_unitario,
                        'iva' => $iva,
                        'impoconsumo' => 0,
                        'descuento_porcentaje' => 0,
                        'descuento_valor' => 0,
                        'precio' => $precio,
                        'precio_puntos' => 0,
                        'fidelizacion' => 0,
                        'media_id_principal' => 1,
                    ]);
                    $producto_nuevo->save();
                    $this->creados = $this->creados + 1;
                    Log::info("se creo producto. Nombre: " . $p['Descripcion']);
                }
            }else{
                break;
            }
        }
        Log::info("Clientes Creados: " . $this->creados);
        Log::info("Clientes Actualizados: " . $this->actualizados);
        Log::info("Finaliza actualizacion clienes compañia: " . $this->nombre_compania);
    }
}
