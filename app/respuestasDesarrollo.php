<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class respuestasDesarrollo extends Model
{
    //
    protected $fillable = ['id_respuesta','idencuesta','rutEstudiante','id_pregunta','respuesta'];
    protected $table='respuestas_desarrollo';
    protected $primaryKey = 'id_respuesta';
}
