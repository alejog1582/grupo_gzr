<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rol_admin = Role::create([
            'name' => 'Admin'
        ]);

        $rol_propietario = Role::create([
            'name' => 'Propietario'
        ]);

        Permission::create([
            'name' => 'dashboard'
        ])->syncRoles([$rol_admin, $rol_propietario]);
    }
}
