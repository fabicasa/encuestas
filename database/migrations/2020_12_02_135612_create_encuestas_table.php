<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEncuestasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('encuestas', function (Blueprint $table) {
            $table->id();
            $table->string('titulos');
            $table->string('descripcion');
            $table->date('fechaIniciollenado');
            $table->date('fechaFinalizacionllenado');
            $table->integer('requiereCorreos')->comment('0=Si,1=No');
            $table->integer('requiereInicioSesion')->comment('0 = Si, 1 = No');
            $table->integer('contarRespuestas');
            $table->integer('estado')->comment('0=cerrada,1=abierta');
            $table->timestamps();
        });
    }

    /**value
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('encuestas');
    }
}
