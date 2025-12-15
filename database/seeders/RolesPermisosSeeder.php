<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesPermisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = 
        [
            ['rol' => 'Supervisor'], 
            ['rol' => 'Administrador'],          
        ];

        DB::table('roles')->insert($roles);
    }
}
