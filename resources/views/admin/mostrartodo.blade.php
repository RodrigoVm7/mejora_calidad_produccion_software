@extends('layouts.app')

@section('content')

<div class="container">

<!-- Seccion que permite mostrar mensajes en pantalla-->
@if(Session::has('Mensaje'))
<div class="alert alert-success" role="alert">
{{ Session::get('Mensaje')}}
</div>

@endif

<a href="{{ url('admin/index') }}" class="btn btn-success" >Regresar ←</a>

<!-- Seccion que permite que hará que todo lo que se muestre a continuacion, sea dentro de una tabla-->
<table class="table table-light table-hover">

<!-- Cabecera de la tabla, donde se especifica los datos que tendrá cada columna-->
	<thread class="thread-light">
		<tr>
			<th>#</th>
			<th>Id Encuesta</th>
			<th>Asunto</th>
			<th>Rut Profesor</th>
			<th>Codigo Curso</th>
			<th>Acciones</th>
		</tr>
	</thread>

	<tbody>
<!-- Mediante un ciclo For, se mostrará dentro de la tabla el contenido de cada encuesta-->
		@foreach($datos as $encuesta)
		<tr>
			<td>{{$loop->iteration}}</td>
			<td>{{ $encuesta->id_encuesta}}</td>
			<td>{{ $encuesta->asunto}}</td>
			<td>{{ $encuesta->rutProfesor}}</td>
			<td>{{ $encuesta->codigoCurso}}</td>
			<td>

			
<!-- Botonces con las opciones que tendrá asociada cada encuesta-->
			<a class="btn btn-info" href="{{url('/admin/'.$encuesta->id_encuesta.'/preguntasadmin')}}">Preguntas 📋
			</a>
			
			<a class="btn btn-info" href="{{url('/admin/'.$encuesta->id_encuesta.'/resultadosadmin')}}">Resultados 📈
			</a>

			</td>
		</tr>
		@endforeach
	</tbody>
</table>


</div>
@endsection