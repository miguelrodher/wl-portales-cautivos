<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CuentaAdministrativa;

use Illuminate\Support\Facades\Hash;

class SupervisoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CuentaAdministrativa::create
        ([
            'nombre' => 'Supervisor',
            'apellido_paterno' => 'Warriors',
            'apellido_materno' => 'Labs',
            'email' => 'wl_supervisor_portales@gmail.com',
            'password' => Hash::make('wlsupervisor12345678'),
            'roles_id' => 1,
            'estatus' => true,
        ]);
    }
}
