@extends('layouts.app')

@section('content')


<div class="container">

<!-- Sección que permite mostrar mensajes en pantalla-->
@if(Session::has('Mensaje'))
<div class="alert alert-success" role="alert">
{{ Session::get('Mensaje')}}
</div>
@endif

<!--Botones que se ubicarán en la parte superior de la pantalla, y redigirá a una url para agregar pregunta o 			regresar-->
<a href="{{ url('preguntas/'.$id_encuesta.'/create') }}" class="btn btn-success" >Agregar Pregunta ✚</a>
<!--En caso de no existir una pregunta de desarrollo, se habilita la opcion para agregar una-->
@if(is_null($datos2)==TRUE)
<a href="{{ url('preguntas/'.$id_encuesta.'/pregdesarrollo')}}" class="btn btn-success" >Pregunta Desarrollo</a>
@endif
<a href="{{ url('encuestas') }}" class="btn btn-primary" >Regresar ←</a>
<br/>
<br/>

<!-- Seccion que permite que hará que todo lo que se muestre a continuacion, sea dentro de una tabla-->
<table class="table table-light table-hover">

	<!-- Cabecera de la tabla, donde se especifica los datos que tendrá cada columna-->
	<thread class="thread-light">
		<tr>
			<th>#</th>
			<th>Pregunta</th>
			<th>Tipo</th>
		</tr>
	</thread>

	@php
        $numit=0
    @endphp
	<tbody>
		<!-- Mediante un ciclo For, se mostrará dentro de la tabla el contenido de cada pregunta ya creada-->
		@foreach($datos as $pregunta)
		<tr>
			<!--Se define una variable "numit" que corresponde a un contador, el que se imprime junto a cada pregunta-->
			@php
                $numit=$loop->iteration
            @endphp
			<td>{{$numit}}</td>
			
			<td>{{ $pregunta->pregunta}}</td>
			<td>{{ 'Alternativas'}}</td>
			<td>
				<!-- Botonces con las opciones que tendrá asociada cada pregunta-->
				<a class="btn btn-warning" href="{{ url('/preguntas/'.$pregunta->id_pregunta.'/edit') }}">Editar</a>

				<form method="post" action="{{ url('/preguntas/'.$pregunta->id_pregunta.'/delete') }}" style="display:inline">
					{{csrf_field() }}
					
					<button class="btn btn-danger" type="sub
					mit" onclick="return confirm('¿Borrar?');" >Borrar</button>
				</form>
			</td>
			<tr>
		@endforeach
		<!-- En caso de existir una pregunta de desaroolo, esta se muestra en pantalla-->
		@if(is_null($datos2)==FALSE)
			<tr>
			<td>{{$numit+1}}</td>
			<td>{{$datos2->pregunta}}</td>
			<td>{{'Desarrollo'}}</td>
			<td>
				<!-- Botonces con las opciones que tendrá asociada cada pregunta-->
				<a class="btn btn-warning" href="{{ url('/preguntas/'.$datos2->id.'/editDesarrollo') }}">Editar ✏</a>

				<form method="post" action="{{ url('/preguntas/'.$datos2->id.'/deleteDesarrollo') }}" style="display:inline">
					{{csrf_field() }}
					
					<button class="btn btn-danger" type="sub
					mit" onclick="return confirm('¿Borrar?');" >Borrar ✖</button>
				</form>
			</td>
		</tr>
		@endif

	</tbody>
</table>


</div>
@endsection