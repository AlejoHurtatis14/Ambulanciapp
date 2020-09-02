<?php

namespace App\Http\Controllers;

use App\usuarios;
use Illuminate\Http\Request;
use App\Settings\JwtLogin;

class UsuariosController extends Controller
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
        $mensaje = "El correo electronico ya existe.";
        $validarCorreo = usuarios::where('email', $request->correo)->get();
        if ($validarCorreo->isEmpty()) {
            $usuario = new usuarios;
            $usuario->documento = $request->documento;
            $usuario->nombres = $request->nombres;
            $usuario->apellidos = $request->apellidos;
            $usuario->telefono = $request->telefono;
            $usuario->direccion = $request->direccion;
            $usuario->password = $request->clave;
            $usuario->email = $request->email;
            $usuario->estado = $request->estado;
            $usuario->fk_perfil = $request->fk_perfil;
            $usuario->fk_empresa = $request->fk_empresa;
            if ($usuario->save()) {
                return array(
                    "success" => true,
                    "mensaje" => "Se ha creado el usuario"
                );
            } else {
                $mensaje = "No se ha podido crear el usuario.";
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
     * @param  \App\usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function show(usuarios $usuarios)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function edit(usuarios $usuarios)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, usuarios $usuarios)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function destroy(usuarios $usuarios)
    {
        //
    }

    public function iniciarSesion($usuario, $password) {
        $message = 'Revisa tu usuario y contraseña.';
        $usuario = usuarios::where(array('email' => $usuario, 'password' => $password))->first();
        if (is_object($usuario)) {
            if ($usuario->estado === 1) {
                $jwt = new JwtLogin();
                $token = $jwt->generarToken($usuario->id, $usuario->nombres, $usuario->password);
                $validarToken = $jwt->verificarToken($token, true);
                return array(
                        'success' => true,
                        'token' => $token,
                        'tokenTiempo' => $validarToken,
                        'usuario' => $usuario
                );
            } else {
                $message = 'Usuario inactivo, comunicate con el administrador.';
            }
        }
        return array( 'success' => false, 'mensaje' => $message);
    }

    public function inactivaActivarUsuario($idUsuario) {
        $usuario = usuarios::where('id', $idUsuario)->get();
        if (!$usuario->isEmpty()) {
            $result = usuarios::where('id', $idUsuario)->update(['estado' => ($usuario[0]['estado'] == 1 ? 0 : 1) ]);
            return array(
                "success" => true,
                "mensaje" => "Usuario " . ($usuario[0]['estado'] == 1 ? 'inactivado' : 'activado') . " correctamente."
            );
        }
        return array(
            "success" => false,
            "mensaje" => 'El usuario no existe.'
        );
    }

    public function obtenerUsuarios($empresa, $estado) {
        $usuarios = [];
        if ($estado !== '') {
            $usuarios = usuarios::where('estado', $estado)->where('fk_empresa', $empresa)->get();
        } else {
            $usuarios = usuarios::where('fk_empresa', $empresa)->get();
        }
        return array(
            "success" => ($usuarios->isEmpty() ? false : true),
            "mensaje" => ($usuarios->isEmpty() ? 'No hay usuarios disponibles.' : 'Aqui tenemos tus usuarios.'),
            "datos" => $usuarios
        );
    }

}
