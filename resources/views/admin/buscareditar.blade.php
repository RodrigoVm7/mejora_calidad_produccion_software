@extends('layouts.app')

@section('content')

<div class="container">

<!-- Seccion que permite mostrar mensajes en pantalla-->
@if(Session::has('Mensaje'))
<div class="alert alert-success" role="alert">
{{ Session::get('Mensaje')}}
</div>

@endif


<!-- Seccion que mediante el método POST, recepciona el rut de la persona a editar.
	Posteriormente, una vez recepcionado, se redirige a la url ('admin/editar')-->
<form action="{{ url('/admin/editar') }}" class="form-horizontal" method="post"   >
	{{ csrf_field() }}
	<div class="form-group">
		<label for="Nombre">{{'Ingrese el Rut de la persona a editar'}}</label>
		<input type="text" class="form-control" name="rut" id="rut" value="">
		<input type="submit" class="btn btn-success" value="Buscar Perfil 🔍">
	</div>
		<a class="btn btn-primary" href="{{ url('/admin/index') }}">Volver ←</a>

</form>

</div>
@endsection