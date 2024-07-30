<?php

namespace App\Http\Middleware;

use App\Models\Nasabah;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ValidateUserRoleMiddleware
{

    public function handle(Request $request, Closure $next): Response|RedirectResponse
    {
        $userId = Auth::id();
        $userRole = Auth::user()->role;

        if ($userId && $userRole === 'nasabah') {
            if (Nasabah::where('user_id', $userId)->exists()) {
                return $next($request);
            }

            return to_route('form-nasabah', ['id' => $userId]);
        }

        return $next($request);

    }
}
