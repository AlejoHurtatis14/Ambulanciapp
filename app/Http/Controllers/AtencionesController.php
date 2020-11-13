<?php

namespace App\Http\Controllers;

use App\atenciones;
use Illuminate\Http\Request;

class AtencionesController extends Controller
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
        $atencion = new atenciones;
        $atencion->latitudInicial = $request->latitudInicial;
        $atencion->longitudInicial = $request->longitudInicial;
        $atencion->latitudFinal = $request->latitudFinal;
        $atencion->longitudFinal = $request->longitudFinal;
        $atencion->estado = $request->estado;
        $atencion->fk_enfermero = +$request->enfermero;
        $atencion->fk_usuario = +$request->usuario;
        $atencion->fk_empresa = +$request->empresa;
        $atencion->fk_ambulancia = +$request->ambulancia;
        if ($atencion->save()) {
            return array(
                "success" => true,
                "mensaje" => "Datos guardados."
            );
        }
        return array(
            "success" => false,
            "mensaje" => "Error al guardar los datos.",
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
     * @param  \App\atenciones  $atenciones
     * @return \Illuminate\Http\Response
     */
    public function show(atenciones $atenciones)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\atenciones  $atenciones
     * @return \Illuminate\Http\Response
     */
    public function edit(atenciones $atenciones)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\atenciones  $atenciones
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, atenciones $atenciones)
    {
        $result = atenciones::where('id', +$request['idAtencion'])->update(["estado" => $request->estado]);
        return array(
            "success" => ($result ? true : false),
            "mensaje" => ($result ? 'Modificado Correctamente' : 'Error al modificar.')
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\atenciones  $atenciones
     * @return \Illuminate\Http\Response
     */
    public function destroy(atenciones $atenciones)
    {
        //
    }

    public function obtenerAtenciones($empresa, $estado) {
        $atenciones = [];
        if ($estado !== 'Todos') {
            $atenciones = atenciones::where('estado', $estado)->where('fk_empresa', $empresa)->get();
        } else {
            $atenciones = atenciones::where('fk_empresa', $empresa)->get();
        }
        return array(
            "success" => ($atenciones->isEmpty() ? false : true),
            "mensaje" => ($atenciones->isEmpty() ? 'No hay atenciones disponibles.' : 'Aqui tenemos tus atenciones.'),
            "datos" => $atenciones
        );
    }

    public function obtenerAtencionesColumna($columna, $valor) {
        $atencion = atenciones::where($columna, $valor)->get();
        return array(
            "success" => ($atencion->isEmpty() ? false : true),
            "mensaje" => ($atencion->isEmpty() ? 'No hay datos.' : ''),
            "datos" => $atencion,
        );
    }

}
