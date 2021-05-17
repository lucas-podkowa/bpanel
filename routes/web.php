<?php

use App\Http\Controllers\AsistenteController;
use App\Http\Controllers\SalaController;
use App\Http\Controllers\XmlController;
use Illuminate\Support\Facades\Route;


//llamada al presionar "Ahora"
Route::get('/', [XmlController::class, 'index'])->name('sesiones.index');

//llamada al presionar "Historial"
Route::get('/salas', [SalaController::class, 'index'])->name('salas.index');

//funcion para actualizar las salas en la BD
Route::get('/salas/store', [SalaController::class, 'store'])->name('salas.store');

//llamado al presionar los botones de las tablas tanto de "Ahora" como de "Hitorial"
Route::get('/salas/{show}', [SalaController::class, 'show',])->name('asistentes.show');

//muestra todos los asistentes actuales sin considerar las salas donde esten
Route::get('/asistentes', [AsistenteController::class, 'index'])->name('asistentes.index');

//funcion para actualizar los asistentes de las salas almacenadas
Route::get('/asistentes/store', [AsistenteController::class, 'store'])->name('asistentes.store');




// //ruta estatica
// Route::get('ruta1', function () {
//     return "bienvenido a la ruta 1";
// });

// //ruta estatica a la que le mando una variable como subruta
// Route::get('ruta/{numeroRuta}', function ($numeroRuta) {
//     return "bienvenido a la ruta: $numeroRuta";
// });

// //puede que una variable no siempre llegue, entonces la colocamos con un signo ? y en la funcion la tenemos que inicializar en null
// //si no llega la variable, es inicializada como nula, pero si llega es reemplazada en la ruta
// Route::get('ruta/{main_ruta}/{sub_ruta?}', function($main_ruta, $sub_ruta = null) {
//     return "bienvenido a la ruta: $main_ruta de la sub_ruta $sub_ruta";
// });
