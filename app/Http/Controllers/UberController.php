<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
class UberController extends Controller
{
    
    public function register(){
        return view('registroUber');
    }


    public function obtenerTiposUber(){
        $cliente = new Client();
        
        try {

            $response = $cliente->get('http://localhost:8080/api/tipoUber/obtener/todos');

            $tiposUber = json_decode($response->getBody(), true);

            // Puedes pasar los tipos de Uber a la vista
            return view('registroConductor', compact("tiposUber"));

        } catch (Exception $e) {
            // Manejar la excepción, por ejemplo, redirigir a una página de error.
            return view('error', ['message' => $e->getMessage()]);
        }
    }


    public function obtenerHistorico($idConductor){
        $cliente = new Client();
    
        try {
            $response = $cliente->get('http://localhost:8080/api/historicoUber/obtener/'.$idConductor);
            
            $historico = json_decode($response->getBody());
    
            return $historico;
           
        } catch (RequestException $e) {
            return ['error' => 'Error al obtener datos de la API'];
        }
    }


    public function obtenerTodosHistorico($idConductor){

        $cliente = new Client();

        $response = $cliente->get('http://localhost:8080/api/historicoUber/obtenerHistoricoConductor/'.$idConductor);
        
        $historico = json_decode($response->getBody());

        return $historico;

    }

    
/**
 * Recibe el Request del formulario el idUber con el que hará el cambio de auto
 * idConductor lo manda a conductor informacion para que pueda desplezar lo necesario
 */

    public function cambiarAuto(Request $request, $idUber, $idConductor){
        
            try {
            $ubicacion = json_decode($request->input('ubicacion'), true);

            $body = 
                [
                    
                    "marca" => $request->input('marca'),
                    "color" => $request->input('color'),
                    "placa" => $request->input('placa'),
                    "anio" => $request->input('anio'),
                    "tipoUber" => $request->input('tipouber'),
                    "ubicacionNombre" => $request->input('places'),
                    "lat" => $ubicacion['latitud'],
                    "lng" => $ubicacion['longitud'],
                ];
                
                $jsonBody = json_encode($body);
            
                    // Inicializa el cliente Guzzle
                $client = new Client();

                $response = $client->put("http://localhost:8080/api/uber/cambiarCarro/".$idUber, [
                    'headers' => ['Content-Type' => 'application/json'],
                    'body' => $jsonBody,
                ]);      

                $responseData = json_decode($response->getBody(), true);

                
            return redirect()->route('conductor.informacion', $idConductor);
        } catch (RequestException $e) {
        
            return 'Error al realizar la solicitud: ' . $e->getMessage();
        }

    }

    public function cambiar($idU, $idC){
        
            $cliente = new Client();
        try {
             $response = $cliente->get('http://localhost:8080/api/tipoUber/obtener/todos');

              $tiposUber = json_decode($response->getBody(), true);

               return view('registroUber', compact("tiposUber","idU","idC"));

            } catch (Exception $e) {
         
            return view('error', ['message' => $e->getMessage()]);
        }
    }
}

