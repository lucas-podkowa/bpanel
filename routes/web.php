<?php

use App\Http\Controllers\AsistenteController;
use App\Http\Controllers\SalaController;
use App\Http\Controllers\XmlController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//ruta utilizando controlador. llamo a la clase que contiene el metodo pasado como parametro en un array
Route::get('/', [XmlController::class, 'index'])->name('sesiones.index');
Route::get('/salas', [SalaController::class, 'index'])->name('salas.index');

Route::get('/ver', [XmlController::class, 'show']);
//Route::get('/sesiones', [XmlController::class, 'sesiones']);

Route::get('/a', [SalaController::class, 'actualizar']);
Route::get('/show', [SalaController::class, 'show']);


Route::get('/asistentes', [AsistenteController::class, 'index'])->name('asistentes.index');
Route::get('/asistentes/store', [AsistenteController::class, 'store'])->name('asistentes.store');
Route::get('/asistentes/{show}', [AsistenteController::class, 'show'])->name('asistentes.show');



//ruta estatica
Route::get('ruta1', function () {
    return "bienvenido a la ruta 1";
});

//ruta estatica a la que le mando una variable como subruta
Route::get('ruta/{numeroRuta}', function ($numeroRuta) {
    return "bienvenido a la ruta: $numeroRuta";
});


//puede que una variable no siempre llegue, entonces la colocamos con un signo ? y en la funcion la tenemos que inicializar en null
//si no llega la variable, es inicializada como nula, pero si llega es reemplazada en la ruta
Route::get('ruta/{main_ruta}/{sub_ruta?}', function($main_ruta, $sub_ruta = null) {
    return "bienvenido a la ruta: $main_ruta de la sub_ruta $sub_ruta";
});
