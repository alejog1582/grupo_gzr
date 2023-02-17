<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DescripcionsMediaFidepuntos;

class DescripcionMediaFidepuntosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DescripcionsMediaFidepuntos::create([
            'nombre_descripcion_media' => 'principal',
        ]);

        DescripcionsMediaFidepuntos::create([
            'nombre_descripcion_media' => 'secundaria',
        ]);
    }
}
