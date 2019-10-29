<?php

/*Modelo "Encuestas". En el se detalla las columnas de su tabla en la Base de Datos, además de la PK.*/

namespace App;

use Illuminate\Database\Eloquent\Model;

class encuestas extends Model
{
    //
    protected $fillable = ['id_encuesta','asunto','codigoCurso','rutProfesor','publicada','finalizada'];
    protected $primaryKey = 'id_encuesta';
}
