<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CategoriasFidepuntos;

class CategoriasFidepuntosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CategoriasFidepuntos::create([
            'nombre_categoria' => 'Generica',
            'compania_id' => 1,
            'activo' => 1,
        ]);

        CategoriasFidepuntos::create([
            'nombre_categoria' => 'Generica',
            'compania_id' => 2,
            'activo' => 1,
        ]);

        CategoriasFidepuntos::create([
            'nombre_categoria' => 'Generica',
            'compania_id' => 3,
            'activo' => 1,
        ]);
    }
}
