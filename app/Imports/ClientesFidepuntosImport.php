<?php

namespace App\Imports;
ini_set('upload_max_filesize', '50M');
ini_set("memory_limit", "1000M");
set_time_limit(0);

use App\Models\ClienteFidepuntos;
use App\Models\CompaniasFidepuntos;
use App\Models\MembresiasFidepuntos;
use App\Models\LogsImportacionesFidepuntos;
use App\Models\Logins;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ClientesFidepuntosImport implements ToCollection
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
            $cliente_nuevo = null;
            $registro_log = null;
            $procesar_membresia = 0;
            $compania_id = null;
            $tipo = null;
            $identificacion = null;
            $nombre_completo = null;
            $nombre_comercial = null;
            $puntos_total = null;
            $codigo_cliente = null;
            $membresia_id = null;
            $celular = null;
            $telefono = null;
            $email = null;
            $direccion = null;
            $ciudad = null;
            $barrio = null;
            $codigo_postal = null;
            $latitud = null;
            $longitud = null;

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
                //campo tipo
                if ($row[1] != null) {
                    if ($row[1] == "persona" || $row[1] == "empresa") {
                        $tipo = $row[1];
                    }else{
                        $tipo = null;
                    }
                }else{
                    $tipo = null;
                }
                //campo identificacion
                if ($row[2] != null) {
                    $identificacion = $row[2];
                }else{
                    $identificacion = null;
                }
                //campo nombre completo
                if ($row[3] != null) {
                    $nombre_completo = $row[3];
                }else{
                    $nombre_completo = null;
                }
                //campo nombre comercial
                if ($row[4] != null) {
                    $nombre_comercial = $row[4];
                }else{
                    $nombre_comercial = $nombre_completo;
                }
                //campo Puntos
                if ($row[5] != null) {
                    if (is_int($row[5])) {
                        $puntos_total = $row[5];
                    }else{
                        $puntos_total = 0;
                    }
                }else{
                    $puntos_total = 0;
                }
                //Campo Codigo cliente
                if ($row[6] != null) {
                    $codigo_cliente = $row[6];
                }else{
                    $codigo_cliente = $identificacion;
                }
                //campo Membresia
                if ($row[7] != null) {
                    $membresia = MembresiasFidepuntos::where('membresia', $row[7])->Where('activo', 1)->get();
                    if (count($membresia) > 0) {
                        $membresia_id = $membresia[0]->id;
                        $procesar_membresia = 1;
                    }else{
                        $membresia_id = null;
                    }
                }else{
                    $membresia_id = null;
                }
                //Campo Celular
                if ($row[8] != null) {
                    $celular = $row[8];
                }else{
                    $celular = $nombre_completo;
                }
                //Campo Telefono
                if ($row[9] != null) {
                    $telefono = $row[9];
                }else{
                    $telefono = null;
                }
                //Campo Email
                if ($row[10] != null) {
                    $email = $row[10];
                }else{
                    $email = null;
                }
                //Campo Direccion
                if ($row[11] != null) {
                    $direccion = $row[11];
                }else{
                    $direccion = null;
                }
                //Campo Direccion
                if ($row[12] != null) {
                    $ciudad = $row[12];
                }else{
                    $ciudad = null;
                }
                //Campo Barrio
                if ($row[13] != null) {
                    $barrio = $row[13];
                }else{
                    $barrio = null;
                }
                //Campo Codigo posta
                if ($row[14] != null) {
                    $codigo_postal = $row[14];
                }else{
                    $codigo_postal = null;
                }
                //Campo latitud
                if ($row[15] != null) {
                    $latitud = $row[15];
                }else{
                    $latitud = null;
                }
                //Campo longitud
                if ($row[16] != null) {
                    $longitud = $row[16];
                }else{
                    $longitud = null;
                }

                if ($compania_id == null || $tipo == null || $identificacion == null || $nombre_completo == null
                    || $celular == null ||  $email == null || $direccion == null || $ciudad == null) {
                    $row_sin_procesar = array(
                        'compania_id' => $compania_id,
                        'tipo' => $tipo,
                        'identificacion' => $identificacion,
                        'nombre_completo' => $nombre_completo,
                        'nombre_comercial' => $nombre_comercial,
                        'puntos_total' => $puntos_total,
                        'codigo_cliente' => $codigo_cliente,
                        'membresia_id' => $membresia_id,
                        'procesar_membresia' => $procesar_membresia,
                        'celular' => $celular,
                        'telefono' => $telefono,
                        'email' => $email,
                        'direccion' => $direccion,
                        'ciudad' => $ciudad,
                        'barrio' => $barrio,
                        'codigo_postal' => $codigo_postal,
                        'latitud' => $latitud,
                        'longitud' => $longitud,
                    );
                    $registro_log = LogsImportacionesFidepuntos::create([
                        'proceso' => 'clientes',
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
                    $cliente = ClienteFidepuntos::where('identificacion', $identificacion)->Where('compania_id', $compania_id)->get();
                    if (count($cliente) > 0) {
                        $row_sin_procesar = array(
                            'compania_id' => $compania_id,
                            'tipo' => $tipo,
                            'identificacion' => $identificacion,
                            'nombre_completo' => $nombre_completo,
                            'nombre_comercial' => $nombre_comercial,
                            'puntos_total' => $puntos_total,
                            'codigo_cliente' => $codigo_cliente,
                            'membresia_id' => $membresia_id,
                            'procesar_membresia' => $procesar_membresia,
                            'celular' => $celular,
                            'telefono' => $telefono,
                            'email' => $email,
                            'direccion' => $direccion,
                            'ciudad' => $ciudad,
                            'barrio' => $barrio,
                            'codigo_postal' => $codigo_postal,
                            'latitud' => $latitud,
                            'longitud' => $longitud,
                        );
                        $registro_log = LogsImportacionesFidepuntos::create([
                            'proceso' => 'clientes',
                            'identificador_importacion' => $this->identificador_importacion,
                            'fecha_ejecucion' => $this->date,
                            'user_id' => $this->usuario->id,
                            'tipo_cargue' => 'excel',
                            'numero_fila_excel' => $key + 1,
                            'resultado' => 'declinado',
                            'motivo_decline' => 'cliente ya existe',
                            'data' => json_encode( $row_sin_procesar ),
                        ]);
                        $registro_log->save();
                        continue;
                    }else{
                        $cliente_nuevo = ClienteFidepuntos::create([
                            'compania_id' => $compania_id,
                            'tipo' => $tipo,
                            'identificacion' => $identificacion,
                            'nombre_completo' => $nombre_completo,
                            'nombre_comercial' => $nombre_comercial,
                            'puntos_total' => $puntos_total,
                            'codigo_cliente' => $codigo_cliente,
                            'membresia_id' => $membresia_id,
                            'procesar_membresia' => $procesar_membresia,
                            'celular' => $celular,
                            'telefono' => $telefono,
                            'email' => $email,
                            'direccion' => $direccion,
                            'ciudad' => $ciudad,
                            'barrio' => $barrio,
                            'codigo_postal' => $codigo_postal,
                            'latitud' => $latitud,
                            'longitud' => $longitud,
                        ]);
                        $registro_log = LogsImportacionesFidepuntos::create([
                            'proceso' => 'clientes',
                            'identificador_importacion' => $this->identificador_importacion,
                            'fecha_ejecucion' => $this->date,
                            'user_id' => $this->usuario->id,
                            'tipo_cargue' => 'excel',
                            'numero_fila_excel' => $key + 1,
                            'resultado' => 'exitoso',
                            'data' => json_encode( $cliente_nuevo ),
                        ]);
                        $registro_log->save();
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
                }
            }else{
                continue;
            }

        }
        return true;
    }
}
