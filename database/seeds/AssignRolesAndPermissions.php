<?php

use App\User;
use Illuminate\Database\Seeder;

class AssignRolesAndPermissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::where('email', '=', 'desarrollo@lasmananitas.com.mx')->first()->assignRoles('admin');
    }
}
