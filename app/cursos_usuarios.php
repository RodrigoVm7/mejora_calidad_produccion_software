<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cursos_usuarios extends Model
{
	protected $fillable = ['id','rut','codigo_curso'];
    protected $primaryKey = 'id';
}
