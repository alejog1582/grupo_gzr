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
use App\Models\ClienteFidepuntos;
use App\Models\Logins;
//use Log;

class ActualizacionClientesFidepuntos implements ShouldQueue
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
        Log::info("Inicia actualizacion clienes compañia: " . $this->nombre_compania);
        $response = Http::get($this->endpoint . 'GetClientsGen');
        $servicio = $response->json($key = null, $default = null);
        $clientes = $servicio['Clientes'];
        Log::info("Numero de clientes : " . count($clientes));
        foreach ($clientes as $key => $c) {
            if ($key < 11) {
                $cliente = ClienteFidepuntos::where('identificacion', $c['Identificacion'])->Where('compania_id', $this->compania_id)->get();
                if (count($cliente) > 0) {
                    foreach ($cliente as $key => $c_bd) {
                        $c_bd->compania_id = $this->compania_id;
                        $c_bd->tipo = 'persona';
                        $c_bd->identificacion = $c['Identificacion'];
                        $c_bd->nombre_completo = ucwords(strtolower($c['Nombre_Comun']));
                        $c_bd->nombre_comercial = ucwords(strtolower($c['Razon_Social']));
                        //$c_bd->puntos_total = 0;
                        $c_bd->codigo_cliente = $c['Cod'];
                        //$c_bd->membresia_id = $c['Identificacion'];
                        //$c_bd->procesar_membresia = $c['Identificacion'];
                        $c_bd->celular = $c['Telefono'];
                        $c_bd->telefono = $c['Telefono'];
                        $c_bd->email = $c['Email'];
                        $c_bd->direccion = $c['Direccion'];
                        $c_bd->ciudad = $c['Ciudad'];
                        //$c_bd->barrio = $c['Identificacion'];
                        //$c_bd->codigo_postal = $c['Identificacion'];
                        $c_bd->latitud = $c['Latitud'];
                        $c_bd->longitud = $c['Longitud'];
                        $c_bd->save();
                        $this->actualizados = $this->actualizados + 1;
                        Log::info("Se actualizo cliente. Cedula: " . $c['Identificacion']);
                    }
                }else{
                    $cliente_nuevo = ClienteFidepuntos::create([
                        'compania_id' => $this->compania_id,
                        'tipo' => 'persona',
                        'identificacion' => $c['Identificacion'],
                        'nombre_completo' => ucwords(strtolower($c['Nombre_Comun'])),
                        'nombre_comercial' => ucwords(strtolower($c['Razon_Social'])),
                        'puntos_total' => 0,
                        'codigo_cliente' => $c['Cod'],
                        'membresia_id' => null,
                        'procesar_membresia' => 0,
                        'celular' => $c['Telefono'],
                        'telefono' => $c['Telefono'],
                        'email' => $c['Email'],
                        'direccion' => $c['Direccion'],
                        'ciudad' => $c['Ciudad'],
                        'barrio' => null,
                        'codigo_postal' => null,
                        'latitud' => $c['Latitud'],
                        'longitud' => $c['Longitud'],
                    ]);
                    $this->creados = $this->creados + 1;
                    Log::info("se creo cliente. Cedula: " . $c['Identificacion']);
                    $login = Logins::where('identificacion', $cliente_nuevo->identificacion)->get();
                    if (count($login) == 0) {
                        $login_nuevo = Logins::create([
                            'identificacion' => $cliente_nuevo->identificacion,
                            'password' => password_hash($cliente_nuevo->identificacion, PASSWORD_DEFAULT),
                            'role' => 'cliente',
                            'proyecto' => 'fidepuntos',
                            'cliente_id' => $cliente_nuevo->id,
                        ]);
                        $login_nuevo->save();
                    }
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
