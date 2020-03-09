@extends('layouts.app')

@section('content')

<div class="container">

<!--Sección que mediante el llenado de un formulario, permite editar un perfil.
	Posteriormente, los datos son enviados mediante el método POST a la url "/resultados/editar"-->
<form action="{{ url('/resultados/editar') }}" class="form-horizontal" method="post">
{{ csrf_field() }}

	<div class="form-group">
		<label for="rut" class="control-label">{{'Rut'}}</label>
		<input type="text" class="form-control" name="rut" id="rut" value="{{ $perfil->rut}}" readonly="readonly">
	</div>

	<div class="form-group">
		<label for="name" class="control-label">{{'Nombre'}}</label>
		<input type="text" class="form-control" name="name" id="name" value="{{$perfil->name}}">
	</div>

	<div class="form-group">
		<label for="email" class="control-label">{{'Email'}}</label>
		<input type="text" class="form-control" name="email" id="email" value="{{ $perfil->email}}">
	</div>

	<input type="submit" class="btn btn-success" value="Modificar ✎">
	<a class="btn btn-primary" href="{{ url('/iniciar') }}">Regresar ← </a>

</form>
</div>

@endsection