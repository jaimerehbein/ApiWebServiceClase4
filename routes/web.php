<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(["prefix" => "apis"], function() {
    Route::resource('/usuario', 'usuarioController', [
        "only" => ["index", "store", "show", "update", "destroy"]
    ]);
    
    Route::resource('/evento', 'eventoController', [
        "only" => ["index", "store", "show", "update", "destroy"]
    ]);
    
    Route::resource('/registrousuario', 'registroUsuarioController', [
        "only" => ["index", "store", "show", "update", "destroy"]
    ]);
});

