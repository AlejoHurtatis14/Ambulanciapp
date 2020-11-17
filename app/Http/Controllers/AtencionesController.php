<?php

namespace App\Http\Controllers;

use App\atenciones;
use App\ambulancias;
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
        $guardado = true;
        $atencion = new atenciones;
        $atencion->latitudInicial = $request->latitudInicial;
        $atencion->longitudInicial = $request->longitudInicial;
        $atencion->latitudFinal = $request->latitudFinal;
        $atencion->longitudFinal = $request->longitudFinal;
        $atencion->estado = $request->estado;
        $atencion->fk_usuario = +$request->usuario;
        if ($atencion->save()) {
            $guardado = true;
        }
        return array(
            "success" => $guardado,
            "mensaje" => ($guardado ? "Datos guardados." : "Error al guardar los datos."),
            "idAtencion" => ($guardado ? $atencion->id : null)
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
        $update = array(
            "estado" => $request->estado
        );
        if (!$request->editarEstado) {
            $ambulancia = ambulancias::where('fk_enfermero_uno', +$request->enfermero)->orWhere('fk_enfermero_dos', +$request->enfermero)->get();
            $add = array(
                "fk_enfermero" => $request->enfermero,
                "fk_empresa" => $request->empresa,
                "fk_ambulancia" => ($ambulancia[0] ? $ambulancia[0]['id'] : null)
            );
            $update = array_merge($update, $add);
        };
        $result = atenciones::where('id', +$request['idAtencion'])->update($update);
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
