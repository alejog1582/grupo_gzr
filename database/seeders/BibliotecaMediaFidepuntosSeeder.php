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
            'nombre' => 'Alimento Perro Pro Plan Adultos Raza Mediana - 3 Kg',
            'url' => 'https://res.cloudinary.com/dikbf3xct/image/upload/v1676563396/fidepuntos_media/alimento-perro-pro-plan-adultos-raza-mediana.png',
            'tipo' => 'imagen',
            'descripcion' => 'principal',
        ]);

    }
}
