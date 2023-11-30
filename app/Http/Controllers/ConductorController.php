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
        try {
            
            $client = new Client();

            $headers = [
                'Content-Type' => 'application/json'
            ];

            $body = '{
                "correo": "'.$request->input('correo').'",
                "contrasena": "'.$request->input('contrasena').'"
            }';

            $response = $client->get('localhost:8080/api/conductor/login', [
                'headers'=> $headers,
                'body' => $body
            ]);

            $conductor = json_decode($response->getBody());


           return view('conductorPrincipal', compact('conductor'));

        } catch (RequestException $e) {
            return 'Error al realizar la solicitud'.$e->getMessage();
        }
    }


    public function register(){
        return view('registroConductor');
    }

    public function crear(Request $request){
            try {
                // Obtenemos la ubicación desde la solicitud
                $ubicacion = json_decode($request->input('ubicacion'), true);
        
                // En este punto, $ubicacion contiene las coordenadas latitud, longitud y el nombre del lugar
        
                // Construimos el cuerpo de la solicitud incluyendo la ubicación
                $body = [
                    "nombre" => $request->input('nombre'),
                    "apellido" => $request->input('apellido'),
                    "correo" => $request->input('correo'),
                    "contrasena" => $request->input('contrasena'),
                    "telefono" => $request->input('telefono'),
                    "fechaNacimiento" => $request->input('fechaNacimiento'),
                    "uber" => [
                        "marca" => $request->input('marca'),
                        "color" => $request->input('color'),
                        "placa" => $request->input('placa'),
                        "anio" => $request->input('anio'),
                        "tipoUber" => $request->input('tipouber'),
                        "ubicacionNombre" => $request->input('places'), // Utilizamos el nombre del lugar desde la ubicación
                        "lat" => $ubicacion['latitud'],
                        "lng" => $ubicacion['longitud'],
                    ]
                ];
        
                // Convierte el array asociativo a JSON
                $jsonBody = json_encode($body);
        
                // Inicializa el cliente Guzzle
                $client = new Client();
        
                // Realiza la solicitud POST al servidor
                $response = $client->post('http://localhost:8080/api/conductor/crear', [
                    'headers' => ['Content-Type' => 'application/json'],
                    'body' => $jsonBody,
                ]);
        
                // Obtiene el cuerpo de la respuesta del servidor
                $responseData = json_decode($response->getBody(), true);
        
                // Maneja la respuesta según tus necesidades
        
                return view('home');; // Retorna la respuesta recibida desde el servidor
            } catch (RequestException $e) {
                // Manejo de errores
                return 'Error al realizar la solicitud: ' . $e->getMessage();
            }
        }
}
