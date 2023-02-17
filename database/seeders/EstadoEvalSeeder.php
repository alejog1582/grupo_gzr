<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EstadoClienteEval;

class EstadoEvalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EstadoClienteEval::create([
            'nombre' => 'nuevo',
            'activo' => '1'
        ]);

        EstadoClienteEval::create([
            'nombre' => 'activo',
            'activo' => '1'
        ]);

        EstadoClienteEval::create([
            'nombre' => 'inactivo',
            'activo' => '1'
        ]);
    }
}
