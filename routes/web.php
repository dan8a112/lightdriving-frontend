<?php

use App\Http\Controllers\ClienteController;
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