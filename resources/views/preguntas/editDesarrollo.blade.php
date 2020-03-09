@extends('layouts.app')

@section('content')

<div class="container">

<!--Sección que mediante el llenado de un formulario, permite editar una pregunta de una encuesta.
	Posteriormente, los datos son enviados mediante el método POST a la url "/preguntas/{ID}"-->
<form action="{{ url('/preguntas/'.$pregunta->id.'/upDesarrollo') }}" class="form-horizontal" method="post">
{{ csrf_field() }}

	<div class="form-group">
		<label for="idencuesta" class="control-label">{{'Id Encuesta'}}</label>
		<input type="text" class="form-control" name="idencuesta" id="idencuesta" value="{{ $pregunta->idencuesta}}" readonly="readonly">
	</div>

	<div class="form-group">
		<label for="pregunta" class="control-label">{{'Pregunta'}}</label>
		<input type="text" class="form-control" name="pregunta" id="pregunta" value="{{ $pregunta->pregunta}}">
	</div>

	<input type="submit" class="btn btn-success" value="Modificar ✍">
	<a class="btn btn-primary" href="{{ url('preguntas/'.$pregunta->idencuesta.'/index') }}">Regresar ←</a>

</form>
</div>

@endsection