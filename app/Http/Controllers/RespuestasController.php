<?php

namespace App\Http\Controllers;

use App\Encuestas;
use App\cursos_usuarios;
use App\Respuestas;
use App\Preguntas;
use App\preguntasDesarrollo;
use App\respuestasDesarrollo;

use Illuminate\Http\Request;

class RespuestasController extends Controller
{
    /* Funcion que retorna la vista principal de un estudiante */
    public function index(Request $request){
        $request->user()->authorizeRoles(['admin','student']);
        $datosRespuestas=Respuestas::where('rutEstudiante',$request->user()->rut)->get();
        $datosEncuestas=encuestas::join('cursos_usuarios','encuestas.codigoCurso','=','cursos_usuarios.codigo_curso')->where('rut',$request->user()->rut)->get();
        return view('respuestas.index',compact('datosEncuestas','datosRespuestas'));
        //return response()->json($datosRespuestas);
    }

    /* Funcion que permite responder una encuesta*/
    public function create(Request $request){
        $request->user()->authorizeRoles(['admin','student']);
        return view('respuestas.create');
    }

    /* Funcion que permite almacenar en la base de datos las respuestas a la encuesta*/
    public function store(Request $request){
        $request->user()->authorizeRoles(['admin','student']);        
        //$datosRespuesta=request()->except('_token','idencuesta','Asunto','codigoCurso');
        $idencuesta=$request->input('idencuesta');
        $rut=$request->user()->rut;
        $dato=Preguntas::where('idencuesta','=',$idencuesta)->get();
        $existeDesarrollo=preguntasDesarrollo::where('idencuesta','=',$idencuesta)->first();

        /* En caso de existir pregunta de desarrollo., se almacena esta respuesta en su tabla correspondiente */
        if($existeDesarrollo!=""){
            $resp_desarrollo= new respuestasDesarrollo();
            $resp_desarrollo->idencuesta=$idencuesta;
            $resp_desarrollo->rutEstudiante=$rut;
            $id=preguntasDesarrollo::where('idencuesta','=',$idencuesta)->first();
            $resp_desarrollo->id_pregunta=$id->id;
            $resp_desarrollo->respuesta=$request->input('pregunta');
            $resp_desarrollo->save();
            $datosRespuesta=request()->except('_token','idencuesta','Asunto','codigoCurso','pregunta');
        }else{
            $datosRespuesta=request()->except('_token','idencuesta','Asunto','codigoCurso');
        }
        $i=0;
        /*Se almacenan todas las respuesta a las alternativas en su tabla correspondiente*/
        foreach($datosRespuesta as $respuestaaa){
            $respuesta= new respuestas();
            $respuesta->idencuesta=$idencuesta;
            $respuesta->rutEstudiante=$rut;
            $respuesta->id_pregunta=$dato[$i]->id_pregunta;
            $respuesta->respuesta=$respuestaaa;
            $respuesta->save();
            $i++;
        }
        return redirect('respuestas')->with('Mensaje','La Encuesta se ha respondido con éxito');
    }

    /* Funcion que permite buscar una encuesta a responder, siempre y cuando esta ya este publicada */
    public function show(Request $request, $id_encuesta){
        $request->user()->authorizeRoles(['admin','student']);

        $encuesta=Encuestas::where('id_encuesta','=',$id_encuesta)->get();
        if($encuesta!="[]" && $encuesta[0]->publicada=='1'){    //Si Existe la encuesta y esta publicada
            $pregunta=Preguntas::where('idencuesta','=',$id_encuesta)->get();
            $desarrollo=preguntasDesarrollo::where('idencuesta','=',$id_encuesta)->first();
            $yaExiste=Respuestas::where('idencuesta','=',$id_encuesta)->where('rutEstudiante','=',$request->user()->rut)->get();
            if($yaExiste=='[]'){
                return view('respuestas.create',compact('encuesta','pregunta','desarrollo'));
            }else{
                return redirect('respuestas')->with('Mensaje','La encuesta ya se ha contestado');
            }
        }else{
            return redirect('respuestas')->with('Mensaje','La Encuesta no existe');
        }
    }
    
    /* Funcion que permite publicar una encuesta, de manera que sea visible para poder ser respondida */
    public function publicar(Request $request,$id){
        $request->user()->authorizeRoles(['admin','profesor']);
        Encuestas::where('id_encuesta','=',$id)->update(['publicada'=> 1]);
        return redirect('encuestas')->with('Mensaje','Encuesta publicada con éxito');
    }
}
