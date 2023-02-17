<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClienteFidepuntos;

class ClientesFidepuntosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ClienteFidepuntos::create([
            'tipo' => 'persona',
            'identificacion' => '52995490',
            'nombre_completo' => 'Diana Zamudio',
            'nombre_comercial' => 'Diana Zamudio',
            'puntos_total' => 150,
            'codigo_cliente' => '01582',
            'celular' => '3165243492',
            'telefono' => '3165243492',
            'email' => 'dianazam_@hotmail.com',
            'direccion' => 'Calle 159 # 7 - 74',
            'ciudad' => 'Bogota',
            'barrio' => 'Barrancas',
            'codigo_postal' => '11011',
            'compania_id' => 1,
        ]);
    }
}
