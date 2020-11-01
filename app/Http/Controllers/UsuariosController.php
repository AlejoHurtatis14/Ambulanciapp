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
    public function create(Request $request, $datos)
    {
        $datos = json_decode($datos);
        $mensaje = "El correo electronico ya existe.";
        $validarCorreo = usuarios::where('email', $datos->email)->get();
        if ($validarCorreo->isEmpty()) {
            $usuario = new usuarios;
            $usuario->documento = $datos->documento;
            $usuario->nombres = $datos->nombres;
            $usuario->apellidos = $datos->apellidos;
            $usuario->telefono = $datos->telefono;
            $usuario->direccion = $datos->direccion;
            $usuario->password = $datos->clave;
            $usuario->email = $datos->email;
            $usuario->estado = +$datos->estado;
            $usuario->fk_perfil = +$datos->perfil;
            $usuario->fk_empresa = ($datos->empresa !== 'null' ? +$datos->empresa : null);
            if ($usuario->save()) {
                error_log("Usuario " . $usuario);
                return array(
                    "success" => true,
                    "mensaje" => "Se ha creado el usuario",
                    "idInsertado" => $usuario->id,
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
    public function update(Request $request, usuarios $usuarios, $datos)
    {
        $datos = json_decode($datos);
        $mensaje = "Este documento ya existe.";
        $usuario = usuarios::where('documento', $datos->documento)->get();
        if ($usuario->isEmpty() || ($usuario[0] && $usuario[0]['id'] === +$datos->idUsuario)) {
            $resul = usuarios::where('id', +$datos->idUsuario)->update([
                "documento" => $datos->documento,
                "nombres" => $datos->nombres,
                "apellidos" => $datos->apellidos,
                "telefono" => $datos->telefono,
                "direccion" => $datos->direccion,
                "password" => $datos->clave,
                "email" => $datos->email,
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

    public function obtenerUsuario($columna, $valor) {
        $usuario = usuarios::where($columna, $valor)->get();
        return array(
            "success" => ($usuario->isEmpty() ? false : true),
            "mensaje" => ($usuario->isEmpty() ? 'El usuario no existe.' : ''),
            "datos" => $usuario
        );
    }

    public function obtenerUsuariosEmpresa($empresa, $perfil) {
        $usuarios = usuarios::where('fk_empresa', $empresa)->where('fk_perfil', $perfil)->get();
        return array(
            "success" => ($usuarios->isEmpty() ? false : true),
            "mensaje" => ($usuarios->isEmpty() ? 'No hay datos.' : ''),
            "datos" => $usuarios
        );
    }

}
