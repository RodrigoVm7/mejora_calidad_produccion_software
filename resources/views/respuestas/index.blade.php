@extends('layouts.app')

@section('content')

<div class="container">

<!-- Sección que permite mostrar mensajes en pantalla-->
@if(Session::has('Mensaje'))
<div class="alert alert-success" role="alert">
{{ Session::get('Mensaje')}}
</div>
@endif

<!-- Seccion que permite que hará que todo lo que se muestre a continuacion, sea dentro de una tabla-->
<table class="table table-light table-hover">

	<!-- Cabecera de la tabla, donde se especifica los datos que tendrá cada columna-->
	<thread class="thread-light">
		<tr>
			<th>#</th>
			<th>Id Encuesta</th>
			<th>Asunto</th>
			<th>Codigo Curso</th>
			<th>Acciones</th>
		</tr>
	</thread>

	<tbody>
		<!-- Mediante un ciclo For, se mostrará dentro de la tabla el contenido de cada encuesta-->
		@foreach($datosEncuestas as $encuesta)

			@php
				$yaRespondio=0
			@endphp
			
			@foreach($datosRespuestas as $respuesta)
				@if($respuesta->idencuesta==$encuesta->id_encuesta)
					@php
						$yaRespondio=1
					@endphp
				@endif
			@endforeach



		<tr>
			@if($encuesta->publicada==1 && $encuesta->finalizada==0 && $yaRespondio==0)
			<td>{{$loop->iteration}}</td>
			<td>{{ $encuesta->id_encuesta}}</td>
			<td>{{ $encuesta->asunto}}</td>
			<td>{{ $encuesta->codigoCurso}}</td>
			<td>

			<!-- Botonces con las opciones que tendrá asociada cada encuesta, según el estado en que se
				encuentre esta-->

			
			<a class="btn btn-info" href="{{url('/respuestas/'.$encuesta->id_encuesta.'/show')}}">Responder ✍🏼
			</a>
			</td>
			@endif
		</tr>
		@endforeach
	</tbody>
</table>


</div>
@endsection