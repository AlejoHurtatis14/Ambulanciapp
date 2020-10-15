<?php

namespace App\Http\Controllers;

use App\empresas;
use App\usuarios;
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
        $empresas = empresas::where('documento', $request->documento)->get();
        if ($empresas->isEmpty()) {
            $empresa = new empresas;
            $empresa->razon_social = $request->razonSocial;
            $empresa->documento = $request->documento;
            $empresa->telefono = $request->telefono;
            $empresa->direccion = $request->direccion;
            $empresa->email = $request->email;
            $empresa->estado = +$request->estado;
            $empresa->fk_prestador = +$request->prestador;
            if ($empresa->save()) {
                $usuario = new usuarios;
                $usuario->documento = $request->documento;
                $usuario->nombres = $request->razonSocial;
                $usuario->apellidos = '';
                $usuario->telefono = $request->telefono;
                $usuario->direccion = $request->direccion;
                $usuario->password = $request->documento;
                $usuario->email = $request->email;
                $usuario->estado = +$request->estado;
                $usuario->fk_perfil = 2;
                $usuario->fk_empresa = $empresa->id;
                error_log($usuario);
                if ($usuario->save()) {
                    return array(
                        "success" => true,
                        "mensaje" => "Se ha creado la empresa"
                    );
                }
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
        $mensaje = "Este documento ya existe.";
        $empresa = empresas::where('documento', $request->documento)->get();
        if ($empresa->isEmpty() || ($empresa[0] && $empresa[0]['id'] === +$request['idEmpresa'])) {
            $resul = empresas::where('id', +$request['idEmpresa'])->update([
                "razon_social" => $request->razonSocial,
                "documento" => $request->documento,
                "telefono" => $request->telefono,
                "direccion" => $request->direccion,
                "email" => $request->email,
                "fk_prestador" => +$request->prestador,
            ]);
            if($resul){
                return array(
                    "success" => true,
                    "mensaje" => 'Modificado correctamente.'
                );
            } else {
                $mensaje = "Error al modificar.";
            }
        }
        return array(
            "success" => false,
            "mensaje" => $mensaje,
        );
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

    public function obtenerEmpresa($columna, $valor) {
        $empresa = empresas::where($columna, $valor)->get();
        return array(
            "success" => ($empresa->isEmpty() ? false : true),
            "mensaje" => ($empresa->isEmpty() ? 'La empresa no existe.' : ''),
            "datos" => $empresa,
        );
    }

}
