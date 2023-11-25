<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class ClienteController extends Controller
{
    public function login(){
        return view('loginCliente');
    }

    public function register(){
        return view('registroCliente');
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
    
            $response = $client->post('localhost:8080/api/cliente/crear', [
                'headers'=> $headers,
                'body' => $body
            ]);

            return redirect(route('home'));

        }catch(RequestException $e){

            return 'Error al realizar la solicitud'.$e->getMessage();

        }
    }
}
