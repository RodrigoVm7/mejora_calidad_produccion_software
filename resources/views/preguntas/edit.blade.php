@extends('layouts.app')

@section('content')

<div class="container">

<!--Seccion que mediante el llenado de un formulario, permite editar una pregunta de una encuesta.
	Posteriormente, los datos son enviados mediante el método POST a la url "/preguntas/{ID}"-->
<form action="{{ url('/preguntas/'.$pregunta->id_pregunta) }}" class="form-horizontal" method="post">
{{ csrf_field() }}

	<div class="form-group">
		<label for="idencuesta" class="control-label">{{'Id Encuesta'}}</label>
		<input type="text" class="form-control" name="idencuesta" id="idencuesta" value="{{ $pregunta->idencuesta}}" readonly="readonly">
	</div>

	<div class="form-group">
		<label for="pregunta" class="control-label">{{'Pregunta'}}</label>
		<input type="text" class="form-control" name="pregunta" id="pregunta" value="{{ $pregunta->pregunta}}">
	</div>

	<div class="form-group">
		<label for="alternativa_a" class="control-label">{{'Alternativa A'}}</label>
		<input type="text" class="form-control" name="alternativa_a" id="alternativa_a" value="{{ $pregunta->alternativa_a}}">
	</div>

	<div class="form-group">
		<label for="alternativa_b" class="control-label">{{'Alternativa B'}}</label>
		<input type="text" class="form-control" name="alternativa_b" id="alternativa_b" value="{{ $pregunta->alternativa_b}}">
	</div>

	<!--Si la pregunta posee la alternativa C, se muestra el valor ingresado inicialmente-->
	@if(is_null($pregunta->alternativa_c)==FALSE)
		<div class="form-group">
			<label for="alternativa_c" class="control-label">{{'Alternativa C'}}</label>
			<input type="text" class="form-control" name="alternativa_c" id="alternativa_c" value="{{ $pregunta->alternativa_c}}">
		</div>		
	@endif

	<!--Si la pregunta posee la alternativa D, se muestra el valor ingresado inicialmente-->
	@if(is_null($pregunta->alternativa_d)==FALSE)
		<div class="form-group">
			<label for="alternativa_d" class="control-label">{{'Alternativa D'}}</label>
			<input type="text" class="form-control" name="alternativa_d" id="alternativa_d" value="{{ $pregunta->alternativa_d}}">
		</div>		
	@endif

	<input type="submit" class="btn btn-success" value="Modificar ✍">
	<a class="btn btn-primary" href="{{ url('preguntas/'.$pregunta->idencuesta.'/index') }}">Regresar ←</a>

</form>
</div>

@endsection