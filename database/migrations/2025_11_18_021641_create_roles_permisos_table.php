<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesPermisosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles_permisos', function (Blueprint $table) 
        {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('roles_id');
            $table->unsignedBigInteger('permisos_id');

            $table->foreign('roles_id')->references('id')->on('roles');
            $table->foreign('permisos_id')->references('id')->on('permisos');

            $table->unique(['roles_id', 'permisos_id']);
            $table->index('roles_id');
            $table->index('permisos_id');
            
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
        Schema::dropIfExists('roles_permisos');
    }
}
