<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TypeUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $typeUser): Response
    {
        if ($request->user()->type_user !== $typeUser) {
            // Redirigir a la ruta de dashboard específica según el tipo de usuario
            switch ($request->user()->type_user) {
                case 'admin_user':
                    return redirect()->route('admin_user.dashboard');
                case 'third-party':
                    return redirect()->route('third_party_user.dashboard');
                case 'user':
                    return redirect()->route('user.profile');
            }
        }

        return $next($request);
    }

}
