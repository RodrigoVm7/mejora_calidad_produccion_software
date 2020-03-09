@extends('layouts.app')

@section('content')

<div class="container">

<!--Seccion que mediante el llenado de un formulario, permite responder las preguntas de una encuesta.
    Posteriormente, los datos son enviados mediante el método POST a la url "/respuestas"-->
<form action="{{ url('/respuestas') }}" class="form-horizontal" method="post">
{{ csrf_field() }}
@foreach($encuesta as $dato)
<div class="form-group">
	<label for="id_encuesta" class="control-lavel">{{ 'Id Encuesta: '}}</label>
	<input type="text" class="form-control" name="idencuesta" id="idencuesta" value="{{$dato->id_encuesta}}" readonly="readonly">
</div>

<div class="form-group">
	<label for="Asunto" class="control-lavel">{{ 'Asunto' }}</label>
	<input type="text" class="form-control" name="Asunto" id="Asunto" value="{{$dato->asunto}}"readonly="readonly">
</div>

<div class="form-group">
	<label for="codigoCurso" class="control-lavel">{{ 'Codigo del Curso' }}</label>
	<input type="text" class="form-control" name="codigoCurso" id="codigoCurso" value="{{$dato->codigoCurso}}"readonly="readonly">
</div>
    
    <!--Se define una variable "numit" que corresponde a un contador, el que se imprime junto a cada pregunta-->
    @php
        $numit=0
    @endphp

    <!--Mediante un ciclo for, se irá mostrando las preguntas, junto con sus respectivas alternativas-->
	@foreach($pregunta as $preg)
		<div class="form-group">
            @php
                $numit=$loop->iteration
            @endphp
            <h5>{{$numit.". "}}{{$preg->pregunta}}</h5>
            <label class="radio-inline">
                a) <input  type="radio"  name="{{$preg->id_pregunta}}" id="{{$preg->alternativa_a}}" value="a">{{$preg->alternativa_a}}
                <br>
                b) <input type="radio" name="{{$preg->id_pregunta}}" id="{{$preg->alternativa_b}}" value="b"> {{$preg->alternativa_b}}
                <br> 
		@if(is_null($preg->alternativa_c)==FALSE)
                c) <input type="radio" name="{{$preg->id_pregunta}}" id="{{$preg->alternativa_c}}" value="c"> {{$preg->alternativa_c}}
                <br> 
        @endif
		@if(is_null($preg->alternativa_d)==FALSE)
                d) <input type="radio" name="{{$preg->id_pregunta}}" id="{{$preg->alternativa_d}}" value="d"> {{$preg->alternativa_d}}
            </label>
            <br> 
        @endif
        </div>
	@endforeach

    <!-- En caso de existir pregunta de desarrollo, esta se muestra por pantalla-->
    @if(is_null($desarrollo)==FALSE)
        <div class="form-group">
        <h5><label for="pregunta" class="control-label">{{($numit+1).". ".$desarrollo->pregunta}}</label></h5>
        <input type="text" class="form-control {{$errors->has('pregunta')?'is-invalid':''}}" name="pregunta" id="pregunta" value="">
        {!! $errors->first('pregunta','<div class="invalid-feedback">:message</div>') !!}
        </div>
    @endif

@endforeach

<input type="submit" class="btn btn-success" value="Responder ✍">
<a class="btn btn-primary" href="{{ url('respuestas') }}">Regresar ←</a>
</form>

</div>
@endsection