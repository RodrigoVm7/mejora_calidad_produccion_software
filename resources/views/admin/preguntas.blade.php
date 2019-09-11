@extends('layouts.app')

@section('content')


<div class="container">

<a href="{{ url('admin/vertodo') }}" class="btn btn-success" >Regresar ←</a>
<br/>
<br/>

<table class="table table-light table-hover">

<!-- Cabecera de la tabla, donde se especifica los datos que tendrá cada columna-->
	<thread class="thread-light">
		<tr>
			<th>#</th>
			<th>Pregunta</th>
		</tr>
	</thread>

	<tbody>
<!-- Mediante un ciclo For, se mostrará dentro de la tabla el contenido de cada pregunta-->

		<!--Se define una variable "numit" que corresponde a un contador, el que se imprime junto a cada pregunta-->
		@php
            $numit=0
        @endphp

		@foreach($datos as $pregunta)
		<tr>
			<!--Se incrementa el contador-->
			@php
                $numit=$loop->iteration	
            @endphp
			<td>{{$numit}}</td>

			<td>{{ $pregunta->pregunta}}<br/>
				a) {{$pregunta->alternativa_a}}<br/>
				b) {{$pregunta->alternativa_b}}<br/>
				<!--En caso de existir alternativa C, se muestra-->
				@if(is_null($pregunta->alternativa_c)==FALSE)
				c) {{$pregunta->alternativa_c}}<br/>
				@endif
				<!--En caso de existir alternativa D, se muestra-->
				@if(is_null($pregunta->alternativa_d)==FALSE)
				d) {{$pregunta->alternativa_d}}
				@endif
			</td>
		</tr>
		@endforeach
		<!--En caso de existir pregunta de desarrollo, esta se muestra por pantalla-->
		@if(is_null($datos2)==FALSE)
			<tr>
			<td>{{$numit+1}}</td>
			<td>{{$datos2->pregunta}}</td>
		</tr>
		@endif

	</tbody>
</table>


</div>
@endsection