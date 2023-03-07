<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PlanPuntosFidepuntos;

class PlanPuntosFidepuntosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PlanPuntosFidepuntos::create([
            'tipo_plan_puntos' => 'Puntos por Compra',
        ]);

        PlanPuntosFidepuntos::create([
            'tipo_plan_puntos' => 'Puntos por Producto',
        ]);

        PlanPuntosFidepuntos::create([
            'tipo_plan_puntos' => 'Fidelizacion Clientes',
        ]);
    }
}
