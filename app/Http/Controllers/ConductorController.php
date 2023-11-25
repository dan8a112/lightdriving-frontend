<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class ConductorController extends Controller
{
    public function login(){
        return view('loginConductor');
    }

    //Envia los parametros de correo y contraseña como objeto request para hacer la validacion del inicia de sesion
    public function iniciar(Request $request){
        try{
            $client = new Client();

            $headers = [
                'Content-Type' => 'application/json'
            ];
    
            $body = '{
                "correo": "'.$request->input('correo').'",
                "contrasena": "'.$request->input('contrasena').'",
                
            }';
    
           $response = $client->post('localhost:8080/api/conductor/iniciar', [
                'headers'=> $headers,
                'body' => $body
            ]);

            return $body;

        }catch(RequestException $e){

            return 'Error al realizar la solicitud'.$e->getMessage();

        }
    }

    public function register(){
        return view('registroConductor');
    }

    public function crear(Request $request){
        try{
            $client = new Client();

            $headers = [
                'Content-Type' => 'application/json'
            ];
    
            $body = '{
                "nombre": "'.$request->input('nombre').'",
                "apellido": "'.$request->input('apellido').'",
                "correo": "'.$request->input('correo').'",
                "contrasena": "'.$request->input('contrasena').'",
                "telefono": "'.$request->input('telefono').'",
                "fechaNacimiento": "'.$request->input('fechaNacimiento').'"
            }';
    
            $response = $client->post('localhost:8080/api/conductor/crear', [
                'headers'=> $headers,
                'body' => $body
            ]);

            return redirect(route('uber.register'));

        }catch(RequestException $e){

            return 'Error al realizar la solicitud'.$e->getMessage();

        }
    }


}
