<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminOnly
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Pastikan user login
        if (!Auth::check()) {
            abort(403, 'Akses ditolak');
        }

        // Pastikan role admin
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses ditolak');
        }

        return $next($request);
    }
}
