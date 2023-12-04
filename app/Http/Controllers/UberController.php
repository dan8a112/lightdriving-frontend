<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
class UberController extends Controller
{
    
    public function register(){
        return view('registroUber');
    }


    public function obtenerTiposUber(){
        try {
            $url = 'http://localhost:8080/api/tipoUber/obtener/todos';
            $response = file_get_contents($url);

            if ($response === false) {
                // Manejar el error, lanzar una excepción, o realizar alguna acción específica.
                throw new Exception("Error al obtener los tipos de Uber.");
            }

            // Decodificar el JSON obtenido
            $tiposUber = json_decode($response, true);

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
            
            if ($response->getStatusCode() === 200) {
                $historico = json_decode($response->getBody());
    
                return $historico;
            } else {
                return ['error' => 'Error en la respuesta de la API'];
            }
        } catch (RequestException $e) {
            // Manejar el error, puedes loguearlo o devolver un mensaje de error
            return ['error' => 'Error al obtener datos de la API'];
        }
    }


    public function obtenerTodosHistorico($idConductor){

        $cliente = new Client();

        $response = $cliente->get('http://localhost:8080/api/historicoUber/obtenerHistoricoConductor/'.$idConductor);
        
        $historico = json_decode($response->getBody());

        return $historico;

    }

    public function cambiarAuto(Request $request, $idUber, $idConductor)
{
    try {
        $ubicacion = json_decode($request->input('ubicacion'), true);

        $body = 
            [
                
                "marca" => $request->input('marca'),
                "color" => $request->input('color'),
                "placa" => $request->input('placa'),
                "anio" => $request->input('anio'),
                "tipoUber" => $request->input('tipouber'),
                "ubicacionNombre" => $request->input('places'), // Utilizamos el nombre del lugar desde la ubicación
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
        // Manejo de errores
        return 'Error al realizar la solicitud: ' . $e->getMessage();
    }

}

    public function cambiar($idUber, $idConductor){
        $idU=$idUber;
        $idC=$idConductor;

        try {
            $url = 'http://localhost:8080/api/tipoUber/obtener/todos';
            $response = file_get_contents($url);

            if ($response === false) {
                // Manejar el error, lanzar una excepción, o realizar alguna acción específica.
                throw new Exception("Error al obtener los tipos de Uber.");
            }

            // Decodificar el JSON obtenido
            $tiposUber = json_decode($response, true);

            // Puedes pasar los tipos de Uber a la vista
            return view('registroUber', compact("tiposUber","idU","idC"));

        } catch (Exception $e) {
            // Manejar la excepción, por ejemplo, redirigir a una página de error.
            return view('error', ['message' => $e->getMessage()]);
        }
    }
}
