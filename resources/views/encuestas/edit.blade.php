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
		<select name="codigoCurso" size="1" style="
			    display: block;
				width: 100%;
    			height: calc(2.19rem + 2px);
				padding: .375rem .75rem;
				font-size: .9rem;
				line-height: 1.6;
				color: #495057;
				background-color: #fff;
				background-clip: padding-box;
				border: 1px solid #ced4da;
				border-radius: .25rem;">
			<option selected> Elige un Curso </option>
			@foreach($datos as $dato)
				<option value="{{$dato->codigo_curso}}">{{$dato->codigo_curso}}</option>
			@endforeach
		</select>
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