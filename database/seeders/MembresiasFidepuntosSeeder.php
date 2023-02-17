<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MembresiasFidepuntos;

class MembresiasFidepuntosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MembresiasFidepuntos::create([
            'membresia' => 'FIDEPUNTOS',
            'puntos_otorgar' => 65,
            'activo' => 1,
        ]);
    }
}
