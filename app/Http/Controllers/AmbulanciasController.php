<?php

namespace App\Http\Controllers;

use App\ambulancias;
use Illuminate\Http\Request;

class AmbulanciasController extends Controller
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
    public function create(Request $request)
    {
        $mensaje = "El código de la ambulancia ya existe.";
        $validarCodigo = ambulancias::where('codigo', $request->codigo)->get();
        if ($validarCodigo->isEmpty()) {
            $ambulancia = new ambulancias;
            $ambulancia->codigo = $request->codigo;
            $ambulancia->placa = $request->placa;
            $ambulancia->estado = $request->estado;
            $ambulancia->fk_empresa = $request->empresa;
            $ambulancia->fk_conductor = $request->conductor;
            $ambulancia->fk_enfermero_uno = $request->enfermeroUno;
            $ambulancia->fk_enfermero_dos = $request->enfermeroDos;
            if ($ambulancia->save()) {
                return array(
                    "success" => true,
                    "mensaje" => "Se ha creado la ambulancia"
                );
            } else {
                $mensaje = "No se ha podido crear la ambulancia.";
            }
        }
        return array(
            "success" => false,
            "mensaje" => $mensaje,
        );
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
     * @param  \App\ambulancias  $ambulancias
     * @return \Illuminate\Http\Response
     */
    public function show(ambulancias $ambulancias)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ambulancias  $ambulancias
     * @return \Illuminate\Http\Response
     */
    public function edit(ambulancias $ambulancias)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ambulancias  $ambulancias
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ambulancias $ambulancias)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ambulancias  $ambulancias
     * @return \Illuminate\Http\Response
     */
    public function destroy(ambulancias $ambulancias)
    {
        //
    }

    public function inactivaActivarAmbulancia($idAmbulancia) {
        $ambulancia = ambulancias::where('id', $idAmbulancia)->get();
        if (!$ambulancia->isEmpty()) {
            $result = ambulancias::where('id', $idAmbulancia)->update(['estado' => ($ambulancia[0]['estado'] == 1 ? 0 : 1) ]);
            return array(
                "success" => true,
                "mensaje" => "Ambulancia " . ($ambulancia[0]['estado'] == 1 ? 'inactivada' : 'activada') . " correctamente."
            );
        }
        return array(
            "success" => false,
            "mensaje" => 'La ambulancia no existe.'
        );
    }

    public function obtenerAmbulancias($empresa, $estado) {
        $ambulancias = [];
        if ($estado !== '') {
            $ambulancias = ambulancias::where('estado', $estado)->where('fk_empresa', $empresa)->get();
        } else {
            $ambulancias = ambulancias::where('fk_empresa', $empresa)->get();
        }
        return array(
            "success" => ($ambulancias->isEmpty() ? false : true),
            "mensaje" => ($ambulancias->isEmpty() ? 'No hay ambulancias disponibles.' : 'Aqui tenemos tus ambulancias.'),
            "datos" => $ambulancias
        );
    }

}
