<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Proyecto;

class ProyectoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Proyecto::create([
            'nombre' => 'Eval',
            'activo' => '1',
            'base_datos' => 'eval',
            'responsable' => 'Alejandro Gonzalez'
        ]);
    }
}
