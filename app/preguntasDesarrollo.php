<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class preguntasDesarrollo extends Model
{
    //
    protected $fillable = ['id','idencuesta','pregunta'];
    protected $table='preguntas_desarrollo';
    protected $primaryKey = 'id';
}
