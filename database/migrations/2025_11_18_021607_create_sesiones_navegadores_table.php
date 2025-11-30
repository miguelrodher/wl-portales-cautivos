<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSesionesNavegadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sesiones_navegadores', function (Blueprint $table) 
        {
            $table->bigIncrements('id');
            $table->timestamp('fecha_inicio');
            $table->timestamp('fecha_cierre')->nullable();

            $table->string('ip', 45);

            $table->string('dispositivo', 50)->nullable();
            $table->string('sistema_operativo', 20)->nullable();
            $table->string('version_sistema_operativo', 30)->nullable();
            $table->string('navegador', 20)->nullable();
            $table->string('version_navegador', 30)->nullable();
            $table->string('motor_navegador', 20)->nullable();
            $table->string('idioma', 20)->nullable();
            
            $table->unsignedBigInteger('eventos_cierres_sesiones_id')->nullable();
            $table->unsignedBigInteger('usuarios_id')->nullable();
            $table->unsignedBigInteger('portales_cautivos_id')->nullable();

            $table->foreign('eventos_cierres_sesiones_id')->references('id')->on('eventos_cierres_sesiones');
            $table->foreign('usuarios_id')->references('id')->on('usuarios');
            $table->foreign('portales_cautivos_id')->references('id')->on('portales_cautivos');

            $table->index('eventos_cierres_sesiones_id');
            $table->index('usuarios_id');
            $table->index('portales_cautivos_id');

            $table->timestamps();
        });
        
        DB::statement('ALTER TABLE sesiones_navegadores ALTER COLUMN ip TYPE INET USING ip::INET;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sesiones_navegadores');
    }
}
