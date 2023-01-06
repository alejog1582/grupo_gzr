<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HomeTarjeta;

class TarjetaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HomeTarjeta::create([
            'activo' => '1',
            'link' => 'admin.users.index',
            'titulo' => 'Usuarios',
            'descripcion' => 'Consulta la informacion de usuarios'
        ]);

        HomeTarjeta::create([
            'activo' => '1',
            'link' => 'admin.eval.index',
            'titulo' => 'Eval',
            'descripcion' => 'Administracion Proyecto Eval.'
        ]);
    }
}
