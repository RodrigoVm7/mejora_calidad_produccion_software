@extends('layouts.app')

@section('content')

<div class="container">

<!-- Sección que permite mostrar mensajes en pantalla-->
@if(Session::has('Mensaje'))
<div class="alert alert-success" role="alert">
{{ Session::get('Mensaje')}}
</div>
@endif

<!--Sección que mediante el llenado de un formulario, permite ingresar el Id de la encuesta a responder.
	Posteriormente, los datos son enviados mediante el método POST a la url "/respuestas/show"-->
<form action="{{ url('/respuestas/show') }}" class="form-horizontal" method="post"   >
	{{ csrf_field() }}
	<div class="form-group">
		<label for="Nombre">{{'Ingrese la ID de la encuesta a responder'}}</label>
		<input type="text" class="form-control" name="id_encuesta" id="id_encuesta" value="">

		<input type="submit" class="btn btn-success" value="Responder Encuesta ✏">

	</div>
</form>

</div>
@endsection