<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware(['guest'])->group(function () {
    Route::group(['middleware' => ['cors']], function () {
        Route::post('usuarios/crear/{datos}', 'UsuariosController@create');
        Route::get('login/{usuario}/{password}', 'UsuariosController@iniciarSesion');
    });
});

Route::middleware('validarInicioSesion')->group( function () {
    Route::group(['middleware' => ['cors']], function () {
        
        /* Rutas para ir a las consultas de los usuarios */
        Route::get('usuarios/listar/{empresa}/{estado}', 'UsuariosController@obtenerUsuarios');
        Route::get('usuarios/inactivar/{idUsuario}', 'UsuariosController@inactivaActivarUsuario');
        Route::get('usuarios/obtener/{columna}/{valor}', 'UsuariosController@obtenerUsuario');
        Route::get('usuarios/empresa/{empresa}/{perfil}', 'UsuariosController@obtenerUsuariosEmpresa');
        Route::put('usuarios/actualizar/{datos}', 'UsuariosController@update');

        /* Rutas para ir a las consultas de las ambulancias */
        Route::post('ambulancia/crear', 'AmbulanciasController@create');
        Route::get('ambulancia/listar/{empresa}/{estado}', 'AmbulanciasController@obtenerAmbulancias');
        Route::get('ambulancia/obtener/{columna}/{valor}', 'AmbulanciasController@obtenerAmbulancia');
        Route::get('ambulancia/inactivar/{idAmbulancia}', 'AmbulanciasController@inactivaActivarAmbulancia');
        Route::put('ambulancia/actualizar', 'AmbulanciasController@update');

        /* Rutas para ir a las consultas de las empresas */
        Route::post('empresa/crear', 'EmpresasController@create');
        Route::get('empresa/listar/{estado}', 'EmpresasController@obtenerEmpresas');
        Route::get('empresa/inactivar/{idEmpresa}', 'EmpresasController@inactivaActivarEmpresa');
        Route::get('empresa/obtener/{columna}/{valor}', 'EmpresasController@obtenerEmpresa');
        Route::put('empresa/actualizar', 'EmpresasController@update');

        /* Rutas para ir a las consultas de las atenciones de las ambulancias */
        Route::post('atencion/crear', 'AtencionesController@create');
        Route::get('atencion/listar/{empresa}/{estado}', 'AtencionesController@obtenerAtenciones');

        /* Rutas para ir a las consultas de los perfiles */
        Route::get('perfil/listar/{estado}', 'PerfilesController@obtenerPerfiles');
        Route::get('perfil/listar/empresa/{estado}/{empresa}', 'PerfilesController@obtenerPerfilesEmpresa');

        /* Rutas para ir a las consultas de los tipos de prestadores */
        Route::get('prestador/listar/{estado}', 'TipoPrestadoresController@obtenerPrestadores');

    });
});
