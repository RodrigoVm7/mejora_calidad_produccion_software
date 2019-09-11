<?php

namespace App\Http\Controllers;

use App\Encuestas;
use App\Resultados;
use App\Respuestas;
use App\Preguntas;
use App\User;
use App\respuestasDesarrollo;
use App\preguntasDesarrollo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class ResultadosController extends Controller
{
    /* Funcion que pone en estado finalizado una encuesta, de modo que ya no pueda ser respondida por mas personas, junto
    con que se calculan los resultados y se envian a una tabla "resultados" en la base de datos*/
    public function finalizar(Request $request,$id){
        $request->user()->authorizeRoles(['admin','profesor']);
        Encuestas::where('id_encuesta','=',$id)->update(['finalizada'=> 1]);
        $preguntas=Preguntas::where('idencuesta','=',$id)->get();
        foreach($preguntas as $pregunta){
            $freq_a=Respuestas::where('idencuesta','=',$id)->where('id_pregunta','=',$pregunta->id_pregunta)->where('respuesta','=','a')->count();
            $freq_b=Respuestas::where('idencuesta','=',$id)->where('id_pregunta','=',$pregunta->id_pregunta)->where('respuesta','=','b')->count();
            $freq_c=Respuestas::where('idencuesta','=',$id)->where('id_pregunta','=',$pregunta->id_pregunta)->where('respuesta','=','c')->count();
            $freq_d=Respuestas::where('idencuesta','=',$id)->where('id_pregunta','=',$pregunta->id_pregunta)->where('respuesta','=','d')->count();

            $result= new resultados();
            $result->idencuesta=$id;
            $result->id_pregunta=$pregunta->id_pregunta;
            $result->pregunta=$pregunta->pregunta;
            $result->alternativa_a=$pregunta->alternativa_a;
            $result->alternativa_b=$pregunta->alternativa_b;
            $result->alternativa_c=$pregunta->alternativa_c;
            $result->alternativa_d=$pregunta->alternativa_d;
            $result->frecuencia_a=$freq_a;
            $result->frecuencia_b=$freq_b;
            $result->frecuencia_c=$freq_c;
            $result->frecuencia_d=$freq_d;
            $result->save();
        }
        return redirect('encuestas')->with('Mensaje','Encuesta finalizada con éxito');
    }

    /* Funcion que retorna a una vista, la cual permite mostrar los resultados de una encuesta*/
    public function mostrar(Request $request,$id){
        $request->user()->authorizeRoles(['admin','profesor']);
        $resultados=Resultados::where('idencuesta','=',$id)->get();
        $desarrollo=respuestasDesarrollo::where('idencuesta','=',$id)->get();
        $preguntaDes=preguntasDesarrollo::where('idencuesta','=',$id)->get();
        return view('respuestas.result',compact('resultados','desarrollo','preguntaDes'));
    }

    /* Funcion que retorna una vista para poder editar el perfil propio */
    public function perfil(Request $request){
        //$request->user()->authorizeRoles(['admin','profesor']);
        $perfil=User::findOrFail($request->user()->rut);
        return view('perfil.edit',compact('perfil'));
    }

    /* Funcino que guarda en la base de datos los cambios realizados a un perfil propio */
    public function editarPerfil(Request $request){
        //$request->user()->authorizeRoles(['admin','profesor']);
        $datos=request()->except('_token');
        $rut=request()->input('rut');
        User::where('rut','=',$rut)->update($datos);
        $usuario=User::where('rut','=',$rut)->first();
        if($usuario->tipo=="profesor"){
            return redirect('/encuestas')->with('Mensaje','Perfil actualizado correctamente');
        }else{
            if($usuario->tipo=="student"){
                return redirect('/respuestas')->with('Mensaje','Perfil actualizado correctamente');
            }else{
                return redirect('/admin/index')->with('Mensaje','Perfil actualizado correctamente');
            }
        }
    }
}