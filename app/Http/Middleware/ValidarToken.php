<?php

namespace App\Http\Middleware;
use Closure;
use App\Settings\JwtLogin;
use Illuminate\Http\JsonResponse;

class ValidarToken {
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next) {
    $token = $request->header('Authorization', null);
    $tiempoToken = $request->header('tokenTime', null);
    if ($token && time() < $tiempoToken) {
      $jwt = new JwtLogin();
      $tokenValido = $jwt->verificarToken($token);
      if ($tokenValido) {
        return $next($request);
      } else {
        $mensaje = 'Token es invalido';
      }
    } else {
      $mensaje = ($token ? 'Sesión expirada' : 'No hay token para validar.');
    }
    return new JsonResponse(array(
      'success' => false,
      'token' => true,
      'msj' => $mensaje
    ), 200);
  }

}
