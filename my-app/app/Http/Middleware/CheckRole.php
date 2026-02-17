<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Verificar si el usuario autenticado tiene el rol adecuado
        if (auth()->check() && auth()->user()->role == $role) {
            return $next($request);
        }

        // Si no tiene el rol adecuado, redirigir al usuario
        return redirect('/')->with('error', 'Acceso denegado');
    }
}
