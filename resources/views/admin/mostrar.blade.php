@extends('layouts.app')

@section('content')

<div class="container">

<!-- Seccion que permite mostrar mensajes en pantalla-->
@if(Session::has('Mensaje'))
<div class="alert alert-success" role="alert">
{{ Session::get('Mensaje')}}
</div>

@endif

<!--Seccion que mediante el método POST, recepciona el id de la encuesta a revisar.
	Posteriormente, una vez recepcionado, se redirige a la url ('admin/show')-->
<form action="{{ url('/admin/show') }}" class="form-horizontal" method="post"   >
	{{ csrf_field() }}
	<div class="form-group">
		<label for="Nombre">{{'Ingrese la ID de la encuesta a revisar'}}</label>
		<input type="text" class="form-control" name="id_encuesta" id="id_encuesta" value="">

		<input type="submit" class="btn btn-success" value="Buscar Encuesta 🔍">
	</div>

		<a class="btn btn-primary" href="{{ url('/admin/index') }}">Regresar ←</a>

</form>

</div>
@endsection