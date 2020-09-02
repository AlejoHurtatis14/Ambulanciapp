<?php

namespace App\Http\Controllers;

use App\empresas;
use Illuminate\Http\Request;

class EmpresasController extends Controller
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
        $mensaje = "Este documento ya existe.";
        $empresa = empresas::where('documento', $request->documento)->get();
        if ($empresa->isEmpty()) {
            $empresa = new empresas;
            $empresa->razon_social = $request->razonSocial;
            $empresa->documento = $request->documento;
            $empresa->telefono = $request->telefono;
            $empresa->direccion = $request->direccion;
            $empresa->email = $request->email;
            $empresa->estado = $request->estado;
            $empresa->fk_prestador = $request->prestador;
            if ($empresa->save()) {
                return array(
                    "success" => true,
                    "mensaje" => "Se ha creado la empresa"
                );
            } else {
                $mensaje = "No se ha podido crear la empresa.";
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
     * @param  \App\empresas  $empresas
     * @return \Illuminate\Http\Response
     */
    public function show(empresas $empresas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\empresas  $empresas
     * @return \Illuminate\Http\Response
     */
    public function edit(empresas $empresas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\empresas  $empresas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, empresas $empresas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\empresas  $empresas
     * @return \Illuminate\Http\Response
     */
    public function destroy(empresas $empresas)
    {
        //
    }

    public function inactivaActivarEmpresa($idEmpresa) {
        $empresa = empresas::where('id', $idEmpresa)->get();
        if (!$empresa->isEmpty()) {
            $result = empresas::where('id', $idEmpresa)->update(['estado' => ($empresa[0]['estado'] == 1 ? 0 : 1) ]);
            return array(
                "success" => true,
                "mensaje" => "empresa " . ($empresa[0]['estado'] == 1 ? 'inactivada' : 'activada') . " correctamente."
            );
        }
        return array(
            "success" => false,
            "mensaje" => 'La empresa no existe.'
        );
    }

    public function obtenerEmpresas($estado) {
        $empresas = [];
        if ($estado !== '') {
            $empresas = empresas::where('estado', $estado)->get();
        } else {
            $empresas = empresas::get();
        }
        return array(
            "success" => ($empresas->isEmpty() ? false : true),
            "mensaje" => ($empresas->isEmpty() ? 'No hay empresas disponibles.' : 'Aqui tenemos tus empresas.'),
            "datos" => $empresas
        );
    }

}
