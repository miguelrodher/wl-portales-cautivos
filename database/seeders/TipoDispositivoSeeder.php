<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TipoDispositivoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        $tipos = 
        [
            ['tipo_dispositivo' => 'Tablet', 'created_at' => $now, 'updated_at' => $now],
            ['tipo_dispositivo' => 'Móvil', 'created_at' => $now, 'updated_at' => $now],
            ['tipo_dispositivo' => 'Escritorio', 'created_at' => $now, 'updated_at' => $now],
            ['tipo_dispositivo' => 'Robot', 'created_at' => $now, 'updated_at' => $now],
            
            ['tipo_dispositivo' => 'Otro', 'created_at' => $now, 'updated_at' => $now],
        ];

        DB::table('tipos_dispositivos')->insert($tipos);    
    }
}
