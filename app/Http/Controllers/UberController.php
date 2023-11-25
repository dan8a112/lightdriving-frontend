<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UberController extends Controller
{
    
    public function register(){
        return view('registroUber');
    }

    public function crear(Request $request){
        try{
            $client = new Client();

            $headers = [
                'Content-Type' => 'application/json'
            ];
    
            $body = '{
                "marca": "'.$request->input('marca').'",
                "color": "'.$request->input('color').'",
                "placa": "'.$request->input('placa').'",
                "anio": "'.$request->input('anio').'",
            }';
    
            $response = $client->post('localhost:8080/api/uber/crear', [
                'headers'=> $headers,
                'body' => $body
            ]);

            return redirect(route('home'));

        }catch(RequestException $e){

            return 'Error al realizar la solicitud'.$e->getMessage();

        }
    }
}
