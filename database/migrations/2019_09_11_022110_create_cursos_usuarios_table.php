<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCursosUsuariosTable extends Migration
{

    public function up()
    {
        Schema::create('cursos_usuarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('rut')->unique();
            $table->foreign('rut')->references('rut')->on('users')->onDelete('cascade');
            $table->string('codigo_curso');
            $table->foreign('codigo_curso')->references('codigo_curso')->on('cursos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cursos_usuarios');
    }
}
