<?php

namespace App\Http\Controllers;

use App\tipo_prestadores;
use Illuminate\Http\Request;

class TipoPrestadoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\tipo_prestadores  $tipo_prestadores
     * @return \Illuminate\Http\Response
     */
    public function show(tipo_prestadores $tipo_prestadores)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\tipo_prestadores  $tipo_prestadores
     * @return \Illuminate\Http\Response
     */
    public function edit(tipo_prestadores $tipo_prestadores)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\tipo_prestadores  $tipo_prestadores
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tipo_prestadores $tipo_prestadores)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\tipo_prestadores  $tipo_prestadores
     * @return \Illuminate\Http\Response
     */
    public function destroy(tipo_prestadores $tipo_prestadores)
    {
        //
    }

    public function obtenerPrestadores($estado) {
        $prestadores = tipo_prestadores::where('estado', $estado)->get();
        return array(
            "success" => ($prestadores->isEmpty() ? false : true),
            "mensaje" => ($prestadores->isEmpty() ? 'No hay prestadores disponibles.' : 'Aqui tenemos tus prestadores.'),
            "datos" => $prestadores
        );
    }

}
