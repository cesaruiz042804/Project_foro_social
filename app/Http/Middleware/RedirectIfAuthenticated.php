<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verifica si el usuario ya está autenticado
        if (Auth::check()) {
            // Si está autenticado, redirige a la ruta de inicio (puedes cambiar 'home' por la ruta que desees)
            return redirect()->route('home'); // Cambia 'home' al nombre de tu ruta de inicio si es necesario
        }

        return $next($request);
    }
}
