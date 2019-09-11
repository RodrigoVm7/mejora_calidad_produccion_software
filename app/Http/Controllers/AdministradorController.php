<?php

namespace App\Http\Controllers;

use App\User;
use App\Encuestas;
use App\Respuestas;
use App\Resultados;
use App\Preguntas;
use App\Role_User;
use App\preguntasDesarrollo;
use App\respuestasDesarrollo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdministradorController extends Controller
{

    /* Función que retorna a la vista de inicio del administrador, la cual esta en la carpeta de nombre "admin"*/
    public function index(Request $request){
        $request->user()->authorizeRoles(['admin']);
        return view('admin.index');
    }

    /* Funcion que retorna la vista que permite ingresar una ID de una encuesta para ver sus resultados */
    public function show(Request $request,encuestas $encuestas){
        $request->user()->authorizeRoles(['admin']);
        return view('admin.mostrar');
    }

    /* Funcion que retorna a una vista donde se visualizan todas las encuestas realizadas en el sistema */
    public function mostrartodo(Request $request,encuestas $encuestas){
        $request->user()->authorizeRoles(['admin']);
        $datoss['datos']=Encuestas::where('finalizada','=',1)->get();
        return view('admin.mostrartodo',$datoss);
    }

    /* Funcion que retorna a una vista donde se podrá visualizar las preguntas de cada encuesta */
    public function preguntas(Request $request,$id){
        $request->user()->authorizeRoles(['admin']);
        $datos=Preguntas::where('idencuesta',$id)->get();
        $datos2=preguntasDesarrollo::where('idencuesta',$id)->first();
        return view('admin.preguntas',compact('datos','datos2'));
    }

    /* Función que permite ver los resulados de las encuestas */
    public function verresultados(Request $request,$id){
        $request->user()->authorizeRoles(['admin']);
        $resultados=Resultados::where('idencuesta','=',$id)->get();

        $desarrollo=respuestasDesarrollo::where('idencuesta','=',$id)->get();
        $preguntaDes=preguntasDesarrollo::where('idencuesta','=',$id)->get();


        return view('admin.resultadoencuesta',compact('resultados','desarrollo','preguntaDes'));
    }

    /* Funcion que retorna a una vista para poder editar datos de una persona*/
    public function buscareditar(Request $request){
        $request->user()->authorizeRoles(['admin']);
        return view('admin.buscareditar');
    }

    /* Funcion que retorna a la vista donde se permite registrar un usuario */
    public function añadir(Request $request){
        $request->user()->authorizeRoles(['admin']);
        return view('admin.register');
    }

    /* Funcion que recibe datos del nuevo perfil, y lo inserta en la base de datos */
    public function insertar(Request $request){
        $request->user()->authorizeRoles(['admin']);
        if($request->input('tipo')=="student"){
            $tipo2=2;
        }

        if($request->input('tipo')=="profesor"){
            $tipo2=3;
        }

        $campos=[
            'rut' => ['required','string'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:1', 'confirmed'],
            'tipo' => ['required','string','min:3']
        ];
        $Mensaje=["required"=>'El :attribute es requerido'];
        $this->validate($request,$campos,$Mensaje);
        User::create([
            'rut'=>request()->input('rut'),
            'name'=>request()->input('name'),
            'email'=>request()->input('email'),
            'password'=>Hash::make(request()->input('password')),
            'tipo'=>request()->input('tipo')
        ]);
        Role_User::create([
            'user_rut'=>request()->input('rut'),
            'role_id'=>$tipo2
        ]);
        return redirect('admin/index')->with('Mensaje','Perfil agregado con éxito');
    }

    /* Funcion que retorna una vista con datos del perfil a editar */
    public function editar(Request $request){
        $request->user()->authorizeRoles(['admin']);
        $rut=$request->except('_token');
        $perfil=User::where('rut','=',$rut)->first();
        if($perfil != ""){
            return view('admin.editar',compact('perfil'));
        }else{
            return redirect('admin/buscareditar')->with('Mensaje','El perfil no existe');
        }
    }

    /* funcion que se encarga de guardar los datos del perfil editado*/
    public function perfileditado(Request $request){
        $request->user()->authorizeRoles(['admin']);
        $rut=$request->except('_token','name','email');
        $datos=$request->except('_token');
        User::where('rut','=',$rut)->update($datos);
        return redirect('admin/buscareditar')->with('Mensaje','Perfil editado correctamente');
    }

    /* Funcion que muestra los datos de una encuesta en particular */
    public function mostrar(Request $request){
        $request->user()->authorizeRoles(['admin']);
        $id=$request->except('_token');
        $existeEncuesta=Encuestas::where('id_encuesta','=',$id)->count();
        if($existeEncuesta==1){
            $fin=Encuestas::where('id_encuesta','=',$id)->select('finalizada')->get();
            if($fin=='[{"finalizada":1}]'){
                $resultados=Resultados::where('idencuesta','=',$id)->get();
                $desarrollo=respuestasDesarrollo::where('idencuesta','=',$id)->get();
                $preguntaDes=preguntasDesarrollo::where('idencuesta','=',$id)->get();
                return view('admin.result',compact('resultados','desarrollo','preguntaDes'));
            }else{
                return redirect('admin/ver')->with('Mensaje','La encuesta aun no ha finalizado');
            }
        }else{
            return redirect('admin/ver')->with('Mensaje','La encuesta no existe');
        }        
    }
}