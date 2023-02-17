<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ErpsFidepuntos;

class ErpsFidepuntosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ErpsFidepuntos::create([
            'compania_id' => 3,
            'endpoint' => 'http://181.204.39.210:8080/ServicioMovilDITO_v2/ServicioMovilDITO.svc/',
            'sistema_erp' => 'abako',
        ]);
    }
}
