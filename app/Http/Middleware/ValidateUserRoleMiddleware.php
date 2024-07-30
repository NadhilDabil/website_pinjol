<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ValidateUserRoleMiddleware
{
    public function handle(Request $request, Closure $next): Response|RedirectResponse
    {
        if (!Auth::check()) {
            return redirect('/');
        }

        return $next($request);
    }
}
