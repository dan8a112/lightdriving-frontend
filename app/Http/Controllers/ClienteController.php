<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class ClienteController extends Controller
{
    public function login_view(){
        return view('loginCliente');
    }

    public function register_view(){
        return view('registroCliente');
    }

    public function principal_view($cliente){
        return view('principalCliente', compact('cliente'));
    }

    public function carrera_view(){
        return view('crearCarrera');
    }

    //Envio de formulario de registro de cliente
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
    
            $response = $client->post('localhost:8080/api/cliente/crear', [
                'headers'=> $headers,
                'body' => $body
            ]);

            return redirect(route('home'));

        }catch(RequestException $e){

            return 'Error al realizar la solicitud'.$e->getMessage();

        }
    }

    //Envio de formulario de login de cliente
    public function autenticar(Request $request){
        try {
            
            $client = new Client();

            $headers = [
                'Content-Type' => 'application/json'
            ];

            $body = '{
                "correo": "'.$request->input('correo').'",
                "contrasena": "'.$request->input('contrasena').'"
            }';

            $response = $client->get('localhost:8080/api/cliente/login', [
                'headers'=> $headers,
                'body' => $body
            ]);

            $cliente = json_decode($response->getBody());


            return view('principalCliente', compact('cliente'));

        } catch (RequestException $e) {
            return 'Error al realizar la solicitud'.$e->getMessage();
        }
    }

    public function buscarUbersCercanos(Request $request){
        try {
            
            $client = new Client();

            $headers = [
                'Content-Type' => 'application/json'
            ];

            $body = '{
                "lat": "'.$request->input('latInicio').'",
                "lng": "'.$request->input('lngInicio').'"
            }';

            $response = $client->get('localhost:8080/api/uber/ubersCercanos', [
                'headers'=> $headers,
                'body' => $body
            ]);

            $ubers = json_decode($response->getBody());

            return $ubers;

        } catch (RequestException $e) {
            return 'Error al realizar la solicitud'.$e->getMessage();
        }
    }

    
}
