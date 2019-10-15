@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="css/font-awesome.css">
<link rel="stylesheet" href="css/estilo.css">

<div class="container">

<style>
	p {
 		 font-size: 200%;
	}
	.rojo {
 		 color: red;
	}
	.verde {
  		color: green;
	}	
</style>


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

<!--Seccion que mediante el llenado de un formulario, permite crear una encuesta.
	Posteriormente, los datos son enviados mediante el método POST a la url "/encuestas"-->
<form action="{{url('/encuestas')}}" class="form-horizontal" method="post">
	{{ csrf_field() }}
	<div class="form-group">
		<label for="asunto" class="control-label">{{'Asunto'}}</label>
		<input type="text" class="form-control {{$errors->has('asunto')?'is-invalid':''}}" name="asunto" id="asunto" value="">
		{!! $errors->first('asunto','<div class="invalid-feedback">:message</div>') !!}
	</div>

	<div class="form-group">
		<label for="codigoCurso" class="control-label">{{'Codigo del Curso'}}</label><br>
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
			<option selected></option>
			@foreach($datos as $dato)
				<option value="{{$dato->codigo_curso}}">{{$dato->codigo_curso}}</option>
			@endforeach
		</select>
		{!! $errors->first('codigoCurso','<div class="invalid-feedback">:message</div>') !!}

	</div>

	<div class="form-group">
		<label for="rutProfesor" class="control-label">{{'Rut Profesor'}}</label>
		<input type="text" class="form-control {{$errors->has('rutProfesor')?'is-invalid':''}}" name="rutProfesor" id="rutProfesor" value="{{auth()->user()->rut}}" readonly="readonly">
		{!! $errors->first('rutProfesor','<div class="invalid-feedback">:message</div>') !!}
	</div>
	
	<input type="submit" class="btn btn-success" value="Agregar ✚">
	<a class="btn btn-primary" href="{{ url('encuestas') }}">Regresar ←</a>

</form>
</div>

@endsection