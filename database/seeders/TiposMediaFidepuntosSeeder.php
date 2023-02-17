<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TiposMediaFidepuntos;

class TiposMediaFidepuntosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TiposMediaFidepuntos::create([
            'nombre_tipo_media' => 'imagen',
        ]);

        TiposMediaFidepuntos::create([
            'nombre_tipo_media' => 'video',
        ]);
    }
}
