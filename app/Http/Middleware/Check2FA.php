<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Check2FA
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Skip 2FA check for 2FA verification routes
        if ($request->is('2fa/verify*')) {
            return $next($request);
        }

        if (auth()->check() && auth()->user()->google2fa_enabled) {
            if (!$request->session()->has('2fa_verified')) {
                return redirect()->route('2fa.verify');
            }
        }

        return $next($request);
    }
}
