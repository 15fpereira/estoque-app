<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TipoUsuarioMiddleware
{
    public function handle(Request $request, Closure $next, ...$tipos)
    {
        $usuario = $request->user();

        if (!$usuario || !in_array($usuario->tipo, $tipos)) {
            return response()->json(['message' => 'Acesso não autorizado'], 403);
        }

        return $next($request);
    }
}
