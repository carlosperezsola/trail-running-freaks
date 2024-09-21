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
            if ($request->user()->type_user == 'third-party') {
                return redirect()->route('third_party_user.dashboard');
            } elseif ($request->user()->type_user == 'admin') {
                return redirect()->route('admin_user.dashboard');
            } else {
                return redirect()->route('user.dashboard');
            }
        }

        return $next($request);
    }
}
