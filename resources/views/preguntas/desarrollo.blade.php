@extends('layouts.app')

@section('content')

<div class="container">

<!-- Seccion que permite mostrar mensajes en pantalla-->
@if(count($errors)>0)
<div class="alert alert-danger" role="alert">
	<ul>
		@foreach($errors->all() as $error)
		<li>{{ $error}}</li>
		@endforeach
	</ul>
</div>
@endif

<!--Seccion que mediante el llenado de un formulario, permite crear preguntas para una encuesta.
	Posteriormente, los datos son enviados mediante el método POST a la url "/preguntas/{ID}/index"-->
<form action="{{url('/preguntas/'.$id_encuesta.'/desarrolloLista')}}" class="form-horizontal" method="post">
	{{ csrf_field() }}
	<div class="form-group">
		<label for="idencuesta" class="control-label">{{'Id Encuesta'}}</label>
		<input type="text" class="form-control {{$errors->has('idencuesta')?'is-invalid':''}}" name="idencuesta" id="idencuesta" value="{{ $id_encuesta }}" readonly="readonly">
		{!! $errors->first('idencuesta','<div class="invalid-feedback">:message</div>') !!}
	</div>

	<div class="form-group">
		<label for="pregunta" class="control-label">{{'Pregunta'}}</label>
		<input type="text" class="form-control {{$errors->has('pregunta')?'is-invalid':''}}" name="pregunta" id="pregunta" value="">
		{!! $errors->first('pregunta','<div class="invalid-feedback">:message</div>') !!}
	</div>

	<input type="submit" class="btn btn-success" value="Agregar ✚">

	<a class="btn btn-primary" href="{{ url('preguntas/'.$id_encuesta.'/index') }}">Regresar ←</a>

</form>
</div>

@endsection