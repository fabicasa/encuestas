<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreguntasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preguntas', function (Blueprint $table) {
            $table->id();
            $table->string('titulos');
            $table->integer('tipoPregunta')->comment('0=RadioButton,1=Checkbox,2=Input,3=Archivo,4=Textarea');
            $table->integer('cantidadArchivos');
            $table->integer('ordenEspecifico');
            $table->bigInteger('encuesta_id')->unsigned();
            $table->foreign('encuesta_id')->references('id')->on('encuestas')->onDelete('cascade');
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
        Schema::dropIfExists('preguntas');
    }
}
