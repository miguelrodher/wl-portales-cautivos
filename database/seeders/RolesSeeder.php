<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        
        $roles = 
        [
            ['rol' => 'Supervisor', 'created_at' => $now, 'updated_at' => $now], 
            ['rol' => 'Administrador', 'created_at' => $now, 'updated_at' => $now],          
        ];

        DB::table('roles')->insert($roles);
    }
}
