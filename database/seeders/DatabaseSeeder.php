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
        $this->call
        ([
            # Catalogos #
            TipoDispositivoSeeder::class,

            # Datos administrativos #
            RolesSeeder::class,        
            SupervisoresSeeder::class, 
        ]);
    }
}
