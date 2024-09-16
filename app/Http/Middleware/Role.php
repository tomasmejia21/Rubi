<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $roles)
    {
        $roleName = session('role_name');
        $newRol = explode('|', $roles);
        $roleName = strtolower($roleName);
        
        if (!in_array($roleName, $newRol)) {
            return abort(403, __('Unauthorized'));
        }
        
        return $next($request);
    }
}
