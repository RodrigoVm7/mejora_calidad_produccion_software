@extends('layouts.app')

@section('content')

<div class="container">

<!-- Seccion que permite mostrar mensajes en pantalla-->
@if(Session::has('Mensaje'))
<div class="alert alert-success" role="alert">
{{ Session::get('Mensaje')}}
</div>

@endif


<!--Seccion que mediante 4 botones, ofrecerá distintas funcionalidades al administrador.
	Cada botón, redirige a distintas url, según lo que se desee realizar-->
<br/>
<br/>
<br/>
<a href="{{ url('admin/ver') }}" class="btn btn-success" >Buscar Encuesta 🔍</a>
<a href="{{ url('admin/vertodo') }}" class="btn btn-success" >Ver Todas las Encuestas  📖 </a>
<a href="{{ url('admin/buscareditar') }}" class="btn btn-success" >Editar un Perfil ✏</a>
<a href="{{ url('admin/añadir') }}" class="btn btn-success" >Añadir Usuario ✚</a>

<br/>
<br/>


</div>
@endsection