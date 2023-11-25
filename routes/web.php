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


Route::get('/cliente/login', [ClienteController::class, 'login'])->name('cliente.login');
Route::get('/cliente/register', [ClienteController::class, 'register'])->name('cliente.register');
Route::post('/cliente/crear', [ClienteController::class, 'crear'])->name('cliente.crear');


Route::get('/cliente/register', [ClienteController::class, 'register'])->name('cliente.register');

//CONDUCTOR
Route::get('/conductor/login', [ConductorController::class, 'login'])->name('conductor.login');
Route::post('/conductor/iniciar', [ConductorController::class, 'iniciar'])->name('conductor.iniciar');
Route::get('/conductor/register', [ConductorController::class, 'register'])->name('conductor.register');
Route::post('/conductor/crear', [ConductorController::class, 'crear'])->name('conductor.crear');

//Uber-> Auto
Route::get('/uber/register', [UberController::class, 'register'])->name('uber.register');
Route::post('/uber/crear', [UberController::class, 'crear'])->name('uber.crear');
