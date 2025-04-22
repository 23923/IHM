<?php

namespace App\Http\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormateurMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || Auth::user()->role !== 'formateur') {
            abort(403, 'Accès réservé aux formateurs.');
        }

        return $next($request);
    }
}