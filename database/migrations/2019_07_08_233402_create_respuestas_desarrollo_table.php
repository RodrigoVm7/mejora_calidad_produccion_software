<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRespuestasDesarrolloTable extends Migration
{
    public function up()
    {
        Schema::create('respuestas_desarrollo', function (Blueprint $table) {
            $table->bigIncrements('id_respuesta');
            $table->bigInteger('idencuesta')->unsigned();
            $table->foreign('idencuesta')->references('id_encuesta')->on('encuestas')->onDelete('cascade');
            $table->string('rutEstudiante');
            $table->foreign('rutEstudiante')->references('rut')->on('users')->onDelete('cascade');
            $table->bigInteger('id_pregunta')->unsigned();
            $table->foreign('id_pregunta')->references('id')->on('preguntas_desarrollo')->onDelete('cascade');
            $table->string('respuesta');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('respuestas_desarrollo');
    }
}
