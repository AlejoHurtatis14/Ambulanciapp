<?php

namespace App\Http\Controllers;

use App\perfiles;
use Illuminate\Http\Request;

class PerfilesController extends Controller
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
     * @param  \App\perfiles  $perfiles
     * @return \Illuminate\Http\Response
     */
    public function show(perfiles $perfiles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\perfiles  $perfiles
     * @return \Illuminate\Http\Response
     */
    public function edit(perfiles $perfiles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\perfiles  $perfiles
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, perfiles $perfiles)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\perfiles  $perfiles
     * @return \Illuminate\Http\Response
     */
    public function destroy(perfiles $perfiles)
    {
        //
    }

    public function obtenerPerfiles($estado) {
        $perfiles = perfiles::where('estado', $estado)->get();
        return array(
            "success" => ($perfiles->isEmpty() ? false : true),
            "mensaje" => ($perfiles->isEmpty() ? 'No hay perfiles disponibles.' : 'Aqui tenemos tus perfiles.'),
            "datos" => $perfiles
        );
    }

    public function obtenerPerfilesEmpresa ($estado, $empresa) {
        $perfiles = perfiles::where('estado', $estado)->where('empresa', $empresa)->get();
        return array(
            "success" => ($perfiles->isEmpty() ? false : true),
            "mensaje" => ($perfiles->isEmpty() ? 'No hay perfiles disponibles.' : 'Aqui tenemos tus perfiles.'),
            "datos" => $perfiles
        );
    }

}
