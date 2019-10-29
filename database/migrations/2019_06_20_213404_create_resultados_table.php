<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resultados', function (Blueprint $table) {
            $table->bigIncrements('id_resultado');
            $table->bigInteger('idencuesta')->unsigned();
            $table->foreign('idencuesta')->references('id_encuesta')->on('encuestas')->onDelete('cascade');
            $table->bigInteger('id_pregunta')->unsigned();
            $table->foreign('id_pregunta')->references('id_pregunta')->on('preguntas')->onDelete('cascade');
            $table->string('pregunta');
            $table->string('alternativa_a');
            $table->string('alternativa_b');
            $table->string('alternativa_c')->nullable();
            $table->string('alternativa_d')->nullable();
            $table->integer('frecuencia_a');
            $table->integer('frecuencia_b');
            $table->integer('frecuencia_c');
            $table->integer('frecuencia_d');
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
        Schema::dropIfExists('resultados');
    }
}
