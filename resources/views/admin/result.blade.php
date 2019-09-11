@extends('layouts.app')

@section('content')


<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Evaluación Docente</title>

  <!-- Bootstrap - CSS -->

  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
  <link href="css/animate.min.css" rel="stylesheet">
  <!-- Plugins -->
  <link href="css/custom.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/maps/jquery-jvectormap-2.0.3.css" />
  <link href="css/icheck/flat/green.css" rel="stylesheet" />
  <link href="css/floatexamples.css" rel="stylesheet" type="text/css" />

  <script src="js/jquery.min.js"></script>
  <script src="js/nprogress.js"></script>

</head>

<body class="nav-md">

  <div class="container body">

    <div class="main_container">

      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">

         
        </div>
      </div>
      {{ csrf_field() }}
      <!-- Barra superior de navegacion -->
      <div class="top_nav">

        <div class="row">


          <div class="col-md-4"></div>
            <div class="x_panel tile fixed_height_320">
              <div class="x_title">
                <h2>Resultados de la Encuesta</h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                  <li class="dropdown"> </li>
                  <li><a class="close-link"><i class="fa fa-close"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">

            <!--Se define una variable "numit" que corresponde a un contador, el que se imprime junto a cada pregunta-->
              @php
                $numit=0
              @endphp


              <!-- Ciclo for mediante el que se mostrará en pantalla los resultados de cada pregunta-->
              @foreach($resultados as $resultado)

              <!--Se incrementa el contador-->
              @php
                $numit=$loop->iteration
              @endphp

               <!--Se verifica que el denominador sea distinto de 0, en caso de que nadie haya respondido
                  la encuesta-->
              @php
                $denominador=$resultado->frecuencia_a+$resultado->frecuencia_b+$resultado->frecuencia_c+$resultado->frecuencia_d
              @endphp
              @php
                if($denominador==0)
                  $denominador=1
              @endphp

                <h4>{{$numit.". ".$resultado->pregunta}}</h4>
                <div class="widget_summary">        
                  <div class="w_left w_25">
                    <span>{{$resultado->alternativa_a}}</span>
                  </div>
                  <div class="w_center w_55">
                    <div class="progress">
                      <div class="progress-bar bg-green" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: {{( ($resultado->frecuencia_a)/($denominador)*100)}}%;">
                        <span class="sr-only">30% Complete</span>
                      </div>
                    </div>
                  </div>
                  <div class="w_right w_20">
                    <span>{{$resultado->frecuencia_a}}</span>
                  </div>
                  <div class="clearfix"></div>
                </div>
                <br>

                <div class="widget_summary">
                  <div class="w_left w_25">
                    <span>{{$resultado->alternativa_b}}</span>
                  </div>
                  <div class="w_center w_55">
                    <div class="progress">
                      <div class="progress-bar bg-green" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: {{( ($resultado->frecuencia_b)/($denominador)*100)}}%;">
                        <span class="sr-only">100% Complete</span>
                      </div>
                    </div>
                  </div>
                  <div class="w_right w_20">
                    <span>{{$resultado->frecuencia_b}}</span>
                  </div>
                  <div class="clearfix"></div>
                </div>
                <br>

              <!-- si existía la alternativa C en la pregunta, se muestra sus resultados-->
                @if(is_null($resultado->alternativa_c)==FALSE)
                <div class="widget_summary">
                  <div class="w_left w_25">
                    <span>{{$resultado->alternativa_c}}</span>
                  </div>
                  <div class="w_center w_55">
                    <div class="progress">
                      <div class="progress-bar bg-green" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: {{( ($resultado->frecuencia_c)/($denominador)*100)}}%;">
                        <span class="sr-only">60% Complete</span>
                      </div>
                    </div>
                  </div>
                  <div class="w_right w_20">
                    <span>{{$resultado->frecuencia_c}}</span>
                  </div>
                  <div class="clearfix"></div>
                </div>
                <br>
                @endif

              <!-- si existía la alternativa D en la pregunta, se muestra sus resultados-->
                @if(is_null($resultado->alternativa_d)==FALSE)
                <div class="widget_summary">
                  <div class="w_left w_25">
                    <span>{{$resultado->alternativa_d}}</span>
                  </div>
                  <div class="w_center w_55">
                    <div class="progress">
                      <div class="progress-bar bg-green" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: {{( ($resultado->frecuencia_d)/($denominador)*100)}}%;">
                        <span class="sr-only">60% Complete</span>
                      </div>
                    </div>
                  </div>
                  <div class="w_right w_20">
                    <span>{{$resultado->frecuencia_d}}</span>
                  </div>
                  <div class="clearfix"></div>
                </div>
                <br>
                @endif
                <br>
                @endforeach


              <!--En caso de haber pregunta de desasrrollo, se muestra esta junto con todas las respuestas-->
              @foreach($preguntaDes as $preg)
                @php
                  $numit=$numit+1
                @endphp
              <h4>{{$numit.". ".$preg->pregunta}}</h4>
              <table class="table table-light table-hover">
                <tbody>
                  @foreach($desarrollo as $des)      
                  <tr>
                      <td>{{$des->respuesta}}</td>
                  @endforeach
                  <tr>
                </tbody>
              </table>
              @endforeach
    </div>
    <div class="col-md-4"></div>
    <br>
    <a class="btn btn-primary" href="{{ url('admin/ver') }}">Regresar ←</a>
  </div>
  @endsection