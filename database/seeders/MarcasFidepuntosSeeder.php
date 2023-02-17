<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MarcasFidepuntos;

class MarcasFidepuntosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MarcasFidepuntos::create([
            'nombre_marca' => 'Pro Plan',
            'compania_id' => 1,
            'fabricante_id' => 1,
            'activo' => 1,
        ]);
    }
}
