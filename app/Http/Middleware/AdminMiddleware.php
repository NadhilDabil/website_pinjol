<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{

    public function handle(Request $request, Closure $next, $role): Response
    {
        dd($role);
        if (Auth::user()->role == $role ) {
            return $next($request);
        }
        return abort(403, "Kamu TIdak memiliki Akses!");
    }
}
