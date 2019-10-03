<?php

use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::insert([
            [
                'name' => 'Crear reservacion',
                'slug' => 'create.reservation',
                'description' => 'Capacidad de registrar reservaciones',
            ],
            [
                'name' => 'Editar reservacion',
                'slug' => 'edit.reservation',
                'description' => 'Capacidad de editar reservaciones',
            ],
            [
                'name' => 'Borrar reservacion',
                'slug' => 'delete.reservation',
                'description' => 'Capacidad de borrar reservaciones',
            ]
        ]);
    }
}
