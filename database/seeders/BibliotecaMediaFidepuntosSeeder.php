<?php

namespace Database\Seeders;
use App\Models\BibliotecaMediaFidepuntos;

use Illuminate\Database\Seeder;

class BibliotecaMediaFidepuntosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BibliotecaMediaFidepuntos::create([
            'nombre' => 'Sin Foto',
            'url' => 'https://res.cloudinary.com/dikbf3xct/image/upload/v1677019576/fidepuntos_media/xi0njrxhplcipehzygyz.webp',
            'tipo' => 'imagen',
            'descripcion' => 'principal',
        ]);
    }
}
