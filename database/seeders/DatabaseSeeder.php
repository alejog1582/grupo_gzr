<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(TarjetaSeeder::class);
        $this->call(ProyectoSeeder::class);
        $this->call(EstadoEvalSeeder::class);
        $this->call(CompaniasFidepuntosSeeder::class);
        $this->call(ErpsFidepuntosSeeder::class);
        $this->call(ClientesFidepuntosSeeder::class);
        $this->call(MembresiasFidepuntosSeeder::class);
        $this->call(FabricantesFidepuntosSeeder::class);
        $this->call(MarcasFidepuntosSeeder::class);
        $this->call(CategoriasFidepuntosSeeder::class);
        $this->call(BibliotecaMediaFidepuntosSeeder::class);
        $this->call(DescripcionMediaFidepuntosSeeder::class);
        $this->call(TiposMediaFidepuntosSeeder::class);
    }
}
