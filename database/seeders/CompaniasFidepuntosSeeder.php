<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CompaniasFidepuntos;

class CompaniasFidepuntosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CompaniasFidepuntos::create([
            'tipo' => 'empresa',
            'identificacion' => '901224405',
            'nombre_compania' => 'Limpro Colombia SAS',
            'nombre_contacto' => 'Jeraldinne Rodriguez',
            'celular_contacto' => '3125223545',
            'telefono_contacto' => '3125223545',
            'email_contacto' => 'servicios@limpro.co',
            'direccion' => 'Cra 7 b bis # 158 - 21',
            'ciudad' => 'Bogota',
            'codigo_postal' => '11011',
            'activo' => '1',
            'erp' => '0',
        ]);

        CompaniasFidepuntos::create([
            'tipo' => 'empresa',
            'identificacion' => '901497735',
            'nombre_compania' => 'Cash Advance',
            'nombre_contacto' => 'Wilber Zamudio',
            'celular_contacto' => '3214518948',
            'telefono_contacto' => '3214518948',
            'email_contacto' => 'wzamudio@cashadvance',
            'direccion' => 'olmos',
            'ciudad' => 'Bogota',
            'codigo_postal' => '11011',
            'activo' => '1',
            'erp' => '0',
        ]);

        CompaniasFidepuntos::create([
            'tipo' => 'empresa',
            'identificacion' => '901497735',
            'nombre_compania' => 'Distrialgusto',
            'nombre_contacto' => 'Dayanna Seils',
            'celular_contacto' => '3132690236',
            'telefono_contacto' => '3132690236',
            'email_contacto' => 'directoradministrativo@distrialgusto.co',
            'direccion' => 'Calle distrialgusto',
            'ciudad' => 'Bogota',
            'codigo_postal' => '11011',
            'activo' => '1',
            'erp' => '1',
        ]);
    }
}
