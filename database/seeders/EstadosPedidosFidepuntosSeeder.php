<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EstadosPedidosClienteFidepuntos;

class EstadosPedidosFidepuntosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EstadosPedidosClienteFidepuntos::create([
            'nombre_estado' => 'solicitado'
        ]);

        EstadosPedidosClienteFidepuntos::create([
            'nombre_estado' => 'aprobado'
        ]);

        EstadosPedidosClienteFidepuntos::create([
            'nombre_estado' => 'pagado'
        ]);

        EstadosPedidosClienteFidepuntos::create([
            'nombre_estado' => 'despachado'
        ]);

        EstadosPedidosClienteFidepuntos::create([
            'nombre_estado' => 'en camino'
        ]);

        EstadosPedidosClienteFidepuntos::create([
            'nombre_estado' => 'entregado'
        ]);

        EstadosPedidosClienteFidepuntos::create([
            'nombre_estado' => 'canjeado'
        ]);
    }
}
