<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {

        if (!Auth::check()) {
            return redirect('/login');
        }

        $authUserRole = Auth::user()->tipo_usuario;

        switch ($role) {
            case 'admin':
                if ($authUserRole !== 'admin') {
                    return $next($request);
                }
                break;

            case 'donante':
                if ($authUserRole !== 'donante') {
                    return $next($request);
                }
                break;

            case 'receptor':
                if ($authUserRole !== 'receptor') {
                    return $next($request);
                }
                break;
        }

        switch ($authUserRole) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'donante':
                return redirect()->route('dashboard');
            case 'receptor':
                return redirect()->route('dashboard');
            default:
                return redirect('/login');
        }
    }
}
