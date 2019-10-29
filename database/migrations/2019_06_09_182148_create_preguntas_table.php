<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id_pregunta');
            $table->bigInteger('idencuesta')->unsigned();
            $table->foreign('idencuesta')->references('id_encuesta')->on('encuestas')->onDelete('cascade');
            $table->string('pregunta');
            $table->string('alternativa_a');
            $table->string('alternativa_b');
            $table->string('alternativa_c')->nullable();
            $table->string('alternativa_d')->nullable();
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
