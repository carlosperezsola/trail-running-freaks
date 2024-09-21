<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if ($request->user()->type_user !== $typeUser) {
                    if ($request->user()->type_user == 'third-party') {
                        return redirect()->route('third_party_user.dashboard');
                    } elseif ($request->user()->type_user == 'admin') {
                        return redirect()->route('admin_user.dashboard');
                    } else {
                        return redirect(RouteServiceProvider::HOME);
                    }
                }
            }
        }

        return $next($request);
    }
}
