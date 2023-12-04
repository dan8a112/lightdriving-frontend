<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class ConductorController extends Controller
{
    public function login(){

        $incorrecto = false;

        return view('loginConductor', compact('incorrecto'));
    }

    public function profile_view($idConductor, $idUber){
        try {
            $client = new Client();
    
        
            $response = $client->get('http://localhost:8080/api/historicoUber/obtenerHistoricoConductor/'.$idConductor);
            
            
            $historico = json_decode($response->getBody());
    
            $responseConductor = $client->get("http://localhost:8080/api/conductor/obtnerInfoPaginaPrincipal/".$idConductor);
            

                $conductor = json_decode($responseConductor->getBody());
    
                // Ahora puedes usar la variable $conductor para acceder a la información del conductor
                return view('perfilConductor', compact('conductor','historico'));
            
        } catch (RequestException $e) {
            return 'Error al realizar la solicitud'.$e->getMessage();
        }

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

            $response = $client->get('http://localhost:8080/api/conductor/login', [
                'headers'=> $headers,
                'body' => $body
            ]);

            $conductorId = json_decode($response->getBody());

            if($conductorId<0){
                $incorrecto = true;
                return view('loginConductor', compact('incorrecto'));
            }else{
                return redirect()->route('conductor.informacion', ['idConductor' => $conductorId]);
        
            }

        } catch (RequestException $e) {
            return 'Error al realizar la solicitud'.$e->getMessage();
        }
    }

    public function obtenerInformacion($idConductor) {
        try {
            $client = new Client();
            
            // Realiza la solicitud para obtener la información principal utilizando el $idConductor
            $responseConductor = $client->get("http://localhost:8080/api/conductor/obtnerInfoPaginaPrincipal/".$idConductor);
            
            $conductor = json_decode($responseConductor->getBody());
    
            return view('conductorPrincipal', compact('conductor'));
            
        } catch (RequestException $e) {
            return 'Error al realizar la solicitud'.$e->getMessage();
        }
    }
    
    public function terminarCarrera( $idConductor, $idCarrera){
        try {
            $client = new Client();
            $temporalId=$idConductor;
            // Realiza la solicitud para cambiar el estado de la carrera utilizando el $idConductor
            $response = $client->put("http://localhost:8080/api/carreras/cambiarEstado/".$idCarrera);
            
            // Redirige directamente a la página de información del conductor
            return redirect()->route('conductor.informacion', $temporalId);
            
        } catch (RequestException $e) {
            return 'Error al realizar la solicitud: ' . $e->getMessage();
        }
    }

    public function register(){
        return view('registroConductor');
    }

    public function crear(Request $request){
            try {
                // Obtenemos la ubicación desde la solicitud
                $ubicacion = json_decode($request->input('ubicacion'), true);
        
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
        
        
                return view('home');
            } catch (RequestException $e) {
                // Manejo de errores
                return 'Error al realizar la solicitud: ' . $e->getMessage();
            }
        }

        public function obtenerCarrera($id){

            $cliente = new Client();
    
            $response = $cliente->get('http://localhost:8080/api/carreras/obtenerDetalleConductor/'.$id);
            
            $factura = json_decode($response->getBody());
    
            return $factura;
    
        }
        
}
