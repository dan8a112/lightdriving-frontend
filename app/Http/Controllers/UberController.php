<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

   public function probando(){
    return view('probando');
   }
}
