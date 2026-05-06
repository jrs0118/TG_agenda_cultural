<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerificarPermiso
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $permiso
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $permiso)
    {
        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        // Verificar si el usuario tiene el permiso requerido
        if (!Auth::user()->tienePermiso($permiso)) {
            abort(403, 'No tienes permiso para acceder a esta sección.');
        }
        
        return $next($request);
    }
}