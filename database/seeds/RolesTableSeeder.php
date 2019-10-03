<?php

use Caffeinated\Shinobi\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::insert([
            [
                'name' => 'Administrador',
                'slug' => 'admin',
                'description' => 'Usuario con todas las capacides del sistema',
                'created_at' => Carbon::today(),
                'updated_at' => Carbon::today(),
                'special' => 'all-access',
            ],
            [
                'name' => 'Recepcionista',
                'slug' => 'recep',
                'description' => 'Usuario con capacidad de administrar recervaciones',
                'created_at' => Carbon::today(),
                'updated_at' => Carbon::today(),
                'special' => null,
            ],
        ]);

        Role::where('slug', '=', 'recep')->first()
        ->givePermissionTo('create.reservation', 'edit.reservation', 'delete.reservation');
    }
}
