@extends('layouts.app')

@section('content')

<div class="container">

<!--Seccion que mediante el llenado de un formulario, permite editar una encuesta.
	Posteriormente, los datos son enviados mediante el método POST a la url "/encuestas/{ID}"-->
<form action="{{ url('/encuestas/'.$encuesta->id_encuesta) }}" class="form-horizontal" method="post">
{{ csrf_field() }}
{{ method_field('PATCH') }}
	<div class="form-group">
		<label for="asunto" class="control-label">{{'Asunto'}}</label>
		<input type="text" class="form-control" name="asunto" id="asunto" value="{{ $encuesta->asunto}}">
	</div>


	<div class="form-group">
		<label for="codigoCurso" class="control-label">{{'Codigo del Curso'}}</label>
		<input type="text" class="form-control" name="codigoCurso" id="codigoCurso" value="{{ $encuesta->codigoCurso}}">
	</div>


	<div class="form-group">
		<label for="rutProfesor" class="control-label">{{'Rut Profesor'}}</label>
		<input type="text" class="form-control" name="rutProfesor" id="rutProfesor" value="{{ $encuesta->rutProfesor}}" readonly="readonly">
	</div>
	<input type="submit" class="btn btn-success" value="Modificar ✍">
	<a class="btn btn-primary" href="{{ url('encuestas') }}">Regresar ←</a>

</form>
</div>

@endsection