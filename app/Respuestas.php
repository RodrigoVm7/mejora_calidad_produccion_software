<?php

/*Modelo "Respuestas". En el se detalla las columnas de su tabla en la Base de Datos, además de la PK.*/

namespace App;

use Illuminate\Database\Eloquent\Model;

class Respuestas extends Model
{
    //
    protected $fillable = ['idencuesta','rutEstudiante','id_pregunta','respuesta'];
    protected $table="respuestas";
    protected $primaryKey = 'id_respuesta';
}
