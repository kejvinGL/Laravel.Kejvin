<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (auth()->user()->role->name == $role) {
            return $next($request);
        } else {
            $route = match ($role){
                'admin' => 'home',
                'client' => 'overall'
            };
            return redirect()->route($route);
        }
    }
}
