<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carreras extends Model
{
	protected $fillable = ['id_carrera','nombre','codigo_carrera'];
    protected $primaryKey = 'id_carrera';
}
