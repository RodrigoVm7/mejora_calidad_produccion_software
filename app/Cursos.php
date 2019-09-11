<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cursos extends Model
{
    protected $fillable = ['id_curso','codigo_curso','nombre_curso','id_carrera'];
    protected $primaryKey = 'id_curso';
}
