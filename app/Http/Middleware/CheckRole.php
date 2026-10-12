<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Verifica si el usuario autenticado tiene alguno de los roles permitidos.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = Auth::user();

        // Si no hay sesión iniciada
        if (!$user) {
            return redirect()->route('login');
        }

        // Si el usuario no tiene rol asignado
        if (!$user->rol) {
            abort(403, 'Tu cuenta no tiene un rol asignado.');
        }

        // Verificar si el rol del usuario está entre los permitidos
        if (!in_array($user->rol->descripcion, $roles)) {
            abort(response()->view('errores.404', [], 403));
        }

        // Continuar con la petición
        return $next($request);
    }
}
