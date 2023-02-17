<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FabricantesFidepuntos;

class FabricantesFidepuntosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FabricantesFidepuntos::create([
            'nombre_fabricante' => 'Purina',
            'compania_id' => 1,
            'activo' => 1,
        ]);
    }
}
