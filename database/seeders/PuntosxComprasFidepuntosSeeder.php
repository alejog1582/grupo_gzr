<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PuntosxComprasFidepuntos;

class PuntosxComprasFidepuntosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PuntosxComprasFidepuntos::create([
            'plan_puntos_compania_id' => 1,
            'valor_punto' => 10000,
            'valor_punto_canje' => 2000,
        ]);
    }
}
