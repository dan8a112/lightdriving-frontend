<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class ClienteController extends Controller
{
    public function login_view(){

        $incorrecto = false;

        return view('loginCliente', compact('incorrecto'));
    }

    public function register_view(){
        return view('registroCliente');
    }

    public function profile_view($id){

        $client = new Client();
        //Se obtiene la informacion del cliente
        $response = $client->get('localhost:8080/api/cliente/obtener/'.$id);

        $cliente = json_decode($response->getBody());

        $fechaCarbon = Carbon::parse($cliente->fechaNacimiento);
        $fechaFormateada = $fechaCarbon->toDateString();

        $cliente->fechaNacimiento = $fechaFormateada;

        return view('perfilCliente', compact('cliente'));
    }

    public function principal_view($id){

        $client = new Client();
        //Se obtiene la informacion del cliente
        $response = $client->get('localhost:8080/api/factura/obtenerFacturas/cliente/'.$id);

        $cliente = json_decode($response->getBody());

        return view('principalCliente', compact('cliente'));
    }

    public function carrera_view($id){

        $client = new Client();
        //Se obtiene la informacion del cliente
        $response = $client->get('localhost:8080/api/cliente/obtenerUbicacion/'.$id);

        $coordenadas = json_decode($response->getBody());

        return view('crearCarrera', compact('id','coordenadas'));
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
                "fechaNacimiento": "'.$request->input('fechaNacimiento').'",
                "lat": "'.$request->input('lat').'",
                "lng": "'.$request->input('lng').'",
                "ubicacionNombre": "'.$request->input('ubicacionNombre').'"
            }';
    
            $response = $client->post('localhost:8080/api/cliente/crear', [
                'headers'=> $headers,
                'body' => $body
            ]);

            return redirect(route('cliente.login'));

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

            $id = json_decode($response->getBody());

            if($id>0){
                return redirect()->route('cliente.principal', $id);
            }else{
                $incorrecto = true;
                return view('loginCliente', compact('incorrecto'));;
            }

            

        } catch (RequestException $e) {
            return 'Error al realizar la solicitud'.$e->getMessage();
        }
    }

    /**
     * Funcion que verifica si la ruta no esta en una zona restringida y busca los ubers cercanos
     */
    public function buscarUbersCercanos(Request $request){
        try {
            
            $client = new Client();

            $headers = [
                'Content-Type' => 'application/json'
            ];

            $body = '{
                "latInicio": "'.$request->input('latInicio').'",
                "lngInicio": "'.$request->input('lngInicio').'",
                "latFinal": "'.$request->input('latFinal').'",
                "lngFinal": "'.$request->input('lngFinal').'"
            }';

            $response = $client->get('localhost:8080/api/uber/ubersCercanos', [
                'headers'=> $headers,
                'body' => $body
            ]);

            $uberResponse = json_decode($response->getBody());

            if($uberResponse->exito){
                return $uberResponse;
            }else{
               return $uberResponse;
            }

        } catch (RequestException $e) {
            return 'Error al realizar la solicitud'.$e->getMessage();
        }
    }

    public function crearCarrera(Request $request){
        try {
            
            $client = new Client();

            $headers = [
                'Content-Type' => 'application/json'
            ];

            $body = '{
                "latInicio": "'.$request->input('latInicio').'",
                "lngInicio": "'.$request->input('lngInicio').'",
                "latFinal": "'.$request->input('latFinal').'",
                "lngFinal": "'.$request->input('lngFinal').'",
                "idConductor": "'.$request->input('idConductor').'",
                "idCliente": "'.$request->input('idCliente').'",
                "metodoPago": "'.$request->input('idMetodoPago').'",
                "ubicacionInicial": "'.$request->input('ubicacionInicial').'",
                "ubicacionFinal": "'.$request->input('ubicacionFinal').'"
            }';

            $response = $client->post('localhost:8080/api/carreras/crear', [
                'headers'=> $headers,
                'body' => $body
            ]);

            if($response){
                $dataResponse = '{
                    "id": "'.$request->input('idCliente').'",
                    "state": true
                }';
            }else{
                $dataResponse = '{
                    "state": false
                }';
            }
            return $dataResponse;

        } catch (RequestException $e) {
            return 'Error al realizar la solicitud'.$e->getMessage();
        }
    }

    public function obtenerCarrera($id){

        $cliente = new Client();

        $response = $cliente->get('localhost:8080/api/carreras/obtenerDetalleCliente/'.$id);
        
        $factura = json_decode($response->getBody());

        return $factura;

    }

    //Actualizar cliente
    public function actualizar(Request $request, $id){
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
                "fechaNacimiento": "'.$request->input('fechaNacimiento').'",
                "lat": "'.$request->input('lat').'",
                "lng": "'.$request->input('lng').'",
                "ubicacionNombre": "'.$request->input('ubicacionNombre').'"
            }';
    
            $response = $client->put(('localhost:8080/api/cliente/actualizar/'.$id), [
                'headers'=> $headers,
                'body' => $body
            ]);

            return redirect(route('cliente.principal', $id));

        }catch(RequestException $e){

            return 'Error al realizar la solicitud'.$e->getMessage();

        }
    }
}
