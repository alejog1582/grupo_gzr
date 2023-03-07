<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PlanPuntosxCompaniaFidepuntos;

class PlanPuntosxCompaniaFidepuntosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PlanPuntosxCompaniaFidepuntos::create([
            'plan_puntos_id' => 1,
            'compania_id' => 1,
            'activo' => 1,
        ]);

        PlanPuntosxCompaniaFidepuntos::create([
            'plan_puntos_id' => 1,
            'compania_id' => 2,
            'activo' => 1,
        ]);

        PlanPuntosxCompaniaFidepuntos::create([
            'plan_puntos_id' => 1,
            'compania_id' => 3,
            'activo' => 1,
        ]);
    }
}
