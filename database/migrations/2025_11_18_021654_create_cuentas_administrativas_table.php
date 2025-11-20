<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuentasAdministrativasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuentas_administrativas', function (Blueprint $table) 
        {
            $table->bigIncrements('id');
            $table->string('nombre', 50);
            $table->string('apellido_paterno', 50);
            $table->string('apellido_materno', 50);
            $table->string('password', 62);
            $table->string('email', 150)->unique();
            $table->boolean('estatus')->nullable();
            $table->unsignedBigInteger('roles_id')->nullable();

            $table->foreign('roles_id')->references('id')->on('roles');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cuentas_administrativas');
    }
}
