<?php

use App\Http\Controllers\ConductorController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\UberController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [Controller::class, 'home'])->name('home');

//Rutas del cliente
Route::get('/cliente/login', [ClienteController::class, 'login_view'])->name('cliente.login');

Route::get('/cliente/register', [ClienteController::class, 'register_view'])->name('cliente.register');

Route::post('/cliente/crear', [ClienteController::class, 'crear'])->name('cliente.crear');

Route::post('/cliente/autenticar', [ClienteController::class, 'autenticar'])->name('cliente.auth');

Route::get('/cliente/main/{id}', [ClienteController::class, 'principal_view'])->name('cliente.principal');

Route::get('/cliente/carrera/{id}', [ClienteController::class, 'carrera_view'])->name('cliente.carrera');

Route::post('/cliente/uberCercanos', [ClienteController::class, 'buscarUbersCercanos'])->name('cliente.buscarUber');

Route::post('/cliente/crearCarrera', [ClienteController::class, 'crearCarrera'])->name('cliente.crearCarrera');



//Rutas de Conductor

//CONDUCTOR
Route::get('/conductor/login', [ConductorController::class, 'login'])->name('conductor.login');
Route::post('/conductor/iniciar', [ConductorController::class, 'iniciar'])->name('conductor.iniciar');
Route::get('/conductor/register', [UberController::class, 'obtenerTiposUber'])->name('conductor.register');
Route::post('/conductor/crear', [ConductorController::class, 'crear'])->name('conductor.crear');
Route::get('/conductor/informacion/{idConductor}', [ConductorController::class, 'obtenerInformacion'])->name('conductor.informacion');

//Uber-> Auto
Route::get('/uber/register', [UberController::class, 'register'])->name('uber.register');
Route::post('/uber/crear', [UberController::class, 'crear'])->name('uber.crear');
Route::get('/uber/obtener', [UberController::class, 'obtenerTiposUber'])->name('uber.obtener');
//Route::get('/uber/p', [UberController::class, 'probando'])->name('uber.prueba');

