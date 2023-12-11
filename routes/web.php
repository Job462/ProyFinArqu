<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\ReservaClienteController;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get('users/pdf', [ClienteController::class,'pdf'] )->name('users.pdf');
Route::get('reservas/pdf', [ReservaController::class,'pdf'] )->name('reservas.pdf');
Route::put('/reservas/{id}/cancelar',[ReservaController::class,'cancelar'] )->name('reservas.cancelar');
Route::put('/reservasCliente/{id}/cancelar',[ReservaClienteController::class,'cancelar'] )->name('reservasCliente.cancelar');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home'); 

Route::resource('users',ClienteController::class);
Route::resource('/reservas',ReservaController::class);
Route::resource('/horarios',HorarioController::class);

Route::resource('/reservasCliente', ReservaClienteController::class);

Route::get('/misreservas', [ReservaClienteController::class, 'misReservas'])->name('reservasCliente.reservascliente');



// Ruta para procesar la actualización de la reserva
Route::put('misreservas', [ReservaClienteController::class, 'misReservas'])->name('misreservas');

//Rutas del perfil


Route::get('/perfil/editar', [PerfilController::class, 'edit'])->name('perfil.editar');

Route::put('/perfil/actualizar', [PerfilController::class, 'update'])->name('perfil.actualizar');


